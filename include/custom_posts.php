<?php
add_action('init','custom_message_post_type');
// Add filter
add_filter( 'manage_contact-form_posts_columns', 'sunset_create_columns');
add_action( 'manage_contact-form_posts_custom_column', 'sunset_insert_columns',10,2);

// Add metabox , Copy and Past Complete Algorithm,just edit screen arg after calling add_meta_boxes function according to custom post type name.
add_action( 'add_meta_boxes', 'sunset_contact_add_meta_box' );
add_action( 'save_post', 'sunset_save_contact_email_data' );

function sunset_create_columns($columns){
	$newColumn=array();
	$newColumn['cb']        ='Checkbox';
	$newColumn['title']     ='Full Name';
	$newColumn['message']   = 'Message';
	$newColumn['email']     ='Email';
	$newColumn['date']      ='Date';
	return $newColumn;
}
function sunset_insert_columns($column,$post_id){
	switch ($column):
		case 'message':
			echo get_the_excerpt();
			break;
		case 'email':
			$email = get_post_meta( $post_id, '_contact_email_value_key', true );
			echo $email;
			break;
	endswitch;
}

function custom_message_post_type (){
	$labels = array(
		'name'              => 'Messages',
		'singular_name'     => 'Message',
		'menu_name'         => 'Message',
		'name_admin_bar'    =>'Message'
	);
	$args = array(
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_menu'      => true,
		'capability_type'   => 'post',
		'hierarchical'      => false,
		'menu_position'     => 26,
		'menu_icon'         =>'dashicons-email-alt',
		'supports' => array( 'title', 'editor', 'author' )
	);
	register_post_type('contact-form',$args);
}
function sunset_contact_add_meta_box() {                                                           //screeen arg below
	add_meta_box( 'contact_email', 'User Email', 'sunset_contact_email_callback', 'contact-form', 'side' );
}
function sunset_contact_email_callback( $post ) {
	wp_nonce_field( 'sunset_save_contact_email_data', 'sunset_contact_email_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_contact_email_value_key', true );

	echo '<label for="sunset_contact_email_field">User Email Address: </lable>';
	echo '<input type="email" id="sunset_contact_email_field" name="sunset_contact_email_field" value="' . esc_attr( $value ) . '" size="25" />';
}
function sunset_save_contact_email_data( $post_id ) {

	if( ! isset( $_POST['sunset_contact_email_meta_box_nonce'] ) ){
		return;
	}

	if( ! wp_verify_nonce( $_POST['sunset_contact_email_meta_box_nonce'], 'sunset_save_contact_email_data') ) {
		return;
	}

	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	}

	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if( ! isset( $_POST['sunset_contact_email_field'] ) ) {
		return;
	}

	$my_data = sanitize_text_field( $_POST['sunset_contact_email_field'] );

	update_post_meta( $post_id, '_contact_email_value_key', $my_data ); //important key for saving messages from user

}