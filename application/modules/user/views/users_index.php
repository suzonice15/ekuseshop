<div class="col-md-offset-0 col-md-12">
<div class="box  box-success">
	<div class="box-header with-border">


		<div class="row">

				<a href="<?=base_url('user-create')?>" class="btn btn-success pull-right">Add New</a>




		</div>
	</div>
	<div class="box-body">
<div class="table-responsive" id="ajaxdata">
		<table id="example1" class="table table-bordered table-striped table-responsive ">
			<thead>
			<tr>
				<th>Sl</th>
				<th >Picture</th>
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
				if($user->user_email=='suzonice15@gmail.com'){
					continue;
				}

    ?>
    <tr>


        <td><?php echo ++$count; ?></td>
        <td>
<?php if($user->user_picture) :?>
		<img src="<?php echo base_url();echo $user->user_picture ?> " width="50" height="50"/>

				<?php else :?>
					<img src="<?php echo base_url() ?>uploads/user/user.png" width="50" height="50"/>
<?php endif;?>
					</td>
        <td><?php echo $user->user_name; ?></td>
        <td><?php echo $user->user_phone; ?></td>
        <td><?php echo $user->user_email; ?></td>
        <td><?php $userr= $user->user_status=='active' ? 'Active' : 'Inactive';echo $userr;?></td>
		<td><?php echo $user->user_type; ?></td>
		<td><?php echo date('d-m-Y',strtotime($user->registered_date)); ?></td>
        <td>
			<a title="edit"
			   href="<?php echo base_url() ?>user-edit/<?php echo $user->user_id ?>"
			<span class="glyphicon glyphicon-edit btn btn-success"></span>
			</a>

			<!---->
			<!--//												if($user_type=='admin' || $user_type=='super-admin')-->
			<!--//												{-->
			<a title="delete"
			   href="<?php echo base_url() ?>user-delete/<?php echo $user->user_id ?>" onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')"  >
				<span class="glyphicon glyphicon-trash btn btn-danger"></span>
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
<script>
	$('.selectAllUrl').on('click',function () {
		url_id=this.id;
		var urlLink=$('#url_'+url_id);
		urlLink.select();
		document.execCommand("copy");
	})



</script>
<script>
	$(document).ready(function () {
		$("#ajax_pagingsearc a").attr('onclick', 'return main_page_pagination($(this));');
	});
</script>

<script>
	function main_page_pagination($this) {
		var url = $this.attr("href");
		if (url != '') {
			$.ajax({
				type: "POST",
				url: url,
				success: function (msg) {
					$("#ajaxdata").html(msg);
				}
			});
		}
		return false;
	}
</script>
<script>
	function search_content() {
		var base_url = "<?php echo base_url()?>";
		var users_title = $('#users_title').val();

		if ($.trim(users_title) != ""  ) {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url()?>users/usersController/index',
				data: {users_title:users_title },
				success: function (data) {
					$("#ajaxdata").html(data);
				}
			});
		} else {
			$.post(base_url + "users/usersController/index", function (data) {
				$("#ajaxdata").html(data);
			});
		}
	}
</script>
<script>
	function totalProductCount() {
		var base_url = "<?php echo base_url()?>";
		var counter = $('#counter').val();
		if ($.trim(counter) != ""  ) {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url()?>users/usersController/index',
				data: { counter:counter },
				success: function (data) {
					$("#ajaxdata").html(data);
				}
			});
		} else {
			$.post(base_url + "product-list", function (data) {
				$("#ajaxdata").html(data);
			});
		}
	}
</script>
