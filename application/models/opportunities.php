<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for reported Opportunities ('in search of')
 *
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class Opportunities_Model extends ORM {
	/**
	 * Database table name
	 * @var string
	 */
	protected $table_name = 'opportunities';

	/**
	 * Gets a list of all opportunities posted
	 */
	public static function get_opportunities()
	{
		// Get all opportunities
		$opportunities = array();
		foreach 
		(
			ORM::factory('opportunities')
				->find_all() as $opportunity)
		{
				// Create a list of all categories
			$opportunities[$opportunity->id] = array(
				$opportunity->resource_available,
				$opportunity->pcv_name, 
				$opportunity->available_from, 
				$opportunity->available_until,
				$opportunity->contact, 
				$opportunity->additional_info, 
			);
		}
		return $opportunities;
	}

	/**
	 * Get list of opportunities needed
	 *
	 */
	public static function get_opportunities_needed()
	{
		// Get all opportunities
		$opportunities_needed = array();
		foreach
		(
			ORM::factory('form_response')
				->where('form_field_id', '=', '5')
				->find_all() as $opportunities_needed)
		{
			// Create a list of all opportunities
			$opportunities_needed[$opportunity_needed->id] = array(
				$opportunity_needed->search_of//, 
				//$opportunity_needed->pcv_name,
			);
		}
		return $opportunities_needed;
	}

}
