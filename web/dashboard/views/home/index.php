<?php 
use TestApp\Core\Text; 
use TestApp\App\City;
use TestApp\App\Country;
use TestApp\App\AccountType;
use TestApp\Core\JsonList;
use TestApp\User\Record\Person;
use TestApp\User\Settings;
use TestApp\Core\Session;


$session = new Session();
$userId =$session->get('usercodeid');
$person = new Person();
$text = new Text();
$city = new City();
$userCountry = new Country($countryCode??null);

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
               <?=$text->notification(@$message); ?>
				  <h4>List <small><a href="<?=URL; ?>dashboard/add"  class="pull-right">Add</a></small></h4>
				  <table id="data-table-autofill" class="table table-striped table-td-valign-middle">
								<thead>
									<tr>
										<th class="text-nowrap">Name</th>
										<th class="text-nowrap">Surname</th>
										<th class="text-nowrap">ID</th>
										<th class="text-nowrap">Mobile</th>
										<th class="text-nowrap">Email</th>
										<th class="text-nowrap">Birth Date</th>
										<th class="text-nowrap">Language</th>
										<th class="text-nowrap">Interests</th>
									</tr>
								</thead>
								<tbody>
										<?php  
										$person->setAddedBy($userId);
										foreach($person->getAllData() as $list): 
										?>
										<tr>
										<td><a href="<?=URL?>dashboard/authorize/add/delete/<?=$list['id'] ?>" title="Delete Record">
										<?=$list['name'] ?></a></td>
										<td><?=$list['surname'] ?></td>
										<td><?=$list['natid'] ?></td>
										<td><?=$list['phone']?></td>
										<td><?=$list['email'] ?></td>
										<td><?=$list['dob'] ?></td>
										<td><?=$list['language'] ?></td>
										<td><?=$list['interests'] ?></td>
										</tr>
										<?php endforeach;?>
										</tbody>
				  					</table>								
						</div> 					
                  </div>
      </section>


	  






	  