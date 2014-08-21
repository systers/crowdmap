<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for reported Incidents
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
				$opportunity->add_info, 
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

		// Database table prefix
		$table_prefix = Kohana::config('database.default.table_prefix');

		// Database instance
		$db = new Database();

		$sql = 'select incident_date, incident_title, incident.id, form_response from incident'
			. ' join form_response on form_response.incident_id=incident.id '
			. 'join form_field on form_field.form_id=incident.form_id'
			. ' where form_field.field_name="In Search Of"';
		foreach ($db->query($sql) as $opportunity_needed)
		{
			// Create a list of all opportunities
			$opportunities_needed[$opportunity_needed->id] = array(
				$opportunity_needed->id,
				$opportunity_needed->incident_date,
				$opportunity_needed->incident_title,
				$opportunity_needed->form_response, 
			);
		}
		return $opportunities_needed;
	}

}
