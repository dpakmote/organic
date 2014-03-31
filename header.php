<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<?php if (is_search()) { ?>
		   <meta name="robots" content="noindex, nofollow" /> 
		<?php } ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
		</title>
        <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/main.css" type="text/css" />
        <!--
	        <link href='http://fonts.googleapis.com/css?family=EB+Garamond' rel='stylesheet' type='text/css'>
			<?php wp_head(); ?>
		-->
    </head>
    <body <?php body_class(); ?>>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
	
        <div class="fauxcolumn">    </div>
        <div class="header-container">
            <header class="wrapper clearfix">
                <a class="logo" href="<?php bloginfo('url'); ?>"> <img src="<?php bloginfo('template_url');?>/images/logo-fairandorganic.png" ></a>
                <?php wp_nav_menu( array( 'theme_location' => 'categories' ) ); ?>
                <?php wp_nav_menu( array( 'theme_location' => 'materials' ) ); ?>
                <!--
	                <div class="menu-materials-container">
						<ul class="menu">
							<?php
							$tags = get_tags(array('orderby' => 'name', 'order' => 'ASC'));
							foreach ( (array) $tags as $tag ) {
							echo '<li class="page_item"><a href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . '</a></li>';
							}
							?>
						</ul>
					</div>
				-->

                <footer>
                    <ul>
                        <li><a href="mailto:info@fairandorganic.org"> info@fairandorganic.org</a></li>
                        <li><a target="blank" href="https://www.facebook.com/fairandorganic">fb.com/fairandorganic</a></li>
                        <li>+91 99 452 33384</li>
                    </ul>
                </footer>
            </header>
        </div>
        <div class="main-container">