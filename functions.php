<?php
include 'secrets.php';
add_action( 'wpcf7_mail_sent', 'cf7_form_send_to_acculynx' );

function cf7_form_send_to_acculynx($contact_form) {
	$title= $contact_form->title;
	if($title==='Get a quote'){
		$submission=WPCF7_Submission::get_instance();
		if($submission){
			$posted_data=$submission->get_posted_data();
			$name=$posted_data['your-name'];
			$email=$posted_data['your-email'];
			$telephone=$posted_data['telephone'];
			$address=$posted_data['your-address'];
			$message=$posted_data['your-message'];
			var_dump($name);
			var_dump($email);
			var_dump($telephone);
			var_dump($address);
			var_dump($message);			
			wp_die;
			
		}
	}	    
}


// [text* your-name class:contact-form-7-name placeholder "First and Last Name"]
// [email* your-email class:contact-form-7-email placeholder "Email"]
// [tel* telephone class:contact-form-7-phone placeholder "Phone"]
// [text* your-address class:contact-form-7-address placeholder "Address"]
// [textarea your-message class:contact-form-7-message placeholder "Message"]
// [submit "Get A Free Estimate"]