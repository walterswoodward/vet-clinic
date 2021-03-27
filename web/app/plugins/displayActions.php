<?php
/**
 * @package Display_Actions
 * @version 1.0.0
 */
/*
Plugin Name: Display Actions
Plugin URI: N/A
Description: Display All Actions (and their frequency)
Author: https://wordpress.stackexchange.com/questions/162862/how-to-get-wordpress-hooks-actions-run-sequence
Version: 1.0.0
Author URI: https://wordpress.stackexchange.com/questions/162862/how-to-get-wordpress-hooks-actions-run-sequence
*/

// This just echoes the chosen line, we'll position it later.
function display_actions() {
    add_action( 'shutdown', function(){
        printf('<p id="display_actions" class="notice notice-success is-dismissible display-actions__container"><span class="display-actions__actions">');
        foreach( $GLOBALS['wp_actions'] as $action => $count )
            printf( '<span id="display-actions__item">%s (%d) </span>' . PHP_EOL, $action, $count );
        printf('</span></p>');
    });
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'in_admin_header', 'display_actions' );

// We need some CSS to position the paragraph.
function display_actions_css() {
	echo "
	<style type='text/css'>
        .display-actions__container {
            margin: 0px 20%;
        }

        .display-actions__actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            padding: 35px 10px;
            font-weight: 600;
            
        }

        .display-actions__item {
            word-wrap: break-word;
        }

        @media screen and (max-width: 782px) {
            .display-actions__container {
                margin: 0;
            }
        }
	</style>
	";
}

add_action( 'admin_head', 'display_actions_css' );

