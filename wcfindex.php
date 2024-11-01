<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
  <body> 
	 
	  <?php
	
$function = new wcf_fomo_functions();
$apidata = $function->get_campaign_details();
if(!empty($apidata)) {
 $user_id = $apidata[0]['id'];   
}

if(isset($_POST['login_onet'])) {
	$function->wcf_one_time_login();
}
$option_var = get_option('wcf_registered_email');
 include_once('function.php'); 
	 
	$function = new wcf_fomo_functions();
if (isset($_POST['wcf_fomo_switch-account'])) {
    $function->wcf_fomo_switch_account();
}
if (isset($_POST['submit_user']))
{
	$function->create_user($_POST);
} 
?>
	  <div class="container">
      
      <br>
      <br>
      <br> <?php
  if(true == $option_var) {
	  $user_details = $function->get_user_details();
	  ?> <h4> You have subscribed to <?php printf(esc_html__(strtoupper($user_details['plan_id']), 'wecodefuture-fomo')); ?> Plan </h4>
	
		  
		  
	<div class="container">
    <div class="main-body">
    
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <div class="mt-3">
                      <h4>Plan: <?php printf(esc_html__(strtoupper($user_details['plan_id']), 'wecodefuture-fomo')); ?></h4>
                      <h6 >Plan Expiry: <?php $date = strtotime($user_details['plan_expiration_date'].'+ 30 days'); printf(esc_html__(date("j F Y", $date), 'wecodefuture-fomo')); ?> </h6>
                      <div class="row">
						  <button class="btn btn-primary"  onclick = "wcf_fomo_update_plan()">Change Plan</button>
						<form method='post' action=''>
						    <button type="submit" class="btn btn-warning"  name='wcf_fomo_switch-account'>Switch Account</button>
						</form>
						</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Registered Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php printf (esc_html__( $user_details['email'], 'wecodefuture-fomo' )); ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Account Type</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php printf (esc_html__($user_details['billing']['type'], 'wecodefuture-fomo' )); ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
					  if($user_details['billing']['phone'] != '') {
						 printf (esc_html__( $user_details['billing']['phone'], 'wecodefuture-fomo' ) );
					  } else {
						  echo 'NA';
					  }
					  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
					  if($user_details['is_enabled'] == '1') {
						  echo 'Active';
					  } else {
						  echo 'Inactive';
					  }
					  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
						  <form method="post" action="">
				<input type="hidden" name="data" value="hello">
				<button type="submit" class="btn btn-info " name="login_onet" target="_blank" placeholder="create">
					Login to WCF Fomo Dashboard
				</button>
				
	</form>
                      
                    </div>
                  </div>
                </div>
              </div>
              </div>
          </div>

        </div>
    </div>
		  <?php
  } else {
	  ?> 
      <div class="form-row justify-content-center">
        <div class="card">
        <img class="wcf-logo"  src="<?php echo esc_url( plugins_url( '/asset/img/WeCodeFuture_Logo_.jpg', __FILE__ ) ); ?>" / >
        <h4> Create your free WCF FOMO account. </h4>
          <form  id="wcf_code_fomo" method="POST"  action="">
			  <div class="form-group">
              <label for="name">Full Name</label>
              <input id="name" type="text" name="name" class="form-control form-control-lg " value="" maxlength="32" placeholder="Your full name" required="required" autofocus="autofocus">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" type="email" name="email" class="form-control form-control-lg " placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input id="password" type="password" name="password" class="form-control form-control-lg " value="" maxlength="32" placeholder="Password" required="required">
            </div>
            <div class="form-group">
              <button id="Submit"  type="submit" name="submit_user" class="btn btn-primary ">Create Account </button>
            </div>
          </form>
        </div>
      </div> <?php
  }
	  ?>
    </div>
  </body>
</html>
