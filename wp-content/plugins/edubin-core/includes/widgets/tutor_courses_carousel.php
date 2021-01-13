<?php
namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly

class Edubin_Elementor_Widget_Tutor_Course_Carousel extends Widget_Base {

	public function get_name() {
		return 'edubin-tutor-course-addons';
	}

	public function get_title() {
		return __('Tutor LMS Courses', 'edubin-core');
	}

	public function get_icon() {
		return 'edubin-icon eicon-gallery-grid';
	}

	public function get_categories() {
		return ['edubin-core'];
	}

	public function get_script_depends() {
		return [
			// 'slick',
			'edubin-widgets-scripts',
		];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'tutor_courses',
			[
				'label' => __('Courses', 'edubin-core'),
			]
		);
		$this->add_control(
			'course_layout_styles',
			[
				'label' => __('Styles', 'edubin-core'),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __('Style 1', 'edubin-core'),
					'2' => __('Style 2', 'edubin-core'),
				],
			]
		);
		$this->add_control(
			'carousel_on_off',
			[
				'label' => esc_html__('Carousel', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'posts_column',
			[
				'label' => __('Items Column', 'edubin-core'),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'2' => __('6 Column', 'edubin-core'),
					'3' => __('4 Column', 'edubin-core'),
					'4' => __('3 Column', 'edubin-core'),
					'6' => __('2 Column', 'edubin-core'),
					'12' => __('1 Column', 'edubin-core'),
				],
				'condition' => [
					'carousel_on_off!' => 'yes',
				],
			]
		);

		$this->add_control(
			'carusel_items_column',
			[
				'label' => esc_html__('Items Column', 'edubin-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);
		$this->add_control(
			'post_limit',
			[
				'label' => __('Number of Course', 'edubin-core'),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'tutor_courses_category_or_tag',
			[
				'label' => esc_html__('Choose Category or Tag', 'edubin-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'tutor_courses_categories',
				'options' => [
					'tutor_courses_categories' => esc_html__('Category', 'edubin-core'),
					'tutor_courses_tag' => esc_html__('Tag', 'edubin-core'),
				],
			]
		);

		$this->add_control(
			'tutor_courses_categories',
			[
				'label' => __('Select Category', 'edubin-core'),
				'type' => Controls_Manager::SELECT2,
				'options' => edubin_tutor_get_taxonomies(),
				'multiple' => true,
				'condition' => [
					'tutor_courses_category_or_tag!' => 'tutor_courses_tag',
				],
			]
		);
		$this->add_control(
			'tutor_courses_tag',
			[
				'label' => __('Select Tag', 'edubin-core'),
				'type' => Controls_Manager::SELECT2,
				'options' => edubin_tutor_get_tag(),
				'multiple' => true,
				'condition' => [
					'tutor_courses_category_or_tag!' => 'tutor_courses_categories',
				],
			]
		);
		$this->add_control(
			'custom_order',
			[
				'label' => esc_html__('Custom Order', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'postorder',
			[
				'label' => esc_html__('Order', 'edubin-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => esc_html__('Descending', 'edubin-core'),
					'ASC' => esc_html__('Ascending', 'edubin-core'),
				],
				'condition' => [
					'custom_order!' => 'yes',
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => esc_html__('Orderby', 'edubin-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__('None', 'edubin-core'),
					'ID' => esc_html__('ID', 'edubin-core'),
					'date' => esc_html__('Date', 'edubin-core'),
					'name' => esc_html__('Name', 'edubin-core'),
					'title' => esc_html__('Title', 'edubin-core'),
					'comment_count' => esc_html__('Comment count', 'edubin-core'),
					'rand' => esc_html__('Random', 'edubin-core'),
				],
				'condition' => [
					'custom_order' => 'yes',
				],
			]
		);
		$this->add_control(
			'title_length',
			[
				'label' => __('Title Length', 'edubin-core'),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'default' => 15,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'default' => 'large',
				'separator' => 'none',
			]
		);
        $this->add_responsive_control(
            'tutor_image_height',
            [
                'label' => __( 'Image Height', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 350,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-tutor-courses-column-area .tutor-course-header > a, .edubin-tutor-courses-column-area .tutor-course-header> a > img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tutor-course-col .tutor-course .tutor-course-header img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

		// Carousel setting
		$this->start_controls_section(
			'carousel_option',
			[
				'label' => esc_html__('Carousel Option', 'edubin-core'),
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'slarrows',
			[
				'label' => esc_html__('Nav Arrow', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'nav_arrow_style',
			[
				'label' => __('Nav Style', 'edubin-core'),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __('Style 1', 'edubin-core'),
					'2' => __('Style 2', 'edubin-core'),
				],
				'condition' => [
					'slarrows' => 'yes',
				],
			]
		);

		$this->add_control(
			'slprevicon',
			[
				'label' => __('Previous icon', 'edubin-core'),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-angle-left',
				'condition' => [
					'slarrows' => 'yes',
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'slnexticon',
			[
				'label' => __('Next icon', 'edubin-core'),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-angle-right',
				'condition' => [
					'slarrows' => 'yes',
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'sldots',
			[
				'label' => esc_html__('Dots', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'slpause_on_hover',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __('No', 'edubin-core'),
				'label_on' => __('Yes', 'edubin-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				'label' => __('Pause on Hover?', 'edubin-core'),
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);
		$this->add_control(
			'slautolay',
			[
				'label' => esc_html__('Auto play', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'separator' => 'before',
				'default' => 'no',
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'slautoplay_speed',
			[
				'label' => __('Autoplay speed', 'edubin-core'),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'slanimation_speed',
			[
				'label' => __('Autoplay animation speed', 'edubin-core'),
				'type' => Controls_Manager::NUMBER,
				'default' => 300,
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'slscroll_columns',
			[
				'label' => __('Slider item to scroll', 'edubin-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_tablet',
			[
				'label' => __('Tablet', 'edubin-core'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'sltablet_display_columns',
			[
				'label' => __('Slider Items', 'edubin-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 8,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'sltablet_scroll_columns',
			[
				'label' => __('Slider item to scroll', 'edubin-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 8,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'sltablet_width',
			[
				'label' => __('Tablet Resolution', 'edubin-core'),
				'description' => __('The resolution to tablet.', 'edubin-core'),
				'type' => Controls_Manager::NUMBER,
				'default' => 769,
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_mobile',
			[
				'label' => __('Mobile Phone', 'edubin-core'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'slmobile_display_columns',
			[
				'label' => __('Slider Items', 'edubin-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 4,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'slmobile_scroll_columns',
			[
				'label' => __('Slider item to scroll', 'edubin-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 4,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->add_control(
			'slmobile_width',
			[
				'label' => __('Mobile Resolution', 'edubin-core'),
				'description' => __('The resolution to mobile.', 'edubin-core'),
				'type' => Controls_Manager::NUMBER,
				'default' => 480,
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);

		$this->end_controls_section(); // Option end

		$this->start_controls_section(
			'course_meta_option',
			[
				'label' => __('Meta', 'edubin-core'),
			]
		);
		$this->add_control(
			'show_difficulty_level',
			[
				'label' => esc_html__('Difficulty Level', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_wishlist',
			[
				'label' => esc_html__('Wishlist', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_review',
			[
				'label' => esc_html__('Review', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_enroll',
			[
				'label' => esc_html__('Enroll', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'course_layout_styles' => '1',
				],
			]
		);
		$this->add_control(
			'show_duration',
			[
				'label' => esc_html__('Duration', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'course_layout_styles' => '1',
				],
			]
		);
		$this->add_control(
			'show_author_avatar',
			[
				'label' => esc_html__('Author Avatar', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'course_layout_styles' => '1',
				],
			]
		);
		$this->add_control(
			'show_author_name',
			[
				'label' => esc_html__('Author Name', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_catagory',
			[
				'label' => esc_html__('Category', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'course_layout_styles' => '1',
				],
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label' => esc_html__('Excerpt', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'course_layout_styles' => '1',
				],
			]
		);
		$this->add_control(
			'show_footer',
			[
				'label' => esc_html__('Price', 'edubin-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->end_controls_section(); // Option End
		// Course body style
		$this->start_controls_section(
			'course_style_section',
			[
				'label' => __('Style', 'edubin-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'courses_align',
			[
				'label' => __('Alignment', 'edubin-core'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'edubin-core'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'edubin-core'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'edubin-core'),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tutor-loop-course-container' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .edubin-tutor-courses-addons .tutor-courses-wrap.style-2 .tutor-course-col .tutor-course' => 'text-align: {{VALUE}};',
				],
				'default' => 'left',
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs('body_box_tabs');

		$this->start_controls_tab(
			'body_box_normal_tab',
			[
				'label' => __('Normal', 'edubin-core'),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .edubin-tutor-courses-addons .slick-slide, .edubin-tutor-courses-addons .tutor-courses-wrap.style-2 .tutor-course-col .tutor-course',
			]
		);

		$this->end_controls_tab(); // Normal Tab end

		$this->start_controls_tab(
			'body_box_hover_tab',
			[
				'label' => __('Hover', 'edubin-core'),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			['label' => __('Box Shadow Hover', 'edubin-core'),
			'name' => 'box_shadow_hover',
			'selector' => '{{WRAPPER}} .tutor-loop-course-container:hover, .edubin-tutor-courses-addons .tutor-courses-wrap.style-2 .tutor-course-col .tutor-course:hover',
		]
	);

		$this->end_controls_tab(); // Hover Tab end

		$this->end_controls_tabs();

		$this->add_control(
			'course_bg_color',
			[
				'label' => __('Content Background', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-loop-course-container' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .edubin-tutor-courses-addons .tutor-courses-wrap.style-2 .tutor-course-col .tutor-course' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'course_footer_bg_color',
			[
				'label' => __('Footer Background', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-loop-course-footer' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'course_layout_styles' => '1',
				],
			]
		);
		$this->end_controls_section();

		// Style Title tab section
		$this->start_controls_section(
			'lp_course_title_style_section',
			[
				'label' => __('Title', 'edubin-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_review' => 'yes',
				],
			]
		);

		$this->start_controls_tabs('title_style_tabs');

		$this->start_controls_tab(
			'title_style_normal_tab',
			[
				'label' => __('Normal', 'edubin-core'),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __('Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-course-loop-title h2 a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tutor-course-col .tutor-course-body h3 a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __('Typography', 'edubin-core'),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tutor-course-loop-title h2 a, .tutor-course-col .tutor-course-body h3 a',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __('Padding', 'edubin-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .tutor-course-loop-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tutor-course-col .tutor-course-body h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'title_section_height',
            [
                'label' => __( 'Title Section Height', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 23,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', ],
                'selectors' => [
                    '{{WRAPPER}} .tutor-course-col .tutor-course-body h3' => 'height: {{SIZE}}{{UNIT}};',
                ],
				'condition' => [
					'course_layout_styles' => '2',
				],
            ]
        );
		$this->end_controls_tab(); // Normal Tab end

		$this->start_controls_tab(
			'title_style_hover_tab',
			[
				'label' => __('Hover', 'edubin-core'),
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __('Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-course-loop-title h2 a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tutor-course-col .tutor-course-body h3 a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab(); // Hover Tab end

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Style content excerpt
		$this->start_controls_section(
			'tutor_course_excerpt_style_section',
			[
				'label' => __('Excerpt', 'edubin-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_excerpt' => 'yes',
				],
				'condition' => [
					'course_layout_styles' => '1',
				],
			]
		);
		$this->add_control(
			'excerpt_color',
			[
				'label' => __('Excerpt Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .edubin-tutor-courses-addons .edubin-tutor-excerpt p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'excerpt_padding',
			[
				'label' => __('Padding', 'edubin-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .edubin-tutor-courses-addons .edubin-tutor-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Style Meta tab section
		$this->start_controls_section(
			'post_meta_style_section',
			[
				'label' => __('Meta', 'edubin-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'level_typography',
				'label' => __('Level Typography', 'edubin-core'),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tutor-course-loop-level',
			]
		);
		$this->add_control(
			'Level_bg_color',
			[
				'label' => __('Level Background', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-course-loop-level' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'wishlist_icon_color',
			[
				'label' => __('Wishlist Icon Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-course-loop-header-meta .tutor-course-wishlist a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tutor-course-loop-header-meta .tutor-course-wishlist:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'wishlist_bg_color',
			[
				'label' => __('Wishlist Background Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-course-loop-header-meta .tutor-course-wishlist' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .tutor-course-loop-header-meta .tutor-course-wishlist:hover a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta_icon_color',
			[
				'label' => __('Icon Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-single-loop-meta i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tutor-course-loop-price>.price .tutor-loop-cart-btn-wrap a::before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta_text_color',
			[
				'label' => __('Text Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-single-loop-meta span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta_Secondary_text_color',
			[
				'label' => __('Secondary Text Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-loop-author>div span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'author_name_typography',
				'label' => __('Author Typography', 'edubin-core'),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tutor-loop-author>.tutor-single-course-author-name a, .tutor-course-author',
			]
		);

		$this->start_controls_tabs('author_name_style_tabs');

		$this->start_controls_tab(
			'author_name_style_normal_tab',
			[
				'label' => __('Normal', 'edubin-core'),
			]
		);

		$this->add_control(
			'author_name_color',
			[
				'label' => __('Author Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-loop-author>.tutor-single-course-author-name a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tutor-course-author' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab(); // Normal Tab end

		$this->start_controls_tab(
			'author_name_style_hover_tab',
			[
				'label' => __('Hover', 'edubin-core'),
			]
		);
		$this->add_control(
			'author_name_hover_color',
			[
				'label' => __('Author Hover Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-loop-author>.tutor-single-course-author-name a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tutor-course-author:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab(); // Hover Tab end

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'label' => __('Category Typography', 'edubin-core'),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .tutor-loop-author>.tutor-course-lising-category a',
				'condition' => [
					'course_layout_styles' => '1',
				],
			]
		);

		$this->start_controls_tabs('cat_style_tabs');

		$this->start_controls_tab(
			'cat_style_normal_tab',
			[
				'label' => __('Normal', 'edubin-core'),
				'condition' => [
					'course_layout_styles' => '1',
				],
			]
		);

		$this->add_control(
			'cat_color',
			[
				'label' => __('Category Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-loop-author>.tutor-course-lising-category a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'course_layout_styles' => '1',
				],
			]
		);

		$this->end_controls_tab(); // Normal Tab end

		$this->start_controls_tab(
			'cat_style_hover_tab',
			[
				'label' => __('Hover', 'edubin-core'),
				'condition' => [
					'course_layout_styles' => '1',
				],
			]
		);
		$this->add_control(
			'cat_hover_color',
			[
				'label' => __('Category Hover Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-loop-author>.tutor-course-lising-category a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab(); // Hover Tab end

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => __('Price Typography', 'edubin-core'),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .tutor-course-loop-price>.price',
			]
		);
		$this->add_control(
			'price_color',
			[
				'label' => __('Price Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-course-loop-price>.price' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'enroll_icon_color',
			[
				'label' => __('Enroll Icon Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-course-loop-price>.price .tutor-loop-cart-btn-wrap a::before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'enroll_typography',
				'label' => __('Enroll Typography', 'edubin-core'),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .tutor-course-loop-price>.price .tutor-loop-cart-btn-wrap a',
			]
		);

		$this->start_controls_tabs('enroll_style_tabs');

		$this->start_controls_tab(
			'enroll_style_normal_tab',
			[
				'label' => __('Normal', 'edubin-core'),
			]
		);

		$this->add_control(
			'enroll_color',
			[
				'label' => __('Enroll text Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tutor-course-loop-price>.price .tutor-loop-cart-btn-wrap a' => 'color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab(); // Normal Tab end

        $this->start_controls_tab(
        	'enroll_style_hover_tab',
        	[
        		'label' => __('Hover', 'edubin-core'),
        	]
        );
        $this->add_control(
        	'enroll_hover_color',
        	[
        		'label' => __('Enroll Text Hover Color', 'edubin-core'),
        		'type' => Controls_Manager::COLOR,
        		'default' => '',
        		'selectors' => [
        			'{{WRAPPER}} .tutor-course-loop-price>.price .tutor-loop-cart-btn-wrap a:hover' => 'color: {{VALUE}}',
        		],
        	]
        );

        $this->end_controls_tab(); // Hover Tab end

        $this->end_controls_tabs();


        $this->end_controls_section();

		// Style Slider arrow style start
        $this->start_controls_section(
        	'lp_course_arrow_style',
        	[
        		'label' => __('Arrow', 'edubin-core'),
        		'tab' => Controls_Manager::TAB_STYLE,
        		'condition' => [
        			'slarrows' => 'yes',
        			'carousel_on_off' => 'yes',
        		],

        	]
        );

        $this->start_controls_tabs('lp_course_arrow_style_tabs');

		// Normal tab Start
        $this->start_controls_tab(
        	'lp_course_arrow_style_normal_tab',
        	[
        		'label' => __('Normal', 'edubin-core'),
        	]
        );

        $this->add_control(
        	'arrow_color',
        	[
        		'label' => __('Icon Color', 'edubin-core'),
        		'type' => Controls_Manager::COLOR,
        		'default' => '',
        		'selectors' => [
        			'{{WRAPPER}} .edubin-carousel-activation button.slick-arrow' => 'color: {{VALUE}};',
        			'{{WRAPPER}} .edubin-tutor-courses-addons.edubin-nav-button-2 .edubin-carousel-activation button.slick-arrow' => 'color: {{VALUE}};',
        		],
        	]
        );
        $this->add_responsive_control(
        	'arrow_position',
        	[
        		'label' => __('Position', 'edubin-core'),
        		'type' => Controls_Manager::SLIDER,
        		'size_units' => ['px'],
        		'range' => [
        			'px' => [
        				'min' => 0,
        				'max' => 200,
        				'step' => 1,
        			],
        		],
        		'selectors' => [
        			'{{WRAPPER}} .edubin-tutor-courses-addons.edubin-nav-button-1 .edubin-carousel-activation button.slick-arrow' => 'top: -{{SIZE}}{{UNIT}};',
        		],
        	]
        );
        $this->add_control(
        	'arrow_bg_color',
        	[
        		'label' => __('Background', 'edubin-core'),
        		'type' => Controls_Manager::COLOR,
        		'default' => '',
        		'selectors' => [
        			'{{WRAPPER}} .edubin-carousel-activation button.slick-arrow' => 'background-color: {{VALUE}};',
        		],
        	]
        );
        $this->add_group_control(
        	Group_Control_Border::get_type(),
        	[
        		'name' => 'course_arrow_border',
        		'label' => __('Border', 'edubin-core'),
        		'selector' => '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow',
        	]
        );

        $this->add_responsive_control(
        	'course_border_radius',
        	[
        		'label' => esc_html__('Border Radius', 'edubin-core'),
        		'type' => Controls_Manager::DIMENSIONS,
        		'selectors' => [
        			'{{WRAPPER}} .edubin-carousel-activation button.slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
        		],
        	]
        );

		$this->end_controls_tab(); // Normal tab end

		// Hover tab Start
		$this->start_controls_tab(
			'lp_course_arrow_style_hover_tab',
			[
				'label' => __('Hover', 'edubin-core'),
			]
		);

		$this->add_control(
			'slider_arrow_hover_color',
			[
				'label' => __('Color', 'edubin-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .edubin-carousel-activation button.slick-arrow:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'slider_arrow_hover_background',
				'label' => __('Background', 'edubin-core'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'slider_arrow_hover_border',
				'label' => __('Border', 'edubin-core'),
				'selector' => '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow:hover',
			]
		);

		$this->add_responsive_control(
			'slider_arrow_hover_border_radius',
			[
				'label' => esc_html__('Border Radius', 'edubin-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .edubin-carousel-activation button.slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->end_controls_tab(); // Hover tab end

		$this->end_controls_tabs();

		$this->end_controls_section(); // Style arrow style end

		// Style Dot section
		$this->start_controls_section(
			'course_dot_style_section',
			[
				'label' => __('Dot', 'edubin-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'carousel_on_off' => 'yes',
				],
			]
		);
		$this->add_control(
			'dot_color',
			[
				'label' => __( 'Dot Color', 'edubin-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .edubin-carousel-activation .slick-dots li button' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .edubin-carousel-activation .slick-dots li.slick-active button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'dot_size',
			[
				'label' => __('Dot Size', 'edubin-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .edubin-carousel-activation .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dot_position',
			[
				'label' => __('Position', 'edubin-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .edubin-carousel-activation .slick-dots li' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dot_space_between',
			[
				'label' => __('Space Between', 'edubin-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .edubin-carousel-activation .slick-dots li' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render($instance = []) {

		$settings = $this->get_settings_for_display();

		$custom_order_ck = $this->get_settings_for_display('custom_order');
		$orderby = $this->get_settings_for_display('orderby');
		$postorder = $this->get_settings_for_display('postorder');

     	if (function_exists('tutor')) : // Check tutor lms active

		// Course Column
     	$this->add_render_attribute('edubin_posts_column', 'class', 'col-xs-' . '12' . ' col-sm-' . '6' . ' col-md-' . '6' . ' col-lg-' . $settings['posts_column'] );

		// Button style
     	$this->add_render_attribute('edubin_carousel_btn_style', ['class' => 'edubin-tutor-courses-addons edubin-nav-button-' . $settings['nav_arrow_style']]);

		// Carusel options
     	$this->add_render_attribute('edubin_course_carousel_attr', 'class', ($settings['carousel_on_off'] ? 'edubin-carousel-activation' : 'row'));

     	$slider_settings = [
     		'arrows' => ('yes' === $settings['slarrows']),
     		'arrow_prev_txt' => $settings['slprevicon'],
     		'arrow_next_txt' => $settings['slnexticon'],
     		'dots' => ('yes' === $settings['sldots']),
     		'autoplay' => ('yes' === $settings['slautolay']),
     		'autoplay_speed' => absint($settings['slautoplay_speed']),
     		'animation_speed' => absint($settings['slanimation_speed']),
     		'pause_on_hover' => ('yes' === $settings['slpause_on_hover']),
     	];

     	$slider_responsive_settings = [
     		'display_columns' => $settings['carusel_items_column'],
     		'scroll_columns' => $settings['slscroll_columns'],
     		'tablet_width' => $settings['sltablet_width'],
     		'tablet_display_columns' => $settings['sltablet_display_columns'],
     		'tablet_scroll_columns' => $settings['sltablet_scroll_columns'],
     		'mobile_width' => $settings['slmobile_width'],
     		'mobile_display_columns' => $settings['slmobile_display_columns'],
     		'mobile_scroll_columns' => $settings['slmobile_scroll_columns'],

     	];

     	$slider_settings = array_merge($slider_settings, $slider_responsive_settings);

     	$this->add_render_attribute('edubin_course_carousel_attr', 'data-settings', wp_json_encode($slider_settings));

     	if ($settings['tutor_courses_category_or_tag'] == 'tutor_courses_categories') {
			// Query
     		$args_cat = array(
     			'post_type' => tutor()->course_post_type,
     			'post_status' => 'publish',
     			'ignore_sticky_posts' => 1,
     			'posts_per_page' => !empty($settings['post_limit']) ? $settings['post_limit'] : 3,
     			'order' => $postorder,
     		);

			// Custom Order
     		if ($custom_order_ck == 'yes') {
     			$args_cat['orderby'] = $orderby;
     		}

     	} elseif ($settings['tutor_courses_category_or_tag'] == 'tutor_courses_tag') {
			// Query
     		$args_tag = array(
     			'post_type' => tutor()->course_post_type,
     			'post_status' => 'publish',
     			'ignore_sticky_posts' => 1,
     			'posts_per_page' => !empty($settings['post_limit']) ? $settings['post_limit'] : 3,
     			'order' => $postorder,
     		);

			// Custom Order
     		if ($custom_order_ck == 'yes') {
     			$args_tag['orderby'] = $orderby;
     		}
     	}

     	if (!empty($settings['tutor_courses_categories'])) {
     		$get_categories = $settings['tutor_courses_categories'];
     	} else {
     		$get_categories = $settings['tutor_courses_categories'];
     	}

     	$carousel_cats = str_replace(' ', '', $get_categories);

     	if (!empty($get_categories)) {
     		if (is_array($carousel_cats) && count($carousel_cats) > 0) {
     			$field_name = is_numeric($carousel_cats[0]) ? 'term_id' : 'slug';

     			$args_cat['tax_query'] = array(
     				array(
     					'taxonomy' => 'course-category',
     					'terms' => $carousel_cats,
     					'field' => $field_name,
     					'include_children' => false,
     				),
     			);
     		}
     	}

     	if (!empty($settings['tutor_courses_tag'])) {
     		$get_tag = $settings['tutor_courses_tag'];
     	} else {
     		$get_tag = $settings['tutor_courses_tag'];
     	}

     	$carousel_tag = str_replace(' ', '', $get_tag);

     	if (!empty($get_categories)) {
     		if (is_array($carousel_tag) && count($carousel_tag) > 0) {
     			$field_name = is_numeric($carousel_tag[0]) ? 'term_id' : 'slug';

     			$args_tag['tax_query'] = array(
     				array(
     					'taxonomy' => 'course-tag',
     					'terms' => $carousel_tag,
     					'field' => $field_name,
     					'include_children' => false,
     				),
     			);
     		}
     	}

     	if ($settings['tutor_courses_category_or_tag'] == 'tutor_courses_categories') {

     		$cat_tag_args = $args_cat;

     	} elseif ($settings['tutor_courses_category_or_tag'] == 'tutor_courses_tag') {
     		$cat_tag_args = $args_tag;
     	}

     	$carousel_post = new \WP_Query($cat_tag_args);

     	?>
     	<div <?php echo $this->get_render_attribute_string('edubin_carousel_btn_style'); ?>>

		<?php if ($settings['carousel_on_off'] == 'yes'): ?>
 			<div <?php echo $this->get_render_attribute_string('edubin_course_carousel_attr'); ?>>
 		<?php else : ?>
			<div class="row">
		<?php endif;?>

     			<?php
     			if ($carousel_post->have_posts()):
     				while ($carousel_post->have_posts()): $carousel_post->the_post();
     					?>

     					<?php if (!$settings['carousel_on_off'] == 'yes'): ?>
     						<div <?php echo $this->get_render_attribute_string('edubin_posts_column'); ?> >
								<div class="edubin-tutor-courses-column-area">
     						<?php endif;?>

     					<?php if ($settings['carousel_on_off'] == 'yes'): ?>
     						<div class="edubin-tutor-course-loop" >
     					<?php endif;?>

						<?php if ($settings['course_layout_styles'] == '1') : ?>

     							<?php do_action('tutor_course/loop/before_content');

     							do_action('tutor_course/loop/badge');

     							do_action('tutor_course/loop/before_header');?>

								<?php if ( has_post_thumbnail() ) : ?>
	     							<div class="tutor-course-header">
							     		<a href="<?php the_permalink(); ?>">
											<?php
						                     the_post_thumbnail($settings['image_size']);
												$course_id = get_the_ID();
											?>
							     		</a>
	     								<div class="tutor-course-loop-header-meta">
	     									<?php
	     									$is_wishlisted = tutor_utils()->is_wishlisted($course_id);
	     									$has_wish_list = '';
	     									if ($is_wishlisted) {
	     										$has_wish_list = 'has-wish-listed';
	     									}
	     									if ($settings['show_difficulty_level'] == 'yes') {
	     										echo '<span class="tutor-course-loop-level">' . get_tutor_course_level() . '</span>';
	     									}
	     									if ($settings['show_wishlist'] == 'yes') {
	     										echo '<span class="tutor-course-wishlist"><a href="javascript:;" class="tutor-icon-fav-line tutor-course-wishlist-btn ' . $has_wish_list . ' " data-course-id="' . $course_id . '"></a> </span>';
	     									}
	     									?>
	     								</div>
	     							</div>
	     						<?php else : ?>
                                <?php $placholder_img = plugins_url('/edubin-core/assets/img/course-ph.png'); ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
                                    </a>
								<?php endif; ?>
     							<?php
     							do_action('tutor_course/loop/after_header');

     							do_action('tutor_course/loop/start_content_wrap');
     							if ($settings['show_review'] == 'yes') {
     								do_action('tutor_course/loop/before_rating');
     								do_action('tutor_course/loop/rating');
     								do_action('tutor_course/loop/after_rating');
     							}
     							do_action('tutor_course/loop/before_title');
     							do_action('tutor_course/loop/title');
     							do_action('tutor_course/loop/after_title');

     							do_action('tutor_course/loop/before_meta');

     							global $post, $authordata;
     							if ( has_post_thumbnail() ) :
     								$profile_url = tutor_utils()->profile_url($authordata->ID);
								endif;
     							?>
     							<?php if ($settings['show_enroll'] == 'yes' || $settings['show_duration'] == 'yes'): ?>
     								<div class="tutor-course-loop-meta">
     									<?php
     									$course_duration = get_tutor_course_duration_context();
     									$course_students = tutor_utils()->count_enrolled_users_by_course();
     									?>
     									<?php if ($settings['show_enroll'] == 'yes') {?>
     										<div class="tutor-single-loop-meta">
     											<i class='tutor-icon-user'></i><span><?php echo $course_students; ?></span>
     										</div>
     									<?php }?>
     									<?php
     									if (!empty($course_duration && $settings['show_duration'] == 'yes')) {?>
     										<div class="tutor-single-loop-meta">
     											<i class='tutor-icon-clock'></i> <span><?php echo $course_duration; ?></span>
     										</div>
     									<?php }?>
     								</div>
     							<?php endif;?>

     							<?php if ($settings['show_author_avatar'] == 'yes' || $settings['show_author_name'] == 'yes' || $settings['show_catagory'] == 'yes'): ?>
     								<div class="tutor-loop-author">
     									<?php if ($settings['show_author_avatar'] == 'yes' && has_post_thumbnail()) {?>
     										<div class="tutor-single-course-avatar">
     											<a href="<?php echo $profile_url; ?>"> <?php echo tutor_utils()->get_tutor_avatar($post->post_author); ?></a>
     										</div>
     									<?php }?>
     									<?php if ($settings['show_author_name'] == 'yes' && has_post_thumbnail()) {?>
     										<div class="tutor-single-course-author-name">
     											<span><?php _e('by', 'edubin-core');?></span>
     											<a href="<?php echo $profile_url; ?>"><?php echo get_the_author(); ?></a>
     										</div>
     									<?php }?>
     									<?php if ($settings['show_catagory'] == 'yes') {
     										?>
     										<div class="tutor-course-lising-category">
     											<?php
     											$course_categories = get_tutor_course_categories();
     											if (!empty($course_categories) && is_array($course_categories) && count($course_categories)) {
     												?>
     												<span><?php esc_html_e('In', 'edubin-core')?></span>
     												<?php
     												foreach ($course_categories as $course_category) {
     													$category_name = $course_category->name;
     													$category_link = get_term_link($course_category->term_id);
     													echo "<a href='$category_link'>$category_name </a>";
     												}
     											}
     											?>
     										</div>
     									<?php }?>
     								</div>
     							<?php endif;?>

     							<?php
     							do_action('tutor_course/loop/after_meta');

     							if ($settings['show_excerpt'] == 'yes') {
     								do_action('tutor_course/loop/before_excerpt'); ?>
     								<div class="edubin-tutor-excerpt">
     									<?php the_excerpt(); ?>
     								</div>
     							<?php	
     							do_action('tutor_course/loop/after_excerpt');
     							}
     							do_action('tutor_course/loop/end_content_wrap');

     							if ($settings['show_footer'] == 'yes') {
     								do_action('tutor_course/loop/before_footer');
     								do_action('tutor_course/loop/footer');
     								do_action('tutor_course/loop/after_footer');
     							}
     							do_action('tutor_course/loop/after_content');?>

							<?php elseif ($settings['course_layout_styles'] == '2') : ?>

								<?php 							
									global $post, $authordata;
									if ( has_post_thumbnail() ) :
										$profile_url = tutor_utils()->profile_url($authordata->ID);
									endif;							 
								?>
							    <div class="tutor-courses-wrap row style-2">
							        <div class="tutor-course-col">
							            <div class="tutor-course">
							                <div class="tutor-course-header">
							                    <?php tutor_course_loop_thumbnail();?>
							                    <div class="tutor-course-loop-header-meta">
							                     <?php
							                        $is_wishlisted = tutor_utils()->is_wishlisted(get_the_ID());
							                        $has_wish_list = '';
							                        if ($is_wishlisted) {
							                            $has_wish_list = 'has-wish-listed';
							                        }

							                        echo '<span class="tutor-course-loop-level">' . get_tutor_course_level() . '</span>';
							                        echo '<span class="tutor-course-wishlist"><a href="javascript:;" class="tutor-icon-fav-line tutor-course-wishlist-btn ' . $has_wish_list . ' " data-course-id="' . get_the_ID() . '"></a> </span>';
							                        ?>
							                    </div>
							                </div>
							                <div class="tutor-course-body">
							                    <h3>
							                        <a href="<?php the_permalink();?>">
							                            <?php echo get_the_title(); ?>
							                        </a>
							                    </h3>
							                    <a href="<?php echo esc_url($profile_url); ?>" class="tutor-course-author"><?php the_author();?></a>
							                    <?php $course_rating = tutor_utils()->get_course_rating();?>
							                    <div class="tutor-loop-rating-wrap <?php echo !$course_rating->rating_count ? 'no-rating' : ''; ?>">
							                        <?php tutor_utils()->star_rating_generator($course_rating->rating_avg);?>
							                        <span class="tutor-rating-count">
							                            <?php
							                            echo $course_rating->rating_avg;
							                            echo '<i>(' . $course_rating->rating_count . ')</i>';
							                            ?>
							                        </span>
							                    </div>

							                    <div class="tutor-course-pricing clearfix">
							                        <?php echo tutor_course_loop_price(); ?>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							<?php endif;?>

     					<?php if ($settings['carousel_on_off'] == 'yes'): ?>
     						</div>
     					<?php endif;?>


     					<?php if (!$settings['carousel_on_off'] == 'yes'): ?>
     							</div>
     						</div>
     					<?php endif;?>

     				<?php endwhile;
     				wp_reset_postdata();
     				wp_reset_query();
     			endif; 
     		endif;
     		?>

     	</div>
     </div>


     <?php

 }

}
