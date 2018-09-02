<div class="login container">
	<div class="middle">
		<div class="center">
			<div class="col-sm-6">
				<div class="middle">
					<?php 
					if ( get_query_var( 'login' ) == 'register' ) { ?>
						<p>You're one step closer</p>
						<h3>Create a new account</h3>
						<?php 

						echo '<div id="login_error">' . apply_filters( 'login_errors', $errors ) . "</div>\n";
						
					} else if (! is_user_logged_in() ) {
						setup_postdata( $post );
						the_content();
						?>
						<p class="error-message">
							<?php switch ( get_query_var( 'login' ) ) {
							 	case 'empty': echo 'Please fill in your Email and Password'; break;
							 	case 'failed': echo 'Please provide a valid Email and Password'; break;
						 		case 'false': echo "You logged out succesfully"; break;
						 		default: break;
							}
						echo '</p>';
					} 
					?>
				</div>
			</div>
			<div class="col-sm-6">
				<?php
				if ( get_query_var( 'login' ) == 'register' ) { ?>
				<form name="registerform" id="registerform" action="<?php echo esc_url( site_url( 'login/?login=register', 'login_post' ) ); ?>" method="post" novalidate="novalidate">
						<?php do_action( 'register_form' );	?>
						<br class="clear" />
						<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
						<p class="submit">
							<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('CREATE ACCOUNT'); ?>" />
						</p>
						<p class="terms">
							<label for="terms">
								<input type="checkbox" name="terms" required> I agree with <a href="Privacy-policy">Terms & Conditions</a>
							</label>
						</p>
					</form>

			   	<?php } else if ( ! is_user_logged_in() ) { // Display WordPress login form:
				    $args = array(
				        'redirect' => home_url(), 
				        'form_id' => 'loginform',
				        'label_username' => __( '' ),
				        'label_password' => __( '' ),
				        'label_log_in' => __( 'SIGN IN' ),
				        'remember' => false
				    );
				    wp_login_form( $args );
			   	} else { // If logged in:
				    wp_loginout( home_url() ); // Display "Log Out" link.
				    echo " | ";
				    wp_register('', ''); // Display "Site Admin" link.
				} ?>
			</div>
		</div>
	<?php if ( ! is_user_logged_in() && get_query_var( 'login' ) != 'register' ) { ?>
	    <footer>Dont have an account? <a href="<?php echo wp_registration_url(); ?>" title="Sign up">Sign up</a></footer>
	<?php } ?>
	</div>
</div>