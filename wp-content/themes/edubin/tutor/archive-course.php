<?php
/**
 * Template for displaying courses
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.5.8
 */

get_header(); 

$defaults = edubin_generate_defaults();
$tutor_course_archive_style = get_theme_mod( 'tutor_course_archive_style', $defaults['tutor_course_archive_style']);

?>

	<div class="<?php tutor_container_classes() ?> edubin-tutor-course-archive-style-<?php echo esc_attr($tutor_course_archive_style); ?>">
		<?php
		do_action('tutor_course/archive/before_loop');

		if ( have_posts() ) :
			/* Start the Loop */

			tutor_course_loop_start();

			while ( have_posts() ) : the_post();
				/**
				 * @hook tutor_course/archive/before_loop_course
				 * @type action
				 * Usage Idea, you may keep a loop within a wrap, such as bootstrap col
				 */
				do_action('tutor_course/archive/before_loop_course');

				if ($tutor_course_archive_style == '1') :
					
					tutor_load_template('loop.course');

				elseif ($tutor_course_archive_style == '2') : ?>
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
				<?php endif; //End course style 2 

				/**
				 * @hook tutor_course/archive/after_loop_course
				 * @type action
				 * Usage Idea, If you start any div before course loop, you can end it here, such as </div>
				 */
				do_action('tutor_course/archive/after_loop_course');
			endwhile;

			tutor_course_loop_end();

		else :

			/**
			 * No course found
			 */
			tutor_load_template('course-none');

		endif;

		tutor_course_archive_pagination();

		do_action('tutor_course/archive/after_loop');
		?>
	</div><!-- .wrap -->

<?php get_footer();
