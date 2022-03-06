<?php
/**
 * Created by PhpStorm.
 * User: phucnguyen
 * Date: 03/06/2022
 * Time: 18:06 PM
 */

namespace Yivic\WpPlugin\BuyTheme\Base;

use Yivic\WpPlugin\BuyTheme\BuyTheme;

class Main extends BaseObject {

    /**
     * Frontend constructor.
     * Initialize all hook related to admin
     *
     * @param null
     */
    public function __construct() {
        self::init();
    }

    public function init() {
        add_action( 'wp_footer', [ $this , 'get_contact_number_box' ] ); // add frontend to footer
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] ); //add style to frontend
    }

    //add style to frontend
    public function enqueue_scripts() {
        wp_enqueue_style('buytheme_style', BuyTheme::plugin_dir_url() . 'assets/dist/css/buytheme-style.css');
    }

    /**
     * Get Contact Number Plugin box content
     *
     * @return string
     */
    public static function get_contact_number_box() {
        $options = BuyTheme::instance()->options;
        $result  = '';
        $result .= '<div class="wp-buytheme">';

        // Buy theme section
        $buyThemeURL = $options['buy_theme_url'] ? $options['buy_theme_url'] : '';
        if( !empty( $buyThemeURL ) ) :
        $result .= '   <div id="buytheme-phone" class="buytheme-contact">';
        $result .= '        <div class="buytheme-phone">';
        $result .= '            <div class="buytheme-phone-circle-fill"></div>';
        $result .= '            <div class="buytheme-phone-img-circle">';
        $result .= '                <a rel="noopener noreferrer nofollow external" href="'.$buyThemeURL.'" title="Mua theme này" target="_blank">';
        $result .= '                    <img src="'.BuyTheme::plugin_dir_url().'assets/src/images/add-to-cart.png">';
        $result .= '                </a>';
        $result .= '            </div>';
        $result .= '        </div>';
        $result .= '   </div>';

        $result .= '   <div class="text-bar text-bar-n">';
        $result .= '        <div class="text-bar text-bar-n">';
        $result .= '            <a rel="noopener noreferrer nofollow external" href="'.$buyThemeURL.'" title="Mua theme này" target="_blank">';
        $result .= '                <span class="text-desc">Mua theme này</span>';
        $result .= '            </a>';
        $result .= '        </div>';
        $result .= '   </div>';

        endif;
        // End buy theme section

        // Check select location
        if( $options['buytheme_location_display'] == 'right' ) :
        $result .= '
            <style>
                .wp-buytheme {right:0;}
			    .text-bar a {left: auto;right: 30px;padding: 8px 55px 7px 15px;}
            </style>
        ';
        endif;

        // Check hide device mobile
        if( !empty( $options['buytheme_hide_app_mobile'] ) == true ) :
            $result .= '
            <style>
                @media(max-width: 736px){
                    .wp-buytheme {display: none;}
                }
            </style>
        ';
        endif;

        // Check hide device desktop
        if( !empty( $options['buytheme_hide_app_desktop'] ) == true ) :
            $result .= '
            <style>
                @media(min-width: 736px){
				    .wp-buytheme {display: none;}
			    }
            </style>
        ';
        endif;

        $result .= '</div>';
        _e( $result, BuyTheme::text_domain() );
    }
}