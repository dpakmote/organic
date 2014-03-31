<?php
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"), false);
	   wp_enqueue_script('jquery');
	}

  // Featured Image support
  add_theme_support('post-thumbnails');

  // Remove visual editor formatting
  remove_filter ('the_content', 'wpautop');
  
  // REMOVE WIDTH & HEIGHT FROM POST THUMBNAIL
  add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
  add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

  function remove_width_attribute( $html ) {
     $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
     return $html;
  }

  // Register Nav Menu
  register_nav_menus( array(
    'categories' => __( 'Category Menu', 'glu' ),
    'materials' => __( 'Material Menu', 'glu' ),
  ) );

	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
  // Rename POSTS to PRODUCT
  function revcon_change_post_label() {
      global $menu;
      global $submenu;
      $menu[5][0] = 'Product';
      $submenu['edit.php'][5][0] = 'Product';
      $submenu['edit.php'][10][0] = 'Add Product';
      $submenu['edit.php'][16][0] = 'Material';
      echo '';
  }
  function revcon_change_post_object() {
      global $wp_post_types;
      $labels = &$wp_post_types['post']->labels;
      $labels->name = 'Product';
      $labels->singular_name = 'Product';
      $labels->add_new = 'Add Product';
      $labels->add_new_item = 'Add Product';
      $labels->edit_item = 'Edit Product';
      $labels->new_item = 'Product';
      $labels->view_item = 'View Product';
      $labels->search_items = 'Search Product';
      $labels->not_found = 'No Product found';
      $labels->not_found_in_trash = 'No Product found in Trash';
      $labels->all_items = 'All Product';
      $labels->menu_name = 'Product';
      $labels->name_admin_bar = 'Product';
  }
     
  add_action( 'admin_menu', 'revcon_change_post_label' );
  add_action( 'init', 'revcon_change_post_object' );

  // Rename TAGS to MATERIAL
  function change_tax_object_label() {
    global $wp_taxonomies;
    $labels = &$wp_taxonomies['post_tag']->labels;
    $labels->name = __('Materials', 'theme_namespace');
    $labels->singular_name = __('Material', 'theme_namespace');
    $labels->search_items = __('Search Materials', 'theme_namespace');
    $labels->all_items = __('All Materials', 'theme_namespace');
    $labels->parent_item = __('Your Parent Taxonomy Name', 'theme_namespace');
    $labels->parent_item_colon = __('Your Parent Taxonomy Name:', 'theme_namespace');
    $labels->edit_item = __('Edit Material', 'theme_namespace');
    $labels->view_item = __('View Material', 'theme_namespace');
    $labels->update_item = __('Update Material', 'theme_namespace');
    $labels->add_new_item = __('Add Material', 'theme_namespace');
    $labels->new_item_name = __('Material', 'theme_namespace');
  }
  add_action( 'init', 'change_tax_object_label' );

  // Numeric Page Navi (built into the theme by default)
  function bones_page_navi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ( $numposts <= $posts_per_page ) { return; }
    if(empty($paged) || $paged == 0) {
      $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
      $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
      $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
      $start_page = $max_page - $pages_to_show_minus_1;
      $end_page = $max_page;
    }
    if($start_page <= 0) {
      $start_page = 1;
    }
    echo $before.'<nav class="page-navigation"><ol class="bones_page_navi clearfix">'."";
    if ($start_page >= 2 && $pages_to_show < $max_page) {
      $first_page_text = "First";
      echo '<li class="bpn-first-page-link"><a href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';
    }
    echo '<li class="bpn-prev-link">';
    previous_posts_link('<<');
    echo '</li>';
    for($i = $start_page; $i  <= $end_page; $i++) {
      if($i == $paged) {
        echo '<li class="bpn-current">'.$i.'</li>';
      } else {
        echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
      }
    }
    echo '<li class="bpn-next-link">';
    next_posts_link('>>');
    echo '</li>';
    if ($end_page < $max_page) {
      $last_page_text = "Last";
      echo '<li class="bpn-last-page-link"><a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';
    }
    echo '</ol></nav>'.$after."";
  } /* end page navi */



?>