<?php 
use TestApp\Core\Text; 
use TestApp\App\City;
use TestApp\App\AccountType;
use TestApp\User\Record\Timesheet;
use TestApp\Core\Session;

$session = new Session();
$userId =$session->get('usercodeid');
$timeSheets = new Timesheet();

$city = new City();
$session = new Session();
$text = new Text();
$id=0;
$projectId ='';
$hoursSpent ='';
$date ='';
$description ='';
$action="add";
$id =filter_var($_GET['app']??null, FILTER_SANITIZE_STRING);
if($id)
{ 
   $timeSheet = new Timesheet($id);
   $projectId = $timeSheet->getProjectId();
   $hoursSpent = $timeSheet->getHoursSpent();
   $date = $timeSheet->getDate();
   $description = $timeSheet->getDescription();   
   $action="update";
}

$accounttype=new AccountType();

?>
<div id="about-us-cover" class="section-container">
			<div class="container">
				<ul class="breadcrumb mb-3">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Timesheet</li>  
				</ul>
				<div class="account-container">
      <div class="account-body">
						<div class="row">
                     <div class="col-md-12">
                     <?= $text->notification(@$message); ?>  
                     </div>
                  <div class="col-md-6">
                     
                     <div class="widget-header">                  
                        <h2>
                           <b>
                              <?=ucfirst($action)?> Timesheet 
                              <?php if($action!="add"):?><small><a href="<?=URL; ?>dashboard/add"  class="pull-right">New Timesheet</a></small><?php endif;?>
                        </b>                     
                        </h2>
                     </div>
                        <div class="widget my-profile ">
                              <div class="widget-body">                       
                                 <form  method="POST" action="<?php echo URL; ?>dashboard/authorize/timesheet/<?=$action?>" id="process-form" data-parsley-validate class="form-horizontal form-label-left">
                                    <input type="hidden"  name="id" value="<?=$id; ?>">
                                       <div class="row">  
                                             <div class="col-sm-12"> 
                                                <div class="form-group">
                                                <label class="control-label">Project <span class="required">*</span></label>
                                                <select class="form-control border-form" name="project"  id="list">; 
                                                      <?=$text->selectListOptions(PROJECTS,$projectId,"Select project")?>
                                                   </select>
                                                </div>
                                             </div>
                                             <div class="col-md-12">   
                                                <div class="form-group">
                                                   <label class="control-label">Date <span class="required">*</span></label>
                                                   <input class="form-control border-form" type="date"  name="date" placeholder="Enter date" value="<?=$date; ?>">
                                                </div>
                                             </div>
                                             <div class="col-md-12">   
                                                <div class="form-group">
                                                   <label class="control-label">Time (hours spent) <span class="required">*</span></label>
                                                   <select class="form-control border-form" name="hours"  id="list">; 
                                                      <?=$text->selectListOptions(HOURSPENT,$hoursSpent,"Select hours spent")?>
                                                   </select>
                                                </div>
                                             </div>
                                             <div class="col-sm-12">   
                                                <div class="form-group">
                                                   <label class="control-label">Description <span class="required">*</span></label>
                                                   <textarea class="form-control border-form" type="text" rows='6'  name="description"><?=$description?></textarea>
                                                   </div>
                                             </div>                                              
                                             <div class="col-sm-12">   
                                                <div class="form-group">
                                                <button class="btn btn-success btn-md  pull-right" type="button"  id="submit-form"><?=ucfirst($action)?> Timesheet</button>                                 
                                                </div>
                                             </div>
                                          </div>
                                    </div>
                                 </form>
                              </div>
                        </div>
              
               <div class="col-md-6">
                     <div class="widget-header">                  
                        <h2>
                           <b>My Timesheets</b>                     
                        </h2>
                     </div>
                           <div class="widget my-profile ">
                              <div class="widget-body">  
                                 
                              <table id="data-table-autofill" class="table table-striped table-td-valign-middle">
								<thead>
									<tr>									
										<th class="text-nowrap">Project</th>
										<th class="text-nowrap">Hours</th>
                              <th class="text-nowrap">Done On</th>
                              <th class="text-nowrap">Action</th>
									</tr>
								</thead>
								<tbody>
										<?php foreach($timeSheets->get($userId) as $list):?>
										<tr>
                                 <td><?= ucfirst(PROJECTS[$list['project_id']]) ?></td>
                                 <td><?=$list['hours_spent'] ?></td>
                                 <td><?=$list['date'] ?></td>
                                 <td>
                                 <a href="<?=URL?>dashboard/add/update/<?=$list['id'] ?>" title="Delete Record"> Edit</a>
                                 <a href="<?=URL?>dashboard/authorize/timesheet/delete/<?=$list['id'] ?>" title="Delete Record"> Delete</a>
                                 </td>
										</tr>
										<?php endforeach;?>
										</tbody>
                              <thead>
									<tr>									
										<th class="text-nowrap">Project</th>
										<th class="text-nowrap">Hours</th>
                              <th class="text-nowrap">Done On</th>
                              <th class="text-nowrap">Action</th>
									</tr>
								</thead>
				  					</table>


                                 
                              </div>
                           </div>
                        </div>
               
               </div>
</div>
      </section>
