<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
<p class="description">
    <?php the_content(); ?>
</p>
<ul class="meta">
    <?php   if(get_field('colour')) 
        {
        echo '<li class="color">' . get_field('colour') . '</li>';
        }   ?>
    <?php   if(get_field('size'))   
        {
        echo '<li class="size">' . get_field('size') . '</li>';
        }   ?>
    <?php   if(get_field('custom')) 
        {
        echo '<li class="custom">' . get_field('custom') . '</li>';
        }   ?>
    <!--
        <?php   if(get_field('minimum_quantity'))   
            {
            echo '<li class="quantity">' . get_field('minimum_quantity') . '</li>';
            }   ?>
    -->
</ul>
<footer>
    <ul>
        <li><span>Code</span><?php the_field('code'); ?></li>
        <li><span>Category</span><?php the_category(', '); ?></li>
        <li><span>Material</span><?php the_tags(' ',' + '); ?></li>
    </ul>
</footer>
<a class="enquiry" href="http://fair-n-organic:8888/enquire/?product=<?php the_title(); ?>&quantity=<?php echo get_field('minimum_quantity'); ?>&code=<?php the_field('code'); ?> ">Send Enquiry</a>
