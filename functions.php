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
<div class="nof_logo">
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
=            Agregando modal window al archivo de productos           =
==============================================*/
function agregando_modal_window_producto() {
	add_action( 'woocommerce_after_main_content', 'custom_modal_window_producto' );
}
add_action( 'init', 'agregando_modal_window_producto' );
function custom_modal_window_producto() {
	?>
	<div id="jquery-ui-product-dialog" class="modalProduct" title="Stoff Details">
		
		<div id="js-modal-image" class="modalimage columna45"></div>
		
		<div class="columna45">
			<h3 id="js-modal-title" class="modaltitle "> </h3>
				<div id="js-modal-description"></div>
				<a id="js-modal-link" href="" title=""
				class="button modalbottom">Diese stoff whälen</a>
		</div>
	</div>	
	<?php
}
/*-----  End of Agregando modal window al archivo de productos ------*/

/*================================================================================
=            Agregando descripcion debajo de los productos en archivo            =
================================================================================*/
add_action( 'woocommerce_after_shop_loop_item_title', 'my_add_short_description', 9 );
function my_add_short_description() {
	  echo '<div class="product-description-custom">' . get_the_excerpt() . '</div>';
}

/*-----  End of Agregando descripcion debajo de los productos en archivo  ------*/


/*=====================================================
=            remove single product sidebar            =
=====================================================*/
function remove_storefront_sidebar() {
	if ( is_product() ) {
		remove_action( 'storefront_sidebar', 'storefront_get_sidebar',			10 );
	}
}
add_action( 'get_header', 'remove_storefront_sidebar' );


/*-----  End of remove single product sidebar  ------*/


/*=================================================================
=            Agregando imagenes al preview de producto            =
=================================================================*/
function agregar_imagenes_al_preview_de_producto() {
	add_action( 'woocommerce_product_thumbnails', 'html_para_imagenes_del_preview' );
}
add_action( 'init', 'agregar_imagenes_al_preview_de_producto' );
function html_para_imagenes_del_preview() {
	?>
		
	<div class= "diseno_traje">
	<?php

	//ref 1: https://wordpress.org/support/topic/display-category-image-on-single-product-page
	// Ref 2: http://stackoverflow.com/questions/20777929/woocommerce-how-do-i-get-the-most-top-level-category-of-the-current-product-ca

	global $post;
	$prod_terms = get_the_terms( $post->ID, 'product_cat' );
	foreach ($prod_terms as $prod_term) {



	    // gets product cat id
	    $product_cat_id = $prod_term->term_id;


	    // gets an array of all parent category levels
	    $product_parent_categories_all_hierachy = get_ancestors( $product_cat_id, 'product_cat' );  

	    // This cuts the array and extracts the last set in the array
	    $last_parent_cat = array_slice($product_parent_categories_all_hierachy, -1, 1, true);
	    foreach($last_parent_cat as $last_parent_cat_value){
	        // $last_parent_cat_value is the id of the most top level category, can be use whichever one like
	          $category_thumbnail = get_woocommerce_term_meta($last_parent_cat_value, 'thumbnail_id', true);
			  $image = wp_get_attachment_url($category_thumbnail);
			  echo '<img class="absolute category-image" src="'.$image.'">';

	    }
	}
	?>
	</div>
    <div class=" js-previewImagenes diseno_atributos">	
	</div>
	<?php

}
/*-----  End of Agregando imagenes al preview de producto  ------*/

/*===================================================================================
=            Quitando los productos relacionados en la vista de producto            =
===================================================================================*/
// REF: http://docs.woothemes.com/document/remove-related-posts-output/

function wc_remove_related_products( $args ) {
	return array();
}
add_filter('woocommerce_related_products_args','wc_remove_related_products', 10); 

/*-----  End of Quitando los productos relacionados en la vista de producto  ------*/


add_action( 'init', 'jk_remove_woo_wc_breadcrumbs' );
function jk_remove_woo_wc_breadcrumbs() {
   
		remove_action( 'storefront_content_top', 'woocommerce_breadcrumb', 	10 );
   
}

function prueba()
{
	
    	echo 'Hola mundo';
	
}
add_action( 'woocommerce_after_main_content', 'prueba' );



