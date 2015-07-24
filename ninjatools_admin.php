<?php

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
require_once NINJATOOLS_PLUGIN_DIR . '/ninjatools_api.php';

function ninjatools_admin_menu_action()
{
    $page = add_options_page(
        __('Ninja Tools', NINJATOOLS_DOMAIN), __('Ninja Tools', NINJATOOLS_DOMAIN), 'manage_options', __FILE__, 'ninjatools_admin_options_page'
    );
    add_action("admin_print_scripts-{$page}", "ninjatools_admin_scripts");
}

function ninjatools_admin_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('jquery-ui-accordion');
    wp_enqueue_script('jquery-ui-draggable');
    wp_enqueue_script('jquery-ui-droppable');

    wp_enqueue_script('ninjatools_admin-onload', NINJATOOLS_PLUGIN_URL . "/ninjatools_admin_zero.js", array("jquery"));
    wp_localize_script('ninjatools_admin-onload', 'NINJATOOLS_ADMIN', array(
        'endpoint' => admin_url('admin-ajax.php'),
        'action' => 'ninjatools_admin_ajax_handler'
    ));
}

function check_widget_activation()
{
    $show_widget = 0;
    global $wp_registered_sidebars, $wp_registered_widgets;
    $sidebars_widgets = wp_get_sidebars_widgets();

    foreach ($wp_registered_sidebars as $name => $value) {
        foreach ($sidebars_widgets[$name] as $id => $widget) {
            if (preg_match('/ninjatoolswidget/i', $widget)) {
                $show_widget = 1;
            }
        }
    }
    return $show_widget;
}

function activate_widget()
{
    if (check_widget_activation()) {
        return;
    }

    $sidebars = array();
    $sidebars_widgets = wp_get_sidebars_widgets();
    foreach ($sidebars_widgets as $name => $value) {
        if ($name == "wp_inactive_widgets") {
            continue;
        }
        if (!isset($sidebars[$name])) {
            $sidebars[$name] = 0;
        }
        foreach ($sidebars_widgets[$name] as $id => $widget) {
            $sidebars[$name] ++;
        }
    }
    if (count($sidebars) == 0) {
        return;
    }
    arsort($sidebars);
    $sidebar_keys = array_keys($sidebars);
    $main_sidebar = array_shift($sidebar_keys);
    $sidebars_widgets[$main_sidebar][] = "ninjatoolswidget-1";
    wp_set_sidebars_widgets($sidebars_widgets);

    $settings = array();
    $settings[1] = array('title' => 'Ninja Tools');
    $settings['_multiwidget'] = 1;
    update_option('widget_ninjatoolswidget', $settings);
}

function ninjatools_admin_options_page()
{
    //check widget is registered in sidebar?
    $show_widget = check_widget_activation();

    //is not registered ninjatoolswidget,
    if (!$show_widget) {
        $options = ninjatools_options();
        $options["services"]["analyze"] = NULL;
        $options = ninjatools_save_options($options);
    }

    require_once(NINJATOOLS_PLUGIN_DIR . "/ninjatools_admin.html.php");

    echo activate_widget();
}

function ninjatools_admin_ajax_handler()
{
    header('Content-Type: application/json; charset=utf-8');
    $query = $_POST['query'];

    $result = null;
    switch ($query['action']) {
        case "getOption":
            echo json_encode(ninjatools_options());
            break;
        case "getCredential":
            $api = new NinjaTools_API();
            $ret = $api->clientLogin($query['id'], $query['ps']);
            $result = array();
            if ($ret === true) {
                $result["result"] = true;
                $public_key = $api->getPublicKey();
                $result["public_key"] = $public_key;

                $options = ninjatools_options(true);
                $options['public_key'] = $public_key;
                $options = ninjatools_save_options($options);
            } else {
                $result["result"] = false;
            }
            echo json_encode($result);
            break;
        case "getTools":
            $api = new NinjaTools_API();
            $options = ninjatools_options();
            $api->setPublicKey($options['public_key']);

            $ret = $api->getOnetagLists();
            $omatome_key = 0;
            if ($ret !== null && $ret !== false) {
                foreach ($ret as $k => $v) {
                    $omatome_key = $k;
                }
            }
            $result["tool_list"] = array(
                'analyze' => $api->getAnalysisLists(),
                'omatome' => $api->getOnetagButtonLists($omatome_key),
            );
            $result["options"] = $options;
            $result["result"] = true;
            echo json_encode($result);
            break;
        case "setTool":
            $api = new NinjaTools_API();
            $options = ninjatools_options();
            $result = array();

            $service = $query['service'];

            $api->setPublicKey($query['public_key']);
            if ($service == "analyze") {
                $ret = $api->getAnalysisScript($query['toolid']);
            } else if ($service == "omatome") {
                $ret = $api->getOnetagScript($query['toolid']);
            }

            if ($ret === false) {
                $result["result"] = false;
            } else {
                $result["result"] = true;
                $options['services'][$service] = array(
                    'toolid' => $query['toolid'],
                    'toolname' => $query['toolname'],
                    'tag' => $ret,
                    'place' => $query['place'],
                );
            }
            $options = ninjatools_save_options($options);
            $result["options"] = $options;
            echo json_encode($result);
            break;
        case "delTool":
            $options = ninjatools_options();
            $result = array();
            $service = $query['service'];
            if (isset($query['deactivate']) && $query['deactivate'] === "true") {
                $options['services'][$service] = NULL;
                $options['services']["omatome"] = NULL;
                $options = ninjatools_save_options($options);
            }

            $result["result"] = true;
            $result["options"] = $options;
            echo json_encode($result);
            break;
    }
    die();
}
