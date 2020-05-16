<?php
/**
 * Material Design Lite Theme Customizer with Kirki Toolkit
 *
 * @package SP_MDL
 */

if (class_exists('Kirki')) :

    /**
     * Kirki helpers
     */
    if (!function_exists('kirki_custom_title')) :
        function kirki_custom_title($title)
        {
            return '<div class="mdl-customizer-section-title">' . $title . '</div>';
        }
    endif;
    if (!function_exists('kirki_custom_button')) :
        function kirki_custom_button($title = 'Button', $class = '', $href = '#')
        {
            return '<a class="mdl-customizer-section-button button-secondary button ' . $class . '" href="' . $href . '">' . strtoupper($title) . '</a>';
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
        'title'          => esc_html__( 'Theme color', 'sp-mdl' ),
        'description'    => sprintf(
            __( 'Select the primary and accent colors to be used for your site. %sMDL Color Wheel%s', 'sp-mdl' ),
            '<a target="_blank" href="http://www.getmdl.io/customize/index.html">', '</a>'),
        'priority'       => 191,
    ) );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'theme_primary_color_title',
            'section'     => 'sp_mdl_theme__color',
            'default'     => kirki_custom_title( __('Primary color', 'sp-mdl')),
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
            'default'     => kirki_custom_title( __('Accent color', 'sp-mdl')),
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
        'title'    => esc_html__( 'Body Background', 'sp-mdl' ),
        'priority' => 192,
    ) );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'background_setting_title',
            'section'     => 'sp_mdl_theme__background',
            'default'     => kirki_custom_title( __('background control', 'sp-mdl')),
            'description' => esc_html__( 'Background controls are pretty complex - but extremely useful if properly used.', 'sp-mdl' ),
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
        'title'          => esc_html__( 'Blog Entries', 'sp-mdl' ),
        'priority'       => 194,
    ) );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'blog_entries_header_title',
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => kirki_custom_title( __('Header', 'sp-mdl')),
            'priority'    => 100,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'select',
            'settings'    => 'blog_entries_header_style',
            'label'       => esc_html__( 'Layout', 'sp-mdl' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => 'modern',
            'priority'    => 105,
            'multiple'    => 1,
            'choices'     => [
                'simple'  => esc_html__( 'Simple: Only Title', 'sp-mdl' ),
                'classic' => esc_html__( 'Classic: Title + Featured image', 'sp-mdl' ),
                'modern'  => esc_html__( 'Modern: Title on the Featured image', 'sp-mdl' ),
                'none'    => esc_html__( 'None: Show nothing / Disable', 'sp-mdl' ),
            ],
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_entries_header_colorful_title',
            'label'       => esc_html__( 'Colorful Title', 'sp-mdl' ),
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
            'label'       => esc_html__( 'Random header bg-color', 'sp-mdl' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => '1',
            'priority'    => 110,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'color-palette',
            'settings'    => 'blog_entries_header_bg_color',
            'label'       => esc_html__( 'Default bg-color for header', 'sp-mdl' ),
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
            'label'       => esc_html__( 'Default Header Image', 'sp-mdl' ),
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
            'default'     => kirki_custom_title('Content'),
            'priority'    => 125,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_entries_content_excerpt',
            'label'       => esc_html__( 'Short post excerpt', 'sp-mdl' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => '0',
            'priority'    => 130,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'slider',
            'settings'    => 'blog_entries_content_excerpt_substr',
            'label'       => esc_html__( 'The excerpt will contain no more than the length of characters', 'sp-mdl' ),
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
            'default'     => kirki_custom_title(__('Footer', 'sp-mdl')),
            'priority'    => 140,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_entries_entry_footer_show',
            'label'       => esc_html__( 'Post footer', 'sp-mdl' ),
            'section'     => 'sp_mdl_theme__blog_entries',
            'default'     => '1',
            'priority'    => 145,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_entries_entry_footer_gravatar_show',
            'label'       => esc_html__( 'Gravatar icon', 'sp-mdl' ),
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
            'label'       => esc_html__( 'Published date', 'sp-mdl' ),
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
        'title'          => esc_html__( 'Blog Single Post', 'sp-mdl' ),
        'priority'       => 194,
    ) );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'blog_single_header_title',
            'section'     => 'sp_mdl_theme__blog_single',
            'default'     => kirki_custom_title( __('Header', 'sp-mdl')),
            'priority'    => 100,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'select',
            'settings'    => 'blog_single_header_style',
            'label'       => esc_html__( 'Layout', 'sp-mdl' ),
            'section'     => 'sp_mdl_theme__blog_single',
            'default'     => 'modern',
            'priority'    => 105,
            'multiple'    => 1,
            'choices'     => [
                'simple'  => esc_html__( 'Simple: Only Title', 'sp-mdl' ),
                'classic' => esc_html__( 'Classic: Title + Featured image', 'sp-mdl' ),
                'modern'  => esc_html__( 'Modern: Title on the Featured image', 'sp-mdl' ),
                'none'    => esc_html__( 'None: Show nothing / Disable', 'sp-mdl' ),
            ],
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_single_header_colorful_title',
            'label'       => esc_html__( 'Colorful Title', 'sp-mdl' ),
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
            'default'     => kirki_custom_title( __('Content', 'sp-mdl')),
            'priority'    => 115,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_single_content_header_show',
            'label'       => esc_html__( 'Content header', 'sp-mdl' ),
            'section'     => 'sp_mdl_theme__blog_single',
            'default'     => '1',
            'priority'    => 120,
        ] );



    // Page
    Kirki::add_section( 'sp_mdl_theme__page', array(
        'title'          => esc_html__( 'Page', 'sp-mdl' ),
        'priority'       => 194,
    ) );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'blog_page_header_title',
            'section'     => 'sp_mdl_theme__page',
            'default'     => kirki_custom_title( __('Header', 'sp-mdl')),
            'priority'    => 100,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'select',
            'settings'    => 'blog_page_header_style',
            'label'       => esc_html__( 'Layout', 'sp-mdl' ),
            'section'     => 'sp_mdl_theme__page',
            'default'     => 'modern',
            'priority'    => 105,
            'multiple'    => 1,
            'choices'     => [
                'simple'  => esc_html__( 'Simple: Only Title', 'sp-mdl' ),
                'classic' => esc_html__( 'Classic: Title + Featured image', 'sp-mdl' ),
                'modern'  => esc_html__( 'Modern: Title on the Featured image', 'sp-mdl' ),
                'none'    => esc_html__( 'None: Show nothing / Disable', 'sp-mdl' ),
            ],
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'blog_page_header_colorful_title',
            'label'       => esc_html__( 'Colorful Title', 'sp-mdl' ),
            'section'     => 'sp_mdl_theme__page',
            'default'     => '0',
            'priority'    => 110,
            'active_callback' => function() {
                if ( in_array(get_theme_mod( 'blog_page_header_style', 'none' ), ['classic', 'simple'] ) ) {
                    return true;
                }
                return false;
            },
        ] );


    /**
     * Discussion Settings
     * @since 1.0.0
     */
    Kirki::add_section( 'sp_mdl_theme__comments', array(
        'title'       => esc_html__( 'Comments', 'sp-mdl' ),
        'priority'    => 197,
    ) );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'custom',
            'settings'    => 'comments_title',
            'section'     => 'sp_mdl_theme__comments',
            'default'     => kirki_custom_title( __('Comments', 'sp-mdl')),
            'priority'    => 100,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'comments_enabled',
            'label'       => esc_html__( 'Enable comments on website', 'sp-mdl' ),
            'description' => esc_html__( "Enable or disable the comments, for the entire site.", 'sp-mdl' ),
            'section'     => 'sp_mdl_theme__comments',
            'default'     => '1',
            'priority'    => 105,
        ] );

        Kirki::add_field( 'sp_mdl_theme', [
            'type'        => 'toggle',
            'settings'    => 'comments_enabled_4_pages',
            'label'       => esc_html__( 'Enable comments on pages', 'sp-mdl' ),
            'description' => esc_html__( "Enable or disable the pages comments, for the entire site.", 'sp-mdl' ),
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
