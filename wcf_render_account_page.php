<?php
$user_id = get_option('wcf_userid');
$wp_request_url = 'https://fomo.wecodefuture.com/admin-api/users/ ' .$user_id. ' ';
$wp_request_headers = array(
              'Authorization' => 'Bearer 065304e41019ec5f82ee874e04e87323' 
);
$wp_get_post_response = wp_remote_get(
    $wp_request_url,
    array(
        'method'    => 'GET',
        'headers'   => $wp_request_headers
    )
);

$wp_get_response = wp_remote_retrieve_response_code( $wp_get_post_response ) ;

$wcf_get_data = wp_remote_retrieve_body( $wp_get_post_response );

$wcf_array_data = json_decode($wcf_get_data, true);
?>
	<h3>WCF  USER </h3>
<meta charset="utf-8">
 

 <div class="wrap">
<table class="wp-list-table widefat striped"  cellspacing="0" cellpadding="5">
<thead>
<tr class="account">
<th><h5>Language</h5></th>
<th><h5>Timezone</h5></th>
<th><h5>Launched On</h5></th>

</tr>
</thead>
<tbody>
<?php
foreach($wcf_array_data as $current_id) {
 
echo '<tr>
		<td>'.$current_id['language'].'</td>
		<td>'.$current_id['timezone'].'</td>
		<td>'.$current_id['datetime'].'</td>
		
		</tr>';
  }
 ?> 
 
</tbody>
</table>
</div>