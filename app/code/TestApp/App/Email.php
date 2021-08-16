<?php
namespace TestApp\App;
use TestApp\Core\Date;

class Email{

 public function __construct(){
	$this->date = new Date();     
 }
 
/**
 * 
 * @param string $subject
 * @param string $message
 * @param string $to
 * @param string $from
 * @return boolean
 */
public function sendMail($subject,$message,$to,$template=true)
{
    $from = SITE_NAME." <".SITE_EMAIL.">";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "From: " . $from . "\r\n";
	// Send this message;
	$message = $template?$this->template($message):$message;
  return mail( $to, $subject, $message, $headers);
    
}


/**
 * 
 * @param string $notification
 * @return string
 */
public function template($notification) {
      $message='<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Email</title>
	</head>
	<body style="margin: 0; padding: 0;background-color:#fff">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
<!-- Header Start -->
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
						<tr>
							<td style="padding:15px 0 0 0;">
								<table align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
									<tr>
										<td>
											<table align="left" border="0" cellpadding="0" cellspacing="0" width="200" style="border-collapse: collapse;">
												<!-- logo -->
												<tr>
													<td align="left">
														<a href="'.URL.'">
															<img src="'.URL.'public/image/logo.png" alt="'.SITE_NAME.' Logo" style="display: block;"/>
														</a>
													</td>
												</tr>
																					
												<!-- Space -->
												<tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>				
				

					<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
						<tr>
							<td>
								<table bgcolor="#fafafa" align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
									<tr>
										<td>
											<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
												<tr>
													<td align="left" bgcolor="#ffffff" style="padding: 10px;padding-top: 20px;font-family: helvetica, Arial, sans-serif; font-size: 14px; color: #777777; line-height: 21px; text-align: left;"s >
													'. $notification.'
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
                    <br></br><br></br>
					<!-- Banner End -->
				

					<!-- Footer Start -->
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
						<tr>
							<td>
								<table bgcolor="#ffffff" align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
									<tr>
										<td>
											<!-- Space -->
											<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
												<tr><td style="font-size: 0; line-height: 0;" height="30">&nbsp;</td></tr>
											</table>	
													</td>
												</tr>
											</table>
											<!-- Space -->
											<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
												<tr><td style="font-size: 0; line-height: 0;" height="30">&nbsp;</td></tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>

					</table>

					<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
						<tr>
							<td>
								<table bgcolor="#f5f5f5" align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
									<tr>
										<td>
											<!-- Space -->
											<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
												<tr><td style="font-size: 0; line-height: 0;" bgcolor="#eaeaea" height="1">&nbsp;</td></tr>
												<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
											</table>
											<table align="center" border="0" cellpadding="0" cellspacing="0" width="540" style="border-collapse: collapse;">
												<tr>
													<td align="center" style="color: #999999; font-size: 14px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;">
														Copyright © 20'.date('y').'</td>
												</tr>
											</table>
											<!-- Space -->
											<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
												<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>';
return $message;
}

  
}
