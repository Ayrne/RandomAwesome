<?php
/*
   Plugin Name: Random Awesome
   Plugin URI: https://ayrne.io
   Description: This plugin creates a link to yourwebsite.com/awesome that, when linked, will serve up a random post on your site.
   Version: 1.0
   Author: Benjamin F Sulivan
   Author URI: http://benjaminfredericksullivan.com
   License: GPL2
   */
   add_action('init','random_add_rewrite');
function random_add_rewrite() {
       global $wp;
       $wp->add_query_var('random');
       add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
}
 
add_action('template_redirect','random_template');
function random_template() {
       if (get_query_var('random') == 1) {
               $posts = get_posts('post_type=post&orderby=rand&numberposts=1');
               foreach($posts as $post) {
                       $link = get_permalink($post);
               }
               wp_redirect($link,307);
               exit;
       }
}
?>
