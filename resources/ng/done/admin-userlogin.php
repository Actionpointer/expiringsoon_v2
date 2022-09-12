<?php
include("dbconnect.php");
$uqq = mysqli_query($con, "SELECT * FROM admin WHERE admin='".$_GET['uid']."'");
$uqr = mysqli_fetch_assoc($uqq);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<!--[if gte mso 9]>
	<xml>
		<o:OfficeDocumentSettings>
		<o:AllowPNG/>
		<o:PixelsPerInch>96</o:PixelsPerInch>
		</o:OfficeDocumentSettings>
	</xml>
	<![endif]-->
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="date=no" />
	<meta name="format-detection" content="address=no" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="x-apple-disable-message-reformatting" />
    <!--[if !mso]><!-->
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--<![endif]-->
	<title>Admin Login | Expiring Soon</title>
	<!--[if gte mso 9]>
	<style type="text/css" media="all">
		sup { font-size: 100% !important; }
	</style>
	<![endif]-->

	<!-- site Favicon -->
	<link rel="icon" href="assets/images/favicon/favicon.png" sizes="32x32" />
	<link rel="apple-touch-icon" href="assets/images/favicon/favicon.png" />
	<meta name="msapplication-TileImage" content="assets/images/favicon/favicon.png" />


	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#f3f4f6; -webkit-text-size-adjust:none }
		a { color:#000001; text-decoration:none }
		p { padding:0 !important; margin:0 !important }
		img { -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */ }
		.mcnPreviewText { display: none !important; }
		.cart-row {display: block; height: 30px; width: 98%; padding: 5px; font-size: 12px; border-bottom: 1px solid #ddd;}
		.cart-row-ttl {display: block; height: 90px; width: 98%; padding: 5px; font-size: 12px; border-bottom: 1px solid #ddd;}
		.cart-item {float: left; width: 15%;}
		.cart-item-name {float: left; width: 60%;}
		.cart-item-qty {float: left; width: 10%;}
		.cart-item-ttl {float: left !important; width: 30%;}


		/* Mobile styles */
		@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
			.mobile-shell { width: 100% !important; min-width: 100% !important; }
			.bg { background-size: 100% auto !important; -webkit-background-size: 100% auto !important; }

			.text-header,
			.m-center { text-align: center !important; }

			.center { margin: 0 auto !important; }
			.container { padding: 20px 10px !important }

			.td { width: 100% !important; min-width: 100% !important; }

			.m-br-15 { height: 15px !important; }
			.p30-15 { padding: 30px 15px !important; }
			.p0-15-30 { padding: 0px 15px 30px 15px !important; }
			.mpb30 { padding-bottom: 30px !important; }

			.m-td,
			.m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }

			.m-block { display: block !important; }

			.fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }

			.column,
			.column-dir,
			.column-top,
			.column-empty,
			.column-empty2,
			.column-dir-top { float: left !important; width: 100% !important; display: block !important; }

			.column-empty { padding-bottom: 30px !important; }
			.column-empty2 { padding-bottom: 10px !important; }

			.content-spacing { width: 15px !important; }
		}
	</style>
</head>
<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#f3f4f6; -webkit-text-size-adjust:none;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f3f4f6">
		<tr>
			<td align="center" valign="top">
				<table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
					<tr>
						<td class="td container" style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; margin:0; font-weight:normal; padding:55px 0px;">
							<!-- Header -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="p30-15 tbrr" style="padding: 30px; border-radius:26px 26px 0px 0px;" bgcolor="#fff">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th class="column-top" width="145" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td style="font-size:0pt; line-height:0pt; text-align:left;"><a href="https://expiringsoon.shop" target="_blank"><img src="https://expiringsoon.shop/src/images/logo.png" width="125" border="0" alt="" /></a></td>
														</tr>
													</table>
												</th>
												<th class="column-empty2" width="1" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;"></th>
												<th class="column" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
															<tr>
															<td class="text-header" style="color:#fff; font-family:'Playfair Display', Georgia,serif; font-size:13px; line-height:18px; text-align:right;">&nbsp;</td>
														</tr>

														</table>
												</th>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!-- END Header -->

							<!-- Hero Image -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="fluid-img"><img src="https://expiringsoon.shop/img/img-verify.jpg" border="0" width="100%" alt="" /></td>
								</tr>
							</table>
							<!-- END Hero Image -->

							<!-- Intro -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="font-size:13px">
								<tr>
									<td style="padding-bottom: 10px;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td class="p30-15" style="padding: 20px 30px;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="h1 pb25" style="color:#666; font-family:Poppins,sans-serif; font-size:13px; line-height:25px; text-align:left; padding-bottom:20px;"><span style="font-size:16px;font-weight:600">Dear <?php echo $uqr['fname']; ?>,</span><br />
															You have been granted Admin access. See your Login details below:</span>.<br /><br />
															Username: <span style="font-weight:600"><?php echo $uqr['admin']; ?></span> | Password: <span style="font-weight:600"><?php echo $_GET['pass']; ?></span>
														</td>
														</tr>
														<tr>
															<td class="text-center pb25" style="color:#666666;font-family:Poppins,sans-serif; font-size:12px; line-height:20px; text-align:left; padding-bottom:20px;padding-top:20px;border-bottom:1px solid #ddd;border-top:1px solid #ddd">
															<div style="margin:auto;width:80%"><span style="font-weight:600">Please Note:</span><br />Do not share this email with anyone.</div>
															</td>
														</tr>
														<!-- END Button -->
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!-- END Intro -->

							<!-- Footer -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="p30-15 bbrr" style="padding: 20px 20px; border-radius:0px 0px 26px 26px;" bgcolor="#ffffff">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td align="center" style="padding-bottom: 30px;">
													<table border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:center;"><a href="#" target="_blank"><img src="https://expiringsoon.shop/img/t2_instagram.jpg" width="34" height="34" border="0" alt="" /></a></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td class="text-footer2" style="color:#999999; font-family:Poppins,sans-serif; font-size:12px; line-height:26px; text-align:center;">Copyright &copy; 2022 <span style="font-weight:500;color:#00b207">Expiring Soon</span></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!-- END Footer -->
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
