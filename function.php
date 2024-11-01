<?php
ob_start();
class wcf_fomo_functions {
    public function create_user($data) {
        $email = $data['email'];
        $data = array('name' => $data['name'], 'email' => $data['email'], 'password' => $data['password']);
		$urli = 'http://underdevelopment.co/api/users/create.php';
		$queryi = $urli. '?' .http_build_query($data);		
        $result_response = wp_remote_get(
			$queryi,
			array(
				'method'    => 'GET'
			)
		);
		$new_query_data = wp_remote_retrieve_body($result_response);
        if ($new_query_data === FALSE) {
			echo 'something went wrong';
		} else {
			$user_currentid = $new_query_data;
			$identi = "https://fomo.wecodefuture.com/api/fetch_api.php?identifier=$user_currentid";
			$wp_get_post_response = wp_remote_get(
				$identi,
			);
			$data = wp_remote_retrieve_body( $wp_get_post_response );
			if($data == '400: Bad Request') {
				//	
			} else {
				update_option('wcf_registered_email', $email);
				update_option('wcf_userid', $user_currentid);
				update_option('wcf_api_key', $data);
				echo '<script>window.location.reload();</script>';
			}
		}
    }
    
    public function wcf_fomo_switch_account() {
        update_option('wcf_api_key', '');
        update_option('wcf_registered_email', '');
        update_option('wcf_userid', '');
        ?>
        <script type='text/javascript'>
        window.location=document.location.href;
    </script>
        <?php
    }
	
	public function get_campaign_details() {
	    if(get_option('wcf_api_key') == '') {
	        
	    } else {
	        $wcfurl = 'https://fomo.wecodefuture.com/api/campaigns/';
		$fomo_api = get_option('wcf_api_key');
		$bearer = "Authorization: Bearer $fomo_api";
		$wp_get_post_response = wp_remote_get(
			$wcfurl,
			array(
				'method'    => 'GET',
				'headers'   => $bearer
			)
		);
		$wcf_get_data = wp_remote_retrieve_body( $wp_get_post_response );
		$wcf_url = json_decode($wcf_get_data, true);
		  foreach($wcf_url as $val) {
			return  $val;
		  }
	    }
	}
	
	public function get_user_details() {
		$wcf_code_url = 'https://fomo.wecodefuture.com/api/user';
		$fomo_api = get_option('wcf_api_key');
		$bearer = "Authorization: Bearer $fomo_api";
		$wp_get_post_response = wp_remote_get(
			$wcf_code_url,
			array(
				'method'    => 'GET',
				'headers'   => $bearer
			)
		);
	
$wcf_get_data = wp_remote_retrieve_body( $wp_get_post_response );
		
		$dataset = json_decode($wcf_get_data, true);
		foreach($dataset as $row) {
			$user_details = $row;
		}
		return $user_details;
	}
	
	public function wcf_one_time_login() {
		$user_id = get_option('wcf_userid');
		$wp_wcf_request_url = 'https://fomo.wecodefuture.com/admin-api/users/'.$user_id.'/one-time-login-code';
$wp_wcf_request_headers = array(
              'Authorization' => 'Bearer 065304e41019ec5f82ee874e04e87323' 
);
$wp_get_post_response = wp_remote_post(
    $wp_wcf_request_url,
    array(
        'method'    => 'POST',
        'headers'   => $wp_wcf_request_headers
    )
);
		
$wp_get_response = wp_remote_retrieve_response_code( $wp_get_post_response ) ;

$wcf_post_data = wp_remote_retrieve_body( $wp_get_post_response );

$wcf_post_array_data = json_decode($wcf_post_data, true);

		foreach($wcf_post_array_data as $val) {
			$wcfexternal_link = $val['url'];
		 	header("Location: $wcfexternal_link");
		 }
	}
}
add_action('wp_enqueue_scripts', 'add_wcf_pixel_code_in_header');
function add_wcf_pixel_code_in_header() {
	$code_wcf_url = 'https://fomo.wecodefuture.com/api/campaigns/';
	$fomo_api = get_option('wcf_api_key');
	$bearer = "Authorization: Bearer $fomo_api";
	$wp_get_campaigns_response = wp_remote_get(
		$code_wcf_url,
		array(
			'method'    => 'GET',
			'headers'   => $bearer
		)
	);
$wcf_get_campaigns = wp_remote_retrieve_body( $wp_get_campaigns_response );
$wcf_array_campaigns = json_decode($wcf_get_campaigns, true);
	foreach($wcf_array_campaigns as $val) {
		foreach($val as $campaigns) {
			if(isset($campaigns['id'])){
				$wcf_pixel_key = $campaigns['pixel_key'];
				wp_enqueue_script('wcf-fomo-notifications-pixel', 'https://fomo.wecodefuture.com/pixel/'. $wcf_pixel_key);
			 }
		}
	}
}
?>