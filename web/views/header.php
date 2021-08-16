<?php  
use TestApp\Core\Session;
use TestApp\Core\Text;
use TestApp\ContentManager;
use TestApp\Core\Date;

$text = new Text();
$session = new Session();
$date = new Date();
$contentManager = new ContentManager();
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=SITE_NAME?> | <?=$contentManager->getPageName()?></title>
		<meta name="description" content="<?=$contentManager->getPageDescription()?>">
		<meta name="keywords" content="<?=$contentManager->getPageKeyWords() ?>">
		<meta name="author" content="<?=SITE_NAME?>">      
	    <link rel="apple-touch-icon" sizes="76x76" href="<?=URL ?>public/assets/image/user.png">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"  />	
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="<?=URL ?>public/assets/frontend/assets/css/app.css" rel="stylesheet" />
		<link href="<?=URL ?>public/assets/css/app.css" rel="stylesheet" />
		<link href="<?=URL ?>public/assets/css/sweetalert.css" rel="stylesheet" >
<body>
	<div id="page-container" class="">
		<div id="header" class="header">
			<div class="container">
				<div class="header-container">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="header-logo">
						<a href="<?=URL ?>home">
							<span class="brand-text">
								<span class="text-danger"><b>Test</b> </span>App								
							</span>
						</a>
					</div>
					<div class="header-nav">
						<div class=" collapse navbar-collapse" id="navbar-collapse">
							<ul class="nav pull-right">
							</ul>
							
						</div>
					</div>
					<div class="header-nav">
						<ul class="nav pull-right">	
						<?php if ($session->get("loggedIn")): ?>							
							<li class="dropdown dropdown-hover">
									<a href="#" data-toggle="dropdown">
									<img src="<?=URL.USER_DEFAULT_IMAGE ?>" class="user-img" alt="<?=USER_DEFAULT_IMAGE ?>" />
										My Account
										<b class="caret"></b>
										<span class="arrow top"></span>
									</a>
									<div class="dropdown-menu">
											<a class="dropdown-item" href="<?php echo URL; ?>dashboard/home">
												<i class="fa fa-fw fa-user"></i>Dashboard
											</a>
											<a class="dropdown-item" href="<?php echo URL; ?>logout">
											<i class="fa fa-fw fa-power-off"></i> Log Out
											</a>
									</div>
								</li>
							<?php else:?>
							<li>
								<a href="<?=URL ?>home">
									<img src="<?=URL.USER_DEFAULT_IMAGE ?>" class="user-img" alt="<?=USER_DEFAULT_IMAGE ?>" /> 
									<span  class="d-none d-xl-inline">Sign in / Sign up </span>	
								</a>                                    
							</li> 
                    	<?php endif; ?>							
						</ul>
					</div>
				</div>
			</div>
		</div>
	  

		<style>
                  
                  </style>
      
    
                      
              
            