<?php

namespace HM\Platform\CMS\Branding;

function bootstrap() {
	add_action( 'add_admin_bar_menus', __NAMESPACE__ . '\\remove_wordpress_admin_bar_item' );
	add_filter( 'admin_footer_text', '__return_empty_string' );
	add_action( 'wp_network_dashboard_setup', __NAMESPACE__ . '\\remove_dashboard_widgets' );
	add_action( 'wp_user_dashboard_setup', __NAMESPACE__ . '\\remove_dashboard_widgets' );
	add_action( 'wp_dashboard_setup', __NAMESPACE__ . '\\remove_dashboard_widgets' );
	add_action( 'admin_init', __NAMESPACE__ . '\\add_default_color_scheme' );
}

/**
 * Remove the WordPress logo admin menu bar item.
 */
function remove_wordpress_admin_bar_item() {
	remove_action( 'admin_bar_menu', 'wp_admin_bar_wp_menu' );
}

/**
 * Remove dashboard widgets that are not useful.
 *
 * @return void
 */
function remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_primary', [ 'dashboard', 'dashboard-network', 'dashboard-user' ], 'side' );
}

function add_default_color_scheme() {
	wp_admin_css_color(
		'platform',
		__( 'Platform', 'hm-platform' ),
		plugin_dir_url( dirname( __FILE__, 2 ) ) . '/assets/admin-color-scheme.css',
		[ '#152354', '#14568A', '#D54E21', '#2683AE' ],
		[ 'base' => '#152354', 'focus' => '#fff', 'current' => '#fff' ]
	);
}