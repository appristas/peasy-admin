<?php

namespace PeasyAdmin;

defined( 'ABSPATH' ) or die( 'Tacita' );

class Option {

	/**
	 * Get option
	 *
	 * @param string $slug Admin Page slug
	 * @param string $key Option key
	 *
	 * @return mixed Option value
	 */
	public static function get( $slug, $key = null ) {
		if ( $key ) {
			return self::get_key( self::get_id( $slug ), $key );
		} else {
			return self::get_all( self::get_id( $slug ) );
		}
	}

	/**
	 * Get option key
	 *
	 * @param string $id Option ID
	 * @param string $key Option key
	 *
	 * @return mixed Option value
	 */
	private static function get_key( $id, $key ) {
		$options = get_option( $id );
		if ( array_key_exists( $key, $options ) ) {
			return $options[ $key ];
		}

		return null;
	}

	/**
	 * Get all options
	 *
	 * @param string $id Option ID
	 *
	 * @return array All options
	 */
	private static function get_all( $id ) {
		return get_option( $id );
	}

	/**
	 * Get ID from slug
	 *
	 * @param string $slug Slug
	 *
	 * @return string ID
	 */
	private static function get_id( $slug ) {
		return str_replace( '-', '_', $slug );
	}
}
