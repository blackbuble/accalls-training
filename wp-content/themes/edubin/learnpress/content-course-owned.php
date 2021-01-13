<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$user = LP_Global::user();
$course    = LP()->global['course'];
$course_id = get_the_ID();
$count = $course->get_users_enrolled();
$defaults = edubin_generate_defaults();
// Customizer option
$lp_course_archive_style = get_theme_mod( 'lp_course_archive_style', $defaults['lp_course_archive_style']); 
$lp_course_archive_clm = get_theme_mod( 'lp_course_archive_clm', $defaults['lp_course_archive_clm'] ); 

$lp_price_show = get_theme_mod( 'lp_price_show', $defaults['lp_price_show']);
$lp_full_price_show = get_theme_mod( 'lp_full_price_show', $defaults['lp_full_price_show']);
$lp_review_on_off = get_theme_mod( 'lp_review_on_off', $defaults['lp_review_on_off']);
$lp_instructor_img_on_off = get_theme_mod( 'lp_instructor_img_on_off', $defaults['lp_instructor_img_on_off']);
$lp_instructor_name_on_off = get_theme_mod( 'lp_instructor_name_on_off', $defaults['lp_instructor_name_on_off']);
$lp_enroll_on_off = get_theme_mod( 'lp_enroll_on_off', $defaults['lp_enroll_on_off']);

$lp_comment_show = get_theme_mod( 'lp_comment_show', $defaults['lp_comment_show']); 

?>

