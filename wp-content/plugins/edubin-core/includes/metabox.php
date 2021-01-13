<?php
// Page meta
add_action('cmb2_admin_init', 'edubin_page_metabox');
function edubin_page_metabox(){

    $prefix  = '_edubin_';
    $page_header_options = new_cmb2_box(
        array(
            'id'           => 'page_header_options',
            'title'         => __( 'Page Options', 'edubin-core' ),
            'object_types' => get_post_types(),
            'context'      => 'normal',
            'priority'     => 'high',
            'show_names'   => true,
            'fields'       => array(
                array(
                    'name'    => __('Page Heading', 'edubin-core'),
                    'id'      => $prefix . 'page_header_enable',
                    'type'    => 'select',
                    'default' => 'enable',
                    'options' => array(
                        'enable'  => __('Enable', 'edubin-core'),
                        'disable' => __('Disable', 'edubin-core'),
                    ),
                ),
                array(
                    'name'       => __('Page Header Image', 'edubin-core'),
                    'id'         => $prefix . 'header_img',
                    'type'       => 'file',
                    'default'    => '',
                ),
                array(
                    'name'    => __('Page Background', 'edubin-core'),
                    'id'      => $prefix . 'page_bg_color',
                    'type'    => 'colorpicker',
                    'default' => '',
                ),
            ),
        )
    );

}
 // LearnPress course custom features metxbox
add_action( 'cmb2_admin_init', 'edubin_lp_course_feature_metaboxes' );
function edubin_lp_course_feature_metaboxes() {

    $cmb = new_cmb2_box( array(
        'id'            => 'edubin_lp_course_feature_repeater',  // Belgrove Bouncing Castles
        'title'         => 'Custom Course Features',
        'object_types'  => array( 'lp_course', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );
    $lp_custom_feature_group_id = $cmb->add_field( array(
        'id'          => 'lp_custom_feature_group',
        'type'        => 'group',
        'repeatable'  => true,
        'options'     => array(
            'group_title'   => 'Course Features {#}',
            'add_button'    => 'Add Another Feature',
            'remove_button' => 'Remove Feature',
            'closed'        => true,  // Repeater fields closed by default - neat & compact.
            'sortable'      => true,  // Allow changing the order of repeated groups.
        ),
    ) );
    $cmb->add_group_field( $lp_custom_feature_group_id, array(
      'name'        => __( 'Add Icon', 'edubin-core' ),
      'desc' => __( 'Add your font awesome icon class. Find all icon here: https://fontawesome.com/v4.7.0/icons/', 'edubin-core' ),
      'id'          => 'lp_custom_feature_group_icon',
      'type'        => 'fontawesome_icon', // This field type
    ) );
    $cmb->add_group_field( $lp_custom_feature_group_id, array(
        'name'        => __( 'Label', 'edubin-core' ),
        'desc' => __( 'Add your custom course feature label', 'edubin-core' ),
        'id'   => 'lp_custom_feature_group_label',
        'type' => 'text',
    ) );
    $cmb->add_group_field( $lp_custom_feature_group_id, array(
        'name'        => __( 'Value', 'edubin-core' ),
        'desc' => __( 'Add your custom course feature label value', 'edubin-core' ),
        'id'   => 'lp_custom_feature_group_value',
        'type' => 'text',
    ) );
}

// The events calender metabox
add_action( 'cmb2_admin_init', 'edubin_tribe_events_map_metabox' );
function edubin_tribe_events_map_metabox() {
    $prefix = '_edubin_';
    $cmb_tribe_events_map = new_cmb2_box( array(
        'id'           => $prefix . 'tribe_events_metabox',
        'title'        => __( 'Location Maps', 'edubin-core' ),
        'object_types' => array( 'tribe_events' ), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
    ) );

    $cmb_tribe_events_map->add_field( array(
        'name' => __( 'Google Maps HTML Code', 'edubin-core' ),
        'desc' => 'Add your google maps HTML code', 'edubin-core',
        'id'      => 'edubin_cmb2_tribe_events_map_html_code',
        'type'    => 'textarea_code',
    ) );
}
// Edubin course features metabox
add_action( 'cmb2_admin_init', 'edubin_course_features_metabox' );
function edubin_course_features_metabox() {
    $prefix = '_edubin_';
    $cmb_ld_course_metabox = new_cmb2_box( array(
        'id'           => $prefix . 'edubin_course_metabox',
        'title'        => __( 'Course Features', 'edubin-core' ),
        'object_types' => array( 'sfwd-courses' ), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
    ) );

    $cmb_ld_course_metabox->add_field( array(
        'name'        => __( 'Custom Views Number', 'edubin-core' ),
        'desc' => __( 'Add your course custom views number', 'edubin-core' ),
        'id'   => 'custom_views_number',
        'type' => 'text',
    ) );
}