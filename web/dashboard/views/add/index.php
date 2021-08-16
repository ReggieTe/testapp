<?php 
use TestApp\Core\Text; 
use TestApp\App\City;
use TestApp\App\AccountType;
use TestApp\User\Record\Person;
use TestApp\Core\Session;

$city = new City();
$session = new Session();
$text = new Text();
$id=0;
$nameCurrent ='';
$surnameCurrent ='';
$natId ='';
$phoneCurrent ='';
$emailCurrent = '';
$dobCurrent = '';
$interestsCurrent ='';
$languageCurrent ='';
$action="add";
$id =filter_var($_GET['method']??null, FILTER_SANITIZE_STRING);
if($id)
{ 
   $person = new Person($id);
   $nameCurrent =$person->getName();
   $surnameCurrent = $person->getSurname();
   $natId = $person->getNatId();
   $phoneCurrent = $person->getPhone();
   $emailCurrent = $person->getEmail();
   $dobCurrent = $person->getDob();
   $emailCurrent= $person->getEmail();
   $action="update";
}

$accounttype=new AccountType();

?>
<div id="about-us-cover" class="section-container">
			<div class="container">
				<ul class="breadcrumb mb-3">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="#">My Account</a></li>
					<li class="breadcrumb-item active">List</li>  
				</ul>
				<div class="account-container">
      <div class="account-body">
						<div class="row">
                  <div class="col-md-12">
               <?php echo $text->notification(@$message); ?>  
               <div class="widget-header">                  
                  <h2>
                     <b><?=ucfirst($action)?> Person</b> 
                     <?php if($action == "update"): ?> 
                         <small class="pull-right">
                     <a href="<?php echo URL; ?>dashboard/add">Add New</a></small>
                      <?php endif; ?>                     
                  </h2>
               </div>
                  <div class="widget my-profile ">
                     <div class="widget-body">
                       
                        <form  method="POST" action="<?php echo URL; ?>dashboard/authorize/add/<?=$action?>" id="process-form" data-parsley-validate class="form-horizontal form-label-left">
                        <input type="hidden"  name="id" value="<?=$id; ?>">
                        <div class="col-sm-12">
                        <div class="row">                             
                              <div class="col-md-6">   
                                 <div class="form-group">
                                    <label class="control-label">Firstname <span class="required">*</span></label>
                                    <input class="form-control border-form" type="text"  name="name" placeholder="Enter firstname" value="<?=$nameCurrent?>">
                                 </div>
                              </div>
                              <div class="col-md-6">   
                                 <div class="form-group">
                                    <label class="control-label">Surname <span class="required">*</span></label>
                                    <input class="form-control border-form" type="text"  name="surname" placeholder="Enter surname" value="<?=$surnameCurrent ?>">
                                 </div>
                              </div>

                              <div class="col-md-6">   
                                 <div class="form-group">
                                    <label class="control-label">South African Id Number <span class="required">*</span></label>
                                    <input class="form-control border-form" type="text"  name="natid" placeholder="Enter id" value="<?=$natId; ?>">
                                 </div>
                              </div>

                              <div class="col-md-6">   
                                 <div class="form-group">
                                    <label class="control-label">Mobile Number <span class="required">*</span></label>
                                    <input class="form-control border-form" type="text"  name="phone" placeholder="Enter phone" value="<?=$phoneCurrent ?>">
                                 </div>
                              </div>
                              <div class="col-sm-6">   
                                 <div class="form-group">
                                    <label class="control-label">Email Address <span class="required">*</span></label>
                                    <input class="form-control border-form" type="text"  name="email" placeholder="Enter email" value="<?=$emailCurrent ?>">
                                 </div>
                              </div>
                              <div class="col-sm-6">   
                                 <div class="form-group">
                                    <label class="control-label">Birth Date <span class="required">*</span></label>
                                    <input class="form-control border-form" type="datetime"  name="dob" placeholder="Enter date of birth" value="<?=$dobCurrent ?>">
                                 </div>
                              </div>

                              <div class="col-sm-12"> 
                                 <div class="form-group">
                                    <label class="control-label">Interests <span class="required">*</span></label>
                                    <select class="form-control border-form" name="interests[]"  id="list" multiple>; 
                                       <?=$text->selectListOptions(INTERESTS,$interestsCurrent,"Select Multiple Interest")?>
                                    </select>
                                 </div>
                              </div> 
                              <div class="col-sm-12"> 
                                 <div class="form-group">
                                 <label class="control-label">Language <span class="required">*</span></label>
                                 <select class="form-control border-form" name="language"  id="list">; 
                                       <?=$text->selectListOptions(LANGUAGE,$languageCurrent,"Select language")?>
                                    </select>
                                 </div>
                              </div>  
                                              
                              <div class="text-right">
                                 <button class="btn btn-success btn-md  pull-right" type="button"  id="submit-form"><i class="fa fa-save"></i> Save Changes</button>                                 
                              </div>
                              </div>
                              </div> 
                           </div>
                        </form>
                        </div>
                        </div>
                     </div>
                  </div>
      </section>
