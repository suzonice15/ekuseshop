<div class="col-md-offset-0 col-md-12">
    <div class="box  box-success">
        <div class="box-header with-border">


            <div class="row">




            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive" id="ajaxdata">
                <table id="example1" class="table table-bordered table-striped table-responsive ">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th >Name </th>
                        <th >Phone </th>
                        <th >Email </th>
                        <th >Status </th>
                        <th >Type </th>
                        <th >date </th>
                        <th >Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($users)){
                        $count = 0;
                        foreach ($users as $user) {

                            ?>
                            <tr>
                                <td><?php echo ++$count; ?></td>
                                <td><?php echo $user->user_f_name; ?></td>
                                <td><?php echo $user->user_mobile; ?></td>
                                <td><?php echo $user->user_email; ?></td>
                                <td>
                                    <?php $userr= $user->user_status=='1' ? 'Active' : 'Inactive';echo $userr;?>
                                </td>
                                <td>
                                    <?php $staatus= $user->affiliate_user;
                                    if($staatus==2){
                                        echo 'Affiliater';
                                    } else {
                                        echo 'Customer';
                                    }

                                    ?>
                                </td>
                                <td>
                                    <?php echo $user->created_date; ?>
                                </td>
                                <td>
                                    <a title="edit"
                                       href="<?php echo base_url() ?>affiliate-user-edit/<?php echo $user->user_id ?>"
                                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                                    </a>
                                </td>

                            </tr>

                        <?php }} ?>
                    </tbody>

                </table>

            </div>



        </div>

    </div>
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
        var userId = new Array();

        //	var allId = $('.checkAll').val();
        $('.checkAll').each(function () {
            if ($(this).is(":checked")) {
                userId.push(this.id);
            }
        });
        if (userId.length > 0) {
            $.ajax({

                url: '<?php echo base_url()?>users/usersController/multipleDelete',
                data: {users_id: userId},
                type: 'post',
                success: function (data) {
                    alert(data)
                    window.location = '<?php echo base_url()?>users-list';
                }
            });
        } else {
            alert("Select at least one product checkbox");

        }


    });

</script>
