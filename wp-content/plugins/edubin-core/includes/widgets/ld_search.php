<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Edubin_Elementor_Widget_LD_Search extends Widget_Base {

    public function get_name() {
        return 'edubin-ld-search';
    }
    
    public function get_title() {
        return __( 'LeanDash LMS Search', 'edubin-core' );
    }

    public function get_icon() {
        return 'edubin-icon eicon-search';
    }

    public function get_categories() {
        return [ 'edubin-core' ];
    }

    public function get_script_depends() {
        return [''];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Content', 'edubee' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'btn_text',
            [
              'label' => __( 'Button Text', 'edubee' ),
              'type'  => Controls_Manager::TEXT,
              'default' => '',
              'label_block' => true,
          ]
      );

        $this->add_control(
            'placeholder',
            [
              'label' => __( 'Placeholder', 'edubee' ),
              'type'  => Controls_Manager::TEXT,
              'default' => 'What do you want to learn?',
              'label_block' => true,
          ]
      );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_testimoni',
            [
                'label' => __( 'Style', 'edubee' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'froms_height',
            [
                'label'  => __( 'Height', 'edubee' ),
                'type'   => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                ],
                'range'  => [
                    'px' => [
                        'min' => 42,
                        'max' => 120,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} form.ld-course-form-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'froms_submit_width',
            [
                'label'  => __( 'Submit Button Width', 'edubee' ),
                'type'   => Controls_Manager::SLIDER,
                'range'  => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ld-course-form-wrapper .ld-course-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'froms_border_radious',
            [
                'label'  => __( 'Border Radius', 'edubee' ),
                'type'   => Controls_Manager::SLIDER,
                'range'  => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-courses-searching' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'input_color',
            [
                'label'     => __( 'Input Text', 'edubee' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-course-form-wrapper .ld-course-input' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_border_color',
            [
                'label'     => __( 'Input Border', 'edubee' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-course-form-wrapper .ld-course-input' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_bg_color',
            [
                'label'     => __( 'Input Background', 'edubee' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-course-form-wrapper .ld-course-input' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label'     => __( 'Submit Background', 'edubee' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-course-form-wrapper .ld-course-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_hover_color',
            [
                'label'     => __( 'Submit Background Hover', 'edubee' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-course-form-wrapper .ld-course-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_border_color',
            [
                'label'     => __( 'Submit Border', 'edubee' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-course-form-wrapper .ld-course-btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'submit_typography',
                'label'    => __( 'Submit Typography', 'edubee' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .ld-course-form-wrapper .ld-course-btn',
            ]
        );
        
        $this->add_control(
            'input_placholder_color',
            [
                'label'     => __( 'Placeholder', 'edubee' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-course-form-wrapper input::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_text_color',
            [
                'label'     => __( 'Submit Text', 'edubee' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-course-form-wrapper .ld-course-btn' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'btn_text_hover_color',
            [
                'label'     => __( 'Submit Text Hover', 'edubee' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-course-form-wrapper .ld-course-btn:hover' => 'color: {{VALUE}};',

                ],
            ]
        );
        $this->end_controls_section();

    } // End options

    protected function render( $instance = [] ) {
        
        $settings = $this->get_settings();
        ?>
        <div class="edubin-courses-searching">

            <form class="ld-course-form-wrapper" method="get" action="<?php echo esc_url( get_post_type_archive_link('sfwd-courses') ); ?>">

                <input type="text" value="" name="s" placeholder="<?php echo $settings['placeholder']; ?>" class="ld-course-input" autocomplete="off" />
                <input type="hidden" value="course" name="ref" />
                <button class="ld-course-btn" type="submit"><?php if ($settings['btn_text']) : echo $settings['btn_text']; else : ?> <i class="fa fa-search"></i><?php endif; ?></button>
                <span class="widget-search-close"></span>

            </form>
        </div>

        <?php

    }

}

