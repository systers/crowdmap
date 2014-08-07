<?php defined('SYSPATH') or die('No direct script access.');

/**
 * This controller is used to display opportunities/resources needed and add new opportunities
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com>
 * @package	   Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class Opportunities_Controller extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Displays opportunities and resources needed
	 */
	public function index()
	{
		$this->template->header->this_page = 'opportunities';
		$this->template->content = new View('opportunities/main');
		$this->template->header->page_title .= Kohana::lang('ui_main.opportunities').Kohana::config('settings.title_delimiter');

		// Load search of view
		$search_of_view = new View('opportunities/main_opportunities_needed');
		$this->template->content->search_of_view = $search_of_view;
	
		//Load resources available view
		$resource_available_view = new View('opportunities/main_opportunities');
		$this->template->content->resource_available_view = $resource_available_view;
	
		//Retrieve Opportunities
		$this->template->content = new Opportunities_Model; 
		$opportunities = $this->template->content->get_opportunities();
		$opportunities = array(); 
	
		//Retrieve Opportunities Needed
		$opporunities_needed = $this->template->content->get_opportunities_needed();
		$opportunities_needed = array();
	
	}

	/**
	 * Submits a new opportunity.
	 */
	public function submit($id = FALSE, $saved = FALSE)
	{
		$db = new Database();

		$this->template->header->this_page = 'opportunities_submit';
		$this->template->content = new View('opportunities/submit');

		$this->template->header->page_title .= Kohana::lang('ui_main.opportunities_submit_new')
											   .Kohana::config('settings.title_delimiter');

		//Retrieve API URL
		$this->template->api_url = Kohana::config('settings.api_url');

		// Setup and initialize form field names
		$form = array(
			'resource_available' => '',
			'pcv_name' => '',
			'available_from' => '',
			'available_until' => '',
			'contact' => '',
			'additional_info' => '',
		);
	
		// Copy the form as errors, so the errors will be stored with keys
		// corresponding to the form field names
		//$captcha = Captcha::factory();
		$errors = $form;
		$form_error = FALSE;
		$form_sent = FALSE;

		// Check, has the form been submitted, if so, setup validation
		if ($_POST)
		{
			// Instantiate Validation, use $post, so we don't overwrite $_POST fields with our own things
			$post = Validation::factory($_POST);

			// Add some filters
			$post->pre_filter('trim', TRUE);

			// Add some rules, the input field, followed by a list of checks, carried out in order
			$post->add_rules('resource_available', 'required', 'length[3,100]');
			$post->add_rules('pcv_name', 'required', 'length[3,100]');
			$post->add_rules('available_from', 'required', 'length[3,100]');
			$post->add_rules('available_until', 'required');
			$post->add_rules('contact', 'required', 'length[3,100]');
			$post->add_rules('additional_info', 'required', 'length[3,100]');

			// Test to see if things passed the rule checks
			// Skip CSRF check since we have a CAPTCHA already
			if ($post->validate(FALSE))
			{
				// If valid post to Database
				$form = new Opportunities_Model(); 
				$form->resource_available = $post->resource_available;
				$form->pcv_name = $post->pcv_name;
				$form->available_from = $post->available_from;
				$form->available_until = $post->available_until;
				$form->contact = $post->contact;
				$form->additional_info = $post->additional_info;			
				$form->save(); 
			}
			// No! We have validation errors, we need to show the form again, with the errors
			else
			{
				// repopulate the form fields
				$form = arr::overwrite($form, $post->as_array());

				// populate the error fields, if any
				$errors = arr::merge($errors, $post->errors('opportunities'));
				$form_error = TRUE;
			}
		}

		$this->template->content->form = $form;
		$this->template->content->errors = $errors;
		$this->template->content->form_error = $form_error;
	}
}
