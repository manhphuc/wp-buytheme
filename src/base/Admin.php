<?php
/**
 * Created by PhpStorm.
 * Author: manhphucofficial@yahoo.com
 * Date time: 03/06/2022 11:20 AM
 */

namespace Yivic\WpPlugin\BuyTheme\Base;

use Yivic\WpPlugin\BuyTheme\BuyTheme;

class Admin extends BaseObject {

	/**
	 * Admin constructor.
	 * Initialize all hook related to admin
	 *
	 * @param null $config
	 */
	public function __construct( $config = null ) {
        self::init();
	}

	/**
	 * Hook to attach to admin_init action
	 * Import old options to group option
	 */
	function admin_init() {
		register_setting( BuyTheme::OPTION_GROUP_NAME, BuyTheme::OPTION_KEY );
	}

    public function init() {
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_color_picker' ] );
        add_action( 'admin_init', [ $this, 'admin_init' ] );
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    // add scripts to frontend
    function enqueue_color_picker() {
        wp_enqueue_style( 'wp-color-picker' );
    }

	/**
	 * Hook to attach to admin_menu action
	 * Add more menu item to admin menu
	 */
	function admin_menu() {
		add_submenu_page( 'options-general.php', 'Yivic - Buy Theme', 'Yivic - IconByTheme', 'manage_options', 'yivic-icon-buytheme', [
			$this,
			'display_options_page'
		] );
	}

	/**
	 * Display options page in Admin Panel
	 */
	function display_options_page() {
		$options = get_option( BuyTheme::OPTION_KEY );
		if ( empty($options)  ) {
			$options = BuyTheme::default_options();
		}

		include( BuyTheme::plugin_dir_path() . '/views/admin/options-page.php' );
	}

	/**
	 * Hook to attach to admin_menu action
	 * Add more menu item to admin menu
	 */
	function display_options() {
		add_menu_page( 'WP Buy Theme Options', 'Shopback - WP Icon Buy Theme', 'manage_options', 'buytheme', [
			$this,
			'options'
		] );
	}

}