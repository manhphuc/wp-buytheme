<?php
/*
Plugin Name:    Yivic -  WP Icon Buy Theme
Plugin URI:     https://github.com/manhphuc/wp-buytheme
Description:    Add a button to buy website interface quickly and conveniently
Version:        1.0.0
Author:         Yivic
Author URI:     https://www.yivic.com/

License:        GPL v3, MIT

=====GNU General Public License V3 (GPL v3)=====

Copyright(C) 2022, Phuc Nguyen - manhphucofficial@yahoo.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

=====The MIT License (MIT)=====

Copyright (c) 2022, Phuc Nguyen - manhphucofficial@yahoo.com

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

All rights reserved.
*/

use \Yivic\WpPlugin\BuyTheme\BuyTheme;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // disable direct access
}

defined( 'YIVIC_BUYTHEME_VER' ) or define( 'YIVIC_BUYTHEME_VER', '1.0.0' );
defined( 'YIVIC_TEXT_DOMAIN' ) or define( 'YIVIC_TEXT_DOMAIN', 'yivic' );

if (!class_exists(BuyTheme::class)) {
    require_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
}

$plugin = plugin_basename( __FILE__ );
$config = [
	'text_domain'     => YIVIC_TEXT_DOMAIN,
	'plugin_dir_path' => plugin_dir_path( __FILE__ ),
	'plugin_dir_url'  => plugin_dir_url( __FILE__ ),
];
BuyTheme::instance( $config );

add_filter( "plugin_action_links_$plugin", [ BuyTheme::instance(), 'plugin_action_links' ] );
add_action( "init", [ BuyTheme::instance(), 'init' ] );

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	try {
		WP_CLI::add_command( 'buytheme', '\\Sb\\BuyTheme\\WpCliCommand' );
	} catch (Exception $e) {
        esc_html_e( 'WP_CLI error:'.$e->getMessage(), BuyTheme::text_domain() );
		exit();
	}
}