<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="date=no" />
	<meta name="format-detection" content="address=no" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="x-apple-disable-message-reformatting" />
    
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<title>Order Receipt No. {{$order->slug}} | Expiring Soon</title>
	
	<link rel="icon" type="image/png" href="{{asset('images/favicon/favicon-16x16.png')}}" />
	<meta name="msapplication-TileImage" content="{{asset('images/favicon/favicon-16x16.png')}}" />


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
															<td style="font-size:0pt; line-height:0pt; text-align:left;">
																<a href="https://expiringsoon.shop" target="_blank">
																	<img src="{{asset('images/logo.png')}}" width="125" border="0" alt="" />
																</a>
															</td>
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
									<td class="fluid-img">
										<img src="{{asset('images/site/img-delivered.jpg')}}" border="0" width="100%" alt="" />
									</td>
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
															<td class="h1 pb25" style="color:#666; font-family:Poppins,sans-serif; font-size:13px; line-height:25px; text-align:left; padding-bottom:15px;">
																<span style="font-size:16px;font-weight:600">Dear {{$order->user->name}},</span>
																<br/>Your order with id:  is now ready to be picked up. In case you are not happy with your purchase, 
																you may still be able to reject it within the next 24hours, else we will assume you are satisfied with your purchase and after which we your order will be automatically marked completed and closed. 
																<br />Thank you for shopping with Expiring Soon. 
																
															</td>
														</tr>
														
														<tr>
															<td class="fluid-img" align="center">
																<img src="{{asset('images/site/tracking-bar-ready.jpg')}}" border="0" width="100%" alt="" />
															</td>
														</tr>
														<tr>
															<td class="text-center pb25" style="color:#666666; font-family:Poppins,sans-serif; font-size:13px; line-height:25px; text-align:left; padding-bottom:15px;padding-top:10px">
																<div style="display:flex;justify-content:space-between">
																	<div style="">
																		<span style="font-weight:600">Pickup Address</span><br />
																			{{ucwords(strtolower($order->shop->name))}}<br />
																			{{ucwords(strtolower($order->shop->address))}}<br/>
																			{{ucwords(strtolower($order->shop->city ? $order->shop->city->name.', ' : ''))}} {{ucwords(strtolower($order->shop->state->name))}} <br/>
																			{{$order->shop->phone}}
																			
																	</div>
																	<div style="">
																		<span style="font-weight:600">Summary</span><br />
																		Order #: {{$order->slug}}<br />
																		Ready Date: {{$status->created_at->format('d/m/y')}}<br />
																		
																	</div>
																</div>
																
															</td>
														</tr>
														
														<tr>
															<td class="text-center pb25" style="color:#666666; font-family:Poppins,sans-serif; font-size:13px; line-height:25px; text-align:left; padding-bottom:15px;">
																
															</td>
														</tr>
														<tr>
															<td style="color:#666666; font-family:Poppins,sans-serif; font-size:13px; line-height:30px; padding-bottom:25px;">
																<div class="cart-row">
																	<div class="cart-item-name" style="font-weight: 600;">Items</div>
																	<div class="cart-item-qty" style="font-weight: 600;">Qty</div>
																	<div class="cart-item" style="font-weight: 600;">Price</div>
																	<div class="cart-item" style="font-weight: 600;">Total</div>
																</div>
																@foreach($order->items as $item)
																	<div class="cart-row">
																		<div class="cart-item-name">{{$item->product->name}}</div>
																		<div class="cart-item-qty">{{$item->quantity}}</div>
																		<div class="cart-item">{!!$order->shop->country->currency->symbol!!}{{$item->amount}}</div>
																		<div class="cart-item">{!!$order->shop->country->currency->symbol!!}{{$item->total}}</div>
																	</div>
																@endforeach
																
															
																<div class="cart-row-ttl">
																	<div class="cart-item-name">&nbsp;</div>
																	<div class="cart-item"><span style="font-weight: 600;">Sub Total</span></div>
																	<div class="cart-item">{!!$order->shop->country->currency->symbol!!}{{$order->subtotal}}</div>

																	<div class="cart-item-name">&nbsp;</div>
																	<div class="cart-item"><span style="font-weight: 600;">VAT ({{$order->shop->country->vat}}%)</span></div>
																	<div class="cart-item">{!!$order->shop->country->currency->symbol!!}{{$order->vat}}</div>

																	<div class="cart-item-name" style="margin-bottom:10px">&nbsp;</div>
																	<div class="cart-item"><span style="font-weight: 600;">Shipping</span></div>
																	<div class="cart-item">{!!$order->shop->country->currency->symbol!!}{{$order->deliveryfee}}</div>

																	<div class="cart-item-name" style="margin-bottom:10px">&nbsp;</div>
																	<div class="cart-item"><span style="font-weight: 600;">Total</span></div>
																	<div class="cart-item"><span style="font-weight: 600;">{!!$order->shop->country->currency->symbol!!}{{$order->total}}</span></div>
																</div>
																
															</td>
														</tr>
														
														<!-- Button -->
														<tr>
															<td align="center">
																<table class="center" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
																	<tr>
																		<td class="text-button" style="padding:12px">
																			<a @if(isset($user)) href="{{route('order.show',$order)}}" @else href="{{route('vendor.shop.order.view',[$shop,$order])}}" @endif target="_blank" class="link">
																				<img src="{{asset('images/site/btn-orderdetails.png')}}" width="175">
																			</a>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
														<tr>
															<td class="text-center pb25" style="color:#666666; font-family:Poppins,sans-serif; font-size:14px; line-height:30px; text-align:center; padding-top:10px;">
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
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:40px; border-top:1px solid #ddd">
											<tr>
												<td align="center" style="padding-bottom: 30px;">
													<table border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:center;">
																<a href="#" target="_blank">
																	<img src="{{asset('images/site/t2_instagram.jpg')}}" width="34" height="34" border="0" alt="" />
																</a>
															</td>
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
