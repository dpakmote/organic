<?php get_header(); ?>
	    <section class="about">
        <div class="major">
            <h3>Welcome!</h3>
            <p>Fair&amp;Organic is a social enterprise, offering products made from natural fibers – cotton, wool and jute. We work with small producers in India, helping them market their products locally and abroad – providing skilled artisans a platform to reach consumers worldwide.</p>
            <p>Some of the producers we work with are certified by GOTS and OEKO-TEX but many of them are not,  because of the high costs involved in certification.</p>
            <p>However, Fair&amp;Organic ensures that the materials used are grown organically and that the working conditions under which the products are manufactured are fair.</p>
        </div>
        <div class="minor">
            <h1>Fair</h1>
            <p>Manufacturers that comply with the ILO core conventions and pay at least minimum wages. However, we encourage our partners to pay living wages as calculated by the Asia Floor Wage Campaign.</p>
            <h1>Organic</h1>
            <p>Products free from chemicals with no usage of pesticides during the cultivation of the crops.</p>
        </div>
    </section>
    <section class="products">
        <h1>Products</h1>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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
        </div>
    </section>

<?php get_footer(); ?>