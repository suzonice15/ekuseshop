<div class="container container-fullwidth" style="margin-bottom: 50px">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li><a href="<?=base_url()?>">Home</a>/</li>
			<li class="active">Contact Us</li>
		</ul>

	</div>
</div>

<div class="container">
<div class="row text-center ">
<div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
	<nav class="text-center">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Contact Us</a>
			<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Email Us</a>
			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Call Us</a>
			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-location" role="tab" aria-controls="nav-contact" aria-selected="false">Location</a>
		</div>
	</nav>
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">


			<h1 class="mt-4">Ekushey Shop</h1>


			<h3>160 Muktobangla Shopping Complex (7th Floor)<br>
				Mirpur-1, Dhaka-1216, Bangladesh</h3>

		</div>
		<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

			<form method="post" id="inquery" action="<?php echo base_url()?>inquery-save">
				<div class="col-md-6 text-center">
					<br/>
					<h3 id="error" class="text-success"></h3>
				<div class="form-group">
					<div class="inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" class="form-control field-name" name="name" placeholder="Name*">
							<br>
						</div>
						<div class="input-group">

							<p id="name_error" class="text-danger"></p>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
							<input type="text" class="form-control field-phone" name="phone" placeholder="Phone*">
						</div>
						<div class="input-group">

							<p id="phone_error" class="text-danger"></p>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
							<input type="text" class="form-control field-subject" name="subject" placeholder="Subject*">
						</div>
						<div class="input-group">

							<p id="subject_error" class="text-danger"></p>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
							<textarea class="form-control field-message" id="message" name="message" placeholder="Message*"></textarea>
						</div>
						<div class="input-group">

							<p id="messaget_error" class="text-danger"></p>
						</div>
					</div>
				</div>
				<div class="form-group">
					<button type="button" id="submit_information" class="btn btn-primary form-control">Send <span class="glyphicon glyphicon-send"></span></button>
				</div>
				</div>
			</form>

		</div>

		<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

		<?php echo $page_content;?>


		</div>
		<div class="tab-pane fade" id="nav-location" role="tabpanel" aria-labelledby="nav-location-tab">

			<iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7301.150962101775!2d90.34543732504021!3d23.798126838263272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c1d452b5f22b%3A0x76a65b2cdb420617!2sekusheyshop.com!5e0!3m2!1sen!2sbd!4v1579498263210!5m2!1sen!2sbd" allowfullscreen="" width="1000" height="450" frameborder="0"></iframe>

		</div>
	</div>
</div>

</div>
</div>
<script>
	$('#submit_information').click(function () {
		var name=$('input[name=name]').val();
		var phone=$('input[name=phone]').val();
		var subject=$('input[name=subject]').val();
		var message=$('textarea[name=message]').val();


		if(name.length<3){
			$('#name_error').text('Enter Your Name');
		}  if(phone.length<11){
			$('#phone_error').text('Enter Your Phone Number');
		}  if(message.length<1) {

			$('#message_error').text('Enter Your Message');

		}
		if(subject.length<1) {

			$('#subject_error').text('Enter Your subject');

		}

		else {
			$.ajax({
				type: "POST",
				url:'<?php echo base_url()?>inquery/InqueryController/store',
		     	data:{name:name,phone:phone,subject:subject,message:message},
				success:function (data) {
				$('#error').text(data);
					var name=$('input[name=name]').val('');
					var phone=$('input[name=phone]').val('');
					var subject=$('input[name=subject]').val('');
					var message=$('textarea[name=message]').val('');



				}
		}
			);
		}

	});

</script>
