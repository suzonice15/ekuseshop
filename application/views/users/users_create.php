<div class="col-md-offset-2 col-md-8">
<div class="box box-success">
    <div class="box-header with-border">
<!--		<div id="fadeout" class="alert alert-success alert-dismissible">-->
<!--			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
<!--			<h4><i class="icon fa fa-check"></i> Alert!</h4>-->
<!--			<span id="studentSuccess"></span>-->
<!--		</div>-->

    </div>
    <div class="box-body">

        <form action="#" class="form-horizontal" method="post">

			<div class="container"><h2><?php if (isset($title)) echo $title ;?> </h2></div>
			<div id="exTab3" class="container">
				<ul  class="nav nav-pills">
					<li class="active">
						<a  href="#1b" data-toggle="tab">Students</a>
					</li>
					<li><a href="#2b" data-toggle="tab">Teacher</a>
					</li>
					<li><a href="#3b" data-toggle="tab">Accountant</a>
					</li>
				</ul>

				<div class="tab-content clearfix">
					<div class="tab-pane active" id="1b">

						<div class="form-group">
							<label for="shiftName" class="col-sm-2 control-label">Student Name:</label>
							<div class="col-sm-4">
								<select required name="student_id" id="student_id" class="form-control select2">
									<option value="">Select student name</option>
									<?php
									if (isset($students)):
										foreach ($students as $student):
											?>
											<option <?php if (isset($studentClassRelation->student_id)): if ($studentClassRelation->student_id == $student->student_id)  : echo 'selected'; else : endif; endif; ?>
							value="<?php echo $student->student_id;?>" > <?php echo $student->student_name .'-'.$student->student_phone ;?> </option>					<?php endforeach; else : ?>
										<option value="">Registration first student name</option>
									<?php endif; ?>
								</select>

								<h4 id="studentExit" ></h4>
							</div>


						</div>

						<div class="form-group">
							<label for="shiftName" class="col-sm-2 control-label">Student password:</label>
							<div class="col-sm-4">

								<input required type="password" name="user_password" id="studentPassword" placeholder="Provide password" class="form-control" />

							</div>
						</div>

						<div class="form-group">
							<label for="shiftName" class="col-sm-2 control-label">User role:</label>
							<div class="col-sm-4">

									<select required name="user_role" id="studentUserRole" class="form-control ">
								<option value="">Select user role</option>


										<option value="0" > Student </option>
										<option value="2" > Teacher </option>
										<option value="3" > Accountant </option>
										<option value="1" > Admin </option>

									</select>


								</div>
							</div>
						</div>

					<div class="tab-pane" id="2b">

						<div class="form-group">
							<label for="shiftName" class="col-sm-2 control-label">Teacher Name:</label>
							<div class="col-md-8">
								<select required name="teacher_id" id="teacher_id" class="form-control select2">
									<option value="">Select teacher name</option>
									<?php
									if (isset($teachers)):
										foreach ($teachers as $teacher):
											?>
											<option <?php if (isset($studentClassRelation->student_id)): if ($studentClassRelation->student_id == $teacher->student_id)  : echo 'selected'; else : endif; endif; ?>
												value="<?php echo $teacher->teacher_id;?>" > <?php echo $teacher->teacher_full_name ;?> </option>					<?php endforeach; else : ?>
										<option value="">Registration first student name</option>
									<?php endif; ?>
								</select>

								<h4 id="teacherExit" ></h4>

							</div>
						</div>


						<div class="form-group">
							<label for="shiftName" class="col-sm-2 control-label">Teacher  password:</label>
							<div class="col-sm-4">

								<input type="password"  required name="user_password" id="teacherPassword" placeholder="Provide password" class="form-control" />

							</div>
						</div>

						<div class="form-group">
							<label for="shiftName" class="col-sm-2 control-label">User role:</label>
							<div class="col-sm-4">

								<select required name="user_role" id="teacherUserRole" class="form-control ">
									<option value="">Select user role</option>


									<option value="0" > Student </option>
									<option value="2" > Teacher </option>
									<option value="3" > Accountant </option>
									<option value="1" > Admin </option>

								</select>


							</div>
						</div>
					</div>

					<div class="tab-pane" id="3b">

						<div class="form-group">
							<label for="shiftName" class="col-sm-2 control-label">Accountant Name:</label>
							<div class="col-md-8">
								<select required name="marketer_id" id="marketer_id" class="form-control select2">
									<option value="">Select Accountant name</option>
									<?php
									if (isset($marketers)):
										foreach ($marketers as $marketer):
											?>
											<option
												value="<?php echo $marketer->marketer_id;?>" > <?php echo $marketer->marketer_name ;?> </option>					<?php endforeach; else : ?>
										<option value="">Registration first account name</option>
									<?php endif; ?>
								</select>

								<h4 id="acountExit" ></h4>

							</div>
						</div>


						<div class="form-group">
							<label for="shiftName" class="col-sm-2 control-label">Accountant  password:</label>
							<div class="col-sm-4">

								<input type="password"  required name="user_password" id="accountPassword" placeholder="Provide password" class="form-control" />

							</div>
						</div>

						<div class="form-group">
							<label for="shiftName" class="col-sm-2 control-label">User role:</label>
							<div class="col-sm-4">

								<select required name="user_role" id="accountUserRole" class="form-control ">
									<option value="">Select user role</option>
									<option value="0" > Student </option>
									<option value="2" > Teacher </option>
									<option value="3" > Accountant </option>
									<option value="1" > Admin </option>

								</select>

							</div>
						</div>
					</div>

				</div>


	</div>

    <div class="box-footer">
		<input type="submit" class="btn btn-success pull-right" value="Save"/>
		<a class="btn btn-danger " href="<?php echo base_url();?>user-list">Cancel</a>

	</div>
    </form>
