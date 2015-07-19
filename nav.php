<div class="menu_top ">
	<?php
	$defaults = array(
		'menu'            => '',
		'theme_location'  => 'top-menu',
		'container'       => 'div',
		'container_class' => 'main-navigation col-full',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s ">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	);
	wp_nav_menu( $defaults );?>
</div>
