            	<table border="0" cellpadding="0" cellspacing="0" width="600" style="background:#ffffff;">
                	<tr>
                        <td valign="top" style="padding:20px 20px 0;">
                        	<p style="margin:0 0 20px;font-family:Tahoma,Arial,sans-serif;font-size:14px;">Following products have limited stock/ out of stock.</p>
						</td>
					</tr>
					<tr>
                        <td valign="top" style="padding:0 20px 20px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="width:85%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<b>Product</b>
									</td>
									<td style="width:15%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;text-align:center;">
										<b>Qty.</b>
									</td>
								</tr>

								<?php
								if(isset($products))
								{
									$html=NULL;
									
									foreach($products as $prod)
									{
										$stock_qty = get_product_meta($prod->product_id, 'stock_qty');

										$featured_image = get_product_meta($prod->product_id, 'featured_image');
										$featured_image = get_media_path($featured_image);
										
										$html.='<tr>
											<td style="padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
												<a href="'.base_url().$prod->product_name.'" style="font-family:Tahoma,Arial,sans-serif;font-size:14px;">
													<img src="'.$featured_image.'" width="30" height="30" style="float:left;"> &nbsp; '.$prod->product_title.'
												</a>
											</td>
											<td style="wipadding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;text-align:center;">
												'.(!empty($stock_qty) ? $stock_qty : 0).'
											</td>
										</tr>';
									}
									
									echo $html;
								}
								?>
							</table>
						</td>
					</tr>
				</table>