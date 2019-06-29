<?php
/**
 * Material Design Lite Theme Customizer with Kirki Toolkit
 *
 * @package Material_Design_Lite
 */

if (class_exists('Kirki')) :

    /**
     * Kirki helpers
     */
    if (!function_exists('kirki_custom_title')) :
        function kirki_custom_title($title)
        {
            return '<div class="mdl-customizer-section-title">' . esc_html__( $title, 'material-design-lite' ) . '</div>';
        }
    endif;
    if (!function_exists('kirki_custom_button')) :
        function kirki_custom_button($title = 'Button', $class = '', $href = '#')
        {
            return '<a class="mdl-customizer-section-button button-secondary button ' . $class . '" href="' . $href . '">' . esc_html__( $title, 'material-design-lite' ) . '</a>';
        }
    endif;


    Kirki::add_config( 'material_design_lite', array(
        'capability'    => 'edit_theme_options',
        'option_type'   => 'theme_mod',
    ) );

    Kirki::add_panel( 'sp_mdl_theme_general_options', array(
        'title'       => esc_html__( 'General options', 'material-design-lite' ),
        'description' => esc_html__( 'Theme general options', 'material-design-lite' ),
        'priority'    => 191,
    ) );


        /**
         * Theme color
         * @since 1.0.0
         */
        Kirki::add_section( 'section_theme_color', array(
            'title'          => esc_html__( 'Theme color', 'material-design-lite' ),
            'description'    => sprintf(
                __( 'Select the primary and accent colors to be used for your site. %sMDL Color Wheel%s', 'material-design-lite' ), //TODO: add some note about same colors
                '<a target="_blank" href="http://www.getmdl.io/customize/index.html">', '</a>'),
            'panel'          => 'sp_mdl_theme_general_options',
            'priority'       => 20,
        ) );

            Kirki::add_field( 'material_design_lite', [
                'type'       => 'color-palette',
                'settings'   => 'theme_primary_color',
                'label'      => esc_html__( 'Primary color', 'material-design-lite' ),
                'section'    => 'section_theme_color',
                'default'    => '#3F51B5',
                'choices'    => [
                    'colors' => sp_mdl_color_wheel('primary'),
                    'size'   => 50,
                    'style'  => 'round',
                ],
            ] );

            Kirki::add_field( 'material_design_lite', [
                'type'       => 'color-palette',
                'settings'   => 'theme_accent_color',
                'label'      => esc_html__( 'Accent color', 'material-design-lite' ),
                'section'    => 'section_theme_color',
                'default'    => '#E91E63',
                'choices'    => [
                    'colors' => sp_mdl_color_wheel('accent'),
                    'size'   => 50,
                    'style'  => 'round',
                ],
            ] );


        /**
         * Background
         * @since 1.0.0
         */
        Kirki::add_section( 'section_background', array(
            'title'    => esc_html__( 'Body Background', 'material-design-lite' ),
            'panel'    => 'sp_mdl_theme_general_options',
            'priority' => 30,
        ) );

            Kirki::add_field( 'material_design_lite', [
                'type'        => 'background',
                'settings'    => 'background_setting',
                'label'       => esc_html__( 'Background Control', 'material-design-lite' ),
                'description' => esc_html__( 'Background controls are pretty complex - but extremely useful if properly used.', 'material-design-lite' ),
                'section'     => 'section_background',
                'default'     => [
                    'background-color'      => '#f5f5f5',
                    'background-image'      => '',
                    'background-repeat'     => 'repeat',
                    'background-position'   => 'center center',
                    'background-size'       => 'cover',
                    'background-attachment' => 'scroll',
                ],
                'transport'   => 'auto',
                'output'      => [
                    [
                        'element' => 'body',
                    ],
                ],
            ] );


        /**
         * Blog Entries
         * @since 1.0.0
         */
        Kirki::add_section( 'section_blog_entries', array(
            'title'          => esc_html__( 'Blog Entries', 'material-design-lite' ),
            'panel'          => 'sp_mdl_theme_general_options',
            'priority'       => 210,
        ) );

            /**
             * Blog Entries - Header
             * @since 1.0.0
             */
            Kirki::add_field( 'sp_mdl_theme_general_options', [
                'type'        => 'custom',
                'settings'    => 'blog_entries_header_title',
                'section'     => 'section_blog_entries',
                'default'     => kirki_custom_title( 'HEADER'),
                'priority'    => 100,
            ] );

            Kirki::add_field( 'sp_mdl_theme_general_options', array(
                'title'       => esc_html__( 'Header', 'material-design-lite' ),
                'panel'       => 'sp_mdl_theme_general_options',
                'priority'    => 110,
            ) );

            Kirki::add_field( 'sp_mdl_theme_general_options', [
                'type'        => 'toggle',
                'settings'    => 'blog_entries_header_random_bg_color',
                'label'       => esc_html__( 'Random header bg-color', 'material-design-lite' ),
                'section'     => 'section_blog_entries',
                'default'     => '1',
                'priority'    => 111,
            ] );

            Kirki::add_field( 'sp_mdl_theme_general_options', [
                'type'        => 'color-palette',
                'settings'    => 'blog_entries_header_bg_color',
                'label'       => esc_html__( 'Default bg-color for header', 'material-design-lite' ),
                'section'     => 'section_blog_entries',
                'default'     => get_theme_mod('theme_accent_color', '#E91E63'),
                'choices'     => [
                    'colors' => sp_mdl_color_wheel('primary'),
                    'size'   => 25,
                    'style'  => 'round',
                ],
                'priority'    => 112,
                'active_callback' => [
                    [
                        'setting'  => 'blog_entries_header_random_bg_color',
                        'operator' => '==',
                        'value'    => false,
                    ]
                ],
            ] );

            Kirki::add_field( 'sp_mdl_theme_general_options', [
                'type'        => 'image',
                'settings'    => 'blog_entries_header_bg_image',
                'label'       => esc_html__( 'Default Header Image', 'material-design-lite' ),
                'section'     => 'section_blog_entries',
                'default'     => '',
                'choices'     => [
                    'save_as' => 'id',
                ],
                'priority'    => 113,
                'active_callback' => [
                    [
                        'setting'  => 'blog_entries_header_random_bg_color',
                        'operator' => '==',
                        'value'    => false,
                    ]
                ],
            ] );

            /**
             * Blog Entries - Content
             * @since 1.0.0
             */
            Kirki::add_field( 'sp_mdl_theme_general_options', [
                'type'        => 'custom',
                'settings'    => 'blog_entries_content_title',
                'section'     => 'section_blog_entries',
                'default'     => kirki_custom_title('CONTENT'),
                'priority'    => 120,
            ] );

            Kirki::add_field( 'sp_mdl_theme_general_options', [
                'type'        => 'toggle',
                'settings'    => 'section_blog_entries_content_excerpt',
                'label'       => esc_html__( 'Short post excerpt', 'material-design-lite' ),
                'section'     => 'section_blog_entries',
                'default'     => '0',
                'priority'    => 121,
            ] );

            Kirki::add_field( 'sp_mdl_theme_general_options', [
                'type'        => 'slider',
                'settings'    => 'section_blog_entries_content_excerpt_substr',
                'label'       => esc_html__( 'The excerpt will contain no more than the length of characters', 'material-design-lite' ),
                'section'     => 'section_blog_entries',
                'default'     => 500,
                'choices'     => [
                    'min'  => 0,
                    'max'  => 2500,
                    'step' => 1,
                ],
                'priority'    => 122,
                'active_callback' => [
                    [
                        'setting'  => 'section_blog_entries_content_excerpt',
                        'operator' => '==',
                        'value'    => true,
                    ]
                ],
            ] );


            /**
             * Blog Entries - Footer
             * @since 1.0.0
             */
            Kirki::add_field( 'sp_mdl_theme_general_options', [
                'type'        => 'custom',
                'settings'    => 'blog_entries_footer_title',
                'section'     => 'section_blog_entries',
                'default'     => kirki_custom_title('FOOTER'),
                'priority'    => 130,
            ] );

            Kirki::add_field( 'sp_mdl_theme_general_options', [
                'type'        => 'toggle',
                'settings'    => 'blog_entries_entry_footer_show',
                'label'       => esc_html__( 'Post footer', 'material-design-lite' ),
                'section'     => 'section_blog_entries',
                'default'     => '1',
                'priority'    => 131,
            ] );

            Kirki::add_field( 'sp_mdl_theme_general_options', [
                'type'        => 'toggle',
                'settings'    => 'blog_entries_entry_footer_gravatar_show',
                'label'       => esc_html__( 'Gravatar icon', 'material-design-lite' ),
                'section'     => 'section_blog_entries',
                'default'     => '1',
                'priority'    => 132,
                'active_callback' => [
                    [
                        'setting'  => 'blog_entries_entry_footer_show',
                        'operator' => '==',
                        'value'    => true,
                    ]
                ],
            ] );

            Kirki::add_field( 'sp_mdl_theme_general_options', [
                'type'        => 'toggle',
                'settings'    => 'blog_entries_entry_footer_published_show',
                'label'       => esc_html__( 'Published date', 'material-design-lite' ),
                'section'     => 'section_blog_entries',
                'default'     => '1',
                'priority'    => 133,
                'active_callback' => [
                    [
                        'setting'  => 'blog_entries_entry_footer_show',
                        'operator' => '==',
                        'value'    => true,
                    ]
                ],
            ] );


        /**
         * Blog single post
         * @since 1.0.0
         */
        Kirki::add_section( 'section_blog_single', array(
            'title'          => esc_html__( 'Single Post', 'material-design-lite' ),
            'panel'          => 'sp_mdl_theme_general_options',
            'priority'       => 220,
        ) );

        Kirki::add_field( 'sp_mdl_theme_general_options', [
            'type'        => 'toggle',
            'settings'    => 'my_setting_2',
            'label'       => esc_html__( 'This is the label', 'material-design-lite' ),
            'section'     => 'section_blog_single',
            'default'     => '1',
            'priority'    => 221,
        ] );


        // Page
        Kirki::add_section( 'section_page', array(
            'title'          => esc_html__( 'Page', 'material-design-lite' ),
            'panel'          => 'sp_mdl_theme_general_options',
            'priority'       => 300,
        ) );

        Kirki::add_field( 'sp_mdl_theme_general_options', [
            'type'        => 'toggle',
            'settings'    => 'my_setting_3',
            'label'       => esc_html__( 'This is the label', 'material-design-lite' ),
            'section'     => 'section_page',
            'default'     => '1',
            'priority'    => 301,
        ] );



    /**
     * Discussion Settings
     * @since 1.0.0
     */
    Kirki::add_section( 'sp_mdl_theme_comments', array(
        'title'       => esc_html__( 'Comments', 'material-design-lite' ),
        'priority'    => 195,
    ) );

        // TODO add option to disable all comments!
        Kirki::add_field( 'material_design_lite', [
            'type'        => 'custom',
            'settings'    => 'comments_title',
            'section'     => 'sp_mdl_theme_comments',
            'default'     => kirki_custom_title( 'Comments'),
            'priority'    => 130,
        ] );

        // TODO add option to choose disqus, replybox or native comment system

endif;
