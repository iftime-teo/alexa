<?php get_header();
if ( is_page('courses') ) { ?>
	<div class="banner">
		<h3>Browse through all Finance courses for Alexa</h3>
		<h4>Pick the one you like and start learning</h4>
	</div>
<?php } ?>
	<div class="container">
		<div class="blog-header">

		</div>
		<div class="row">
			<?php 
			if ( is_page('courses') ) {
				$lastposts = get_posts( array(
				    'posts_per_page' => 6
				) );
				 
				if ( $lastposts ) {
				    foreach ( $lastposts as $post ) :
				        setup_postdata( $post ); ?>
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
				    endforeach; 
				    wp_reset_postdata();
				}
			} else get_template_part( 'content', get_post_format() );
			?>
		</div> <!-- /.row -->
		<?php if ( is_page('courses') ) echo '<button class="discover-more">Discover more</button>'; ?>
<?php get_footer(); ?>