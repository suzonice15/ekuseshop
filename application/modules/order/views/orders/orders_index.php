<div class="col-md-offset-0 col-md-12">
    <div class="box  box-success">
        <div class="box-header with-border  ">

            <?php

            function order_status($id)
            {
                $array_value = Array(
                    'new' => 'New',
                    'pending_payment' => 'Pending for Payment',
                    'processing' => 'On Process',
                    'on_courier' => 'With Courier',
                    'delivered' => 'Delivered',
                    'completed' => 'Completed',
                    'refund' => 'Refunded',
                    'cancled' => 'Cancelled'


                );
                echo $array_value[$id];
            }

            ?>


            <form action="<?php echo base_url() ?>order-list-report" name="order" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Order status</label>
                          
                            <select class="form-control select2" id="order_status" name="order_status">
                                <option value="">--select--</option>
                                
                                <option value="new">New</option>
                                <option value="pending_payment">Pending for Payment</option>
                                <option value="processing">On Process</option>
                                <option value="on_courier">With Courier</option>
                                <option value="delivered">Delivered</option>
                                <option value="refund">Refunded</option>
                                <option value="cancled">Cancelled</option>
                                <option value="completed">Completed</option>
								<option value="1">All</option>
                            </select>
                        </div>
                    </div>
                    <!--					<div class="col-md-3">-->
                    <!--						<div class="form-group">-->
                    <!--							<label for="email">Order By</label>-->
                    <!---->
                    <!--							<select class="form-control select2" id="order_by" name="order_by">-->
                    <!--								<option value="">--select--</option>-->
                    <!--								--><?php
                    //								$office_staffs = users_by_role('office-staff');
                    //
                    //								if(isset($office_staffs)):
                    //								foreach ($office_staffs as $office_staff):
                    //								?>
                    <!--								<option value="-->
                    <?php //echo $office_staff->user_id;?><!--">-->
                    <?php //echo $office_staff->user_name;?><!--</option>-->
                    <!--								--><?php
                    //endforeach;								endif;?>
                    <!---->
                    <!---->
                    <!--							</select>-->
                    <!--						</div>-->
                    <!--					</div>-->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date From</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="date_from" name="date_from"
                                       class="form-control pull-right <?php if (isset($date_from)) {
                                           echo 'withoutFixedDate';
                                       } else { echo 'datepicker';} ?>  "
                                       value="<?php if (isset($date_from)) {
                                           echo date('d-m-Y', strtotime($date_from));
                                       } ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date To</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="date_to" name="date_to"
                                       class="form-control pull-right <?php if (isset($date_to)) {
                                           echo 'withoutFixedDate';
                                       } else { echo 'datepicker';} ?>   "
                                       value="<?php if (isset($date_to)) {
                                           echo date('d-m-Y', strtotime($date_to));
                                       } ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Filter</button>
                        </div>
                    </div>


                </div>
            </form>


        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Order Id</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Created By</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Affiliater</th>
                        <th>Date & Time</th>
                        <th>Actions&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    if (isset($orders)) {
                        $html = NULL;
                        $i = 0;
                        //echo '<pre>'; print_r($orders); echo '</pre>';
                        foreach ($orders as $row) {
                            if ($row->order_status == 'new') {
                                $order_status = 'New';
                            } else if ($row->order_status == 'pending_payment') {
                                $order_status='Pending for Payment';
                            }
                            else if ($row->order_status == 'processing') {
                                $order_status='On Process';
                            }
                            else if ($row->order_status == 'on_courier') {
                                $order_status='With Courier';
                            }
                            else if ($row->order_status == 'delivered') {
                                $order_status='Delivered';
                            }
                            else if ($row->order_status == 'completed') {
                                $order_status='Completed';
                            }
                            else if ($row->order_status == 'refund') {
                                $order_status='Refunded';
                            } else {
                                $order_status='Cancelled';

                            }
                            if ($row->affiliate_user_id == 0) {
                                $name = 'General customer';
                            } else {
                                $this->db->select('user_f_name');
                                $this->db->join('order_data', 'affiliate_users.user_id=order_data.affiliate_user_id');
                                $this->db->where('order_data.affiliate_user_id', $row->affiliate_user_id);
                                $results = $this->db->get('affiliate_users')->row();
                                $name = $results->user_f_name;
                            }
                            //print_r($results);
                            $html .= '<tr>
											<td>' . ++$i . '</td>
											<td>' . $row->order_id . '</td>
												<td>' . $row->customer_name . '</td>
												<td>' . $row->customer_phone . '</td>';

                                $html .= '<td>' . ucwords(str_replace('-', ' ', $row->created_by)) . '</td>';
                           

                            $html .= '<td> ' .formatted_price($row->order_total ). '</td>';
                            $html .= '<td>' . $order_status . '</td>';
                            $html .= '<td> <a href="#" class="btn btn-info">' . $name . '</a></td>';


                            $html .= '<td>' . date('H:i:s a d-M-Y', strtotime($row->created_time)) . '</td>
												<td class="action text-center">';


                            $html .= '<a class="fa fa-eye" href="' . base_url() . 'order-view/' . $row->order_id . '">&nbsp;</a>
													<a class="fa fa-trash"  id="deleteOrder" href="' . base_url() . 'order-delete/' . $row->order_id . '"  >&nbsp;</a>
												</td>
											</tr>';
                        }
                        echo $html;
                    }
                    ?>
                    </tbody>
                </table>

            </div>
            <p id="data"></p>

        </div>

    </div>
</div>

<script>
    $(document).ready(function () {
        $('#example1 #deleteOrder').click(function () {
            var con = confirm('Are you want to delete ');
            if (con == true) {
                return true;
            } else {
                return false;

            }
        });

    });
</script>
<script>

    document.forms['order'].elements['order_status'].value = "<?php if (isset($option)) {
        echo $option;
    }?>";
    document.forms['order'].elements['order_by'].value = "<?php if (isset($order_by)) {
        echo $order_by;
    }?>";
</script>

