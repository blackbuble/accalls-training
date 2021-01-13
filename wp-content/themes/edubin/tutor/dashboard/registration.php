<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

?>

<form class="edubin-tutor-registration" method="post" enctype="multipart/form-data">
	<?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>
    <input type="hidden" value="tutor_register_student" name="tutor_action"/>

    <?php
    $errors = apply_filters('tutor_student_register_validation_errors', array());
    if (is_array($errors) && count($errors)){
        echo '<div class="tutor-alert-warning tutor-mb-10"><ul class="tutor-required-fields">';
        foreach ($errors as $error_key => $error_value){
            echo "<li>{$error_value}</li>";
        }
        echo '</ul></div>';
    }
    ?>

    <?php if ( is_active_sidebar( 'edubin-tutor-student-reg-form-before-widget' ) ) : ?>
        <div class="tutor-form-row">
            <div class="tutor-form-col-12">
                <div class="edubin-tutor-student-reg-form-before-widget-wrapper">
                    <?php dynamic_sidebar( 'edubin-tutor-student-reg-form-before-widget' ); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="tutor-form-row">
        <div class="tutor-form-col-6">
            <div class="tutor-form-group">
                <label>
					<?php _e('First Name', 'edubin'); ?>
                </label>

                <input type="text" name="first_name" value="<?php echo tutor_utils()->input_old('first_name'); ?>" placeholder="<?php _e('First Name', 'edubin'); ?>">
            </div>
        </div>

        <div class="tutor-form-col-6">
            <div class="tutor-form-group">
                <label>
					<?php _e('Last Name', 'edubin'); ?>
                </label>

                <input type="text" name="last_name" value="<?php echo tutor_utils()->input_old('last_name'); ?>" placeholder="<?php _e('Last Name', 'edubin'); ?>">
            </div>
        </div>

    </div>

    <div class="tutor-form-row">
        <div class="tutor-form-col-6">
            <div class="tutor-form-group">
                <label>
				    <?php _e('User Name', 'edubin'); ?>
                </label>

                <input type="text" name="user_login" class="tutor_user_name" value="<?php echo tutor_utils()->input_old('user_login'); ?>" placeholder="<?php _e('User Name', 'edubin'); ?>">
            </div>
        </div>

        <div class="tutor-form-col-6">
            <div class="tutor-form-group">
                <label>
					<?php _e('E-Mail', 'edubin'); ?>
                </label>

                <input type="text" name="email" value="<?php echo tutor_utils()->input_old('email'); ?>" placeholder="<?php _e('E-Mail', 'edubin'); ?>">
            </div>
        </div>

    </div>

    <div class="tutor-form-row">
        <div class="tutor-form-col-6">
            <div class="tutor-form-group">
                <label>
					<?php _e('Password', 'edubin'); ?>
                </label>

                <input type="password" name="password" value="<?php echo tutor_utils()->input_old('password'); ?>" placeholder="<?php _e('Password', 'edubin'); ?>">
            </div>
        </div>

        <div class="tutor-form-col-6">
            <div class="tutor-form-group">
                <label>
					<?php _e('Password confirmation', 'edubin'); ?>
                </label>

                <input type="password" name="password_confirmation" value="<?php echo tutor_utils()->input_old('password_confirmation'); ?>" placeholder="<?php _e('Password Confirmation', 'edubin'); ?>">
            </div>
        </div>
    </div>


    <div class="tutor-form-row">
        <div class="tutor-form-col-12">
            <div class="tutor-form-group tutor-reg-form-btn-wrap">
                <button type="submit" name="tutor_register_student_btn" value="register" class="tutor-button"><?php _e('Register', 'edubin'); ?></button>
            </div>
        </div>
    </div>

    <?php if ( is_active_sidebar( 'edubin-tutor-student-reg-form-after-widget' ) ) : ?>
        <div class="tutor-form-row">
            <div class="tutor-form-col-12">
                <div class="edubin-tutor-student-reg-form-after-widget-wrapper">
                    <?php dynamic_sidebar( 'edubin-tutor-student-reg-form-after-widget' ); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</form>