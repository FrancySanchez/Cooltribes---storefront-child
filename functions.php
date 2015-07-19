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
add_action( 'storefront_header', 'storefront_display_custom_logo', 20 );
}

function storefront_display_custom_logo() {
?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link" rel="home">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.jpg" alt="<?php echo get_bloginfo( 'name' ); ?>" />
</a>
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



