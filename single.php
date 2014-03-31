<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<section <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="major gallery">
				<?php the_post_thumbnail('fullsize');?>
			</div>
			<div class="minor">
                <?php include(TEMPLATEPATH.'/index-loop.php'); ?>
			</div>
		</section>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>