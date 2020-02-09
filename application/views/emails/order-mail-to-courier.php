            	<?php
            	//echo '<pre>'; print_r($orders); echo '</pre>';

            	if(sizeof($orders)<=0)
            	{
            		return;
            	}

            	$courier_service = NULL;
            	foreach($orders as $order)
            	{
            		$courier_service = $order->courier_service;
            	}
            	?>

            	<table border="0" cellpadding="0" cellspacing="0" width="600" style="background:#ffffff;">
                	<tr>
                        <td valign="top" style="padding:20px 20px 0;">
							<p style="margin:0 0 10px;font-family:Tahoma,Arial,sans-serif;font-size:14px;font-weight:bold;">Hello legal authority of <?=$courier_service?>,</p>							
							<p style="margin:0;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
								Please collect the following products to shipment.<br><?php echo get_option('address'); ?>
							</p>
						</td>
					</tr>
					<tr>
                        <td valign="top" style="padding:20px 20px 20px;">
							<table cellpadding="0" cellspacing="0" style="width:100%;">
								<tr style="background:#f9f9f9;">
									<th colspan="4" style="padding:8px;border:1px solid #ddd;text-align:left;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Products
									</th>
								</tr>
								<tr>
									<td style="width:15%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;text-align:center;">
										Order No.
									</td>
									<td style="width:45%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Product
									</td>
									<td style="width:20%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;text-align:center;">
										Qty.
									</td>
									<td style="width:20%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;text-align:center;">
										Price
									</td>
								</tr>

								<?php
								foreach($orders as $order)
								{
									$product_items = unserialize($order->products);
									foreach($product_items['items'] as $product_id=>$item)
									{
										?><tr>
											<td style="padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;text-align:center;">
												<?=$order->order_id?>
											</td>
											<td style="padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
												<?=$item['name']?>
											</td>
											<td style="padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;text-align:center;">
												TK <?=$item['price']?> x <?=$item['qty']?>
											</td>
											<td style="padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;text-align:center;">
												TK <?=$item['subtotal']?>
											</td>
										</tr><?php
									}
								}
								?>
							</table>

							<br>

							<table cellpadding="0" cellspacing="0" style="width:100%;">
								<tr>
									<th colspan="2" style="width:100%;padding:8px;border:1px solid #ddd;text-align:left;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Orders
									</th>
								</tr>
								<tr>
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Order Number
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Order Total
									</td>
								</tr>

								<?php
								$total_cost = array();
								foreach($orders as $order)
								{
									$total_cost[] = floatval((str_replace(",", "", $order->order_total)));

									?><tr>
										<td style="padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
											<?=$order->order_id?>
										</td>
										<td style="padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
											TK <?=$order->order_total?>
										</td>
									</tr><?php
								}
								?>

								<tr>
									<th style="padding:8px;border:1px solid #ddd;text-align:left;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Total Cost
									</th>
									<th style="padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<?=array_sum($total_cost)?>
									</th>
								</tr>
							</table>
						</td>
					</tr>
				</table>