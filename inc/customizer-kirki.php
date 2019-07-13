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
            return '<a class="mdl-customizer-section-button button-secondary button ' . $class . '" href="' . $href . '">' . strtoupper(esc_html__( $title, 'material-design-lite' )) . '</a>';
        }
    endif;


    /**
     * Init Kirki Customizer config
     * @since 1.0.0
     */
    Kirki::add_config( 'sp_mdl_theme', array(
        'capability'    => 'edit_theme_options',
        'option_type'   => 'theme_mod',
    ) );


    /**
     * Theme color
     * @since 1.0.0
     */
    Kirki::add_section( 'sp_mdl_theme__color', array(
        'title'          => esc_html__( 'Theme color', 'material-design-lite' ),
        'description'    => sprintf(
            __( 'Select the primary and accent colors to be used for your site. %sMDL Color Wheel%s', 'material-design-lite' ), //TODO: add some note about same colors
            '<a target="_blank" href="http://www.getmdl.io/customize/index.html">', '</a>'),
        'priority'       => 191,
    ) );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'theme_primary_color_title',
            'section'     => 'sp_mdl_theme__color',
            'default'     => kirki_custom_title( 'Primary color'),
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'       => 'color-palette',
            'settings'   => 'theme_primary_color',
            'section'    => 'sp_mdl_theme__color',
            'default'    => '#3F51B5',
            'choices'    => [
                'colors' => sp_mdl_color_wheel('primary'),
                'size'   => 50,
                'style'  => 'round',
            ],
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'theme_accent_color_title',
            'section'     => 'sp_mdl_theme__color',
            'default'     => kirki_custom_title( 'Accent color'),
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'       => 'color-palette',
            'settings'   => 'theme_accent_color',
            'section'    => 'sp_mdl_theme__color',
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
    Kirki::add_section( 'sp_mdl_theme__background', array(
        'title'    => esc_html__( 'Body Background', 'material-design-lite' ),
        'priority' => 192,
    ) );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'background_setting_title',
            'section'     => 'sp_mdl_theme__background',
            'default'     => kirki_custom_title( 'background control'),
            'description' => esc_html__( 'Background controls are pretty complex - but extremely useful if properly used.', 'material-design-lite' ),
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'background',
            'settings'    => 'background_setting',
            'section'     => 'sp_mdl_theme__background',
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
    Kirki::add_section( 'sp_mdl_theme__blog_entries', array(
        'title'          => esc_html__( 'Blog Entries', 'material-design-lite' ),
        'priority'       => 194,
    ) );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'blog_entries_header_title',
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => kirki_custom_title( 'HEADER'),
            'priority'    => 100,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'select',
            'settings'    => 'blog_entries_header_style',
            'label'       => esc_html__( 'Header layout', 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => 'modern',
            'priority'    => 105,
            'multiple'    => 1,
            'choices'     => [
                'simple'  => esc_html__( 'Simple: Only Title', 'material-design-lite' ),
                'classic' => esc_html__( 'Classic: Title + Featured image', 'material-design-lite' ),
                'modern'  => esc_html__( 'Modern: Title on the Featured image', 'material-design-lite' ),
                'none'    => esc_html__( 'None: Show nothing / Disable', 'material-design-lite' ),
            ],
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_entries_header_colorful_title',
            'label'       => esc_html__( 'Colorful Title', 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => '0',
            'priority'    => 110,
            'active_callback' => function() {
                if ( in_array(get_theme_mod( 'blog_entries_header_style', 'none' ), ['classic', 'simple'] ) ) {
                    return true;
                }
                return false;
            },
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_entries_header_random_bg_color',
            'label'       => esc_html__( 'Random header bg-color', 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => '1',
            'priority'    => 110,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'color-palette',
            'settings'    => 'blog_entries_header_bg_color',
            'label'       => esc_html__( 'Default bg-color for header', 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => get_theme_mod('theme_accent_color', '#E91E63'),
            'choices'     => [
                'colors' => sp_mdl_color_wheel('primary'),
                'size'   => 25,
                'style'  => 'round',
            ],
            'priority'    => 115,
            'active_callback' => [
                [
                    'setting'  => 'blog_entries_header_random_bg_color',
                    'operator' => '==',
                    'value'    => false,
                ]
            ],
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'image',
            'settings'    => 'blog_entries_header_bg_image',
            'label'       => esc_html__( 'Default Header Image', 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => '',
            'choices'     => [
                'save_as' => 'id',
            ],
            'priority'    => 120,
            'active_callback' => [
                [
                    'setting'  => 'blog_entries_header_random_bg_color',
                    'operator' => '==',
                    'value'    => false,
                ]
            ],
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'blog_entries_content_title',
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => kirki_custom_title('CONTENT'),
            'priority'    => 125,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_entries_content_excerpt',
            'label'       => esc_html__( 'Short post excerpt', 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => '0',
            'priority'    => 130,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'slider',
            'settings'    => 'blog_entries_content_excerpt_substr',
            'label'       => esc_html__( 'The excerpt will contain no more than the length of characters', 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => 55,
            'choices'     => [
                'min'  => 0,
                'max'  => 2500,
                'step' => 1,
            ],
            'priority'    => 135,
            'active_callback' => [
                [
                    'setting'  => 'blog_entries_content_excerpt',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'blog_entries_footer_title',
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => kirki_custom_title('FOOTER'),
            'priority'    => 140,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_entries_entry_footer_show',
            'label'       => esc_html__( 'Post footer', 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => '1',
            'priority'    => 145,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_entries_entry_footer_gravatar_show',
            'label'       => esc_html__( 'Gravatar icon', 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => '1',
            'priority'    => 150,
            'active_callback' => [
                [
                    'setting'  => 'blog_entries_entry_footer_show',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_entries_entry_footer_published_show',
            'label'       => esc_html__( 'Published date', 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => '1',
            'priority'    => 155,
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
        Kirki::add_section( 'sp_mdl_theme__blog_single', array(
            'title'          => esc_html__( 'Blog Single Post', 'material-design-lite' ),
            'priority'       => 194,
        ) );

            Kirki::add_field( 'sp_mdl_theme', [
                'type'        => 'custom',
                'settings'    => 'blog_single_header_title',
                'section'     => 'sp_mdl_theme__blog_single',
                'default'     => kirki_custom_title( 'Header'),
                'priority'    => 100,
            ] );

            Kirki::add_field( 'sp_mdl_theme', [
                'type'        => 'select',
                'settings'    => 'blog_single_header_style',
                'label'       => esc_html__( 'Header layout', 'material-design-lite' ),
                'section'     => 'sp_mdl_theme__blog_single',
                'default'     => 'modern',
                'priority'    => 105,
                'multiple'    => 1,
                'choices'     => [
                    'simple'  => esc_html__( 'Simple: Only Title', 'material-design-lite' ),
                    'classic' => esc_html__( 'Classic: Title + Featured image', 'material-design-lite' ),
                    'modern'  => esc_html__( 'Modern: Title on the Featured image', 'material-design-lite' ),
                    'none'    => esc_html__( 'None: Show nothing / Disable', 'material-design-lite' ),
                ],
            ] );

            Kirki::add_field( 'sp_mdl_theme', [
                'type'        => 'toggle',
                'settings'    => 'blog_single_header_colorful_title',
                'label'       => esc_html__( 'Colorful Title', 'material-design-lite' ),
                'section'     => 'sp_mdl_theme__blog_single',
                'default'     => '0',
                'priority'    => 110,
                'active_callback' => function() {
                    if ( in_array(get_theme_mod( 'blog_single_header_style', 'none' ), ['classic', 'simple'] ) ) {
                        return true;
                    }
                    return false;
                },
            ] );

            Kirki::add_field( 'sp_mdl_theme', [
                'type'        => 'custom',
                'settings'    => 'blog_single_content_title',
                'section'     => 'sp_mdl_theme__blog_single',
                'default'     => kirki_custom_title( 'Content'),
                'priority'    => 115,
            ] );

            Kirki::add_field( 'sp_mdl_theme', [
                'type'        => 'toggle',
                'settings'    => 'blog_single_content_header_show',
                'label'       => esc_html__( 'Content header', 'material-design-lite' ),
                'section'     => 'sp_mdl_theme__blog_single',
                'default'     => '1',
                'priority'    => 120,
            ] );



    // Page
        Kirki::add_section( 'sp_mdl_theme__page', array(
            'title'          => esc_html__( 'Page', 'material-design-lite' ),
            'priority'       => 194,
        ) );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'my_setting_3',
            'label'       => esc_html__( 'This is the label', 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__page',
            'default'     => '1',
            'priority'    => 100,
        ] );


    /**
     * Discussion Settings
     * @since 1.0.0
     */
    Kirki::add_section( 'sp_mdl_theme__comments', array(
        'title'       => esc_html__( 'Comments', 'material-design-lite' ),
        'priority'    => 197,
    ) );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'comments_title',
            'section'     => 'sp_mdl_theme__comments',
            'default'     => kirki_custom_title( 'Comments'),
            'priority'    => 100,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'comments_enabled',
            'label'       => esc_html__( 'Enable comments on website', 'material-design-lite' ),
            'description' => esc_html__( "Enable or disable the comments, for the entire site.", 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__comments',
            'default'     => '1',
            'priority'    => 105,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'comments_enabled_4_pages',
            'label'       => esc_html__( 'Enable comments on pages', 'material-design-lite' ),
            'description' => esc_html__( "Enable or disable the pages comments, for the entire site.", 'material-design-lite' ),
            'section'     => 'sp_mdl_theme__comments',
            'default'     => '1',
            'priority'    => 110,
            'active_callback' => [
                [
                    'setting'  => 'comments_enabled',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ] );

        // TODO add option to choose disqus, replybox or native comment system

endif;
