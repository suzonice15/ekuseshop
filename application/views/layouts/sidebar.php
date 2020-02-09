<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">

			</div>
			<div class="pull-left info">
				<p>

				</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

		<?php

		$userType=$this->session->userdata('user_type');


		?>

		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">

			<li class="">
				<a href="<?php echo base_url(); ?>dashboard">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>

				</a>

			</li>
			

			<?php

			if($userType =='super-admin' ||  $userType =='admin'  ){


				?>

				<li class="treeview">
					<a href="#">
						<i class="fa fa-dashboard"></i>
						<span>Users </span>
					<span class="pull-right-container">
			 <i class="fa fa-angle-left pull-right"></i>
			 </span>

					</a>
					<ul class="treeview-menu">
						<li><a href="<?php echo base_url(); ?>users">
								<i class="fa fa-arrow-circle-o-right"></i> Admin user </a>
						</li>
						<li><a href="<?php echo base_url(); ?>affiliate-user">
								<i class="fa fa-arrow-circle-o-right"></i> General user </a>
						</li>
					</ul>
				</li>
			<?php } ?>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-dashboard"></i>
					<span>Orders </span>
					<span class="pull-right-container">
			 <i class="fa fa-angle-left pull-right"></i>
			 </span>

				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url(); ?>order-create">
							<i class="fa fa-arrow-circle-o-right"></i> Add New </a>
					</li>
					<li ><a href="<?php echo base_url(); ?>order/OrderController/tryorder">
							<i class="fa fa-arrow-circle-o-right"></i> Try Orders </a>
					</li>
					<li><a href="<?php echo base_url(); ?>order-list">
							<i class="fa fa-arrow-circle-o-right"></i> Orders </a>
					</li>

					<li hidden><a href="<?php echo base_url(); ?>latest-order">
							<i class="fa fa-arrow-circle-o-right"></i> latest order </a>
					</li>
					<li hidden ><a href="<?php echo base_url(); ?>order-report">
							<i class="fa fa-arrow-circle-o-right"></i> Orders Report </a>
					</li>


				</ul>
			</li>

			<?php

			if($userType =='super-admin' ||  $userType =='admin'  ){


			?>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-dashboard"></i>
					<span>Products </span>
					<span class="pull-right-container">
			 <i class="fa fa-angle-left pull-right"></i>
			 </span>

				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url(); ?>product-create">
							<i class="fa fa-arrow-circle-o-right"></i> Add New </a>
					</li>
					<li><a href="<?php echo base_url(); ?>product-list">
							<i class="fa fa-arrow-circle-o-right"></i> Products </a>
					</li>

					<!--
					<li><a href="<?php echo base_url(); ?>product-limited">
							<i class="fa fa-arrow-circle-o-right"></i> Limited Stock Products </a>
					</li>
					<li><a href="<?php echo base_url(); ?>product-bad-stock?status=bad_stock">
							<i class="fa fa-arrow-circle-o-right"></i> Bad Stock Products </a>
					</li>
					<li><a href="<?php echo base_url(); ?>product-return?status=return_stock">
							<i class="fa fa-arrow-circle-o-right"></i> Return Products </a>
					</li>
					<li><a href="<?php echo base_url(); ?>product-demage?status=demurrage">
							<i class="fa fa-arrow-circle-o-right"></i> Demurrage Products </a>
					</li>
					-->
					<li><a href="<?php echo base_url(); ?>product-size">
							<i class="fa fa-arrow-circle-o-right"></i> Products Size </a>
					</li>
					<li><a href="<?php echo base_url(); ?>product-color">
							<i class="fa fa-arrow-circle-o-right"></i> Products Color </a>
					</li>


					<li><a href="<?php echo base_url(); ?>category-list">
							<i class="fa fa-arrow-circle-o-right"></i> Categories </a>
					</li>
				</ul>
			</li>
			<?php } ?>

				<li class="">
				<a href="<?php echo base_url(); ?>inquery-list">
					<i class="fa fa-dashboard"></i> <span>Inquery</span>
				</a>
			</li>

			<li class="">
				<a href="<?php echo base_url(); ?>review-list">
					<i class="fa fa-dashboard"></i> <span>Reviews</span>
				</a>
			</li>

			<?php

			if($userType =='super-admin' ||  $userType =='admin'  ){


			?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-dashboard"></i>
					<span>Media </span>
					<span class="pull-right-container">
			 <i class="fa fa-angle-left pull-right"></i>
			 </span>

				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url(); ?>media-list">
							<i class="fa fa-arrow-circle-o-right"></i> Media Files </a>
					</li>
					<li><a href="<?php echo base_url(); ?>slider-list">
							<i class="fa fa-arrow-circle-o-right"></i> Slider </a>
					</li>
					<li><a href="<?php echo base_url(); ?>add-list">
							<i class="fa fa-arrow-circle-o-right"></i> Ads </a>
					</li>
					<li><a href="<?php echo base_url(); ?>picture-delete">
							<i class="fa fa-arrow-circle-o-right"></i> Picture delete </a>
					</li>
				</ul>
			</li>

				<li class="treeview">
					<a href="#">
						<i class="fa fa-dashboard"></i>
						<span>Affiliate Program </span>
					<span class="pull-right-container">
			 <i class="fa fa-angle-left pull-right"></i>
			 </span>

					</a>
					<ul class="treeview-menu">
						<li><a href="<?php echo base_url(); ?>password-change">
								<i class="fa fa-arrow-circle-o-right"></i> Password change request </a>
						</li>
						<li><a href="<?php echo base_url(); ?>all-payment-request">
								<i class="fa fa-arrow-circle-o-right"></i> All Request </a>
						</li>
						<li><a href="<?php echo base_url(); ?>cookie-time-set">
								<i class="fa fa-arrow-circle-o-right"></i>Cookie Time Set </a>
						</li>
						li><a href="<?php echo base_url(); ?>product-delivered-list">
							<i class="fa fa-arrow-circle-o-right"></i>Product Delivered List</a></li>
						<li><a href="<?php echo base_url(); ?>bill-closing">
								<i class="fa fa-arrow-circle-o-right"></i>Bill Closing</a></li>
						<li><a href="<?php echo base_url(); ?>set-closing-date">
								<i class="fa fa-arrow-circle-o-right"></i>Set Closing Date</a>
						</li>
						    <li><a href="<?php echo base_url(); ?>affiliate-request">
                                <i class="fa fa-arrow-circle-o-right"></i>All Affiliate Request</a>
                        </li>


					</ul>
				</li>



			<li hidden class="treeview "><a href="#"> <i class="fa fa-wrench"></i> <span>Tools</span> <span
						class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
				<ul class="treeview-menu" >
					<li><a href="<?php echo base_url(); ?>courier-list"> <i class="fa fa-truck"></i>
							<span>Courier</span> </a></li>
					<li hidden ><a href="<?php echo base_url(); ?>expense-category-list"> <i class="fa fa-wrench"></i> <span>Expense Types</span>
						</a></li>

				</ul>
			</li>
			<li><a href="<?php echo base_url(); ?>page-list"> <i class="fa fa-wrench"></i> <span>Pages</span>
				</a></li>




			<li class="treeview ">
				<a href="#"> <i class="fa fa-wrench"></i> <span>Setting Options</span> <span
						class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url(); ?>setting-default"> <i class="fa fa-circle-o"></i> <span>Default Settings</span>
						</a></li>
					<li><a href="<?php echo base_url(); ?>setting-home"> <i class="fa fa-home"></i> <span>Home Page Settings</span>
						</a></li>
					<li hidden><a href="<?php echo base_url(); ?>setting-extra"> <i class="fa fa-circle-o"></i> <span>Extra Settings</span>
						</a></li>
					<li><a href="<?php echo base_url(); ?>setting-social"> <i class="fa fa-circle-o"></i>
							<span>Social Settings</span> </a></li>
					<li hidden ><a href="<?php echo base_url(); ?>setting-popup"> <i class="fa fa-circle-o"></i> <span>Popup Settings</span>
						</a></li>
					<li hidden ><a href="<?php echo base_url(); ?>setting-facebook"> <i class="fa fa-facebook-square"></i>
							<span>FaceBook Settings</span> </a></li>
				</ul>
			</li>

			<?php } ?>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
