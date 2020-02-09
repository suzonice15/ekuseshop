<div class="col-md-offset-0 col-md-12">
	<div class="box-body">
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-success">
						<div class="box-body">

						<?php
						date_default_timezone_set("Asia/Dhaka");

						$date_from = date('Y-m-d');
						$date_to = date('Y-m-d', strtotime(date('Y-m-d').' +1 day'));

						$staff_id = '';
						$staff_sql = '';
						$staff_row = FALSE;
						$total_specific_staff_order_price=$total_specific_staff_order_qty=0;

						if(isset($_POST['filter']))
						{
							//echo "<pre>"; print_r($_POST); echo "</pre>";

							$staff_id = isset($_POST['staff_id']) ? $_POST['staff_id'] : $user_id;

							$data_by_selection = $_POST['data_by_selection'];
							if($data_by_selection)
							{
								if($data_by_selection=='today')
								{
									$date_from = date("Y-m-d");
									$date_to = date("Y-m-d", strtotime(date('Y-m-d').' +1 day'));
								}
								elseif($data_by_selection=='yesterday')
								{
									$date_from = date("Y-m-d", strtotime(date('Y-m-d').' -1 day'));
									$date_to = date("Y-m-d");
								}
								elseif($data_by_selection=='this_week')
								{
									$monday = strtotime("last monday");
									$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
									$sunday = strtotime(date("Y-m-d", $monday)." +6 days");
									$date_from = date("Y-m-d", $monday);
									$date_to = date("Y-m-d", $sunday);
								}
								elseif($data_by_selection=='this_month')
								{
									$date_from = date("Y-m-01", strtotime(date("Y-m-d")));
									$date_to =  date("Y-m-t", strtotime(date("Y-m-d")));
								}
								elseif($data_by_selection=='this_year')
								{
									$date_from = date("Y-01-01", strtotime(date("Y-m-d")));
									$date_to =  date("Y-12-31", strtotime(date("Y-m-d")));
								}
								elseif($data_by_selection=='all')
								{
									$date_from = "2017-01-01";
									$date_to = date("Y-m-d", strtotime(date('Y-m-d').' +1 day'));
								}
							}
							else
							{
								$date_from = date("Y-m-d", strtotime($_POST['date_from']));
								$date_to = date("Y-m-d", strtotime($_POST['date_to'].' +1 day'));
							}

							//echo 'date_from: '.$date_from.'<br>';
							//echo 'date_to: '.$date_to.'<br>';

							if($staff_id)
							{
								$staff_sql = "AND `staff_id`=$staff_id";
								$staff_row = TRUE;

								// specific staff orders
								$sql = "SELECT COUNT(order_id) as no_of_order, SUM(order_total) as order_total FROM `order_data` WHERE `created_by`='office-staff' AND `created_time` >= '$date_from' AND `created_time` <= '$date_to' $staff_sql ORDER BY order_id DESC";
								$specific_staff_orders_result = get_result($sql);
								foreach($specific_staff_orders_result as $specific_staff_order_row);
								$total_specific_staff_order_qty = $specific_staff_order_row->no_of_order;
								$total_specific_staff_order_price = $specific_staff_order_row->order_total;
								$total_specific_staff_order_price = number_format($total_specific_staff_order_price ? $total_specific_staff_order_price : 0);
							}
						}

						// total orders
						$sql="SELECT COUNT(order_id) as no_of_order, SUM(order_total) as order_total FROM `order_data` WHERE `created_time` >= '$date_from' AND `created_time` <= '$date_to' ORDER BY `order_id` DESC";
						$orders_result = get_result($sql);
						foreach($orders_result as $order_row);
						$total_order_qty = $order_row->no_of_order;
						$total_order_price = $order_row->order_total;
						$total_order_price = number_format($total_order_price ? $total_order_price : 0);

						// total online orders
						$sql="SELECT COUNT(order_id) as no_of_order, SUM(order_total) as order_total FROM `order_data` WHERE `created_time` >= '$date_from' AND `created_time` <= '$date_to' AND `created_by`='customer' ORDER BY `order_id` DESC";
						$online_orders_result = get_result($sql);
						foreach($online_orders_result as $online_order_row);
						$total_online_order_qty = $online_order_row->no_of_order;
						$total_online_order_price = $online_order_row->order_total;
						$total_online_order_price = number_format($total_online_order_price ? $total_online_order_price : 0);

						// total staff orders
						$sql="SELECT COUNT(order_id) as no_of_order, SUM(order_total) as order_total FROM `order_data` WHERE `created_time` >= '$date_from' AND `created_time` <= '$date_to' AND `created_by`='office-staff' ORDER BY `order_id` DESC";
						$staff_orders_result = get_result($sql);
						foreach($staff_orders_result as $staff_order_row);
						$total_staff_order_qty = $staff_order_row->no_of_order;
						$total_staff_order_price = $staff_order_row->order_total;
						$total_staff_order_price = number_format($total_staff_order_price ? $total_staff_order_price : 0);

						// orders
						if($user_type=='admin' || $user_type=='super-admin')
						{
							$sql = "SELECT * FROM `order_data` WHERE `created_time` >= '$date_from' AND `created_time` <= '$date_to' $staff_sql ORDER BY order_id DESC";
						}
						else
						{
							$sql = "SELECT * FROM `order_data` WHERE `created_by`='office-staff' AND `created_time` >= '$date_from' AND `created_time` <= '$date_to' $staff_sql ORDER BY order_id DESC";
						}
						
						$orders = get_result($sql);
						?>

						<form method="POST">
							<section class="content">
								<div class="box box-primary">
									<div class="box-body">
										<div class="row row5">
											<?php
											if($user_type=='admin' || $user_type=='super-admin')
											{
												?><div class="col-sm-2">
													<div class="form-group">
														<label>Office Staff</label>
														<?php
														$office_staffs = users_by_role('office-staff');
														echo "<pre>"; print_r($office_staffs); echo "</pre>";

														$staff_option[] = '--- choose ---';

														if(sizeof($office_staffs)>0)
														{
															foreach($office_staffs as $staff)
															{
																$staff_option[$staff->user_id] = $staff->user_name;
															}
														}
														
														$selected_staff = set_value('staff_id') ? set_value('staff_id') : '';
														
														echo form_dropdown('staff_id', $staff_option, $selected_staff, array('class'=>'form-control', 'id'=>'staff_id'));
														?>
													</div>
												</div><?php
											}
											?>
											<div class="col-sm-2">
												<div class="form-group">
													<label>Data By Selection</label>
													<?php
													$option[] = '--- choose ---';
													$option['today'] = 'Today';
													$option['yesterday'] = 'Yesterday';
													$option['this_week'] = 'This Week';
													$option['this_month'] = 'This Month';
													$option['this_year'] = 'This Year';
													$option['all'] = 'All';
													
													$selected = set_value('data_by_selection') ? set_value('data_by_selection') : '';
													
													echo form_dropdown('data_by_selection', $option, $selected, array('class'=>'form-control', 'id'=>'data_by_selection'));
													?>
												</div>
											</div>
											<div class="col-sm-2">
												<div class="form-group">
													<label>Date From</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" name="date_from" class="form-control pull-right datepicker" value="<?=date('m/d/Y')?>">
													</div>
												</div>
											</div>
											<div class="col-sm-2">
												<div class="form-group">
													<label>Date To</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" name="date_to" class="form-control pull-right datepicker" value="<?=date('m/d/Y')?>">
													</div>
												</div>
											</div>
											<div class="col-sm-1">
												<label>&nbsp;</label><br>
												<button type="submit" name="filter" value="filter" class="btn btn-primary">Filter</button>
											</div>
										</div>
									</div>
								</div>

								<?php
								if($user_type=='admin' || $user_type=='super-admin')
								{
									?><div class="row">
										<div class="<?=($staff_row==TRUE) ? 'col-sm-3' : 'col-sm-4'?>">
											<div class="box box-widget widget-user">
												<div class="widget-user-header bg-yellow" style="height:auto;">
													<h3 class="widget-user-username" style="font-size:16px;">Totall Orders</h3>
												</div>
												<div class="box-footer" style="padding-top:0;">
													<div class="row">
														<div class="col-sm-6">
															<div class="description-block">
																<h5 class="description-header"><?=$total_order_price?></h5>
																<span class="description-text">Total Price</span>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="description-block">
																<h5 class="description-header"><?=$total_order_qty?></h5>
																<span class="description-text">No. of orders</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="<?=($staff_row==TRUE) ? 'col-sm-3' : 'col-sm-4'?>">
											<div class="box box-widget widget-user">
												<div class="widget-user-header bg-purple" style="height:auto;">
													<h3 class="widget-user-username" style="font-size:16px;">Totall Online Orders</h3>
												</div>
												<div class="box-footer" style="padding-top:0;">
													<div class="row">
														<div class="col-sm-6">
															<div class="description-block">
																<h5 class="description-header"><?=$total_online_order_price?></h5>
																<span class="description-text">Total Price</span>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="description-block">
																<h5 class="description-header"><?=$total_online_order_qty?></h5>
																<span class="description-text">No. of orders</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="<?=($staff_row==TRUE) ? 'col-sm-3' : 'col-sm-4'?>">
											<div class="box box-widget widget-user">
												<div class="widget-user-header bg-aqua-active" style="height:auto;">
													<h3 class="widget-user-username" style="font-size:16px;">Totall Staff Orders</h3>
												</div>
												<div class="box-footer" style="padding-top:0;">
													<div class="row">
														<div class="col-sm-6">
															<div class="description-block">
																<h5 class="description-header"><?=$total_staff_order_price?></h5>
																<span class="description-text">Total Price</span>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="description-block">
																<h5 class="description-header"><?=$total_staff_order_qty?></h5>
																<span class="description-text">No. of orders</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<?php
										if($staff_row==TRUE)
										{
											?><div class="col-sm-3">
												<div class="box box-widget widget-user">
													<div class="widget-user-header bg-aqua-active" style="height:auto;">
														<h3 class="widget-user-username" style="font-size:16px;">Orders by <?=get_user_name($staff_id)?></h3>
													</div>
													<div class="box-footer" style="padding-top:0;">
														<div class="row">
															<div class="col-sm-6">
																<div class="description-block">
																	<h5 class="description-header"><?=$total_specific_staff_order_price?></h5>
																	<span class="description-text">Total Price</span>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="description-block">
																	<h5 class="description-header"><?=$total_specific_staff_order_qty?></h5>
																	<span class="description-text">No. of orders</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div><?php
										}
										?>
									</div>

									<div class="box">
										<div class="box-header with-border">
											<h3 class="box-title">Order Summary</h3>
							            </div>
										<div class="box-body">
											<div class="order-report-summary-table">									
												<table class="table table-bordered">
													<tr>
														<td>Total Orders(<?=$total_order_qty?>)</td>
														<td>Price: <?=$total_order_price?></td>
													</tr>
													<tr>
														<td>Totall Online Orders(<?=$total_online_order_qty?>)</td>
														<td>Price: <?=$total_online_order_price?></td>
													</tr>
													<tr>
														<td>Totall Staff Orders(<?=$total_staff_order_qty?>)</td>
														<td>Price: <?=$total_staff_order_price?></td>
													</tr>
													<?php if($staff_row==TRUE){ ?>
													<tr>
														<td>Orders by <?=get_user_name($staff_id)?>(<?=$total_specific_staff_order_qty?>)</td>
														<td>Price: <?=$total_specific_staff_order_price?></td>
													</tr>
													<?php } ?>
												</table>
											</div>
										</div>
									</div><?php
								}
								elseif($user_type=='office-staff')
								{
									?><div class="box box-widget widget-user">
										<div class="widget-user-header bg-aqua-active" style="height:auto;">
											<h3 class="widget-user-username" style="font-size:16px;">Orders by You</h3>
										</div>
										<div class="box-footer" style="padding-top:0;">
											<div class="row">
												<div class="col-sm-6">
													<div class="description-block">
														<h5 class="description-header"><?=$total_specific_staff_order_price?></h5>
														<span class="description-text">Total Price</span>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="description-block">
														<h5 class="description-header"><?=$total_specific_staff_order_qty?></h5>
														<span class="description-text">No. of orders</span>
													</div>
												</div>
											</div>
										</div>
									</div><?php
								}
								?>

								<div class="btnarea">
									<div class="row">
										<div class="col-md-8 col-sm-6 col-xs-12">
											<?php echo get_req_message(); ?>
										</div>
										<div class="col-md-4 col-sm-6 col-xs-12" style="text-align:right;">
											<!--<a href="<?=base_url('admin/order/add-new')?>" class="btn btn-default">Add New</a>-->
											<input type="submit" name="delete" value="Delete" class="btn btn-danger" id="deleteAll" data-table="order"/>
										</div>
									</div>
								</div>

								<div class="result">
									<table id="dataTable" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th><input type="checkbox" id="checkAll"></th>
											<th>Customer</th>
											<th>Total</th>
											<th>Created By</th>
											<th>Created Date</th>
											<th>Order Status</th>
											<th class="text-left">&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if(isset($orders) && count($orders)>0)
										{
											$html=NULL;
											//echo '<pre>'; print_r($orders); echo '</pre>';
											foreach($orders as $row)
											{
												$html.='<tr>
													<td>
														<input type="checkbox"  id="'.$row->order_id.'" class="checkAll"  />
													</td>
													<td>'.get_order_meta($row->order_id, 'billing_name').'('.get_order_meta($row->order_id, 'billing_phone').')</td>
													<td>TK '.$row->order_total.'</td>
													<td>'.get_user_name($row->staff_id).'</td>
													<td>'.date('d-m-Y', strtotime($row->created_time)).'</td>
													<td>'.ucwords($row->order_status).'</td>
													<td class="action text-right">';

														if($row->order_status == 'new')
														{
															$html.='<a class="fa fa-check make_order_done" href="javascript:void(0);" data-row_id="'.$row->order_id.'">&nbsp;</a>';
														}

														$html.='<a class="fa fa-eye" href="'.base_url().'order-view/'.$row->order_id.'">&nbsp;</a>
														<a class="fa fa-trash" href="javascript:void(0);" data-row_id="'.$row->order_id.'" data-table="order">&nbsp;</a>
													</td>
												</tr>';
											}
											echo $html;
										}
										?>
									</tbody>
									</table>
								</div>
							</section>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
	<script>

		$('#checkAll').change(function(){

			if($(this).is(":checked")){

				$('.checkAll').prop('checked',true);

			}

			else if($(this).is(":not(:checked)")){

				$('.checkAll').prop('checked',false);

			}

		});
		$('#deleteAll').click(function (e) {
			e.preventDefault();
			var orderId = new Array();

			var allId = $('.checkAll').val();
			$('.checkAll').each(function () {
				if ($(this).is(":checked")) {
					orderId.push(this.id);
				}
			});

			if (orderId.length > 0) {
				$.ajax({

					url: '<?php echo base_url()?>order/OrderController/multipleDelete',
					data: {order_id: orderId},
					type: 'post',
					success: function (data) {
						alert(data)
						window.location = '<?php echo base_url()?>order-report';
					}
				});
			} else {
				alert("Select at least one order checkbox");

			}


		});

	</script>
