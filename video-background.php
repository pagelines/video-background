<?php
/*
Plugin Name: Video Background
Plugin URI: http://videobackground.ahansson.com
Description: A section that makes it possible to have YouTube videos as background on a page-by-page basis. 7 customization options and pure awesomeness!
Version: 1.4
Author: Aleksander Hansson
Author URI: http://ahansson.com
PageLines: true
v3:true
*/

class ah_VideoBackground_Plugin {

	function __construct() {
		add_action( 'init', array( &$this, 'ah_updater_init' ) );
	}

	/**
	 * Load and Activate Plugin Updater Class.
	 * @since 0.1.0
	 */
	function ah_updater_init() {

		/* Load Plugin Updater */
		require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/plugin-updater.php' );

		/* Updater Config */
		$config = array(
			'base'      => plugin_basename( __FILE__ ), //required
			'repo_uri'  => 'http://shop.ahansson.com',  //required
			'repo_slug' => 'video-background',  //required
		);

		/* Load Updater Class */
		new AH_VideoBackground_Plugin_Updater( $config );
	}

}

new ah_VideoBackground_Plugin;