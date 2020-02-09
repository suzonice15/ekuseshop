<table class="table table-bordered table-striped table-hover">
    <tr>
        <th>Product Preview</th>
        <th>Name</th>
        <th>Approximate commission</th>
        <th>Approximate price</th>
        <th>Link Action</th>
    </tr>
    <?php foreach ($product_link as $v_link) {

        $featured_image = get_product_meta($v_link->product_id, 'featured_image');
        $featured_image = get_media_path($featured_image, 'thumb');
        $product_link = base_url() . 'product/' . $v_link->product_name;
        $prduct_price=$v_link->product_price;
        $discount_price=$v_link->discount_price;
        if($discount_price){
            $price=$discount_price;
        } else {
            $price=$prduct_price;

        }
        $rate=($price*3)/100;

        ?>
        <tr>
            <td><img src="<?php echo $featured_image; ?>" width="50" height="50"></td>
            <td><a  target="_blank" href="<?php echo $product_link ?>"><?php echo $v_link->product_title; ?></a></td>
            <td>৳<?php echo $rate;?></td>
            <td>৳<?php echo $price; ?></td>
            <td>
                <a href="#" onclick="get_link(<?php echo $v_link->product_id; ?>)" type="button"
                   class="btn btn-success" data-toggle="modal" data-target="#myModal">GET LINK</a>
            </td>
        </tr>
    <?php } ?>
</table>