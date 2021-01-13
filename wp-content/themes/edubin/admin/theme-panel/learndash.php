<?php
// Archive page
$wp_customize->add_section('learndash_archive_page_section',
    array(
        'title' => esc_html__('Archive Page', 'edubin'),
        'panel' => 'learndash_panel',
    )
);

// Style
$wp_customize->add_setting('ld_course_archive_style',
    array(
        'default'           => $this->defaults['ld_course_archive_style'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_radio_sanitization',
    )
);

$wp_customize->add_control('ld_course_archive_style',
    array(
        'label'   => esc_html__('Courses Style', 'edubin'),
        'section' => 'learndash_archive_page_section',
        'type'    => 'select',
        'choices' => array(
            '1' => esc_html__('Style 1', 'edubin'),
            '2' => esc_html__('Style 2', 'edubin'),
            '3' => esc_html__('Style 3', 'edubin'),
            '4' => esc_html__('Style 4', 'edubin'),
            '5' => esc_html__('Style 5', 'edubin'),
        ),
    )
);

// Column
$wp_customize->add_setting('ld_course_archive_clm',
    array(
        'default'           => $this->defaults['ld_course_archive_clm'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_radio_sanitization',
    )
);
$wp_customize->add_control('ld_course_archive_clm',
    array(
        'label'   => esc_html__('Courses Column', 'edubin'),
        'section' => 'learndash_archive_page_section',
        'type'    => 'select',
        'choices' => array(
            '6' => esc_html__('Column 2', 'edubin'),
            '4' => esc_html__('Column 3', 'edubin'),
            '3' => esc_html__('Column 4', 'edubin'),
        ),
    )
);

// Price
$wp_customize->add_setting('ld_hide_archive_text',
    array(
        'default'           => $this->defaults['ld_hide_archive_text'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'ld_hide_archive_text',
    array(
        'label'   => esc_html__('Hide Archive: Text', 'edubin'),
        'section' => 'learndash_archive_page_section',
    )
));
// Price
$wp_customize->add_setting('ld_price_show',
    array(
        'default'           => $this->defaults['ld_price_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'ld_price_show',
    array(
        'label'   => esc_html__('Price', 'edubin'),
        'section' => 'learndash_archive_page_section',
    )
));

// Views
$wp_customize->add_setting('ld_views_show',
    array(
        'default'           => $this->defaults['ld_views_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'ld_views_show',
    array(
        'label'   => esc_html__('Views', 'edubin'),
        'section' => 'learndash_archive_page_section',
    )
));

// Comment
$wp_customize->add_setting('ld_comment_show',
    array(
        'default'           => $this->defaults['ld_comment_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'ld_comment_show',
    array(
        'label'   => esc_html__('Comments', 'edubin'),
        'section' => 'learndash_archive_page_section',
    )
));
// progress bar
$wp_customize->add_setting('ld_progress_bar_show',
    array(
        'default'           => $this->defaults['ld_progress_bar_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'ld_progress_bar_show',
    array(
        'label'   => esc_html__('Progress Bar', 'edubin'),
        'section' => 'learndash_archive_page_section',
    )
));

// See more Button
$wp_customize->add_setting('see_more_btn',
    array(
        'default'           => $this->defaults['see_more_btn'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'see_more_btn',
    array(
        'label'   => esc_html__('See More Button', 'edubin'),
        'section' => 'learndash_archive_page_section',
    )
));
// Read more button text
$wp_customize->add_setting( 'ld_see_more_btn_text',
    array(
        'default' => $this->defaults['ld_see_more_btn_text'],
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    )
);

$wp_customize->add_control( 'ld_see_more_btn_text',
    array(
        'label' => esc_html__( 'See More Button - Custom Text', 'edubin' ),
        'type' => 'text',
        'section' => 'learndash_archive_page_section'
    )
);
// Free custom text
$wp_customize->add_setting( 'free_custom_text',
    array(
        'default' => $this->defaults['free_custom_text'],
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    )
);

$wp_customize->add_control( 'free_custom_text',
    array(
        'label' => esc_html__( 'Free - Custom Text', 'edubin' ),
        'type' => 'text',
        'section' => 'learndash_archive_page_section'
    )
);
// Free custom text
$wp_customize->add_setting( 'enrolled_custom_text',
    array(
        'default' => $this->defaults['enrolled_custom_text'],
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    )
);

$wp_customize->add_control( 'enrolled_custom_text',
    array(
        'label' => esc_html__( 'Enrolled - Custom Text', 'edubin' ),
        'type' => 'text',
        'section' => 'learndash_archive_page_section'
    )
);
// Free custom text
$wp_customize->add_setting( 'completed_custom_text',
    array(
        'default' => $this->defaults['completed_custom_text'],
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    )
);

$wp_customize->add_control( 'completed_custom_text',
    array(
        'label' => esc_html__( 'Completed - Custom Text', 'edubin' ),
        'type' => 'text',
        'section' => 'learndash_archive_page_section'
    )
);
// learndash single page
$wp_customize->add_section('learndash_single_page_section',
    array(
        'title' => esc_html__('Single Page', 'edubin'),
        'panel' => 'learndash_panel',
    )
);

// Sidebar
$wp_customize->add_setting('ld_sidebar_single_show',
    array(
        'default'           => $this->defaults['ld_sidebar_single_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'ld_sidebar_single_show',
    array(
        'label'   => esc_html__('Sidebar', 'edubin'),
        'section' => 'learndash_single_page_section',
    )
));

// Related
$wp_customize->add_setting('ld_related_course_show',
    array(
        'default'           => $this->defaults['ld_related_course_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'ld_related_course_show',
    array(
        'label'       => esc_html__('Related Course', 'edubin'),
        'description' => esc_html__('Show hide your sidebar you may like course section', 'edubin'),
        'section'     => 'learndash_single_page_section',
    )
));
// Related Course heading
$wp_customize->add_setting( 'ld_related_course_heading',
    array(
        'default' => $this->defaults['ld_related_course_heading'],
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    )
);

$wp_customize->add_control( 'ld_related_course_heading',
    array(
        'label' => esc_html__( 'Related Course Heading', 'edubin' ),
        'type' => 'text',
        'section' => 'learndash_single_page_section'
    )
);
// views
$wp_customize->add_setting('ld_related_course_views',
    array(
        'default'           => $this->defaults['ld_related_course_views'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'ld_related_course_views',
    array(
        'label'       => esc_html__('Related Course Views', 'edubin'),
        'section'     => 'learndash_single_page_section',
    )
));
// Price
$wp_customize->add_setting('ld_related_course_price',
    array(
        'default'           => $this->defaults['ld_related_course_price'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'ld_related_course_price',
    array(
        'label'       => esc_html__('Related Course Price', 'edubin'),
        'section'     => 'learndash_single_page_section',
    )
));

      // Learndash other settings start
   $wp_customize->add_section( 'ld_course_others_section',
        array(
            'title' => esc_html__( 'Utilities', 'edubin' ),
            'panel' => 'learndash_panel'
        )
    );
// Custom placeholder image
$wp_customize->add_setting('ld_custom_placeholder_image', array(
  'capability'        => 'edit_theme_options',
  'sanitize_callback' => 'esc_url_raw',
  'transport'         => 'refresh',
  'default'           => $this->defaults['ld_custom_placeholder_image'],
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ld_custom_placeholder_image', array(
  'label'       => esc_html__('Custom Placeholder Image', 'edubin'),
  'section'     => 'ld_course_others_section',
)));


