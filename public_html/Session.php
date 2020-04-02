<?php
/**
 * Project: afisha
 * Filename: Session.php
 * Date: 12/15/2019
 * Time: 8:53 PM
 */
abstract class Session {
    /**
     * @param $key
     * @param $value
     */
    public static function set( $key, $value ) {
        $_SESSION[ $key ] = $value;
    }

    /**
     * @param $key
     *
     * @return null
     */
    public static function get( $key ) {
        if ( self::has( $key ) ) {
            return $_SESSION[ $key ];
        }

        return null;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public static function has( $key ) {
        return isset( $_SESSION[ $key ] );
    }

    /**
     * @param $key
     */
    public static function delete( $key ) {
        unset( $_SESSION[ $key ] );
    }

    /**
     * destroy
     */
    public static function destroy() {
        session_destroy();
    }
}