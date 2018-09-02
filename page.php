<?php get_header();?>
	<div class="container">
		<div class="row">
			<?php 
			if ( is_page( 'courses' ) ) {
				$lastposts = new WP_Query( array(
				    'posts_per_page' => 6,
				    'category_name' => 'course',
				    'paged' => 1,
				    'post_type' => 'post'
				) );
				if ( $lastposts -> have_posts() ) {
				    while ( $lastposts -> have_posts() ) : $lastposts -> the_post() ?>
				        <div class="course col-sm-4">
				        	<a class='post-title' href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				        	<?php the_content(); the_post_thumbnail_url(); ?>
				        	<span class="course-footer">
				        		<a href="#" class='finance'>Finance</a>
				        		<span class="estimated-time">
				        			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/time.jpg" alt="estimated time" width="15px" height="15px" > 2h course
				        		</span>
				        	</span>
				        </div>
				    <?php
				    endwhile;   
				    //next_posts_link( 'Discover more', $lastposts -> max_num_pages );
				    wp_reset_postdata();
				}
			} else get_template_part( 'content', get_post_format() );
			?>
		</div> <!-- /.row -->
		<?php 
			if ( is_page( 'courses' ) && sizeOf( get_posts( array( 'category_name' => 'course', 'posts_per_page' => 7 ) ) ) > 6 )
			echo '<button class="discover-more" >Discover more</button>';
		?>
<?php get_footer(); ?>