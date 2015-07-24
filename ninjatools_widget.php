<?php

class NinjaToolsWidget extends WP_Widget
{

    function NinjaToolsWidget()
    {
        parent::WP_Widget(false, 'NinjaTools Widget');
    }

    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }

        $tag = ninjatools_extract_tag("sidebar");
        echo $tag;

        echo $after_widget;
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function form($instance)
    {
        $title = esc_attr($instance['title']);
        if (!$title) {
            $title = "Ninja Tools";
        }
        echo '<div>' . __("Title", NINJATOOLS_DOMAIN) . ':<br /><input name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></div>';
    }

}
