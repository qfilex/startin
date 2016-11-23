<?php
/**
 * The template for displaying single answers
 *
 * @package DW Question & Answer
 * @since DW Question & Answer 1.0.1
 */
?>

<?php do_action( 'dwqa_before_question_submit_form' ); ?>
<?php if ( dwqa_current_user_can( 'post_question' ) ) : ?>
	<form method="post" class="dwqa-content-ask-form">
		<p class="dwqa-search">
			<label for="question_title"><?php _e( 'Title', 'dwqa' ) ?></label>
			<?php $title = isset( $_POST['question-title'] ) ? $_POST['question-title'] : ''; ?>
			<input type="text" data-nonce="<?php echo wp_create_nonce( '_dwqa_filter_nonce' ) ?>" id="question-title" name="question-title" value="<?php echo $title ?>" tabindex="1">
		</p>
		<?php $content = isset( $_POST['question-content'] ) ? $_POST['question-content'] : ''; ?>
		<p><?php dwqa_init_tinymce_editor( array( 'content' => $content, 'textarea_name' => 'question-content', 'id' => 'question-content' ) ) ?></p>
		<?php global $dwqa_general_settings; ?>
		<?php if ( isset( $dwqa_general_settings['enable-private-question'] ) && $dwqa_general_settings['enable-private-question'] ) : ?>
		<p>
			<label for="question-status"><?php _e( 'Status', 'dwqa' ) ?></label>
			<select class="dwqa-select" id="question-status" name="question-status">
				<optgroup label="<?php _e( 'Who can see this?', 'dwqa' ) ?>">
					<option value="publish"><?php _e( 'Public', 'dwqa' ) ?></option>
					<option value="private"><?php _e( 'Only Me &amp; Admin', 'dwqa' ) ?></option>
				</optgroup>
			</select>
		</p>
		<?php endif; ?>
		<p>
			<label for="question-category1"><?php _e( 'Industry', 'dwqa' ) ?></label>
			<?php
				wp_dropdown_categories( array(
					'name'          => 'question-category1',
					'id'            => 'question-category1',
					'taxonomy'      => 'dwqa-question_category',
					'show_option_none' => __( 'Select Industy', 'dwqa' ),
					'child_of'      => 116,
                                        'hide_empty'    => 0,
					'quicktags'     => array( 'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,spell,close' ),
					'selected'      => isset( $_POST['question-category1'] ) ? $_POST['question-category1'] : false,
				) );
			?>
			<label for="question-category2"><?php _e( 'Location', 'dwqa' ) ?></label>
			<?php
				wp_dropdown_categories( array(
					'name'          => 'question-category2',
					'id'            => 'question-category2',
					'taxonomy'      => 'dwqa-question_category',
					'show_option_none' => __( 'Select Location', 'dwqa' ),
					'child_of'      => 117,
					'hide_empty'    => 0,
					'quicktags'     => array( 'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,spell,close' ),
					'selected'      => isset( $_POST['question-category2'] ) ? $_POST['question-category2'] : false,
				) );
			?>
<label for="question-category3"><?php _e( 'Official party', 'dwqa' ) ?></label>
			<?php
				wp_dropdown_categories( array(
					'name'          => 'question-category3',
					'id'            => 'question-category3',
					'taxonomy'      => 'dwqa-question_category',
					'show_option_none' => __( 'Select official party', 'dwqa' ),
					'child_of'      => 121,
					'hide_empty'    => 0,
					'quicktags'     => array( 'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,spell,close' ),
					'selected'      => isset( $_POST['question-category3'] ) ? $_POST['question-category3'] : false,
				) );
			?>
<label for="question-category4"><?php _e( 'Type of company', 'dwqa' ) ?></label>
			<?php
				wp_dropdown_categories( array(
					'name'          => 'question-category4',
					'id'            => 'question-category4',
					'taxonomy'      => 'dwqa-question_category',
					'show_option_none' => __( 'Select question category', 'dwqa' ),
					'child_of'      => 124,
					'hide_empty'    => 0,
					'quicktags'     => array( 'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,spell,close' ),
					'selected'      => isset( $_POST['question-category4'] ) ? $_POST['question-category4'] : false,
				) );
			?>

		</p>
		<p>
			<label for="question-tag"><?php _e( 'Tag', 'dwqa' ) ?></label>
			<?php $tags = isset( $_POST['question-tag'] ) ? $_POST['question-tag'] : ''; ?>
			<input type="text" class="dwqa-question-tags" name="question-tag" value="<?php echo $tags ?>" >
		</p>
		<?php if ( dwqa_current_user_can( 'post_question' ) && !is_user_logged_in() ) : ?>
		<p>
			<label for="_dwqa_anonymous_email"><?php _e( 'Your Email', 'dwqa' ) ?></label>
			<?php $email = isset( $_POST['_dwqa_anonymous_email'] ) ? $_POST['_dwqa_anonymous_email'] : ''; ?>
			<input type="email" class="dwqa-question-anonymous-email" name="_dwqa_anonymous_email" value="<?php echo $email ?>" >
		</p>
		<p>
			<label for="_dwqa_anonymous_name"><?php _e( 'Your Name', 'dwqa' ) ?></label>
			<?php $name = isset( $_POST['_dwqa_anonymous_name'] ) ? $_POST['_dwqa_anonymous_name'] : ''; ?>
			<input type="text" class="dwqa-question-anonymous-name" name="_dwqa_anonymous_name" value="<?php echo $name ?>" >
		</p>
		<?php endif; ?>
		<?php wp_nonce_field( '_dwqa_submit_question' ) ?>
		<?php dwqa_load_template( 'captcha', 'form' ); ?>
		<input type="submit" name="dwqa-question-submit" class="dwqa-btn dwqa-btn-primary" value="<?php _e( 'Submit', 'dwqa' ) ?>" >
	</form>
<?php else : ?>
	<?php if ( is_user_logged_in() ) : ?>
		<div><?php _e( "You doesn't have permission to post a question", 'dwqa' ) ?></div>
	<?php else : ?>
		<div class="dwqa-answers-login">
			<div class="dwqa-answers-login-title">
				<p><?php printf( __( 'Please login or %1$sRegister%2$s to submit your answer', 'dwqa' ), '<a href="'.wp_registration_url().'">', '</a>' ) ?></p>
			</div>
			<div class="dwqa-answers-login-content">
				<?php wp_login_form(); ?>
				<?php do_action( 'wordpress_social_login' ); ?>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>
<?php do_action( 'dwqa_after_question_submit_form' ); ?>