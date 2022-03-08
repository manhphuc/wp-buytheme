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
        add_action( 'wp_footer', [ $this , 'get_icon_buytheme_box' ] ); // add frontend to footer
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] ); //add style to frontend
    }

    //add style to frontend
    public function enqueue_scripts() {
        wp_enqueue_style('buytheme_style', BuyTheme::plugin_dir_url() . 'assets/dist/css/buytheme-style.css');
    }

    /**
     * Get Icon BuyTheme Plugin box content
     *
     * @return string
     */
    public static function get_icon_buytheme_box() {
        $options = BuyTheme::instance()->options;
        $result  = '';
        $result .= '<div class="wp-buytheme">';
        // Buy theme section
        $buyThemeURL        = $options['buy_theme_url'] ? $options['buy_theme_url'] : '';
        $buyThemeAttribute  = $options['buy_theme_attribute'] ? $options['buy_theme_attribute'] : '';
        $buyThemeContent    = $options['buy_theme_content'] ? $options['buy_theme_content'] : __( 'Buy this theme', YIVIC_TEXT_DOMAIN );
        if( !empty( $buyThemeURL ) ) :
        $result .= '   <div id="buytheme-button" class="buytheme-contact">';
        $result .= '        <div class="buytheme-button">';
        $result .= '            <div class="buytheme-button-circle-fill"></div>';
        $result .= '            <div class="buytheme-button-img-circle">';
        $result .= '                <a href="'.$buyThemeURL.'" title="'.$buyThemeContent.'" '.$buyThemeAttribute.'>';
        $result .= '                    <img src="'.BuyTheme::plugin_dir_url().'assets/src/images/add-to-cart.png">';
        $result .= '                </a>';
        $result .= '            </div>';
        $result .= '        </div>';
        $result .= '   </div>';

        $result .= '   <div class="text-bar text-bar-n">';
        $result .= '        <div class="text-bar text-bar-n">';
        $result .= '            <a href="'.$buyThemeURL.'" title="'.$buyThemeContent.'" '.$buyThemeAttribute.'>';
        $result .= '                <span class="text-desc">'.$buyThemeContent.'</span>';
        $result .= '            </a>';
        $result .= '        </div>';
        $result .= '   </div>';

        $iconColor      = !empty( $options['buy_theme_color_icon'] ) ? $options['buy_theme_color_icon'] : '#dd382d';
        $textBarBgColor = !empty( $options['buy_theme_bg_color_text'] ) ? $options['buy_theme_bg_color_text'] : '#402828';
        $result .= '
        <style>
            .buytheme-button-bar a, #buytheme-button .buytheme-button-circle-fill, #buytheme-button .buytheme-button-img-circle {
                background-color: '.$iconColor.';
            }
            #buytheme-button .buytheme-button-circle-fill {
                opacity: 0.7;box-shadow: 0 0 0 0 '.$iconColor.';
            }
            .text-bar a {background: '.$textBarBgColor.'}
        </style>';
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