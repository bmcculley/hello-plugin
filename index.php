<?php
/**
 * let's learn plugin development
 */
/*
Plugin Name: Hello World
Plugin URI: https://bmcculley.github.io/hello-world
Description: Just a test plugin, want to see how this all works.
Author: bmcculley
Version: 0.1
Author URI: https://bmcculley.github.io
Text Domain: hello-world
 */

// we shouldn't say hello too much
// let's check if the cookie is set
function say_hello() {
  if (!isset($_COOKIE["wp_say_hello"])) {
    return True;
  }
  else {
    return False;
  }
}

// function to set a cookie to track if we should say hello
// expires in 8 hours
function set_hello_cookie() {
  setcookie("wp_say_hello", 1, time()+28800);
}

if ( say_hello() ) {
  add_action( 'init', 'set_hello_cookie' );

  // get the current user and build the hello message
  function say_hello_user() {
    $current_user = wp_get_current_user()->display_name;
    $hello = wp_sprintf("Hello, %s!", $current_user);
    return wptexturize( $hello );
  }

  // build the message display
  function hello_world() {
    $hello_message = say_hello_user();
    echo "<div id='message' class='updated notice is-dismissible'>
          <p>$hello_message</p></div>";
  }

  add_action( 'admin_notices', 'hello_world' );

}

?>
