<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<section class="page" id="post-<?php the_ID(); ?>">

			<h1><?php the_title(); ?></h1>

			<div class="major">
				<?php the_content(); ?>
			</div>


		</section>
		

		<?php endwhile; endif; ?>

<?php get_footer(); ?>
