<?php 
use TestApp\Core\Text;
use TestApp\App\AccountType;

$text = new Text();
$accountTypes = new AccountType(); 
?>
	<div id="about-us-cover-" class="section-container">
			<div class="container">
				<ul class="breadcrumb mb-3">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Log In</li>
				</ul>
				<div class="account-container">
					<div class="account-body">
						<div class="row">
                  <div class="col-md-4"></div>
                  
                  
                     <div class="col-md-4 login-panel-widget"  >
                        <div class="login-panel widget">
                           <div class="login-body">
                              <h1>Log In</h1>
                           <?= $text->notification(@$message); ?>
                           <form action="<?=URL ?>authorize/login" method="post">
                                 <div class="form-group">
                                    <label class="control-label">Email <span class="required">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="User Email" required/>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label">Password <span class="required">*</span></label>	
                                    <input type="password" name="password" class="form-control" placeholder="Password" required/>
                                 </div>
                                 
                                 <div class="form-group">
                                    <button class="btn btn-block btn-lg btn-primary" type="submit">Sign In</button>
                                 </div>
                              </form>
                           </div>                     
                        </div>                        
                     </div>

                     <div class="col-md-4"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
      
	
      