<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo get_option('site_title'); ?></title>
	<style type="text/css">
	body{margin:0;padding:0;}
	.wrapper{background:#f1f1f1;padding:40px 0;}
	.template-header{background:#074488;width:600px;border-radius:4px 4px 0 0;}
	.template-header img{display:block;margin:auto;height:40px;padding:10px;}
	a{color:#074488;text-decoration:none;}
	</style>
</head>
<body>
<div class="wrapper">
	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
    	<tr>
        	<td align="center" valign="top">
				<div class="template-header">
					<img src="<?=base_url('applications/views/emails/images/email-logo.png')?>" alt="<?php echo get_option('site_title'); ?>">
				</div>

            	<table border="0" cellpadding="0" cellspacing="0" width="600" style="background:#ffffff;">
                	<tr>
                        <td valign="top" style="padding:20px 20px 0;">
							<p style="margin:0 0 10px;font-family:Tahoma,Arial,sans-serif;font-size:14px;font-weight:bold;">Dear Ismail Hosen,</p>
							<p style="margin:0;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
								Welcome to <?php echo get_option('site_title'); ?>
							</p>
						</td>
					</tr>
                	<tr>
                        <td align="center" valign="top" style="padding:20px;">
                        	<a href="<?=base_url('trackorder/?track_id=&track_type=')?>" style="display:inline-block;background:#074488;padding:7px 15px;border-radius:4px;color:#ffffff;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
                        		Trackorder
                        	</a>
						</td>
					</tr>
					<tr>
                        <td valign="top" style="padding:0 20px 20px;">
							<table cellpadding="0" cellspacing="0" style="width:100%;">
								<tr>
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Order Status
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Processing
									</td>
								</tr>
							</table>

							<br>

							<table cellpadding="0" cellspacing="0" style="width:100%;">
								<tr style="background:#f9f9f9;">
									<th style="width:50%;padding:8px;border:1px solid #ddd;text-align:left;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Product
									</th>
									<th style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Price
									</th>
								</tr>
								<tr>
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<img src="http://localhost/himelshop.com/uploads/baby_thumb.jpg" height="50" width="50" style="float:left;margin-right:10px;">
										<div class="item-name-and-price">
											<div>ttt</div>
											<div>
												<span style="font-family:'SiyamRupaliANSI';">৳ 120.00</span> x <span style="font-family:'SiyamRupaliANSI';">1</span>
											</div>
										</div>
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<span style="font-family:'SiyamRupaliANSI';">৳ 120.00</span>
									</td>
								</tr>
							</table>

							<br>

							<table cellpadding="0" cellspacing="0" style="width:100%;">
								<tr style="background:#f9f9f9;">
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Payment Method
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<span class="bold">Cash On Delivery</span>
									</td>
								</tr>
								<tr>
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Order Number
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<span style="font-family:'SiyamRupaliANSI';">392</span>
									</td>
								</tr>
								<tr style="background:#f9f9f9;">
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Delivery Cost
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<span style="font-family:'SiyamRupaliANSI';">৳ 100</span>
									</td>
								</tr>
								<tr style="background:#f9f9f9;">
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Total
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<span style="font-family:'SiyamRupaliANSI';">৳ 220.00</span>
									</td>
								</tr>
							</table>

							<br>

							<table cellpadding="0" cellspacing="0" style="width:100%;">
								<tr style="background:#f9f9f9;">
									<th style="width:50%;padding:8px;border:1px solid #ddd;text-align:left;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Delivery Address
									</th>
									<th style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Address
									</th>
								</tr>
								<tr>
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										sdfsdfsd sfsdf sfsdf dfsfsd sdfsdfsd sfsdf sfsdf dfsfsd sdfsdfsd sfsdf sfsdf dfsfsd
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										sdfsdfsd sfsdf sfsdf dfsfsd sdfsdfsd sfsdf sfsdf dfsfsd sdfsdfsd sfsdf sfsdf dfsfsd
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>

				<table border="0" cellpadding="10" cellspacing="0" width="600" >                
					<tr>
                 		<td valign="top" align="center" style="padding:20px 0; color:#999999;font-family:Tahoma,Arial,sans-serif;font-size:12px;font-weight:normal;line-height:20px;text-align:center; background:#eeeeee;">
                 			<?=get_option('copyright')?> | Powered By <a href="http://isolutionsbd.com/">isolutions</a>
                 		</td>
                 	</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
</body>
</html>