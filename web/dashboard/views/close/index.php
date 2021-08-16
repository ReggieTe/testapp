<?php
use TestApp\Core\Text;
$text = new Text();
?>
<div id="about-us-cover" class="section-container">
			<div class="container">
				<ul class="breadcrumb mb-3">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="#">My Account</a></li>
					<li class="breadcrumb-item active">Profile Settings</li>  
				</ul>
				<div class="account-container">
      <div class="account-body">
						<div class="row">
                  <div class="col-md-12">
                  <div class="widget my-profile margin-bottom-none">
                     <div class="widget-header">
                        <h1>Close account </h1>
                     </div>
                     <div class="widget-body">
                        <?=$text->notification($message??''); ?>
                           <div class="form-group">
                              <label class="col-sm-12 control-label">You are sure you want to close your account? <span class="required">*</span></label>
                              <div class="col-sm-12">
                                <p>Please note that the action of deleting your account is irrevesible and all account data will be lost</p>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-sm-12">
                                 <a href="<?=URL?>dashboard/authorize/profile/delete" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i> Yes I want to delete my account</a>
                              </div>
                           </div>
                     </div>
                  </div>
                  </div>
					</div>
				</div>
			</div>
		</div>