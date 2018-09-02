<div class="blog-post">
	<?php setup_postdata( $post ); ?>
    <div class="container">
    	<?php 
    	if ( esc_html( get_the_category( get_the_ID() )[0] -> name ) == 'course' ) {
    		add_filter('the_content', 'strip_images', 2);

			function strip_images( $content ){
			   return preg_replace( '/<img[^>]+./', '', $content);
			}
    	} 
    	the_content();
		if ( esc_html( get_the_category( get_the_ID() )[0] -> name ) == 'course' ) {
			$chapters = new WP_Query( array(
			    'posts_per_page' => 4,
			    'category_name' => 'chapter',
			    'paged' => 1,
			    'post_type' => 'post',
			    'order' => 'asc'
			) );
			echo "<br>";
			if ( $chapters -> have_posts() ) {
			    while ( $chapters -> have_posts() ) : $chapters -> the_post() ?>
			        <hr>
			        <div class="course-chapter">
			        	<h5 class='post-title'><?php the_title(); ?></h5>
			        	<div class='col-sm-11'><?php the_content(); ?></div>
		        		<div class='col-sm-1'><a href="<?php the_permalink(); ?>" class='start-chapter'>Start</a></div>
			        </div>
			    <?php 
				endwhile;
			    if ( sizeOf( get_posts( array( 'category_name' => 'chapter', 'posts_per_page' => 5 ) ) ) > 4 )
		    		echo '<button class="discover-more">See the full curriculum</button>';
			    //next_posts_link( 'See the full curriculum', $chapters -> max_num_pages );
			    wp_reset_postdata();
			}
		}
    	?>
    </div>
</div><!-- /.blog-post -->