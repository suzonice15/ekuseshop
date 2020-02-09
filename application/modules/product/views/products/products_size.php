<form method="POST" action="<?php echo  base_url('product-size-save')?>" enctype="multipart/form-data">
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

						<label for="product_title">product size<span class="required">*</span></label>
						<input required type="text" class="form-control the_title" name="product_size" id="product_title" placeholder="enter product size" value="">
						<div class="box-footer">
							<button type="submit" class="btn btn-success">Save</button>
						</div>
					</div>

				</div>
			</div>

			<div class="col-sm-6">
				<div class="box box-primary">
					<div class="box-header">

						<h3 class="box-title">product size list</h3><br/>

					</div>

					<table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="dataTable_info">

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
						$result= $this->db->query("SELECT * FROM `product_size` ORDER BY `product_size`.`product_size_id` DESC")->result();
						foreach($result as $row){
							$i++;
							?>

							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row->name;?></td>
								<td><a href="<?php echo base_url()?>product-size-edit/<?php echo $row->product_size_id;?>">edit</a></td>


							</tr>
						<?php }?>
						</tbody>

					</table>
				</div>


			</div>
		</div>



	</div>

</form>

