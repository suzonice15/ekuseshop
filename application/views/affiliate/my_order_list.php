
<div class="col-lg-9 col-md-9 col-sm-12 col-12"">
				
				

<h5>My Order lists
</h5>

<table class="table table-bordered" >
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th   >Date</th>

                    <th   >Order Total</th>
                    <th   >Status</th>
                    <th   >Action</th>
                </tr>
            </thead>
            <tbody>
                       
<?php

 if(isset($orders_list)){ 

 foreach($orders_list as $order) { ?>

					   <tr>
                        <td><?php echo $order->order_id;?> </td>
                        <td ><?php echo $order->created_time;?></td>
                           <td><?= formatted_price($order->order_total);?></td>
                        <td><?php  order_status($order->order_status);?></td>
                        
                        <td >
                            <a href="<?php echo base_url()?>affiliate/order_edit/<?php echo $order->order_id;?>" class="action view">
                                <span>View Order</span>
                            </a>
							</td>
                    </tr>
					
<?php } }?>
                      

					  </tbody>
        </table>





</div>

<?php

 function order_status($id){
     $array_value=Array(
         'new'=>'New',
         'pending_payment'=>'Pending for Payment',
         'processing'=>'On Process',
         'on_courier'=>'With Courier',
         'delivered'=>'Delivered',
         'completed'=>'Completed',
         'refund'=>'Refunded',
         'cancled'=>'Cancelled'


);
     echo $array_value[$id];
}
?>