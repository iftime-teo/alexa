<?php
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.jpg);
            height: 65px;
            width: 320px;
            background-size: 320px 65px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'ASSIST Teach Me';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

function add_query_vars_filter( $vars ){
  $vars[] = "login";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

// Main redirection of the default login page
function redirect_login_page() {
    $login_page  = home_url('/login/');
    $page_viewed = basename($_SERVER['REQUEST_URI']);

    if($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}
add_action('init','redirect_login_page');

// Main redirection of the default register page
add_filter( 'register_url', 'my_register_page' );
function my_register_page( $register_url ) {
    return home_url( '/login/?login=register' );
}

add_filter( 'registration_redirect', 'my_redirect_home' );
function my_redirect_home( $registration_redirect ) {
    return home_url('/login/?login=registered');
}

// If a login failed
function custom_login_failed() {
    $login_page  = home_url('/login/');
    wp_redirect($login_page . '?login=failed');
    exit;
}
add_action('wp_login_failed', 'custom_login_failed');

// If any of the fields were empty
function verify_user_pass($user, $username, $password) {
    $login_page  = home_url('/login/');
    if($username == "" || $password == "") {
        wp_redirect($login_page . "?login=empty");
        exit;
    }
}
add_filter('authenticate', 'verify_user_pass', 1, 3);

// On logout
function logout_redirect() {
    $login_page  = home_url('/login/');
    wp_redirect($login_page . "?login=false");
    exit;
}
add_action('wp_logout','logout_redirect');

// Add new form elements...
add_action( 'register_form', 'myplugin_register_form' );
function myplugin_register_form() {
    $user_login = ( ! empty( $_POST[ 'user_login' ] ) ) ? sanitize_text_field( $_POST[ 'user_login' ] ) : ''; 
    $last_name = ( ! empty( $_POST[ 'last_name' ] ) ) ? sanitize_text_field( $_POST[ 'last_name' ] ) : '';
    $user_email = ( ! empty( $_POST[ 'user_email' ] ) ) ? sanitize_text_field( $_POST[ 'user_email' ] ) : '';
    $password = ( ! empty( $_POST[ 'password' ] ) ) ? sanitize_text_field( $_POST['password'] ) : '';

    ?>
    <p><input type="text" placeholder='first name' name="user_login" id="user_login" class="input" value="<?php echo esc_attr( wp_unslash( $user_login ) ); ?>" size="20" /></label></p>
    <p><input type="text" placeholder='last name' name="last_name" id="last_name" class="input" value="<?php echo esc_attr( $last_name ); ?>" size="25" /></p>
    <p><input type="email" placeholder='email adress' name="user_email" id="user_email" class="input" value="<?php echo esc_attr( wp_unslash( $user_email ) ); ?>" size="25" /></p>
    <p><input type="password" placeholder='password' name="password" id="password" class="input" value="<?php echo esc_attr( $password ); ?>" size="25" /></p>

    <?php
}

// Add validation. Make sure fields are required.
add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {
    
    if ( empty( $_POST[ 'user_login' ] ) || ! empty( $_POST[ 'user_login' ] ) && trim( $_POST[ 'user_login' ] ) == '' ) {
        $errors -> add( 'user_login_error', sprintf('<strong>%s</strong>: %s', __( 'ERROR', 'mydomain' ), __( 'You must include a first name.', 'mydomain' ) ) );
    }
    if ( empty( $_POST[ 'password' ] ) || ! empty( $_POST[ 'password' ] ) && trim( $_POST[ 'password' ] ) == '' ) {
        $errors -> add( 'password_error', sprintf('<strong>%s</strong>: %s', __( 'ERROR', 'mydomain' ), __( 'You must include a password.', 'mydomain' ) ) );
    }
    if ( empty( $_POST[ 'user_email' ] ) || ! empty( $_POST[ 'user_email' ] ) && trim( $_POST[ 'user_email' ] ) == '' ) {
        $errors -> add( 'user_email_error', sprintf('<strong>%s</strong>: %s', __( 'ERROR', 'mydomain' ), __( 'You must include an email address.', 'mydomain' ) ) );
    }
    if ( empty( $_POST[ 'last_name' ] ) || ! empty( $_POST[ 'last_name' ] ) && trim( $_POST[ 'last_name' ] ) == '' ) {
        $errors -> add( 'last_name_error', sprintf('<strong>%s</strong>: %s', __( 'ERROR', 'mydomain' ), __( 'You must include a last name.', 'mydomain' ) ) );
    }

    return $errors;
}
// save our extra registration user meta.
add_action( 'user_register', 'myplugin_user_register' );
function myplugin_user_register( $user_id ) {
    if ( ! empty( $_POST[ 'user_login' ] ) ) {
        update_user_meta( $user_id, 'user_login', sanitize_text_field( $_POST[ 'user_login' ] ) );
    }
    if ( ! empty( $_POST[ 'last_name' ] ) ) {
        update_user_meta( $user_id, 'last_name', sanitize_text_field( $_POST[ 'last_name' ] ) );
    }
    if ( ! empty( $_POST[ 'user_email' ] ) ) {
        update_user_meta( $user_id, 'user_email', sanitize_text_field( $_POST[ 'user_email' ] ) );
    }
    if ( ! empty( $_POST[ 'password' ] ) ) {
        update_user_meta( $user_id, 'password', sanitize_text_field( $_POST[ 'password' ] ) );
    }
}