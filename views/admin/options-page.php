<?php
/**
 * Created by PhpStorm.
 * User: phucnguyen
 * Date: 03/06/2022
 * Time: 11:23 PM
 */

use \Yivic\WpPlugin\BuyTheme\BuyTheme;

wp_enqueue_style('buytheme_admin', BuyTheme::plugin_dir_url() . 'assets/dist/css/admin.css');
wp_enqueue_script( 'buytheme_admin_script', BuyTheme::plugin_dir_url() . 'assets/dist/js/admin.js', [ 'wp-color-picker' ], false, true );
?>
<div class="options">
    <div class="options_header">
        <h1><?php echo __( 'WP Icon Buy Theme', BuyTheme::text_domain() ) ?></h1>
    </div>

    <div class="options">
        <div class="options_left">
            <h3>Options Left</h3>
            <div class="inside">
                <form method="post" action="options.php" id="options">
                    <?php settings_fields( BuyTheme::OPTION_GROUP_NAME ); ?>
                    <h3 class="title"><?php __( 'Contact App Settings', BuyTheme::text_domain() ) ?></h3>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
                                <label for="buy_theme_url"><?php esc_attr_e( 'Url buy theme', BuyTheme::text_domain() ) ?></label>
                            </th>
                            <td>
                                <input style=" max-width: 315px; width: 100%; " placeholder="https://domain.com/demo-url" id="buy_theme_url" class="standard-input" type="text" name="buytheme[buy_theme_url]"
                                       value="<?php esc_html_e( $options['buy_theme_url'], BuyTheme::text_domain() ); ?>"/>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">
                                <label for="buy_theme_content"><?php esc_attr_e( 'Contents of the button', BuyTheme::text_domain() ) ?></label>
                            </th>
                            <td>
                                <input style=" max-width: 315px; width: 100%; " placeholder="Buy this theme" id="buy_theme_content" class="standard-input" type="text" name="buytheme[buy_theme_content]"
                                       value="<?php esc_html_e( $options['buy_theme_content'], BuyTheme::text_domain() ); ?>"/>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">
                                <label for="phone_app_number"><?php esc_attr_e( 'Attribute tag', BuyTheme::text_domain() ) ?></label>
                            </th>
                            <td>
                                <input style=" max-width: 315px; width: 100%; " placeholder='target="_blank" rel="nofollow"' id="buy_theme_attribute" class="standard-input" type="text" name="buytheme[buy_theme_attribute]"
                                       value="<?php esc_html_e( $options['buy_theme_attribute'], BuyTheme::text_domain() ); ?>"/>
                                <br><i><?php esc_attr_e( 'Attributes are separated by space marks. Example: rel="nofollow" target="_blank"', BuyTheme::text_domain() ) ?></i>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">
                                <label for="buy_theme_color_icon"><?php esc_attr_e( 'Color icon', BuyTheme::text_domain() ) ?></label>
                            </th>
                            <td>
                                <input id="buy_theme_color_icon" class="my-color-field" type="text" name="buytheme[buy_theme_color_icon]"
                                       value="<?php esc_html_e( $options['buy_theme_color_icon'], BuyTheme::text_domain() ); ?>"/>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">
                                <label for="buy_theme_bg_color_text"><?php esc_attr_e( 'Background color text', BuyTheme::text_domain() ) ?></label>
                            </th>
                            <td>
                                <input id="buy_theme_bg_color_text" class="my-color-field" type="text" name="buytheme[buy_theme_bg_color_text]"
                                       value="<?php esc_html_e( $options['buy_theme_bg_color_text'], BuyTheme::text_domain() ); ?>"/>
                            </td>
                        </tr>

                    </table>

                    <h3 class="title"><?php esc_attr_e( 'Display Settings', BuyTheme::text_domain() ) ?></h3>
                    <table class="form-table">

                        <tr valign="top">
                            <th scope="row"><label
                                        for="buytheme_location_display"><?php esc_attr_e( 'Location', BuyTheme::text_domain() ) ?></label></th>
                            <td>
                                <select id="buytheme_location_display" name="buytheme[buytheme_location_display]">
                                    <option value="left"<?php if ( $options['buytheme_location_display'] == 'left' ) {
                                        echo ' selected="selected"';
                                    } ?>>
                                        <?php esc_attr_e( 'Left', BuyTheme::text_domain() ) ?>
                                    </option>
                                    <option value="right"<?php if ( $options['buytheme_location_display'] == 'right' ) {
                                        echo ' selected="selected"';
                                    } ?>>
                                        <?php esc_attr_e( 'Right', BuyTheme::text_domain() ) ?>
                                    </option>
                                </select>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row"><label for="buytheme_hide_on_label">Hide on</label></th>
                            <td>
                                <?php if ( ! isset( $options['buytheme_hide_app_desktop'] ) ) {
                                    $options['buytheme_hide_app_desktop'] = 0;
                                } ?>
                                <input id="buytheme_hide_app_desktop" name="buytheme[buytheme_hide_app_desktop]" type="checkbox"
                                       value="1" <?php checked( $options['buytheme_hide_app_desktop'], 1 ); ?> />
                                <small><?php esc_attr_e( 'Button will not be displayed on desktop sized devices.', BuyTheme::text_domain() ) ?></small>
                            </td>
                            <td>
                                <?php if ( ! isset( $options['buytheme_hide_app_mobile'] ) ) {
                                    $options['buytheme_hide_app_mobile'] = 0;
                                } ?>
                                <input id="buytheme_hide_app_mobile" name="buytheme[buytheme_hide_app_mobile]" type="checkbox"
                                       value="1" <?php checked( $options['buytheme_hide_app_mobile'], 1 ); ?> />
                                <small><?php esc_attr_e( 'Button will not be displayed on small devices like on mobile.', BuyTheme::text_domain() ) ?></small>
                            </td>
                        </tr>

                    </table>

                    <p class="submit">
                        <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>"/>
                    </p>
                </form>
            </div>
        </div>
        <div class="options_right">
            <h3>Options Right</h3>
        </div>
    </div>
</div>