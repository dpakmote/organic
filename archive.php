<?php get_header(); ?>
		<section class="products">
		<?php if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h1>Category: <?php single_cat_title(); ?></h1>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h1>Material: <?php single_tag_title(); ?></h1>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h1>Archive for <?php the_time('F jS, Y'); ?></h1>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1>Archive for <?php the_time('F, Y'); ?></h1>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1 class="pagetitle">Archive for <?php the_time('Y'); ?></h1>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h1 class="pagetitle">Author Archive</h1>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1 class="pagetitle">Blog Archives</h1>
			
			<?php } ?>

			<?php while (have_posts()) : the_post(); ?>
			
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		        <div class="info major">
		            <?php include(TEMPLATEPATH.'/index-loop.php'); ?>
		        </div>
		        <aside class="gallery minor">
		            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail');?></a>
		        </aside>
            </div>
    <?php endwhile; ?>

    <?php else : ?>

        <h2>Not Found</h2>

    <?php endif; ?>
    <?php wp_reset_query(); // reset the query ?>
        <div class="pagination">
        <?php
            global $wp_query;
            
            $big = 999999999; // need an unlikely integer
            
            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
                'prev_next' => false
            ) );
        ?>
    </section>

<?php get_footer(); ?>
