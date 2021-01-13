<?php 

/* Template Name: Tutor Advanced Course Filter */

get_header(); 

?>


<?php 
if (function_exists('tutor')) {

function tutor_course_function($atts, $content, $tag)
{

    // Customizer option
    $defaults = edubin_generate_defaults();
    $filter_course_search_show = get_theme_mod( 'filter_course_search_show', $defaults['filter_course_search_show']); 
    $tutor_filter_results_show = get_theme_mod( 'tutor_filter_results_show', $defaults['tutor_filter_results_show']); 
    $tutor_filter_select_show = get_theme_mod( 'tutor_filter_select_show', $defaults['tutor_filter_select_show']); 
    $tutor_course_filter_per_page = get_theme_mod( 'tutor_course_filter_per_page', $defaults['tutor_course_filter_per_page']); 
    $tutor_course_filter_column = get_theme_mod( 'tutor_course_filter_column', $defaults['tutor_course_filter_column']); 
    $tutor_sidebar_filter_show = get_theme_mod( 'tutor_sidebar_filter_show', $defaults['tutor_sidebar_filter_show']); 
    $tutor_course_cat_count = get_theme_mod( 'tutor_course_cat_count', $defaults['tutor_course_cat_count']); 
    $tutor_filter_custom_level_text = get_theme_mod( 'tutor_filter_custom_level_text', $defaults['tutor_filter_custom_level_text']); 
    $tutor_filter_category_show = get_theme_mod( 'tutor_filter_category_show', $defaults['tutor_filter_category_show']); 
    $tutor_filter_custom_cat_text = get_theme_mod( 'tutor_filter_custom_cat_text', $defaults['tutor_filter_custom_cat_text']); 
    $tutor_filter_level_show = get_theme_mod( 'tutor_filter_level_show', $defaults['tutor_filter_level_show']); 
    $tutor_course_pagination = get_theme_mod( 'tutor_course_pagination', $defaults['tutor_course_pagination']); 
    $tutor_filter_sidebar_position = get_theme_mod( 'tutor_filter_sidebar_position', $defaults['tutor_filter_sidebar_position']); 
    $tutor_filter_custom_topic_text = get_theme_mod( 'tutor_filter_custom_topic_text', $defaults['tutor_filter_custom_topic_text']); 
    $tutor_filter_topic_show = get_theme_mod( 'tutor_filter_topic_show', $defaults['tutor_filter_topic_show']); 

    global $wp_query;
    $sidebar_filter = $tutor_sidebar_filter_show;
    $course_per_page = $tutor_course_filter_per_page;
    $course_pagination = $tutor_course_pagination;
    $course_column_count = $tutor_course_filter_column;
    $course_category_count = get_theme_mod('course_category_count', 1);
    $course_sidebar_position = $tutor_filter_sidebar_position;

    $atts = extract(shortcode_atts(array(
        'sidebar' => $sidebar_filter,
        'count' => $course_per_page,
        'pagination' => $course_pagination,
        'column' => $course_column_count,
        'category_count' => $course_category_count,
        'sidebar_position' => $course_sidebar_position,
    ), $atts, $tag
    ));

    if ($sidebar === 'false' || $sidebar === 0) {
        $sidebar = false;
    }

    switch ($column) {
        case 1:
            $column = 12;
            break;
        case 2:
            $column = 6;
            break;
        case 3:
            $column = 4;
            break;
        case 4:
            $column = 3;
            break;
        case 6:
            $column = 2;
            break;
        case 12:
            $column = 1;
            break;
        default:
            $column = 3;
    }

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $selected_cat = !empty($_GET['course_category']) ? (array) $_GET['course_category'] : array();
    $selected_cat = array_map('sanitize_text_field', $selected_cat);
    $selected_cat = array_map('intval', $selected_cat);
    $is_queried_object = false;
    if (isset($wp_query->queried_object->term_id)) {
        $is_queried_object = true;
        $selected_cat = array($wp_query->queried_object->term_id);
    }

    $selected_tag = !empty($_GET['course_tag']) ? (array) $_GET['course_tag'] : array();
    $selected_tag = array_map('sanitize_text_field', $selected_tag);
    $selected_tag = array_map('intval', $selected_tag);

    $selected_level = !empty($_GET['course_level']) ? (array) $_GET['course_level'] : array('all_levels');
    $selected_level = array_map('sanitize_text_field', $selected_level);

    $course_terms_cat = get_terms(array(
        'taxonomy' => 'course-category',
        'hide_empty' => true,
        'parent' => 0,
    ));

    $course_terms_tag = get_terms(array(
        'taxonomy' => 'course-tag',
        'hide_empty' => true,
    ));

    $course_levels = tutor_utils()->course_levels();

    $course_level_filter = !empty($selected_level) && !in_array('all_levels', $selected_level) ? array(
        'key' => '_tutor_course_level',
        'value' => $selected_level,
        'compare' => 'IN',
    ) : array();

    $args = array(
        'post_type' => tutor()->course_post_type,
        'post_status' => 'publish',
        'paged' => $paged,
        'posts_per_page' => $count,
        's' => get_search_query(),
        'meta_query' => array(
            $course_level_filter,
        ),
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'course-category',
                'field' => 'term_id',
                'terms' => $selected_cat,
                'operator' => !empty($selected_cat) ? 'IN' : 'NOT IN',
            ),
            array(
                'taxonomy' => 'course-tag',
                'field' => 'term_id',
                'terms' => $selected_tag,
                'operator' => !empty($selected_tag) ? 'IN' : 'NOT IN',
            ),
        ),
    );

    $course_filter = 'newest_first';
    if (!empty($_GET['tutor_course_filter'])) {
        $course_filter = sanitize_text_field($_GET['tutor_course_filter']);
    }
    switch ($course_filter) {
        case 'newest_first':
            $args['orderby'] = 'ID';
            $args['order'] = 'desc';
            break;
        case 'oldest_first':
            $args['orderby'] = 'ID';
            $args['order'] = 'asc';
            break;
        case 'course_title_az':
            $args['orderby'] = 'post_title';
            $args['order'] = 'asc';
            break;
        case 'course_title_za':
            $args['orderby'] = 'post_title';
            $args['order'] = 'desc';
            break;
    }

    $q = new WP_Query($args);
    ob_start();?>


    <div class="row">
        <?php if ($sidebar): ?>

            <?php
                $current_url = get_post_type_archive_link('course');
            ?>
            <div class="col-12 col-md-4 col-lg-3 order-2 order-sm-<?php echo $sidebar_position == 'right' ? 2 : 1; ?> mb-4 md-lg-0">
                <?php if ($filter_course_search_show) {?>
                <div class="edubin-filter-courses-searching">
                    <form class="tutor-filter-course-form-wrapper" method="get" action="<?php echo esc_url( get_post_type_archive_link(tutor()->course_post_type) ); ?>">

                        <input type="text" value="" name="s" placeholder="<?php esc_html_e('Find your course', 'edubin');?>" class="tutor-course-input" autocomplete="off" />
                        <input type="hidden" value="course" name="ref" />
                        <button class="tutor-course-btn" type="submit"><i class="fa fa-search"></i></button>
                        <span class="widget-search-close"></span>

                    </form>
                </div>
                <?php }?>
                
                <?php if ($tutor_filter_results_show || $tutor_filter_select_show) {?>      
                    <div class="tutor-course-filter-wrap tutor-course-filter-wrap2 align-items-center">
                        <?php if ($tutor_filter_results_show) {?>
                            <div class="tutor-course-archive-results-wrap">
                                <?php
                                $courseCount = tutor_utils()->get_archive_page_course_count();
                                printf(__('%s Courses', 'edubin'), "<strong>{$q->post_count}</strong>");
                                ?>
                            </div>
                        <?php }?>
                        <?php if ($tutor_filter_select_show) {?>
                            <div class="tutor-course-archive-filters-wrap">
                                <form class="tutor-course-filter-form" method="get">
                                    <select name="tutor_course_filter" class="small">
                                        <option value="newest_first" <?php if (isset($_GET["tutor_course_filter"]) ? selected("newest_first", $_GET["tutor_course_filter"]) : "");?> ><?php _e("Release Date (newest first)", 'edubin');?></option>
                                        <option value="oldest_first" <?php if (isset($_GET["tutor_course_filter"]) ? selected("oldest_first", $_GET["tutor_course_filter"]) : "");?>><?php _e("Release Date (oldest first)", 'edubin');?></option>
                                        <option value="course_title_az" <?php if (isset($_GET["tutor_course_filter"]) ? selected("course_title_az", $_GET["tutor_course_filter"]) : "");?>><?php _e("Course Title (a-z)", 'edubin');?></option>
                                        <option value="course_title_za" <?php if (isset($_GET["tutor_course_filter"]) ? selected("course_title_za", $_GET["tutor_course_filter"]) : "");?>><?php _e("Course Title (z-a)", 'edubin');?></option>
                                    </select>
                                </form>
                            </div>
                        <?php }?>
                    </div>
                <?php }?>

                <form class="tutor-sidebar-filter" action="<?php echo esc_url($current_url); ?>" method="get">
                    <input type="hidden" name="s" value="<?php echo get_search_query(); ?>">

                <?php if ($tutor_filter_level_show) : ?>
                    <div class="single-filter">
                        <?php if ($tutor_filter_custom_level_text) { ?>
                             <h4><?php echo esc_html($tutor_filter_custom_level_text); ?></h4>
                      <?php  } else { ?>
                            <h4><?php esc_html_e('Level', 'edubin');?></h4>
                       <?php }
                         ?>

                        <?php
                        foreach ($course_levels as $key => $course_level) {
                            if ($key == 'all_levels') {
                                continue;
                            }
                            ?>
                            <label for="<?php echo esc_attr($key); ?>">
                                <input
                                    type="checkbox"
                                    name="course_level[]"
                                    value="<?php echo esc_attr($key); ?>"
                                    id="<?php echo esc_attr($key); ?>"
                                    <?php echo in_array($key, $selected_level) ? 'checked="checked"' : ''; ?>
                                >
                                <span class="filter-checkbox"></span>
                                <?php echo esc_html($course_level); ?>
                            </label>
                            <?php
                        }?>
                    </div>
                <?php endif; ?>

                    <?php if (is_array($course_terms_cat) && count($course_terms_cat) && $tutor_filter_category_show): ?>
                        <div class="single-filter">

                        <?php if ($tutor_filter_custom_cat_text) { ?>
                            <h4><?php echo esc_html($tutor_filter_custom_cat_text); ?></h4>
                      <?php  } else { ?>
                            <h4><?php esc_html_e('Category', 'edubin');?></h4>
                       <?php }
                         ?>
                            <?php
                                foreach ($course_terms_cat as $course_term) {
                                        $childern = get_categories(
                                            array(
                                                'parent' => $course_term->term_id,
                                                'taxonomy' => 'course-category',
                                            )
                                            );?>
                                <div class="tutor-archive-single-cat">
                                    <label for="cat-<?php echo esc_attr($course_term->slug) ?>">
                                        <input
                                                type="checkbox"
                                                name="course_category[]"
                                                value="<?php echo esc_attr($course_term->term_id) ?>"
                                                id="cat-<?php echo esc_attr($course_term->slug) ?>"
                                            <?php echo in_array($course_term->term_id, $selected_cat) ? 'checked="checked"' : ''; ?>
                                        >
                                        <span class="filter-checkbox"></span>
                                        <?php echo esc_attr($course_term->name);?>

                                        <?php if ($tutor_course_cat_count) { ?>
                                       <span class="edubin-filter-course-count <?php if(count($childern)) : echo esc_attr('has-children'); endif; ?> ?>"> <?php echo esc_attr('('. $course_term->count .')');?></span>
                                        <?php } ?>

                                    </label>
                                       <?php
                                        if (count($childern)) {
                                            echo "<i class='category-toggle fa fa-plus'></i>";
                                        }?>
                                    <?php if (count($childern)): ?>
                                        <div class="tutor-archive-childern"  style="display: none;">
                                            <?php foreach ($childern as $child) {?>
                                                <label for="cat-<?php echo esc_attr($child->slug) ?>">
                                                    <input
                                                            type="checkbox"
                                                            name="course_category[]"
                                                            value="<?php echo esc_attr($child->term_id) ?>"
                                                            id="cat-<?php echo esc_attr($child->slug) ?>"
                                                        <?php echo in_array($child->term_id, $selected_cat) ? 'checked="checked"' : ''; ?>
                                                    >
                                                    <span class="filter-checkbox"></span>
                                                    <?php echo esc_attr($child->name) ?>

                                                    <?php if ($tutor_course_cat_count) { ?>
                                                   <span class="edubin-filter-course-count <?php if(count($childern)) : echo esc_attr('has-children'); endif; ?> ?>"> <?php echo esc_attr('('. $child->count .')');?></span>
                                                    <?php } ?>
                                                </label>
                                            <?php }?>
                                        </div>
                                    <?php endif;?>
                                </div>

                            <?php }?>
                        </div>
                    <?php endif;?>

                    <?php if (is_array($course_terms_tag) && count($course_terms_tag) && $tutor_filter_topic_show): ?>
                        <div class="single-filter">
                           
                            <?php if ($tutor_filter_custom_topic_text) { ?>
                                <h4><?php echo esc_html($tutor_filter_custom_topic_text); ?></h4>
                          <?php  } else { ?>
                                <h4><?php esc_html_e('Topics', 'edubin');?></h4>
                           <?php }
                             ?>
                            <?php
                                foreach ($course_terms_tag as $course_tag) {
                            ?>
                                <label for="tag-<?php echo esc_attr($course_tag->slug) ?>">
                                    <input
                                        type="checkbox"
                                        name="course_tag[]"
                                        value="<?php echo esc_attr($course_tag->term_id) ?>"
                                        id="tag-<?php echo esc_attr($course_tag->slug) ?>"
                                        <?php echo in_array($course_tag->term_id, $selected_tag) ? 'checked="checked"' : ''; ?>
                                    >
                                    <span class="filter-checkbox"></span>
                                    <?php echo esc_html($course_tag->name) ?>
                                </label>
                                <?php
                                    }
                                ?>
                        </div>
                    <?php endif;?>
                </form>
            </div>
        <?php endif;?>
        <div class="col order-1 order-sm-<?php echo $sidebar_position == 'right' ? 1 : 2; ?>">
            <div class="tutor-courses-wrap row">
                <?php
                if ($q->have_posts()) {
                        while ($q->have_posts()) {
                            $q->the_post();
                            $idd = get_the_ID();
                            global $authordata;
                            $profile_url = tutor_utils()->profile_url($authordata->ID)
                            ?>
                            <div class="col-lg-<?php echo $column; ?> col-sm-6 tutor-course-col">
                                <div class="tutor-course">
                                    <div class="tutor-course-header">
                                        <?php tutor_course_loop_thumbnail();?>
                                        <div class="tutor-course-loop-header-meta">
                                         <?php
                                            $is_wishlisted = tutor_utils()->is_wishlisted($idd);
                                            $has_wish_list = '';
                                            if ($is_wishlisted) {
                                                $has_wish_list = 'has-wish-listed';
                                            }

                                            echo '<span class="tutor-course-loop-level">' . get_tutor_course_level() . '</span>';
                                            echo '<span class="tutor-course-wishlist"><a href="javascript:;" class="tutor-icon-fav-line tutor-course-wishlist-btn ' . $has_wish_list . ' " data-course-id="' . $idd . '"></a> </span>';
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
                        <?php }
                    } else {
                        ?>

                        <div class="col-12">
                            <?php
                            echo "<h2>" . __('Nothing found!', 'edubin') . "</h2>";
                            echo "<div>" . __('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'edubin') . "</div>";
                            ?>
                            </div>

                            <?php
                            }

                            ?>
            </div>
            <?php
            if (!function_exists('tutor_pagination')):

                    function tutor_pagination($page_numb, $max_page)
                {
                        $big = 999999999;
                        echo '<div class="tutor-pagination">';
                        echo paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => $page_numb,
                            'prev_text' => __('<i class="fa fa-long-arrow-left" aria-hidden="true"></i>'),
                            'next_text' => __('<i class="fa fa-long-arrow-right" aria-hidden="true"></i>'),
                            'total' => $max_page,
                            'type' => 'list',
                        ));
                        echo '</div>';
                    }

                endif;?>


            <?php if ($pagination) {?>
                <div class="course-pagination">
                    <?php
                        $page_numb = max(1, get_query_var('paged'));
                        $max_page = $q->max_num_pages;
                        tutor_pagination($page_numb, $max_page);
                    ?>
                </div>
            <?php }?>
            
        </div>
    </div>
    <?php

    wp_reset_query();
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
}

add_shortcode('tutor-course', 'tutor_course_function'); ?>

<div class="generic-padding">
    <div class="container">
        <?php do_shortcode('[tutor-course]');?>
    </div>
</div>
<?php } //end check if tutor plugin active ?>

<?php
get_footer();
