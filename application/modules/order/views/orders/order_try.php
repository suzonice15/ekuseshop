<div class="col-md-offset-0 col-md-12">
    <div class="box  box-success">

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <form method="POST">
                                <?php
                                date_default_timezone_set("Asia/Dhaka");


                                $staff_id = $staff_sql = $date_sql = $shipment_sql = $order_status_sql = '';
                                $staff_row = FALSE;

                                $order_status = 'try';

                                if (isset($_POST['filter'])) {
                                    $order_status = $_POST['order_status'];

                                    if ($user_type == 'admin' || $user_type == 'super-admin') {
                                        $staff_id = $_POST['staff_id'];
                                    }

                                    $data_by_selection = $_POST['data_by_selection'];

                                    if ($data_by_selection) {
                                        if ($data_by_selection == 'today') {
                                            $date_from = date("Y-m-d");
                                            $date_to = date("Y-m-d", strtotime(date('Y-m-d') . ' +1 day'));
                                        } elseif ($data_by_selection == 'yesterday') {
                                            $date_from = date("Y-m-d", strtotime(date('Y-m-d') . ' -1 day'));
                                            $date_to = date("Y-m-d");
                                        } elseif ($data_by_selection == 'this_week') {
                                            $monday = strtotime("last monday");
                                            $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;
                                            $sunday = strtotime(date("Y-m-d", $monday) . " +6 days");
                                            $date_from = date("Y-m-d", $monday);
                                            $date_to = date("Y-m-d", $sunday);
                                        } elseif ($data_by_selection == 'this_month') {
                                            $date_from = date("Y-m-01", strtotime(date("Y-m-d")));
                                            $date_to = date("Y-m-t", strtotime(date("Y-m-d")));
                                        } elseif ($data_by_selection == 'this_year') {
                                            $date_from = date("Y-01-01", strtotime(date("Y-m-d")));
                                            $date_to = date("Y-12-31", strtotime(date("Y-m-d")));
                                        } elseif ($data_by_selection == 'all') {
                                            $date_from = "2017-01-01";
                                            $date_to = date("Y-m-d", strtotime(date('Y-m-d') . ' +1 day'));
                                        }

                                        $date_sql = "AND `modified_time` >= '$date_from' AND `modified_time` <= '$date_to'";
                                    } else {
                                        if ($_POST['date_from']) {
                                            $date_from = date("Y-m-d", strtotime($_POST['date_from']));
                                            $date_to = date("Y-m-d", strtotime($_POST['date_to'] . ' +1 day'));

                                            $date_sql = "AND `modified_time` >= '$date_from' AND `modified_time` <= '$date_to'";
                                        }
                                    }

                                    //echo 'date_from: '.$date_from.'<br>';
                                    //echo 'date_to: '.$date_to.'<br>';

                                    if ($staff_id) {
                                        if ($order_status) {
                                            $staff_sql = "AND `staff_id`=$staff_id";
                                        } else {
                                            $staff_sql = "`staff_id`=$staff_id";
                                        }
                                    }
                                } else {

                                }

                                if ($order_status) {
                                    $order_status_sql = "`try_status`=1";
                                }

                                $sql = "select * from `order_data` 

 WHERE $order_status_sql $date_sql $staff_sql ORDER BY `order_data`.order_id DESC";
                                ?>

                                <div class="row row5">
                                    <div class="col-sm-11">
                                        <div class="row row5">
                                            <div class="col-sm-2">
                                                <div hidden class="form-group">
                                                    <label>Order Status</label>
                                                    <?php
                                                    $status_option['new'] = 'New';
                                                    $status_option['pending'] = 'Pending';
                                                    $status_option['pending_payment'] = 'Pending Payment';
                                                    $status_option['processing'] = 'Processing';
                                                    $status_option['on_courier'] = 'On Courier Service';
                                                    $status_option['ready_to_deliver'] = 'Ready To Deliver';
                                                    $status_option['delivered'] = 'Delivered';
                                                    $status_option['cancled'] = 'Cancled';
                                                    $status_option['try'] = 'Try Order';

                                                    $selected_status = set_value('order_status') ? set_value('order_status') : 'try';

                                                    echo form_dropdown('order_status', $status_option, $selected_status, array('class' => 'form-control', 'id' => 'order_status'));
                                                    ?>
                                                </div>
                                            </div>


                                            <div hidden class="col-sm-2">
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

                                                    echo form_dropdown('data_by_selection', $option, $selected, array('class' => 'form-control', 'id' => 'data_by_selection'));
                                                    ?>
                                                </div>
                                            </div>

                                            <div hidden class="col-sm-2">
                                                <div class="form-group">
                                                    <label>Date From</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" name="date_from"
                                                               class="form-control pull-right datepicker"
                                                               value="<?= date('m/d/Y') ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div hidden class="col-sm-2">
                                                <div class="form-group">
                                                    <label>Date To</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" name="date_to"
                                                               class="form-control pull-right datepicker"
                                                               value="<?= date('m/d/Y') ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div hidden class="col-sm-1">
                                        <label>&nbsp;</label><br>
                                        <button type="submit" name="filter" value="filter" class="btn btn-primary">
                                            Filter
                                        </button>
                                    </div>
                                </div>

                                <div hidden class="btnarea">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php echo get_req_message(); ?>
                                        </div>
                                        <div class="col-sm-6" style="text-align:right;">

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Try Order Id</th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Total</th>
                                            <th>Order Status</th>
                                            <th>Date</th>
                                            <th>Action&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $result = get_result($sql);

                                        $newsql = "SELECT * FROM `order_data` WHERE order_status ='new' order by order_id  ASC";
                                        $new_result = get_result_array($newsql);


                                        if (isset($result) && count($result) > 0) {
                                            $html = NULL;
                                            //echo '<pre>'; print_r($result); echo '</pre>';
                                            foreach ($result as $new) {


                                                $array = array('order_status' => 'new', 'customer_phone' => $new->customer_phone);
                                                $CI = get_instance();
                                                $CI->db->select('*');
                                                $CI->db->where($array);
                                                $resultt = $CI->db->get('order_data')->row();


                                                if ($resultt) {

                                                } else {


                                                    $html .= '<tr>
												<td>
													' . $new->order_id . '
												</td>
<td>' . $new->customer_name . '</td>
<td>' . $new->customer_phone . '</td>
												<td>৳ ' .$new->order_total. '</td>';

                                                        $html .= '<td>'.$new->order_status.'</td>';


                                                    $html .= '<td>' . date('h:i:s a d-M-Y', strtotime($new->created_time)) . '</td>
												<td class="action text-center">';


                                                    $html .= '<a class="fa fa-eye " href="' . base_url() . 'order/OrderController/try_view/' . $new->order_id . '">&nbsp;</a>
													<a class="fa fa-trash" href="' . base_url() . 'order/OrderController/try_delete/' . $new->order_id . '" data-row_id="' . $new->order_id . '" data-table="order">&nbsp;</a>
												</td>
											</tr>';


                                                }

                                            }
                                            echo $html;


                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>