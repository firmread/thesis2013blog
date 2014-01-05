<?php
/* Template Name: Contact */
?>
<?php
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	
	if(trim($_POST['subject']) === '') {
		$subjectError = 'Please enter a subject.';
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = get_option('of_email_address');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = 'From '.$name.': ' .$subject;
		$body = "Name: $name \n\nEmail: $email \n\n$comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>
<?php get_header(); ?>
 <div class="container" style="margin-bottom:50px;">
        <div class="row">
        	<div class="span12">
            <div class="welcome">
            <?php
				$page_name = trim( wp_title( '', false ) );
				$page = get_page_by_title( $page_name );
			?>
            <h1><span class="colored"><?php echo trim( wp_title( '', false ) ); ?></span><span class="grey_colored"> / <?php echo get_post_meta( $page->ID, 'page_subtitle', true ); ?></span></h1>
            <div class="divider"></div>
            </div>
            </div>
        </div>
        

    	<div class="row">
        	<div class="span6">
            	
            		<div id="map"><iframe width="100%" height="420" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo get_option('of_contact_google'); ?>"></iframe></div>
            </div>
            <div class="span6">
                <div class="row">
                	<div class="span3">
                        <div class="block">
                            <?php echo get_option('of_contact_text'); ?>
                        </div>
                    </div>
                    <div class="span3">
<p>
                         	<i class="icon-map-marker"></i> <?php echo get_option('of_contact_address'); ?><br>
                            <i class="icon-user"></i> <?php echo get_option('of_contact_telephone'); ?><br>
                            <i class="icon-print"></i> <?php echo get_option('of_contact_fax'); ?><br>
                            <i class="icon-envelope"></i> <?php echo get_option('of_email_address'); ?>
                            
                        </p>
                    </div>
                </div>
                <div id="note"></div>
                 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                 <?php if(isset($emailSent) && $emailSent == true) { ?>
                  <p><?php echo get_option('of_email_thanku'); ?></p>
                  <?php } else { ?>
		 <?php the_content(); ?>
		 <?php if(isset($hasError) || isset($captchaError)) { ?>
            <p class="error"><?php _e('Sorry, an error occured.', 'themeText'); ?><p>
		 <?php } ?>
                <form class="form" method="post" id="ajax-contact-form" action="<?php the_permalink(); ?>">
                    <!--[if IE]><label for="name"><?php _e('Name:', 'themeText'); ?></label><![endif]--><input type="text" id="name" name="contactName" class="span2 required requiredField" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" style="margin-right:15px;" placeholder="<?php _e('Name:', 'themeText'); ?>" />
                    <?php if($nameError != '') { ?>
               <?php $nameError; ?>
               <?php } ?>
                    <!--[if IE]><label for="email"><?php _e('Email:', 'themeText'); ?></label><![endif]--><input id="email" type="text" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" style="margin-right:15px;"  class="span2 required requiredField email" name="email" placeholder="<?php _e('Email:', 'themeText'); ?>" />
                     <?php if($emailError != '') { ?>
               <?php $emailError;?>
               <?php } ?>
                    <!--[if IE]><label for="subject"><?php _e('Subject:', 'themeText'); ?></label><![endif]--><input id="subject" type="text" value="<?php if(isset($_POST['subject'])) echo $_POST['subject'];?>"  class="span2 required requiredField" name="subject" placeholder="<?php _e('Subject:', 'themeText'); ?>" />
                     <?php if($nameError != '') { ?>
               <?php $nameError;?>
               <?php } ?>
                    <!--[if IE]><label for="message"><?php _e('Message:', 'themeText'); ?></label><![endif]--><textarea id="message" type="text" name="comments" placeholder="<?php _e('Message:', 'themeText'); ?>" rows="8" class="span6 required requiredField"></textarea>
                     <?php if($commentError != '') { ?>
              <?php $commentError;?>
               <?php } ?>
                    <input type="submit" value="<?php _e('Send Your Message', 'themeText'); ?> &rarr;" class="featbtn2"></input>
                    <input type="hidden" name="submitted" id="submitted" value="true" />
                </form>
                 <?php } ?>
            </div>
        </div>
    </div></div>
    <?php endwhile; endif; ?>
	<?php get_footer(); ?>