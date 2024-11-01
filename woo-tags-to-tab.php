<?php
/*
Plugin Name: Woo Tags To Tab
Version: 1.0.0
Description: Remove Tags From Product Page Meta And Add Tags Tab For Woocommerce
Plugin URI: http://www.barfaraz.com
Author: Mohammad Reza Javadi
Author URI: http://www.mohammad-reza.ir
*/

add_action( 'init', 'wttt_init' );
function wttt_init() {
    $priority = has_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta');
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', $priority );
	add_action( 'woocommerce_single_product_summary', 'wttt_woocommerce_template_single_meta' );
}

function wttt_woocommerce_template_single_meta() {
	include( 'inc/meta.php' );
}

add_filter( 'woocommerce_product_tabs', 'wttt_new_product_tab' );
function wttt_new_product_tab( $tabs ) {
	$tabs['test_tab'] = array(
		'title'		=> __( 'Tags', 'woocommerce' ),
		'priority'	=> 50,
		'callback'	=> 'wttt_new_product_tab_content'
	);

	return $tabs;
}

function wttt_new_product_tab_content() {
	global $product;
	echo '<h2>' . __( 'Tags', 'woocommerce' ) . '</h2>';
	echo wc_get_product_tag_list( $product->get_id() );
}

?>