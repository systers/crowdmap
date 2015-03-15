<?php defined('SYSPATH') or die('No direct script access.');
/**
 * FAQs Controller.
 * This controller will read the FAQs stored in the database.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com>
 * @package	   Ushahidi - http://source.ushahididev.com
 * @subpackage Members
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class Faq_Controller extends Main_Controller {
	function __construct()
	{
		parent::__construct();

//		$this->template->this_page = 'faq';
	}


	/**
	 * Lists the FAQs.
	 * @param int $page
	 */
	public function index($page = 1)
	{
		$this->template->content = new View('faq');
		$this->template->content->title = Kohana::lang('ui_main.faqs');
		
		// Pagination
		$pagination = new Pagination(array(
			'query_string'	 => 'page',
			'items_per_page' => (int) Kohana::config('settings.items_per_page_admin'),
			'total_items'	 => ORM::factory('faq')
				->count_all()
			));

		$messages = ORM::factory('faq')
			->find_all((int) Kohana::config('settings.items_per_page_admin'), $pagination->sql_offset);
			
		$this->template->content->messages = $messages;
		$this->template->content->pagination = $pagination;

		// Total Questions
		$this->template->content->total_items = $pagination->total_items;
		
		// Javascript Header
//		$this->themes->js = new View('members/private_js');
	}
}
