<div class="col-lg-9 col-md-9 col-sm-12 col-12">


    <h5>Order details
    </h5>
    <?php
    function order_status_condition($id)
    {
        $array_value = Array(
            'new' => 'New',
            'pending_payment' => 'Pending for Payment',
            'processing' => 'On Process',
            'on_courier' => 'With Courier',
            'delivered' => 'Delivered',
            'completed' => 'Completed',
            'refund' => 'Refunded',
            'cancled' => 'Cancelled',
            'try' => 'Try'


        );
        return $array_value[$id];
    } ?>
    <?php
    $track_html = '';
    $curiar = '';

    $order_day = date('d-M-Y', strtotime($order->created_time));
    $order_status = order_status_condition($order->order_status);

    $courier_name = $order->customer_name;
    $order_id = $order->order_id;
    $courier_phone = $order->customer_phone;
    $courier_email = $order->customer_email;
    $customer_addressl = $order->customer_address;
    $customer_deliveryaddressl = $order->delevery_address;
    $order_note = $order->order_note;
    $shipment_time = $order->shipment_time;
    if ($order->courier_service) {
        $curiar = '
										<td width="50%">Courier Service</td>
										<td>' . $order->courier_service . '</td>
									';
    }
//    if ($order->customer_email) {
//        $mail = '<td width="50%">Customer Email</td>
//										<td>' . $courier_email . '</td>';
//
//    }
    $track_html .= '<table class="table table-striped table-bordered">
		<tr>
			<th colspan="2"><center>Order Status</center></th>
		</tr>
		<tr>
			<td width="50%">Order Id</td>
			<td>' . $order_id . '</td>
		</tr>
			<tr>
			<td width="50%">Order Date</td>
			<td>' . $order_day . '</td>
		</tr>
		<tr>
			<td width="50%">Shipping Date</td>
			<td>' . $shipment_time . '</td>
		</tr>
		<tr>' . $curiar . '</tr>

		<tr>
			<td width="50%">Customer Name</td>
			<td>' . $courier_name . '</td>
		</tr>
		<tr>
			<td width="50%">Customer Phone</td>
			<td>' . $courier_phone . '</td>
		</tr>
		
		<tr>
			<td width="50%">Customer Address</td>
			<td>' . $customer_addressl . '</td>
		</tr>
		<tr>
			<td width="50%">Delivery Adress</td>
			<td>' . $customer_deliveryaddressl . '</td>
		</tr>
		
		';

    $track_html .= '<tr>
			<td width="50%">Order Status</td>
			<td>' . $order_status . '</td>
		</tr>
		';
    $track_html .= '<tr>
			<td width="50%">Order Note</td>
			<td>' . $order_note . '</td>
		</tr>
		';


    $track_html .= '</tr>';

    $track_html .= '</table>';

    echo $track_html;
    ?>

        <table class="table table-striped table-bordered">
            <tr>
                <th colspan="7">
                    <center>Product details</center>
                </th>
            </tr>
            <tr>
                <th class="name" width="30%">Product</th>
                <th class="image text-center" width="5%">Image</th>

                <th class="quantity text-center" width="5%">Qty</th>
                <th width="10%">Unit price</th>
                <th class="total text-right" width="10%">Sub-Total</th>
            </tr>
            <?php
            $product_ids = array();
            $proSizeList = 0;
            $total = 0;

            $product_items = unserialize($order->products);
            $product_items['items'];
            foreach ($product_items['items'] as $key => $item) {
                $totall = intval(preg_replace('/[^\d.]/', '', $item['subtotal']));

                $total += $totall;

                $this->db->select('product_of_size');
                $this->db->where('product_id', $key);
                $productSize = $this->db->get('product')->result();
                foreach ($productSize as $product) {
                    $proSizeList = $product->product_of_size;
                }
                $productSize_OF = explode(',', $proSizeList);
                //var_dump($productSize_OF);exit();
            }

            $html = null;
            if (is_array($product_items['items'])) {
                foreach ($product_items['items'] as $product_id => $item) {
                    $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;

                    $product_ids[] = $product_id;
                    $size = '';
                    $color = '';
                    if (isset($item['Size'])) {
                        $size = $item['Size'];
                    }
                    if (isset($item['Color'])) {
                        $color = $item['Color'];
                    }


                    $html .= '<tr>
														<td>' . (isset($item['name']) ? $item['name'] : null) . '</td>	
													
														<td class="image text-center">
															<img src="' . $featured_image . '" height="30" width="30">
														</td>
														
														';



                    $html .= '</select></td><td class="text-center">
															' . (isset($item['qty']) ? $item['qty'] : null) . '
														</td>
														<td class="text-center"> ৳ ' . (isset($item['price']) ? $item['price'] : null) . '</td>
														<td class="text-right"> ৳ ' . (isset($item['subtotal']) ? $item['subtotal'] : null) . '</td>
													</tr>';


                }
            }

            echo $html;
            ?>

        </table>



    <table class="table table-striped table-bordered">
        <tbody>
        <tr>

            <td>
                <span class=" ">Sub Total</span>
            </td>
            <td class="text-right" style="width:50%">
                <span class=" "> <?= formatted_price($total) ?> </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="extra bold">Delivery Cost</span>
            </td>
            <td class="text-right">
		<span class="bold"> <span
                id="delivery_cost"><?= formatted_price($order->shipping_charge); ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="extra bold totalamout">Total</span>
            </td>
            <td class="text-right">
														<span class="bold totalamout"> <span
                                                                id="total_cost"><?= formatted_price($order->order_total) ?></span></span>

            </td>
        </tr>


        </tbody>
    </table>
    </span>


</div>


</div>