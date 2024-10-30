<?php
/*
Plugin Name: Hide Dokan Promotional Banner
Plugin URI: https://ibnat-it.com/
Description: Simply Hiding the Dokan Multivendor plugins Promotional Banner.
Version: 1.0.0
Author: Sajidul Islam
Author URI: https://www.facebook.com/sajidulislam0
Text Domain: hdpb
Domain Path: /languages
License: GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html

*/

/**
 * Copyright (c) 2021 Ibnat IT (email: ibnatit@gmail.com). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

defined( 'ABSPATH' ) || exit;

/**
 * Dokan_HidePromo class
 *
 * @class Dokan_HidePromo
 */
class Dokan_HidePromo {


 
    /**
     * Constructor for the Dokan_HidePromo class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     *
     * @uses register_activation_hook() 
     */
    public function __construct() {
        register_activation_hook( __FILE__, [ $this, 'hdpb_dependency_missing_notice' ] );

        // Localize our plugin
        add_action( 'init', [ $this, 'hdpb_localization_setup' ] );

        // Load all  hook
        add_action( 'admin_head', [ $this, 'hdpb_hide_dokan_dashboard_banner' ] ); 

		
    }
 
    /**
     * Print error notice if dependency not active
     *
     * @since 1.0.1
     *
     * @return void
     */
    public function hdpb_dependency_missing_notice() {
        deactivate_plugins( plugin_basename( __FILE__ ) );

        if ( ! class_exists( 'WeDevs_Dokan' ) ) {
            $error   = sprintf( __( '<b>Dokan - Hide Promotional Banner</b> requires %sDokan plugin%s to be installed & activated!' , 'hdpb' ), '<a target="_blank" href="https://wedevs.com/products/plugins/dokan/">', '</a>' );
			$backtodashboard  = '<a class="button button-primary" href="'.get_admin_url().'plugins.php">'.__('Back to plugins','hdpb').'</a>';
            $message = '<div class="error"><p>' . $error . '</p>'.$backtodashboard.'</div>';
            wp_die( $message );
        }

     
    }

    /**
     * Initialize plugin for localization
     *
     * @uses hdpb_localization_setup()
     */
    public function hdpb_localization_setup() {
        load_plugin_textdomain( 'hdpb', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }


    /**
     * Hiding the banner
     *
     * @uses hide_dokan_dashboard_banner()
     */
    public function hdpb_hide_dokan_dashboard_banner() {
        echo '<style type="text/css">
			body #wpbody-content div.dokan-upgrade-promotional-notice{
				display:none;
				height:0;
				opacity:0;
				visibility:hidden;
			}
		</style>';
    }
    

} // Dokan_HidePromo

 // Executing the Class
new Dokan_HidePromo();