<style>
	.required{color:red}

</style>


<form method="POST" action="<?php echo  base_url('product-color-update')?>" enctype="multipart/form-data">
	<div class="box-body">
		<div class="row">
			<div class="col-sm-6">
				<div class="box box-primary">
					<div class="box-header">

						<h3 class="box-title"><?php if (isset($title)) echo $title ?></h3><br/>
						<?php $message=$this->session->userdata('message');
						if(isset($message)){
							echo "<span style='color :blue;font-size:20px'>$message</span>";
							$this->session->unset_userdata('message');

						}?>

					</div>
					<div class="form-group">

						<label for="product_title" class="col-md-offset-1 col-md-6">product color<span class="required">*</span></label>
						<div class="col-md-offset-1 col-md-6">
						<input required type="text" class="  form-control " name="product_color_name" id="product_title" placeholder="enter product size" value="<?php echo $color->product_color_name;?>">
							<input required type="hidden"     name="product_color_id"  value="<?php echo $color->product_color_id;?>">
					</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-success pull-right">Update</button>
						</div>
					</div>

				</div>
			</div>

			<div class="col-sm-6">
				<div class="box box-primary">
					<div class="box-header">

						<h3 class="box-title">product size list</h3><br/>

					</div>

					<table id="dataTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="dataTable_info">

						<thead>
						<tr>
							<th>no</th>
							<th> Name</th>

							<th>Action</th>
						</tr>
						</thead>
						<tbody>

						<?php
						$i=0;
						$result= $this->db->query("SELECT * FROM `product_color` ORDER BY `product_color`.`product_color_id` DESC")->result();
						foreach($result as $row){
							$i++;
							?>

							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row->product_color_name;?></td>
								<td><a href="<?php echo base_url()?>product-color-edit/<?php echo $row->product_color_id;?>">edit</a></td>


							</tr>
						<?php }?>
						</tbody>

					</table>
				</div>


			</div>
		</div>



	</div>

</form>

