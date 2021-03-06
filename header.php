<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo get_bloginfo( 'name' ); ?></title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo get_bloginfo( 'template_directory' );?>/blog.css" rel="stylesheet">
	<link href="<?php echo get_bloginfo( 'template_directory' );?>/style.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php wp_head(); ?>
</head>

<body>
	<div class="blog-masthead">
		<div class="container">
			<a href="<?php echo get_home_url(); ?>">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.jpg" alt="logo" width="150px" height="36px" />
			</a>
			<div class="profile">
				<?php if ( get_userdata( get_current_user_id() ) ) { ?>
					<img src="<?php echo esc_url( get_avatar_url( get_userdata( get_current_user_id() ) ) ); ?>" alt="profile picture" width="40px" height="40px" />
					<a href="<?php echo get_edit_user_link(); ?>" class="username">
						<?php echo get_userdata( get_current_user_id() ) -> first_name ." ". get_userdata( get_current_user_id() ) -> last_name; ?>
					</a>
					<span class="notifications">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/notifications.jpg" alt="notifications bell" width="18px" height="20px" />
						<span class="number">210</span>
					</span>
				<?php } else { ?>
					<a href="login">Login</a>	
				<?php } ?>
			</div>
			<nav class="blog-nav">
				<?php wp_list_pages( array( 'title_li' => '', 'sort_column'  => 'ID', 'exclude' => '3, 57' ) ); ?>
			</nav>
		</div>
	</div>
	<div class="banner">
		<?php 
		if ( is_page( 'courses' ) ) { ?>
			<h3>Browse through all Finance courses for Alexa</h3>
			<h4>Pick the one you like and start learning</h4>
		<?php } else { ?>
			<div class="post-head">
				<h3 class="blog-post-title"><?php the_title(); ?></h3>
				<?php if ( esc_html( get_the_category( get_the_ID() )[0] -> name ) == 'course' ) echo "<a href='#' class='finance'>Finance</a>"; ?>
			</div>
		<?php }	?>
	</div>