<?php
// Social 
$wp_customize->add_section( 'social_section',
    array(
        'title' => esc_html__( 'Social Share', 'edubin' ),
        'panel' => 'general_panel',
        'priority'   => 40,
    )
);

// Add our Checkbox switch setting and control for opening URLs in a new tab
$wp_customize->add_setting('social_newtab',
    array(
        'default'           => $this->defaults['social_newtab'],
        'transport'         => 'postMessage',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'social_newtab',
    array(
        'label'   => esc_html__('Open in new browser tab', 'edubin'),
        'section' => 'social_section',
    )
));
$wp_customize->selective_refresh->add_partial('social_newtab',
    array(
        'selector'            => '.social',
        'container_inclusive' => false,
        'render_callback'     => function () {
            echo edubin_get_social_media();
        },
        'fallback_refresh'    => true,
    )
);

// Add our Text Radio Button setting and Custom Control for controlling alignment of icons
$wp_customize->add_setting('social_alignment',
    array(
        'default'           => $this->defaults['social_alignment'],
        'transport'         => 'postMessage',
        'sanitize_callback' => 'edubin_radio_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Text_Radio_Button_Custom_Control($wp_customize, 'social_alignment',
    array(
        'label'       => esc_html__('Alignment', 'edubin'),
        'description' => esc_html__('Choose the alignment for your social icons', 'edubin'),
        'section'     => 'social_section',
        'choices'     => array(
            'alignleft'  => esc_html__('Left', 'edubin'),
            'alignright' => esc_html__('Right', 'edubin'),
        ),
    )
));
$wp_customize->selective_refresh->add_partial('social_alignment',
    array(
        'selector'            => '.social',
        'container_inclusive' => false,
        'render_callback'     => function () {
            echo edubin_get_social_media();
        },
        'fallback_refresh'    => true,
    )
);
// Header top show/hide
$wp_customize->add_setting('follow_us_show',
    array(
        'default'           => $this->defaults['follow_us_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'follow_us_show',
    array(
        'label'   => esc_html__('Enable', 'edubin'),
        'section' => 'social_section',
    )
));
// Login button text
$wp_customize->add_setting('follow_us_text',
    array(
        'default'           => $this->defaults['follow_us_text'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);
$wp_customize->add_control('follow_us_text',
    array(
        'label'   => esc_html__('Custom Follow Us Text', 'edubin'),
        'type'    => 'text',
        'section' => 'social_section',
    )
);
// Add our Sortable Repeater setting and Custom Control for Social media URLs
$wp_customize->add_setting('social_urls',
    array(
        'default'           => $this->defaults['social_urls'],
        'transport'         => 'postMessage',
        'sanitize_callback' => 'edubin_url_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Sortable_Repeater_Custom_Control($wp_customize, 'social_urls',
    array(
        'label'         => esc_html__('Social URLs', 'edubin'),
        'description'   => esc_html__('Add your social media links.', 'edubin'),
        'section'       => 'social_section',
        'button_labels' => array(
            'add' => esc_html__('Add Icon', 'edubin'),
        ),
    )
));
$wp_customize->selective_refresh->add_partial('social_urls',
    array(
        'selector'            => '.social',
        'container_inclusive' => false,
        'render_callback'     => function () {
            echo edubin_get_social_media();
        },
        'fallback_refresh'    => true,
    )
);

$wp_customize->add_setting('social_url_icons',
    array(
        'default'           => $this->defaults['social_url_icons'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_text_sanitization',
    )
);
