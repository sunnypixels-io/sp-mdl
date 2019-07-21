<?php
/**
 * MDL Widget: Footer Menu
 *
 * @package SP_MDL
 */

if (!class_exists('MaterialDesignLite_Widget_FooterMenu') && class_exists('WP_Widget')) :
    class MaterialDesignLite_Widget_FooterMenu extends WP_Widget
    {
        function __construct()
        {
            parent::__construct(

            // Base ID of your widget
                'MaterialDesignLite_Widget_FooterMenu',
                // Widget name will appear in UI
                __('MDL Footer Dropdown menu', 'sp-mdl'),
                // Widget description
                array(
                    'description' => __('Footer Dropdown links', 'sp-mdl'),

                )
            );
        }

        // Creating widget front-end
        // This is where the action happens
        public function widget($args, $instance)
        {
            extract($args);

            $title = apply_filters('widget_title', $instance['title']);

            $links = array();
            $i = 0;

            while ($i <= 30) :
                $link = (isset($instance['link_' . $i]) && !empty($instance['link_' . $i]) ) ? esc_attr($instance['link_' . $i]) : '';
                $url_title = (isset($instance['title_' . $i]) && !empty($instance['title_' . $i]) ) ? esc_attr($instance['title_' . $i]) : $link;
                if (!empty($link) && !empty($url_title)) {
                    array_push($links, array(
                        'url' => $link,
                        'title' => $url_title
                    ) );
                }
                $i++;
            endwhile;

            // before and after widget arguments are defined by themes
            echo $before_widget;

            if (!empty($title))
                echo $before_title . $title . $after_title;

            echo '<ul class="mdl-mega-footer__link-list">';
            foreach ($links as $link) :
                echo '<li><a href="' . $link['url']. '">' . $link['title'] . '</a></li>';
            endforeach;

            echo '</ul>';

            echo $after_widget;
        }

        // Widget Backend
        public function form($instance)
        {
            $instance = wp_parse_args((array)$instance, array(
                'title' => __('Menu', 'sp-mdl')
            ));

            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">
                    <?php _e('Title:', 'sp-mdl'); ?></label>
                <input class="widefat"
                       id="<?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>"
                       type="text"
                       value="<?php echo esc_attr($instance['title']); ?>"/>
            </p>

            <hr>

            <?php

            $i = 0;

            while ($i <= 30) :
                $link = (isset($instance['link_' . $i]) && !empty($instance['link_' . $i]) ) ? esc_attr($instance['link_' . $i]) : '';
                $title = (isset($instance['title_' . $i]) && !empty($instance['title_' . $i]) ) ? esc_attr($instance['title_' . $i]) : '';
                $class = ($i >= 3 && empty($link) && empty($title)) ? 'hidden' : '';
                ?>
                <div class="js-mdl--footer-menu--field <?php echo $class; ?>">
                    <p>
                        <label for="<?php echo $this->get_field_id('link_' . $i); ?>">
                            <?php _e('Link + Title', 'sp-mdl'); ?> [<?php echo $i + 1; ?>]</label>
                        <input class="js-mdl--autocomplete-footer-menu-link widefat"
                               id="<?php echo $this->get_field_id('link_' . $i); ?>"
                               name="<?php echo $this->get_field_name('link_' . $i); ?>"
                               type="text"
                               value="<?php echo $link; ?>"/>
                        <input class="js-mdl--autocomplete-footer-menu-title widefat"
                               id="<?php echo $this->get_field_id('title_' . $i); ?>"
                               name="<?php echo $this->get_field_name('title_' . $i); ?>"
                               type="text"
                               value="<?php echo $title; ?>"/>
                    </p>
                    <hr>
                </div>
                <?php
                $i++;
            endwhile;

            ?>
            <p class="js-mdl--footer-menu--add-fields">
                <span class="dashicons dashicons-plus"></span> <?php _e('Add fields', 'sp-mdl'); ?>
            </p>
            <?php
        }

        // Updating widget replacing old instances with new
        public function update($new_instance, $old_instance)
        {
            $i = 0;

            $instance = array();
            $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
            while ($i <= 30) :
                $instance['link_' . $i] = wp_kses_post($new_instance['link_' . $i]);
                $instance['title_' . $i] = wp_kses_post($new_instance['title_' . $i]);
                $i++;
            endwhile;

            return $instance;
        }
    }
endif;
