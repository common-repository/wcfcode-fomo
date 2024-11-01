<?php
include_once('function.php');
$function = new wcf_fomo_functions();
$apidata = $function->get_campaign_details();
if(!empty($apidata)) {
    $user_id = $apidata[0]['id'];
} else {
    $user_id = '';
}


if(isset($_POST['login_onet'])) {
	$function->wcf_one_time_login();
}
if(''== $user_id){
?>

<html lang="en">
<head>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
  <body>
  <div class="card">
        <div class="row">
<div class="col">
            <form method="post" action="">
				<input type="hidden" name="data" value="hello">
				<button type="submit" class="btn btn-primary " name="login_onet" placeholder="create">
					Create New Campaign
				</button>
				
	</form>
          </div>
</div>
</div>

</body>
</html>

<?php
}else{
?>	
	<h3>WCF FOMO Campaigns</h3>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<form method="post" action="">
<input type="hidden" name="data" value="hello">
	<button type="submit" class="btn btn-primary rounded-pill " name="login_onet" placeholder="create">New Campaigns</button>
</form>
 <div class="wrap">
<table class="wp-list-table widefat striped"  cellspacing="0" cellpadding="5">
<thead>
<tr class ="table_wcf" >
<th><h5>Campaign</h5></th>
<th><h5>Domain</h5></th>
<th><h5>Launched On</h5></th>
<th><h5>Manage</h5></th>
</tr>
</thead>
<tbody>
<?php
	foreach ($apidata as $campaigns) {
		echo '<tr>
		<td>'.$campaigns['name'].'</td>
		<td>'.$campaigns['domain'].'</td>
		<td>'.$campaigns['datetime'].'</td>
		<td><a href="#" class="btn btn-info"  >
					Manage Campaign
				</a></td>
		</tr>';
	}
?>
</tbody>
</table>
</div>
<?php
	}
?>