<?php if ($lp_course_archive_style == '1' || $lp_course_archive_style == '2' || $lp_course_archive_style == '3') : ?>
  <div class="col-md-12 col-lg-6">
    <div class="edubin-single-course-1 mb-30">
     <div class="thum">
      <?php if ( has_post_thumbnail() ):?>
        <figure class="image">
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail();?>
          </a>
        </figure>
      <?php else : ?>
      <?php $placholder_img = get_template_directory_uri() . '/assets/images/course-ph.png'; ?>
          <figure class="image">
              <a href="<?php the_permalink(); ?>">
                  <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
              </a>
          </figure> 
      <?php endif; ?>

      <?php if ($lp_price_show): ?>
        <div class="edubin-course-price-<?php echo esc_html($lp_course_archive_style); ?>">

          <?php if ( $price_html = $course->get_price_html() ) : ?>

            <?php if ($lp_course_archive_style == '2' || $lp_course_archive_style == '3') : ?>
              <?php $origin_price_html = $course->get_origin_price_html(); ?>
              <?php $price_seprator = $origin_price_html . " /"; ?>
              <span><?php echo wp_kses_post(($course->get_origin_price() ? $price_seprator : '')); ?> <?php echo esc_html($price_html); ?></span>
              <?php else : ?>
                  <?php if ($lp_full_price_show) : ?>
                      <span><?php echo $price_html; ?></span>
                  <?php else : ?>
                      <span><?php $new_price = preg_replace('/.00/', '', $price_html); echo esc_html($new_price); ?></span>
                  <?php endif; ?> 
              <?php endif; ?> 

            <?php endif; ?>
          </div>
        <?php endif ?>
      </div>

      <div class="course-content">

        <?php if (class_exists('LP_Addon_Course_Review_Preload') & $lp_review_on_off == '1'):
          $course_id       = get_the_ID();
          $course_rate_res = learn_press_get_course_rate($course_id, false);
          $course_rate     = $course_rate_res['rated'];
          $total           = $course_rate_res['total'];
          ?>

          <?php if ( $course_rate_res): ?>
            <?php echo '<ul class="edubin-course-rate"><div class="star-rating" title="' . sprintf(__('Rated %s out of 5', 'edubin'), $course_rate) . '"><span style="width:' . (($course_rate / 5) * 100) . '%"><strong itemprop="ratingValue" class="rating">' . $course_rate . '</strong> ' . __('out of 5', 'edubin') . '</span></div></ul>'; ?>
          <?php endif;?>

          <?php if ( $course_rate_res): ?>
            <?php $rating = sprintf( _n( '(%s Reviews)', '(%s Review)', $total, 'edubin' ), $total ); ?>
            <span class="course-reviews"><?php echo esc_html($rating); ?></span>
          <?php endif;?>
          <?php endif; ?><!--  End Review -->

          <?php
          the_title( sprintf( '<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
          do_action( 'learn_press_after_the_title' );
          ?>
          <div class="course-bottom">

            <?php if(true == $lp_instructor_img_on_off) : ?>
              <div class="thum">
               <a href="<?php echo esc_url( learn_press_user_profile_link( get_the_author_meta( 'ID' ) ) ); ?>" class="instructor-img">
                <?php echo wp_kses_post($course->get_instructor()->get_profile_picture()); ?>
              </a>
            </div>
            <?php endif; ?><!--  End instructor image -->

            <?php if($lp_instructor_name_on_off == '1') : ?>
              <div class="name">
                <a href="<?php echo esc_url( learn_press_user_profile_link( get_the_author_meta( 'ID' ) ) ); ?>"><h6><?php echo wp_kses_post($course->get_instructor_html()); ?></h6></a>
              </div>
              <?php endif; ?><!--  End instructor name -->
              <div class="admin">
                <ul>
                 <?php if($lp_enroll_on_off == '1') : ?>
                  <li><i class="glyph-icon flaticon-profile"></i><span class="enroll-users"><?php echo esc_html( $count ); ?></span></li>
                  <?php endif; ?><!--  End enroll -->
                  <?php if($lp_comment_show) : ?>
                    <li><a href="<?php the_permalink();?>"><i class="glyph-icon flaticon-chat"></i><span><?php echo get_comments_number(); ?></span></a></li>
                    <?php endif; ?><!--  End comments -->
                  </ul>
                </div>
              </div>
              <!--  End course bottom -->
            </div>
          </div>
          <!-- single course -->

        </div>
        <?php elseif ($lp_course_archive_style == '4') : ?>
          <div class="col-md-12 col-lg-6">

            <div class="edubin-single-course-2">
              <div class="thum">
                <?php if ( has_post_thumbnail() ):?>
                  <figure class="image">
                    <a href="<?php the_permalink(); ?>">
                      <?php the_post_thumbnail();?>
                    </a>
                  </figure>
                <?php else : ?>

                <?php $placholder_img = get_template_directory_uri() . '/assets/images/course-ph.png'; ?>
                    <figure class="image">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
                        </a>
                    </figure>
                <?php endif; ?>

                <?php if($lp_price_show) : ?>
                 <div class="edubin-course-price-<?php echo esc_html($lp_course_archive_style); ?>">
                  <?php if ( $price_html = $course->get_price_html() ) : ?>

                    <?php if ( $lp_course_archive_style == '2' || $lp_course_archive_style == '3') : ?>
                      <?php $origin_price_html = $course->get_origin_price_html(); ?>
                      <?php $price_seprator = $origin_price_html . " /"; ?>
                      <span><?php echo wp_kses_post(($course->get_origin_price() ? $price_seprator : '')); ?> <?php echo esc_html($price_html); ?></span>
                      <?php else : ?>
                        <span><?php $new_price = preg_replace('/.00/', '', $price_html); echo esc_html($new_price); ?></span>
                      <?php endif; ?> 

                    <?php endif; ?>
                  </div>
                <?php endif; ?>

                <div class="course-teacher">

                  <?php if($lp_instructor_img_on_off) : ?>
                    <div class="thum">
                     <a href="<?php echo esc_url( learn_press_user_profile_link( get_the_author_meta( 'ID' ) ) ); ?>" class="instructor-img">
                      <?php echo wp_kses_post($course->get_instructor()->get_profile_picture()); ?>
                    </a>
                  </div>
                  <?php endif; ?><!--  End instructor image -->

                  <?php if($lp_instructor_name_on_off) : ?>
                    <div class="name">
                      <a href="<?php echo esc_url( learn_press_user_profile_link( get_the_author_meta( 'ID' ) ) ); ?>"><h6><?php echo wp_kses_post($course->get_instructor_html()); ?></h6></a>
                    </div>
                    <?php endif; ?><!--  End instructor name -->

                    <?php if (class_exists('LP_Addon_Course_Review_Preload')):
                      $course_id       = get_the_ID();
                      $course_rate_res = learn_press_get_course_rate($course_id, false);
                      $course_rate     = $course_rate_res['rated'];
                      $total           = $course_rate_res['total'];
                      ?>
                      <div class="review">
                        <?php if ( $course_rate_res): ?>
                          <?php echo '<ul class="edubin-course-rate"><div class="star-rating" title="' . sprintf(__('Rated %s out of 5', 'edubin'), $course_rate) . '"><span style="width:' . (($course_rate / 5) * 100) . '%"><strong itemprop="ratingValue" class="rating">' . $course_rate . '</strong> ' . __('out of 5', 'edubin') . '</span></div></ul>'; ?>
                        <?php endif;?>
                      </div>

                      <?php endif; ?><!--  End review  -->
                    </div>
                  </div>
                  <div class="content">
                    <?php
                    the_title( sprintf( '<h4 class="course-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
                    do_action( 'learn_press_after_the_title' );
                    ?>
                  </div>
                </div> <!-- single course -->

              </div>
              <?php endif; ?>