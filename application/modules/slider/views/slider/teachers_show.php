
<div class="col-md-offset-1 col-md-10">

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $title; ?></h3>


	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-10">
				<table class="table ">
					<tbody>
					<tr>
						<td style="padding: 33px 15px;">Teacher picture</td>
						<td > <?php
							if (!empty($teacher->teacher_picture_path)>0) {
								?>
								<img width="80" height="80"  src="<?php echo base_url(); ?><?php echo $teacher->teacher_picture_path; ?>"/>
								<?php
							} else {
								?>
								<img width="80" height="80" src="<?php echo base_url(); ?>/uploads/teachers/teacher.png"/>
							<?php } ?>

						</td>
					</tr>

					<tr>
						<td>Teacher Name</td>
						<td> <?php echo $teacher->teacher_full_name; ?></td>
					</tr>
					<tr>
						<td>Teacher mobile</td>
						<td> <?php echo $teacher->teacher_contact_no; ?></td>
					</tr>
					<tr>
						<td>Teacher address</td>
						<td> <?php echo $teacher->teacher_address; ?></td>
					</tr>
					<tr>
						<td>Teacher's email</td>
						<td> <?php echo $teacher->teacher_email; ?></td>
					</tr>

					<tr>
						<td>
							Teacher nid
						</td>
						<td> <?php echo $teacher->teacher_nid; ?></td>
					</tr>
					<tr>
						<td>
							Job title
						</td>
						<td> <?php echo $teacher->designation_name; ?></td>
					</tr>
					<tr>
						<td>Gender </td>
						<td> <?php echo $teacher->teacher_sex; ?></td>
					</tr>
					<tr>
						<td>Blood Group </td>
						<td> <?php echo $teacher->teacher_blood_group; ?></td>
					</tr>
					<tr>
						<td>Religion </td>
						<td> <?php echo $teacher->teacher_religion; ?></td>
					</tr>

					<table id="qualification" class="table table-bordered ">
						<caption class="text-center bg-success">Educational Qualification</caption>
						<thead>
						<tr>
							<th>Class</th>
							<th>Passing Year</th>
							<th>Result </th>
							<th>Board</th>
						</tr>
						</thead>
						<tbody>
						<?php if(isset($qualifications)):foreach ($qualifications as $qualification):?>
							<tr>
								<td><?php echo $qualification->qualification_name;?></td>
								<td>
									<?php echo $qualification->qualification_year;?>


								</td>
								<td><?php echo $qualification->qualification_result;?></td>
								<td><?php echo $qualification->qualification_board;?></td>
							</tr>
						<?php endforeach;endif;?>
						</tbody>


					</table>


					<table id="qualification" class="table table-bordered ">
						<caption class="text-center bg-success">Training Information</caption>
						<thead>
						<tr>
							<th>Training Name</th>
							<th>Durations</th>
							<th>Starting date </th>
							<th>Ending date</th>
						</tr>
						</thead>
						<tbody>
						<?php if(isset($traininges)):foreach ($traininges as $traininge):?>

							<tr>
								<td><?php echo $traininge->teacher_training_name;?></td>
								<td><?php echo $traininge->teacher_training_duration;?></td>
								<td><?php echo $traininge->teacher_training_starting_date;?></td>
								<td><?php echo $traininge->teacher_training_endingdate;?></td>
							</tr>
						<?php endforeach;endif;?>

						</tbody>


					</table>


					<table id="qualification" class="table table-bordered ">
						<caption class="text-center bg-success">Training service provider</caption>
						<thead>
						<tr>
							<th>Venue Name</th>
							<th>Durations</th>
							<th>Starting date </th>
							<th>Ending date</th>
						</tr>
						</thead>
						<tbody>
						<?php if(isset($services)):foreach ($services as $service):?>

							<tr>
								<td><?php echo $service->trainging_service_name;?></td>
								<td><?php echo $service->trainging_service_duration;?></td>
								<td><?php echo $service->trainging_service_starting_date;?></td>
								<td><?php echo $service->trainging_service_ending_date;?></td>
							</tr>
						<?php endforeach;endif;?>

						</tbody>


					</table>


			</div>
		</div>
					<tr>
						<td colspan="2"><a class="btn btn-info pull-right" href="<?php echo base_url(); ?>teacher-list">Back</a> </td>

					</tr>

					</tbody>

				</table>
			</div>


		</div>
	</div>


</div>
</div>
