<?php

/*
  Plugin Name: NinjaTools
  Plugin URI: http://wordpress.org/plugins/ninjatools/
  Description: Ninja Tools wordpress plugin
  Author: Kenichi Kashiwagi
  Author URI: http://www.ninja.co.jp/
  Version: 1.2.4
 */

/*
  Copyright 2013 Samurai Factory Inc.(email : github-analyze@ml.ninja.co.jp)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

define("NINJATOOLS_PLUGIN_DIR", WP_PLUGIN_DIR . "/ninjatools");
define("NINJATOOLS_PLUGIN_URL", WP_PLUGIN_URL . "/ninjatools");
define("NINJATOOLS_OPTIONS", "ninjatools_options");
define("NINJATOOLS_DOMAIN", "ninjatools");

load_plugin_textdomain(NINJATOOLS_DOMAIN, false, "ninjatools/po");

require_once NINJATOOLS_PLUGIN_DIR . '/ninjatools_admin.php';
require_once NINJATOOLS_PLUGIN_DIR . '/ninjatools_widget.php';

//add_action('wp_head', 'ninjatools_wp_head_action');
add_action('wp_footer', 'ninjatools_wp_footer_action');
add_filter('the_content', 'ninjatools_the_content_filter');
add_action('admin_menu', 'ninjatools_admin_menu_action');
add_action('wp_ajax_ninjatools_admin_ajax_handler', 'ninjatools_admin_ajax_handler');
add_action('widgets_init', create_function('', 'return register_widget("NinjaToolsWidget");'));

function ninjatools_options($load_default = false)
{
    $default_options = array(
        "public_key" => NULL,
        "services" => array(
            "analyze" => NULL,
            "omatome" => NULL,
        )
    );
    if ($load_default === true) {
        $options = $default_options;
    } else {
        $options = get_option(NINJATOOLS_OPTIONS, $default_options);
    }
    return $options;
}

function ninjatools_save_options($options)
{
    update_option(NINJATOOLS_OPTIONS, $options);
    return $options;
}

function ninjatools_extract_tag($place)
{
    $options = ninjatools_options();
    $output_tag = "";
    foreach ($options["services"] as $service_name => $service) {
        if ($service === NULL) {
            continue;
        }
        if ($service["place"] === $place) {
            $output_tag .= $service["tag"] . "\n";
        }
    }
    return $output_tag;
}

function ninjatools_wp_head_action()
{
    if (($tag = ninjatools_extract_tag("header")) === "") {
        return;
    }
    echo "<!-- ninjatools_wp_head -->\n";
    echo $tag . "\n";
    echo "<!-- /ninjatools_wp_head -->\n";
}

function ninjatools_wp_footer_action()
{
    if (($tag = ninjatools_extract_tag("footer")) === "") {
        return;
    }
    echo "<!-- ninjatools_wp_footer -->\n";
    echo "<div class=\"wp_ninjatools_plugin_wp_footer\">\n";
    echo $tag . "\n";
    echo "</div>\n";
    echo "<!-- /ninjatools_wp_footer -->\n";
}

function ninjatools_the_content_filter($content)
{
    if (is_feed() || is_404() || is_robots() || is_comments_popup()) {
        return $content;
    }

    $options = ninjatools_options();

    $top_output_tag = "";
    $bottom_output_tag = "";

    foreach ($options["services"] as $service_name => $service) {
        if ($service === NULL || !is_array($service)) {
            continue;
        }

        if ($service["place"] !== "article") {
            continue;
        }
        /*
          if ( $service["position"] === "top" ) {
          $top_output_tag .= $service["tag"] . "\n";
          } else if ($service["position"] === "bottom") {
          $bottom_output_tag .= $service["tag"] . "\n";
          }
         */
        $bottom_output_tag .= $service["tag"] . "\n";
    }
    $bottom_output_tag = str_replace('&lt;?php the_permalink(); ?&gt;', get_permalink(), $bottom_output_tag);
    $bottom_output_tag = str_replace('&lt;?php the_title(); ?&gt;', get_the_title(), $bottom_output_tag);

    return <<<_EOF_

<!-- ninjatools_the_content_top -->
{$top_output_tag}<!-- /ninjatools_the_content_top -->
{$content}
<!-- ninjatools_the_content_bottom -->
{$bottom_output_tag}<!-- /ninjatools_the_content_bottom -->

_EOF_;
}
