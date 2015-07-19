<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

add_filter( 'storefront_customizer_enabled', 'woa_storefront_disable_customizer' );
	function woa_storefront_disable_customizer() {
    return false;
}
	
//function register_top_menu() {
//	register_nav_menu('top-menu',__( 'Top Menu' ));
//}
//add_action( 'init', 'register_top_menu' );


/*=========================================
=            Agregando el logo            =
=========================================*/

add_action( 'init', 'storefront_custom_logo' );
function storefront_custom_logo() {
remove_action( 'storefront_header', 'storefront_site_branding', 20 );
remove_action( 'storefront_header', 'storefront_skip_links', 0 );
add_action( 'custom_storefront_skip_links', 'storefront_skip_links' );

add_action( 'storefront_header', 'storefront_display_custom_logo', 20 );
}

function storefront_display_custom_logo() {
?>
<div class="my clase">
	<?php do_action( 'custom_storefront_skip_links' ); ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link" rel="home">
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.jpg" alt="<?php echo get_bloginfo( 'name' ); ?>" />

	</a>
</div>
<?php
}

/*-----  End of Agregando el logo  ------*/

/*=================================================================
=            Agregando el menu principal junto al logo            =
=================================================================*/

add_action( 'init', 'storefront_custom_nav' );

function storefront_custom_nav() {
	remove_action( 'storefront_header', 'storefront_product_search', 40 );
	remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
	add_action( 'storefront_primary_navigation', 'storefront_secondary_navigation', 10 );

}

/*-----  End of Agregando el menu principal junto al logo  ------*/


/*================================================================================
=      Agrupando el secondary menu y el icono del carrito en un <div>            =
================================================================================*/

function agrupando_secondaryMenu_and_cart_y_moviendolos_al_top() {

	remove_action( 'storefront_header', 'storefront_header_cart', 60 );
	remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );

	add_action( 'storefront_before_header', 'custom_before_header', 5 );

	add_action( 'custom_secondaryMenu', 'storefront_secondary_navigation' );
	add_action( 'custom_cart', 'storefront_header_cart' );
}
add_action( 'init', 'agrupando_secondaryMenu_and_cart_y_moviendolos_al_top' );

function custom_before_header() {
	?>
	<div class="menu_top">
		<div class="col-full">
			<?php do_action( 'custom_secondaryMenu' ); ?>
			<?php do_action( 'custom_cart' ); ?>
		</div>
		</div>		
	<?php
}



/*-----  End of Agrupando el secondary menu y el icono del carrito en un <div>  ------*/

/*================================================
=            Desactivando los reviews            =
================================================*/
// Referencia: https://support.woothemes.com/hc/en-us/articles/203447633-How-to-Disable-Product-Reviews
add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
	function wcs_woo_remove_reviews_tab($tabs) {
	 unset($tabs['reviews']);
	 return $tabs;
}

/*-----  End of Desactivando los reviews  ------*/


/*====================================================================
=            Agregando archivo JS donde estan los scripts            =
====================================================================*/
// Referencia: https://codex.wordpress.org/Function_Reference/wp_enqueue_script
/**
 * Proper way to enqueue scripts and styles
 */
function my_custom_scripts() {
		// jQuery UI
		wp_enqueue_script( 'jquery-ui', '//code.jquery.com/ui/1.11.4/jquery-ui.min.js', array(), '1.0.0', true );

		// Custom scripts
		wp_enqueue_script( 'custom-child-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), '1.0.0', true );

}

add_action( 'wp_enqueue_scripts', 'my_custom_scripts' );

/*-----  End of Agregando archivo JS donde estan los scripts  ------*/

/*==============================================
=            Agregando modal window            =
==============================================*/
function agregando_modal_window_producto() {
	add_action( 'woocommerce_after_main_content', 'custom_modal_window_producto' );
}
add_action( 'init', 'agregando_modal_window_producto' );

function custom_modal_window_producto() {
	?>
	<div id="jquery-ui-product-dialog" title="Basic dialog" style="width: auto; min-height: 117px; max-height: none; height: auto; padding: 40px;background: rgb(255, 255, 255);width: 600px;border: 1px solid #ddd; display:none">
	  <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
	</div>	
	<?php
}



/*-----  End of Agregando modal window  ------*/



