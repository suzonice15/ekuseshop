<div class="col-md-offset-0 col-md-12">
	<div class="box  box-success">
		<div class="box-header with-border">
			<h3 class="box-title">
							<a class="btn btn-info" href="
				<?php echo base_url();?>user-create"><i class="fa fa-plus-circle"></i>Add new</span></a>

				<div class="form-group">
					<label for="shiftName" class="col-sm-5 control-label">Student Name:</label>
					<div class="col-sm-7">
						<select required name="classreg_section_id" id="classreg_section_id"
								class="form-control select2">
							<option value="">Select student name</option>
							<?php
							if (isset($classSections)):
								foreach ($classSections as $classSection):
									?>
									<option
										value="<?php echo $classSection->classreg_section_id; ?>"> <?php echo $classSection->classreg_section_name; ?> </option>
								<?php endforeach; else : ?>
								<option value="">Registration first student name</option>
							<?php endif; ?>
						</select>

					</div>
			</h3>


		</div>
		<div class="box-body">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
				<tr>
					<th>Sl</th>
					<th>Class</th>
					<th>Student</th>
					<th>Mobile</th>
					<th>Email</th>
					<th>Status</th>
				</tr>
				</thead>
				<tbody>

				</tbody>

			</table>


		</div>

	</div>
</div>
<script>

	$(function () {

		$(document).on('change', '#classreg_section_id', function(){

		var classreg_section_id = $("#classreg_section_id").val();
		$.ajax({
			type: "POST",
			data: {classreg_section_id: classreg_section_id},
			dataType: "json",
			url: '<?php echo base_url();?>UserController/studentList',
			success: function (results) {
		var str = "";
				var str1 = "";

				$.each(results['students'], function (key, result) {
					var key = key + 1;
					if (result['user_status'] == 1) {
						str = '<tr>' +
							'<td>' + key + '</td>' +
							'<td>' + result['classreg_section_name'] + '</td>' +
							'<td>' + result['student_name'] + '</td>' +
							'<td>' + result['student_phone'] + '</td>' +
							'<td>' + result['student_email'] + '</td>' +
							'<td><input type="button"  id="studentActive" data-id="'+result['studentId']+'" ' +
							'class="btn-xs btn-success" value="Active"></input></td>' +

							'</tr>';
					} else {
						str = '<tr>' +
							'<td>' + key + '</td>' +
							'<td>' + result['classreg_section_name'] + '</td>' +
							'<td>' + result['student_name'] + '</td>' +
							'<td>' + result['student_phone'] + '</td>' +
							'<td>' + result['student_email'] + '</td>' +
							'<td><input type="button"  id="studentInActive" type="button" ' +
							'data="'+result['studentId']+'" ' +
							'class="btn-xs btn-danger" value="Inactive"></input></td>' +

							'</tr>';
					}
					str1 = str1 + str;

				});
				$("#example1 tbody").empty();
				$("#example1 tbody").append(str1);
			}
		});
	});

		$(document).on('click', '#studentActive, #studentInActive', function()
		{
			var studentActiveId=$(this).attr("data-id");
			var studentInActiveId=$(this).attr("data");


			$.ajax({
				type: "POST",
				dataType: "json",

				data: {studentActiveId: studentActiveId, studentInActiveId: studentInActiveId},
				url: '<?php echo base_url()?>UserController/studentActiveInactive',
				success: function (dataa) {
					alert(dataa['data']);
				},
				error:function (dataa) {
					// alert(dataa['data']);
				}
			});


		});

	});
</script>