</div>
</div>

	<script>
		$(function () {
$(":submit").click(function () {

	var student_id=$("#student_id").val();
	var user_role=$("#studentUserRole").val();
	var user_password=$("#studentPassword").val();
	if(student_id.length ==0) {

	} else {
		$.ajax({

			type: "POST",
			data: {student_id: student_id, user_role: user_role, user_password: user_password},
			url: '<?php echo base_url()?>UserController/store',
			success: function (data) {
				$("#studentExit").html(data);
				$("#student_id").val("");

				return false;
			}
		});
	}


});


			$("#student_id").change(function () {

				var student_id=$("#student_id").val();
				$.ajax({
					type:"POST",
					data:{student_id:student_id},
					url:'<?php echo base_url()?>UserController/studentCheck',
					success:function (data) {
						if (data.length > 1) {
							$("#studentExit").html(data);
							$(':submit').prop('disabled', true);
							return false;
						} else {
							$("#studentExit").html("");
							$(':submit').prop('disabled', false);
							return false;
						}
					}
				});


			});



			$(":submit").click(function () {

				var teacher_id = $("#teacher_id").val();
				var user_role = $("#teacherUserRole").val();
				var user_password = $("#teacherPassword").val();
				if (teacher_id.length ==0) {

				}
				else {
					$.ajax({

						type: "POST",
						data: {teacher_id: teacher_id, user_role: user_role, user_password: user_password},
						url: '<?php echo base_url()?>UserController/store',
						success: function (data) {
							$("#teacherExit").html(data);
							$("#teacher_id").val("");

							return false;
						}
					});
				}

			});



			$("#teacher_id").change(function () {

				var teacher_id=$("#teacher_id").val();

				$.ajax({

					type:"POST",
					data:{teacher_id:teacher_id},
					url:'<?php echo base_url()?>UserController/teacherCheck',
					success:function (data) {
						if (data.length > 1) {
							$("#teacherExit").html(data);
							//$(":submit").prop("disabled",false);
							$(':submit').prop('disabled', true);
							return false;
						} else {
							$("#teacherExit").html("");
							$(':submit').prop('disabled', false);
							return false;
						}
					}
				});


			});


			$(":submit").click(function () {

				var marketer_id = $("#marketer_id").val();
				var user_role = $("#accountUserRole").val();
				var user_password = $("#accountPassword").val();
				if (marketer_id.length ==0) {
				}
				else {
					$.ajax({

						type: "POST",
						data: {marketer_id: marketer_id, user_role: user_role, user_password: user_password},
						url: '<?php echo base_url()?>UserController/store',
						success: function (data) {
							$("#acountExit").html(data);
							$("#marketer_id").val("");

							return false;
						}
					});
				}

			});

			$("#marketer_id").change(function () {
				var marketer_id=$("#marketer_id").val();
				$.ajax({

					type:"POST",
					data:{marketer_id:marketer_id},
					url:'<?php echo base_url()?>UserController/AccountantCheck',
					success:function (data) {
						if (data.length > 1) {
							$("#acountExit").html(data);
							//$(":submit").prop("disabled",false);
							$(':submit').prop('disabled', true);
							return false;
						} else {
							$("#acountExit").html("");
							$(':submit').prop('disabled', false);
							return false;
						}
					}
				});


			});



		});

	</script>
