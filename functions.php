<?php

/**
 * Enqueue scripts and styles.
 */
function lanyon_enqueue_scripts() {
  wp_enqueue_style( 'lanyon-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'lanyon_enqueue_scripts' );

/**
 * Register menu.
 */
function lanyon_register_menus() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Main menu', 'lanyon' ),
    )
  );
}
add_action( 'init', 'lanyon_register_menus' );

/**
 * Method for building custom sidebar navigation.
 */
function lanyon_sidebar_nav() {
  $menu_name = 'main-menu'; // specify custom menu slug

  if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $menu_items = wp_get_nav_menu_items($menu->term_id);

    $menu_list = '<div class="row">' ."\n";
    foreach ((array) $menu_items as $key => $menu_item) {
      $title = $menu_item->title;
      $url = $menu_item->url;
      $menu_list .= "\t\t\t\t\t". '<a class="sidebar-nav-item" href="'. $url .'">'. $title .'</a>' ."\n";
    }
    $menu_list .= "\t\t\t". '</div>' ."\n";
  } else {
    // $menu_list = '<!-- no list defined -->';
  }
  echo $menu_list;
}
