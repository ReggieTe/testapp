<?php 
use TestApp\Core\Text; 
use TestApp\User\Record\Timesheet;
use TestApp\User\User;
use TestApp\Core\Hash;
//Populating tables with data
// $hash = new Hash();
// $usersD = array(array(
// 	"firstname" => 'John',	
//     "surname" => 'Doe',       
//     "email" => 'gvivolunteer1@gviworld.com',
//   "password" => $hash->create('gvi1000',"924988244605afb5b1c6ed"),
//   "salt"=>"924988244605afb5b1c6ed"
// ),
// array(
// 	"firstname" => 'Jane',	
//     "surname" => 'Doe',       
//     "email" => 'gvivolunteer2@gviworld.com',
//   "password" =>  $hash->create('gvi2000',"924988244605afb5b1c6ed"),
//   "salt"=>"924988244605afb5b1c6ed"
// ),
// array(
// 	"firstname" => 'Bob',	
//     "surname" => 'Doe',       
//     "email" => 'gvivolunteer3@gviworld.com',
//   "password" =>  $hash->create('gvi3000',"924988244605afb5b1c6ed"),
//   "salt"=>"924988244605afb5b1c6ed"
// ));
// $users = new User();
// foreach ($usersD as $D ){
// 	$users->register($D);
// }

$timesheet = new Timesheet();
$text = new Text();
?>

<div id="about-us-cover" class="section-container">
			<div class="container">
				<ul class="breadcrumb mb-3">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Dashboard</li>  
				</ul>
				<div class="account-container">
      <div class="account-body">
						<div class="row">
                  <div class="col-md-12">
               <?=$text->notification(@$message); ?>
				  <h4>List <small><a href="<?=URL; ?>dashboard/add"  class="pull-right">Add Time Sheet</a></small></h4>
				  <table id="data-table-autofill" class="table table-striped table-td-valign-middle">
								<thead>
									<tr>
									<th class="text-nowrap">Image</th>
										<th class="text-nowrap">FirstName</th>
										<th class="text-nowrap">Surname</th>
										<th class="text-nowrap">Projects/Hours spent</th>
									</tr>
								</thead>
								<tbody>
										<?php  
										$users = new User();										
										$default = URL.USER_DEFAULT_IMAGE;
										$size = 40;
										foreach($users->getAll() as $user):
											$email = $user['email'];
											$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
										?>
										<tr>
										<td><img class="img-circle img-responsive" style="height:60px;" src="<?=$grav_url?>"  alt="<?=ucfirst($user['firstname'])." ".ucfirst($user['surname']) ?> image"/></td>
										<td><?=$user['firstname'] ?></td>
										<td><?=$user['surname'] ?></td>
										<td>	
										<div class="modal fade" id="<?=$user['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel"><?=$user['firstname'] ?> <?=$user['surname'] ?> Timesheet</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
											<ul>
										<?php 
										$monthlyTotal = 0 ;
											foreach(PROJECTS as $key => $project):
												$total = 0 ;
												foreach($timesheet->get($user['id']) as $timesheetItem):
													if($key==$timesheetItem['project_id']): 
														$total = $total + (int)$timesheetItem['hours_spent'];
													endif;
												endforeach;
												echo"<li> $project : <small><b>$total hours</b></small></li>"; 
												$monthlyTotal = $monthlyTotal + $total;										
											endforeach;	
																				
										?>
										</ul>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
											</div>
										</div>
										</div>

										<?= "<p>Total : <b>$monthlyTotal hours <small>
										<a href='#' data-toggle='modal' data-target='#".$user['id']."'> Details</a>
										</small></p>"; ?>
										<!-- Modal -->
										
									</td>
										<td></td>										
										</tr>
										<?php endforeach;?>
										</tbody>
				  					</table>								
						</div> 					
                  </div>
      </section>

	  <!-- Button trigger modal -->


	  






	  