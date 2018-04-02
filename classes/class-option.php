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
	 * Get attachment
	 *
	 * @param string $slug Admin Page slug
	 * @param string $key Option key
	 * @param string|array $size Image size(s)
	 * @param string $return What to return
	 *
	 * @return mixed|null Image info if exists, null otherwise
	 */
	public static function get_attachment( $slug, $key, $size = 'thumbnail', $return = 'url' ) {
		$attachment_id = (int) self::get_key( self::get_id( $slug ), $key );
		$src = wp_get_attachment_image_src( $attachment_id, $size, false );

		if ( $src === false ) {
			return null;
		}

		$keys = [ 'url' => 0, 'width' => 1, 'height' => 2, 'is_intermediate' => 3 ];

		if ( $return === 'all' ) {
			$return = array_keys( $keys );
		}

		if ( is_string( $return ) ) {
			return isset( $src[ $keys[ $return ] ] ) ? $src[ $keys[ $return ] ]: null;
		}

		$result = [];
		foreach ( $return as $r ) {
			if ( $src[ $keys[ $r ] ] ) {
				$result[ $r ] = $src[ $keys[ $r ] ];
			}
		}

		return $result;
	}

	/**
	 * Get option by key
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
