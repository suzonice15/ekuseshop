<?php $this->load->view('layouts/header'); ?>
<?php $this->load->view('layouts/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php if (isset($main)) echo $main; ?>
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
           <!-- <li><a href="#"> <?php if (isset($second)) echo $second; ?></a></li> -->
            <li class="active"><?php if (isset($active)) echo $active; ?></li>
        </ol>
<br/>

	<?php //$message = $this->session->userdata('message');
	$message = $this->session->flashdata('message');
	$error = $this->session->flashdata('error');
	$relationMessage=$this->session->userdata('relationMessage');


	if (isset($message)) {
		?>
	<div class="callout callout-success">
		<p>
			<i class="icon fa fa-check"></i>
			<?php
			echo $message;
					$this->session->unset_userdata('message');


					?>
		</p>
	</div>
		<?php
	}
	else if (isset($error)) {
		?>
	<div style="margin-bottom: -8px;" class="callout callout-danger">



		<p>
			<i class="icon fa fa-ban"></i>
		<?php

					echo $error;
					$this->session->unset_userdata('error');


					?>
		</p>
	</div>

		<?php
	}

	else if (isset($relationMessage)) {
		?>
	<div style="margin-bottom: -8px;" class="callout callout-success">



		<p>
			<i class="icon fa fa-check "></i>
					<?php

					echo $relationMessage;
					$this->session->unset_userdata('relationMessage');

					?>
		</p>
	</div>
		<?php
	} else {

		?>

		<div style="margin-bottom: -8px;" class="callout callout-success">


			<p>Welcome to Ekusheyshop

				</p>
		</div>

	<?php
	}
	?>
	</section>

    <!-- Main content -->

    <section class="content" style="height: auto">
		<div class="row">
        <?php if (isset($pageContent)) {
            echo $pageContent;
        } ?>
		</div>
    </section>

    <!-- /.content -->
</div>
<?php $this->load->view('layouts/footer'); ?>
