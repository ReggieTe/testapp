<?php 
use TestApp\Core\Session;
use TestApp\Core\Response;

$app = new Response();
$session = new Session();
if (!$session->get('loggedIn')) {
   $app->site("Invalid link .Please try again","web/views/signin/index.php");
}
?>
      
    <div id="about-us-cover" class="section-container">
			<div class="container">
				<ul class="breadcrumb mb-3">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Redirect</a></li>
				</ul>
				<div class="account-container">
               <div class="account-body">
						<div class="row">
                     <div class="col-md-12">
                        <div class="row"> 

                        <div class="col-sm-3"></div>

                        <div class="col-sm-6  text-center">
                           <div class="error-page">
                           <div class="spinner-border " role="status">
                              <span class="sr-only">Loading...</span>
                           </div>
                              <h2>Redirecting...</h2>
                              <div class="error-details">
                              You will be auto redirected to the <b>dashboard</b> in a few seconds
                              </div><br><br>
                              <div>
                                 <div class="spinner-grow text-primary" role="status">
                                 <span class="sr-only">Loading...</span>
                                 </div>
                                 <div class="spinner-grow text-secondary" role="status">
                                 <span class="sr-only">Loading...</span>
                                 </div>
                                 <div class="spinner-grow text-success" role="status">
                                 <span class="sr-only">Loading...</span>
                                 </div>
                                 <div class="spinner-grow text-danger" role="status">
                                 <span class="sr-only">Loading...</span>
                                 </div>
                                 <div class="spinner-grow text-warning" role="status">
                                 <span class="sr-only">Loading...</span>
                                 </div>
                                 <div class="spinner-grow text-info" role="status">
                                 <span class="sr-only">Loading...</span>
                                 </div>
                                 <div class="spinner-grow text-light" role="status">
                                 <span class="sr-only">Loading...</span>
                                 </div>
                                 <div class="spinner-grow text-dark" role="status">
                                 <span class="sr-only">Loading...</span>
                                 </div><br>
                                 <p>Please be patient whilst we warm up the cache for you for a better experience</p>
                              </div>
                              <br>                       
                                 <a href="<?=URL?>dashboard/home" class="text text-primary">Click here for manual redirecting..</a>
                                 <?='<script>  window.location.href="'.URL.'dashboard/home";  </script>'?>
                           </div>
                        </div>                           
                        </div>
                     </div>               
                  </div>
               </div>
            </div>
                 
      </section>
