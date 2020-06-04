<!--Just Change <form> id for future use-->
<form id="sunsetContactForm" action="<?php the_permalink(); ?>" method="post" name="myForm">
	<div id="position">
		<div id="form-loader" class="text-center spin"><i id="abc" class="fa fa-spinner"></i></div>
	</div>
	<div id="success" class="result"><div class="table"><div class="table-cell text-center"><?php _e('Successfully Sent Message') ?></div></div></div>
	<div id="failed" class="result"><div class="table"><div  class="table-cell text-center"><?php _e('Sorry, it seems that mail server is not responding. Please try again later!') ?></div></div></div>

	<div id="form_wrapper">
		<h3><?php _e('Leave a Message') ?></h3>
		<div class="form-group">
			<div id="name-message"></div>
			<input type="text" class="form-control jsFormTrigger" id="name" name="client_name"  placeholder="Your Name">
		</div>
		<div class="form-group">
			<div id="email-message"></div>
			<input type="email" class="form-control jsFormTrigger" id="email" name="client_email"  placeholder="Email">
		</div>
		<div class="form-group">
			<div id="text-message"></div>
			<textarea class="form-control jsFormTrigger" id="message" name="client_message" placeholder="Message"></textarea>
		</div>
        <div class="g-recaptcha" data-sitekey="6LfFGiMUAAAAAKidWOGMu8tPbnIa-RZwJ1yOPNei"></div>
        <div class="form-group">
            <input type="submit" name="submit_form" class="btn btn-default" data-toggle="false" value="<?php _e('Submit'); ?>">
        </div>
    </div>
</form>

<?php
if ($_POST['submit_form'] ) {
    if ( $_POST['g-recaptcha-response'] ) {
        $captcha = $_POST['g-recaptcha-response'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfFGiMUAAAAAORTq-yB724VynP7P_AZ-CkdnXFA&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        $response = json_decode($response,true);

        if ($response['success']) {
            $name=wp_strip_all_tags($_POST['client_name']);
            $email=wp_strip_all_tags($_POST['client_email']);
            $message=wp_strip_all_tags($_POST['client_message']);

            $args=array(
                'post_title'    =>$name,
                'post_content'  =>$message,
                'post_author'   =>1,   //1 because the user is not logged in so anyone can post if this is 1.
                'post_status'   =>'publish', //if not defined,WordPress will save it as a Draft.
                'post_type'     =>'contact-form',   //define custom post type
                'meta_input'    => array(
                    '_contact_email_value_key'   =>$email
                )
            );
            $postID = wp_insert_post($args);
//				if ($postID !== 0) {
//					/* Start  Mail Function */
//
//					$to = get_bloginfo('admin_email');
//					$subject = 'Sunset Contact Form - '.$name;
//					$headers[] = 'From: '.get_bloginfo('name').' <'.$to.'>'; // 'From: Alex <me@alecaddd.com>'
//					$headers[] = 'Reply-To: '.$name.' <'.$email.'>';
//					$headers[] = 'Content-Type: text/html: charset=UTF-8';
//					wp_mail($to, $subject, $message, $headers);
//
//					/* End  Mail Function */
//
//					echo $postID;
//				}
//				else {
//					echo 0;
//				}
            if($postID){?> <script>document.getElementById("success").style.display = "block";</script> <?php
            }
            else{ ?> <script>document.getElementById("failed").style.display = "block";</script>
           <?php }
        }
        else { ?>
            <script>document.getElementById("failed").style.display = "block";</script>
            <?php
            echo "RESPONSE NO";
        }
    }
    else { ?>
        <script>document.getElementById("failed").style.display = "block";</script>
        <?php
    }
}
?>

