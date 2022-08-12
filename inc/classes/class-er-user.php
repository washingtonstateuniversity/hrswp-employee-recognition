<?php
/**
 * User API: ER_User class.
 *
 * Manages the plugin user data and methods.
 *
 * @package EmployeeRecognition
 */

namespace Hrswp\EmployeeRecognition\ERUser;

use HRSWP\SQLSRV\Sqlsrv_DB;
use HRSWP\SQLSRV\Sqlsrv_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class used to implement the ER_User object.
 *
 * @since 1.0.0
 *
 * @property string $first_name
 * @property string $last_name
 * @property int    $awardee_id
 * @property string $service_years
 * @property bool   $is_eligible
 * @property bool   $has_ordered
 */
class ER_User {
	/**
	 * ER User data container.
	 *
	 * @since 1.0.0
	 * @var stdClass
	 */
	public $data;

	/**
	 * The user's WSU ID
	 *
	 * @since 1.0.0
	 * @var int
	 */
	public $wsu_id = 0;

	/**
	 * Constructor.
	 *
	 * Retrieves user data and passes it to ER_User::init().
	 *
	 * @since 1.0.0
	 *
	 * @param int $id User's WSU ID number.
	 */
	public function __construct( int $id = 0 ) {
		if ( $id ) {
			$data = $this->get_wsu_data_by_id( $id );
		}

		if ( $data ) {
			$this->init( $data );
		} else {
			$this->data = new stdClass();
		}
	}

	/**
	 * Sets up object properties.
	 *
	 * @since 1.0.0
	 *
	 * @param object $data Awardees DB row object.
	 */
	public function init( object $data ): void {
		if ( ! isset( $data->id ) ) {
			$data->id = 0;
		}

		$this->data   = $data;
		$this->wsu_id = (int) $data->id;
	}

	/**
	 * Returns the user fields from the Awardees database.
	 *
	 * @since 1.0.0
	 *
	 * @param int $value The WSU ID value.
	 * @return object|null Raw user object.
	 */
	public function get_wsu_data_by_id( int $value ): ?object {
		// 'wsu_id' is an alias of 'id'.
		if ( 'wsu_id' === $field ) {
			$field = 'id';
		}

		if ( 'id' === $field ) {
			if ( ! is_numeric( $value ) ) {
				return null;
			}
			$value = (int) $value;
			if ( $value < 1 ) {
				return null;
			}
		} else {
			$value = trim( $value );
		}

		if ( ! $value ) {
			return null;
		}

		// Query the HRS Awardees DB using the HRS Sqlsvr plugin.
		$msdb  = new Sqlsrv_DB\Sqlsrv_DB();
		$query = array(
			'dataset' => array(
				array(
					'table'  => 'awardees-local',
					'fields' => '*',
				),
			),
			'where'   => 'WSUID=' . $value,
			'orderby' => 'AwardeeID',
			'limit'   => 1,
		);

		$response = new Sqlsrv_Query\Sqlsrv_Query( $query );

		if ( ! $response ) {
			return null;
		}

		$response = $response->records;

		// Build the user object.
		$user                       = (object) $user;
		$user->awardee_id           = $response[0]->AwardeeID;
		$user->id                   = $response[0]->WSUID;
		$user->first_name           = $response[0]->FName;
		$user->last_name            = $response[0]->LName;
		$user->is_employee          = (bool) $response[0]->isEmployed;
		$user->service_years        = $response[0]->ServiceYears;
		$user->is_eligible          = (bool) $response[0]->isEligToOrder;
		$user->is_eligible_expired  = (bool) $response[0]->isEligExpired;
		$user->has_ordered          = (bool) $response[0]->isOrdered;
		$user->last_ordered_date    = $response[0]->DateOrdered;
		$user->last_ordered_pin_id  = $response[0]->PinID;
		$user->last_ordered_gift_id = $response[0]->GiftID;

		return $user;
	}

	/**
	 * Magic method for checking the existence of a certain field.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key User meta key to check if set.
	 * @return bool Whether the given user data key is set.
	 */
	public function __isset( string $key ): bool {
		// 'wsu_id' is an alias of 'id'.
		if ( 'wsu_id' === $key ) {
			$key = 'id';
		}

		if ( isset( $this->data->$key ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Magic method for accessing user data fields.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key User meta key to retrieve.
	 * @return mixed Value of the given user meta key (if set). Null if key is not set.
	 */
	public function __get( string $key ) {
		// 'wsu_id' is an alias of 'id'.
		if ( 'wsu_id' === $key ) {
			$key = 'id';
		}

		$value = $this->data->$key ?? null;

		return $value;
	}

	/**
	 * Retrieves the value of a user property field.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key User meta key to retrieve.
	 * @return mixed Value of the given user meta key (if set). Null if key is not set.
	 */
	public function get( string $key ) {
		return $this->__get( $key );
	}

	/**
	 * Determines whether a user data property is set.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key User meta key to check if set.
	 * @return bool Whether the given user data key is set.
	 */
	public function has_prop( string $key ): bool {
		return $this->__isset( $key );
	}

}
