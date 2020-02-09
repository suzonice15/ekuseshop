<div class="col-md-12">
    <div class="box-body">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success">
                        <div class="box-body">
                            <form method="POST">
                                <div class="btnarea">
                                    <div class="row">


                                    </div>
                            </form>
                        </div>


                        <div id="ajaxdata" class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Mobile</th>
                                    <th>Cration date</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>


                                <?php
                                if (isset($passwords)) {

                                    $i = 0;

                                    foreach ($passwords as $prod) {
                                     ?>
                                        <tr>
                                            <td><?php echo ++$i; ?>
                                            </td>

                                            <td><?php echo $prod->mobile; ?> </td>
                                            <td><?php echo $prod->date; ?> </td>



                                            <td class="action text-right">


                                                <a title="edit"
                                                   href="<?php echo base_url() ?>DashboardController/changed/<?php echo $prod->password_id ?>"
                                                <span class=" btn btn-success">Changed</span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }


                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
    </div>
    </section>
</div>

</div>

</div>
</div>
