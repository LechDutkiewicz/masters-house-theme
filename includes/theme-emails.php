<?php

class Email_content {
	function __construct() {
		$this->subject;
		$this->listing_id;
		$this->message;
	}
}

class Email_user {
	function __construct() {
		$this->email;
		$this->phone;
		$this->email_body;
		$this->email_headers;
		$this->success;
	}
}

class TSM_emails {
	function __construct() {
		$this->post_data;
		$this->return_data;
		$this->user = new Email_user;
		$this->content = new Email_content;
		$this->admin = new Email_user;
		$this->post_ID;
	}

	public function init() {
		$this->setup_vars();
		// $this->return_data['success'] = 1;
		// $this->return_data['user'] = $this->user;
		// $this->return_data['content'] = $this->content;
		$this->validate();
		$this->setup_admin_response_body();
		$this->setup_admin_response_headers();
		$this->setup_user_response_body();
		$this->setup_user_response_headers();
		$this->add_log_post();
		$this->send_to_user();
	}

	private function setup_vars() {
		$this->user->email = isset( $this->post_data['email'] ) ? sanitize_email( $this->post_data['email'] ) : '';
		$this->user->phone = isset( $this->post_data['phone'] ) ? esc_attr( $this->post_data['phone'] ) : '' ;
		
		$this->content->subject = esc_html( $this->post_data['subject'] );
		$this->content->listing_id = absint( $this->post_data['listing_id'] );
		$this->content->message = esc_textarea( $this->post_data['messages'] );
	}

	private function validate() {	

		if (!$this->content->message) {
			$this->content->message = isset( $this->post_data['messages_default'] ) ? esc_attr( $this->post_data['messages_default'] ) : '';
		}

		if (empty($this->content->message)) {
			// setup return message if neither message nor default message variable exists
			$this->return_data['value'] = __('Please enter your messages.', 'bon');
		}
	}

	private function setup_admin_response_body() {
		$this->admin->email = $this->post_data['receiver'] ? $this->post_data['receiver'] : get_bloginfo('admin_email');

		$admin_output = '<p style = "margin-bottom:1em">' . sprintf( __( "You have received a new contact form message via %s \n", "bon" ), get_bloginfo( 'name' ) ) . '</p>';
		if ($this->user->email) { $admin_output .= '<p style = "margin-bottom:1em">' . sprintf( __( "Sender Email : %s \n", "bon" ), $this->user->email ) . '</p>'; }
		if ($this->user->phone) { $admin_output .= '<p style = "margin-bottom:1em">' . sprintf( __( "Sender Phone Number : %s \n", "bon" ), $this->user->phone ) . '</p>'; }
		$admin_output .= '<p style = "margin-bottom:1em">' . sprintf( __( "Subject : %s \n", "bon" ), $this->content->subject ) . '</p>';
		if ($this->content->listing_id) { $admin_output .= '<p style = "margin-bottom:1em">' . sprintf( __( "Email Send From : %s \n", "bon" ), get_permalink( $this->content->listing_id ) ) . '</p>'; }
		$admin_output .= '<p style = "margin-bottom:1em">' . sprintf( __( "Message : %s \n", "bon" ), $this->content->message ) . '</p>';
		
		$this->admin->email_body = $admin_output;
	}

	private function setup_admin_response_headers() {
		$this->admin->email_headers = array(
			"Content-Type: text/html",
			);
		if ($this->user->email) {
			$this->admin->email_headers[] = "From: " . $this->user->email;
			$this->admin->email_headers[] = "Reply-To: " . $this->user->email;
		} else {
			$this->admin->email_headers[] = "From: " . $this->admin->email;
		}

		$this->admin->subject = sprintf( "%s %s", $this->content->subject, __( "Masters House", 'bon' ) );
	}

	private function setup_user_response_body() {
		$user_output = '<p style = "margin-bottom:1em">' . __( 'We succesfully received your request. Our representative will contact you within one hour.', 'bon' ) . '</p>';
		$user_output .= '<p style = "margin-bottom:1em">' . __( 'Kind regards', 'bon' ) . ', <br>' . esc_attr( get_bloginfo( 'name' ) ) . '</p>';
		
		$this->user->email_body = $user_output;
	}

	private function setup_user_response_headers() {
		$this->user->email_headers = array(
			"From: " . __( "Masters House", "bon" ),
			"Reply-To: " . 'no-reply@mastershouse.com',
			"Content-Type: text/html",
			);

		$this->user->subject = __( 'Thank you for contacting us', 'bon' );
	}

	private function add_log_post() {		
		$post_args = array(
			'post_content'	=> $this->admin->email_body,
			'post_title'	=> sprintf(__('Email from %s'), $this->user->email),
			'post_type'		=> 'email',
			);
		$this->post_ID = wp_insert_post($post_args);
		update_post_meta($this->post_ID, 'shandora_email', $this->user->email);
		update_post_meta($this->post_ID, 'shandora_phone', $this->user->phone);
	}

	private function send_to_user() {
		$this->user->success = wp_mail($this->user->email, $this->user->subject, $this->user->email_body, $this->user->email_headers);
		// $this->return_data['maile'] = $this->user->success;
		if ($this->user->success) {
			$this->send_to_admin();
			$this->return_data['success'] = '1';
			$this->return_data['value'] = __( 'Email was sent successfully.', 'bon' );

			update_post_meta($this->post_ID, 'shandora_status', 1);
		} else {
			$this->return_data['value'] = __( 'There is an error sending email.', 'bon' );
			update_post_meta($this->post_ID, 'shandora_status', 0);
		}
	}

	private function send_to_admin() {
		add_filter( 'wp_mail_from', function() {// add necessary WP filters
			return 'no-reply@mastershouse.com';
		} );
		add_filter( 'wp_mail_from_name', function() {
			return __( "Masters House", 'bon' );
		} );
		wp_mail($this->admin->email, $this->admin->subject, $this->admin->email_body, $this->admin->email_headers);
	}

	public function setup_return_data() {
		return $this->return_data;
	}
}