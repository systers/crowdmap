<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Download Reports Controller.
 * This controller will take care of downloading reports.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author Marco Gnazzo
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

Class Download_Controller extends Main_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->template->this_page = 'download';
		$this->template->header->this_page = 'download';
		$this->template->content = new View('download_reports');
		$this->template->content->calendar_img = url::base() . "media/img/icon-calendar.gif";
		$this->template->content->title = Kohana::lang('ui_admin.download_reports');

		// Javascript Header
		$this->themes->js = new View('download_reports_js');
		$this->themes->js->calendar_img = url::base() . "media/img/icon-calendar.gif";
		$this->themes->treeview_enabled = TRUE;

		$this->template->header->header_block = $this->themes->header_block();
		$this->template->footer->footer_block = $this->themes->footer_block();

		// Select first and last incident
		$from = orm::factory('incident')->orderby('incident_date', 'asc')->find();
		$to = orm::factory('incident')->orderby('incident_date', 'desc')->find();

		$from_date = substr($from->incident_date, 5, 2) . "/" . substr($from->incident_date, 8, 2) . "/" . substr($from->incident_date, 0, 4);

		$to_date = substr($to->incident_date, 5, 2) . "/" . substr($to->incident_date, 8, 2) . "/" . substr($to->incident_date, 0, 4);

		$form = array('category' => '', 'verified' => '', 'category_all' => '', 'from_date' => '', 'to_date' => '', 'filter_search' => '');

		$errors = $form;
		$form_error = FALSE;
		$form['from_date'] = $from_date;
		$form['to_date'] = $to_date;

		if ($_POST)
		{
			// Instantiate Validation, use $post, so we don't overwrite $_POST fields with our own things
			$post = Validation::factory($_POST);

			//  Add some filters
			$post->pre_filter('trim', TRUE);

			// Add some rules, the input field, followed by a list of checks, carried out in order
			$post->add_rules('category.*', 'required', 'numeric');
			$post->add_rules('verified.*', 'required', 'numeric', 'between[0,1]');
			$post->add_rules('formato', 'required', 'numeric', 'between[0,2]');
			$post->add_rules('from_date', 'required', 'date_mmddyyyy');
			$post->add_rules('to_date', 'required', 'date_mmddyyyy');

			// Validate the report dates, if included in report filter
			if (!empty($_POST['from_date']) && !empty($_POST['to_date']))
			{
				// TO Date not greater than FROM Date?
				if (strtotime($_POST['from_date']) > strtotime($_POST['to_date']))
				{
					$post->add_error('to_date', 'range_greater');
				}
			}

			// $post validate check
			if ($post->validate())
			{
				// Check child categories too
				$categories = ORM::factory('category')->select('id')->in('parent_id', $post->category)->find_all();
				foreach($categories as $cat)
				{
					$post->category[] = $cat->id;
				}

				$incident_query = ORM::factory('incident')->select('DISTINCT incident.id')->select('incident.*')->where('incident_active', 1);
				$incident_query->in('category_id', $post->category);

				// If only unverified selected
				if (in_array('0', $post->verified) && !in_array('1', $post->verified))
				{
					$incident_query->where('incident_verified', 0);
				}
				// If only verified selected
				elseif (!in_array('0', $post->verified) && in_array('1', $post->verified))
				{
					$incident_query->where('incident_verified', 1);
				}
				// else - do nothing

				// Report Date Filter
				if (!empty($post->from_date) && !empty($post->to_date))
				{
					// JP: Added the times 00:00:00 for the from_date and 23:59:59 for the to_date; this fixes the bug where reports made on the day of the to_date would not be included since the time was not specified.
					$incident_query->where(array('incident_date >=' => date("Y-m-d 00:00:00", strtotime($post->from_date)), 'incident_date <=' => date("Y-m-d 23:59:59", strtotime($post->to_date))));
				}

				// JP: Search Filter
				if (!empty($post->filter_search))
				{

					$where_string = "";
					$or = "";

					// Stop words that we won't search for
					// Add words as needed!!
					$stop_words = array('the', 'and', 'a', 'to', 'of', 'in', 'i', 'is', 'that', 'it',
						'on', 'you', 'this', 'for', 'but', 'with', 'are', 'have', 'be',
						'at', 'or', 'as', 'was', 'so', 'if', 'out', 'not'
					);

					// Phase 1 - Fetch the search string and perform initial sanitization
					$keyword_raw = preg_replace('#/\w+/#', '', $post->filter_search);

					// Phase 2 - Strip the search string of any HTML and PHP tags that may be present for additional safety
					$keyword_raw = strip_tags($keyword_raw);

					// Phase 3 - Apply Kohana's XSS cleaning mechanism
					$keyword_raw = $this->input->xss_clean($keyword_raw);

					// Database instance
					$db = new Database();

					$keywords = explode(' ', $keyword_raw);
					if (is_array($keywords) AND ! empty($keywords)) 
					{
						array_change_key_case($keywords, CASE_LOWER);
						$i = 0;

						foreach($keywords as $value)
						{
							if ( ! in_array($value,$stop_words) AND ! empty($value))
							{
								// Escape the string for query safety
								$chunk = $db->escape_str($value);

								if ($i > 0)
								{
									$or = ' OR ';
								}

								$where_string = $where_string.$or."(incident_title LIKE '%$chunk%' OR incident_description LIKE '%$chunk%')";
								$i++;
							}
						}
					}

					$incident_query->where($where_string);
				}

				$incidents = $incident_query->join('incident_category', 'incident_category.incident_id', 'incident.id', 'INNER')->orderby('incident_date', 'desc')->find_all();

				// CSV selected
				if ($post->formato == 0)
				{
					$report_csv = "#,INCIDENT TITLE,INCIDENT DATE,LOCATION,DESCRIPTION,CATEGORY,LATITUDE,LONGITUDE,APPROVED,VERIFIED\n";

					foreach ($incidents as $incident)
					{
						$new_report = array();
						array_push($new_report, '"' . $incident->id . '"');
						array_push($new_report, '"' . $this->_csv_text($incident->incident_title) . '"');
						array_push($new_report, '"' . $incident->incident_date . '"');
						array_push($new_report, '"' . $this->_csv_text($incident->location->location_name) . '"');
						array_push($new_report, '"' . $this->_csv_text($incident->incident_description) . '"');

						$catstring = '"';
						$catcnt = 0;

						foreach ($incident->incident_category as $category)
						{
							if ($catcnt > 0)
							{
								$catstring .= ",";
							}
							if ($category->category->category_title)
							{
								$catstring .= $this->_csv_text($category->category->category_title);
							}
							$catcnt++;
						}

						$catstring .= '"';
						array_push($new_report, $catstring);
						array_push($new_report, '"' . $incident->location->latitude . '"');
						array_push($new_report, '"' . $incident->location->longitude . '"');

						if ($incident->incident_active)
						{
							array_push($new_report, "YES");
						}
						else
						{
							array_push($new_report, "NO");
						}

						if ($incident->incident_verified)
						{
							array_push($new_report, "YES");
						}
						else
						{
							array_push($new_report, "NO");
						}

						array_push($new_report, "\n");

						$repcnt = 0;
						foreach ($new_report as $column)
						{
							if ($repcnt > 0)
							{
								$report_csv .= ",";
							}
							$report_csv .= $column;
							$repcnt++;
						}

					}

					// Output to browser
					header("Content-type: text/x-csv");
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Content-Disposition: attachment; filename=" . time() . ".csv");
					header("Content-Length: " . strlen($report_csv));
					echo $report_csv;
					exit ;
				}

				// KML selected
				else if ($post->formato == 1)
				{
					$categories = ORM::factory('category')->where('category_visible',1)->find_all();

					header("Content-Type: application/vnd.google-earth.kml+xml");
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Content-Disposition: attachment; filename=" . time() . ".kml");

					$view = new View("kml");
					$view->kml_name = htmlspecialchars(Kohana::config('settings.site_name'));
					$view->items = $incidents;
					$view->categories = $categories;
					$view->render(TRUE);
					exit ;
				}

				// JP: HTML selected
				else
				{

					$h = array();

					$h[] = '<!DOCTYPE html>';
					$h[] = '  <head>';
					$h[] = '    <title>';
					$h[] = '      Downloaded Reports';
					$h[] = '    </title>';
					$h[] = '    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
					$h[] = '    <style>';
					$h[] = '      table { border-collapse: collapse; }';
					$h[] = '      table thead tr { background: #CCCCCC; }';
					$h[] = '      table thead tr th, table tbody tr td { padding: 0.75em; border: 1px solid #AAAAAA; }';
					$h[] = '      table tbody tr.even, table tbody tr.alt, table tbody tr:nth-of-type(even) { background: #DDDDDD; }';
					$h[] = '    </style>';
					$h[] = '  </head>';
					$h[] = '  <body>';
					$h[] = '    <table>';
					$h[] = '      <thead>';
					$h[] = '        <tr>';
					$h[] = '          <th>';
					$h[] = '            #';
					$h[] = '          </th>';
					$h[] = '          <th>';
					$h[] = '            TITLE';
					$h[] = '          </th>';
					$h[] = '          <th>';
					$h[] = '            DATE';
					$h[] = '          </th>';
					$h[] = '          <th>';
					$h[] = '            LOCATION';
					$h[] = '          </th>';
					$h[] = '          <th>';
					$h[] = '            DESCRIPTION';
					$h[] = '          </th>';
					$h[] = '          <th>';
					$h[] = '            CATEGORY';
					$h[] = '          </th>';
					$h[] = '          <th>';
					$h[] = '            LATITUDE';
					$h[] = '          </th>';
					$h[] = '          <th>';
					$h[] = '            LONGITUDE';
					$h[] = '          </th>';
					$h[] = '          <th>';
					$h[] = '            APPROVED';
					$h[] = '          </th>';
					$h[] = '          <th>';
					$h[] = '            VERIFIED';
					$h[] = '          </th>';
					$h[] = '        </tr>';
					$h[] = '      </thead>';
					$h[] = '      <tbody>';

					foreach ($incidents as $r)
					{
						$h[] = '        <tr>';
						$h[] = '          <td>';
						$h[] = '            '.$r->id;
						$h[] = '          </td>';
						$h[] = '          <td>';
						$h[] = '            '.$r->incident_title;
						$h[] = '          </td>';
						$h[] = '          <td>';
						$h[] = '            '.$r->incident_date;
						$h[] = '          </td>';
						$h[] = '          <td>';
						$h[] = '            '.$r->location->location_name;
						$h[] = '          </td>';
						$h[] = '          <td>';
						$h[] = '            '.$r->incident_description;
						$h[] = '          </td>';
						$h[] = '          <td>';

						$cats = '';
						$cnt = 0;

						foreach ($r->incident_category as $cat)
						{
							if ($cnt > 0)
							{
								$cats .= ", ";
							}
							if ($cat->category->category_title)
							{
								$cats .= $cat->category->category_title;
							}
							$cnt++;
						}

						$h[] = '            '.$cats;
						$h[] = '          </td>';
						$h[] = '          <td>';
						$h[] = '            '.$r->location->latitude;
						$h[] = '          </td>';
						$h[] = '          <td>';
						$h[] = '            '.$r->location->longitude;
						$h[] = '          </td>';
						$h[] = '          <td>';

						if ($r->incident_active)
						{
							$h[] = '            YES';
						}
						else
						{
							$h[] = '            NO';
						}

						$h[] = '          </td>';
						$h[] = '          <td>';

						if ($r->incident_verified)
						{
							$h[] = '            YES';
						}
						else
						{
							$h[] = '            NO';
						}

						$h[] = '          </td>';
						$h[] = '        </tr>';
					}

					$h[] = '      </tbody>';
					$h[] = '    </table>';
					$h[] = '  </body>';
					$h[] = '</html>';

					$f = implode("\n", $h);
					
					header("Content-type: text/html; charset=UTF-8");
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Content-Disposition: attachment; filename=" . time() . ".html");
					header("Content-Length: " . strlen($f));
					echo $f;
					exit;

				}
			}
			// Validation errors
			else
			{
				// repopulate the form fields
				$form = arr::overwrite($form, $post->as_array());

				// populate the error fields, if any
				$errors = arr::overwrite($errors, $post->errors('download_reports'));
				$form_error = TRUE;
			}

		}

		$this->template->content->form = $form;
		$this->template->content->errors = $errors;
		$this->template->content->form_error = $form_error;

	}

	private function _csv_text($text)
	{
		$text = stripslashes(htmlspecialchars($text));
		return $text;
	}

}
