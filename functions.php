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
			$phone=$posted_data['telephone'];
			$address=$posted_data['your-address'];
			$message=$posted_data['your-message'];
			
			$url="https://api.acculynx.com/api/v1/leads";
			$body=[
				'firstName'=> $name,
        		'emailAddress'=> $email,
        		'phoneNumber1'=> $phone,
        		'jobCategory'=> "residential",
        		'street'=> $address,
        		'notes'=> $message,
			];
			$body = wp_json_encode($body);
			$args=array(
				'headers'=>array(
					'Authorization' => 'Bearer '. $key,
					'Content-Type' => 'application/json',
				),
				'method'=>'POST',
				'body'=>$body,
			);
			$response=wp_remote_post($url,$args);
			if ( is_wp_error( $response ) ) {
    			$error_message = $response->get_error_message();
    			echo "Something went wrong: $error_message";
				} else {
    			echo 'Response:<pre>';
    			print_r( $response );
    			echo '</pre>';
			}			
		}
	}	    
}


// [text* your-name class:contact-form-7-name placeholder "First and Last Name"]
// [email* your-email class:contact-form-7-email placeholder "Email"]
// [tel* telephone class:contact-form-7-phone placeholder "Phone"]
// [text* your-address class:contact-form-7-address placeholder "Address"]
// [textarea your-message class:contact-form-7-message placeholder "Message"]
// [submit "Get A Free Estimate"]