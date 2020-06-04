<?php
//
//
//if($_POST['submit_form']){
//    echo "FORM YES";
//    if($_POST['g-recaptcha-response']){
//	    echo "CAPTHA YES";
//	    $captcha=$_GET['g-recaptcha-response'];
//
//	    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfFGiMUAAAAAORTq-yB724VynP7P_AZ-CkdnXFA&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
//	    $response=json_decode($response,true);
//
//	    if($response['success']){
//		    echo "RESPONSE YES";
//	    }
//	    else{
//		    echo "RESPONSE NO";
//	    }
//    }else{
//	    echo 0;
//    }
//}


// Form Validation
//add_action( 'wp_ajax_nopriv_sunset_save_user_contact_form', 'sunset_contact_form' );
//add_action( 'wp_ajax_sunset_save_user_contact_form', 'sunset_contact_form' );
//
//function sunset_contact_form(){
//	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=YOUR SECRET KEY&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
//	$name=wp_strip_all_tags($_POST['name']);
//	$email=wp_strip_all_tags($_POST['email']);
//	$message=wp_strip_all_tags($_POST['message']);
//
//	$args=array(
//		'post_title'    =>$name,
//		'post_content'  =>$message,
//		'post_author'   =>1,   //1 because the user is not logged in so anyone can post if this is 1.
//		'post_status'   =>'publish', //if not defined,WordPress will save it as a Draft.
//		'post_type'     =>'contact-form',   //define custom post type
//		'meta_input'    => array(
//			'_contact_email_value_key'   =>$email
//		)
//	);
//	$postID = wp_insert_post($args);
//
//
//	if ($postID !== 0) {
//		/* Start  Mail Function */
//
//		$to = get_bloginfo('admin_email');
//		$subject = 'Sunset Contact Form - '.$name;
//		$headers[] = 'From: '.get_bloginfo('name').' <'.$to.'>'; // 'From: Alex <me@alecaddd.com>'
//		$headers[] = 'Reply-To: '.$name.' <'.$email.'>';
//		$headers[] = 'Content-Type: text/html: charset=UTF-8';
//		wp_mail($to, $subject, $message, $headers);
//
//		/* End  Mail Function */
//
//		echo $postID;
//	}
//	else {
//		echo 0;
//	}
//	die();
//}
