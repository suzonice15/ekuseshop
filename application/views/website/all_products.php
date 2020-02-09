<section class="xs-section-padding bg-gray">
    <div class="container" style="margin-top: -60px;
margin-bottom: -132px;">
        <div class="product-cate-block-wraper" style="border:none">
            <div class="row no-gutters">
                <div class="col-lg-12">
                    <div class="row no-gutters">
                              <div id="load_data"></div>
                           
                    </div>       
                </div>
            </div>
        </div><!-- .row END -->
    </div>
    <!-- .container END -->

</section>

<script>
    $(document).ready(function () {



load_data();
        function load_data() {


            $.ajax({
                url: "<?php echo base_url()?>/Ajax/all_product",
                method: "POST",
                cache: false,
                success: function (data) {
                    if (data == '') {
                    
                    } else {
                        $('#load_data').append(data);

                    }
                }
            })
        }




    });
</script>
