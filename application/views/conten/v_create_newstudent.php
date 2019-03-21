
<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<h4 class="pull-left page-title">Welcome !</h4>
		<ol class="breadcrumb pull-right">
			<li><a href="#">Moltran</a></li>
			<li class="active">User	</li>
		</ol>
	</div>
</div>

<?php 
$this->load->view('layout/Widget');
?>

<div class="row">
	<div class="col-lg-12">
		<div class="portlet"><!-- /portlet heading -->
			<div class="portlet-heading">
				<h3 class="portlet-title text-dark text-uppercase">
					Create New Student
				</h3>
				<div class="portlet-widgets">
					<a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
					<span class="divider"></span>
					<a data-toggle="collapse" data-parent="#accordion1" href="#portlet1"><i class="ion-minus-round"></i></a>
					<span class="divider"></span>
					<a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div id="portlet1" class="panel-collapse collapse in">
				<div class="portlet-body">
					<div class="row">
						<!-- form wizard -->
						<div class="panel-body"> 
				<form id="form_new" enctype="multipart/form-data" name="form_new" method="post">
				
					<div>
						<h3>Step 1</h3>
						<section>

							<div class="form-group clearfix">
								<label class="col-lg-2 control-label " for="confirm2"><i class="fa fa-user"></i> NIS *</label>
								<div class="col-lg-10">
									<input type="text" class="required form-control" value="<?= $getcode ?>" id="nis" name="nis" placeholder="NIS" readonly> 
								</div>
							</div>
							<div class="form-group clearfix">
								<label class="col-lg-2 control-label " for="userName2"><i class="fa fa-user"></i> First Name *</label>
								<div class="col-lg-10">
									<input type="hidden" name="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />
									<input class="required form-control" id="first_name" name="first_name" placeholder="First Name" type="text">
								</div>
							</div>
							<div class="form-group clearfix">
								<label class="col-lg-2 control-label " for="password2"><i class="fa fa-user"></i> Last Name *</label>
								<div class="col-lg-10">
									<input type="text" class="required form-control" id="last_name" name="last_name" placeholder="Last Name"> 
								</div>
							</div>

							<div class="form-group clearfix"></div>
						</section>
						<h3>Step 2</h3>
						<section>

							<div class="form-group clearfix">
								<label class="col-lg-2 control-label" for="file"> Class *</label>
								<div class="row"> 
									<div class="col-md-6"> 
										<div class="form-group"> 
											<div class="input-group">
												<select name="kelas" id="kelas" class="required form-control">
													<option></option>
													<?php foreach ($class as $key ) {?>
													<option value="<?= $key->id_class ?>"><?= $key->class ?> </option>
													<?php } ?>
												</select>
											<span class="input-group-btn">
											<button type="button" class="btn waves-effect waves-light btn-primary">
											<i class="fa fa-wrench"></i></button></span>
											</div> 
											
										</div> 
									</div> 
								</div>  
							</div>
							
							<div class="form-group clearfix">
								<label class="col-lg-2 control-label " for="confirm2"> Date of Birth *</label>
								<div class="col-lg-10">
									<input name="date_of_birth" id="date_of_birth" type="text" class="required form-control">
								</div>
							</div>
							<div class="form-group clearfix">
								<label class="col-lg-2 control-label " for="confirm2"> Address *</label>
								<div class="col-lg-10">
									<textarea class="required form-control" id="address" name="address" ></textarea>
								</div>
							</div>
							<div class="form-group clearfix"></div>

						</section>
						<h3>Step 3</h3>
						<section>
							<div class="form-group clearfix">
								<div class="col-lg-12">
									<div class="form-group clearfix">
										<label class="col-lg-2 control-label " for="password2"><i class="fa fa-user"></i> Select Image *</label>
										<div class="col-lg-10">
											<input type="file" class="required form-control" id="img_file" name="img_file" placeholder="Last Name"> 
										</div>
									</div>
									<ul class="list-unstyled w-list" id="step13">
										<div id="step32" class="form-group">
											<div class="col-lg-6">
												<img id="preview" src="<?= base_url()?>assets/images/back1.jpg" alt="" style="width: auto;height: 200px">
											</div>
										</div>
										<li id="step3"></li>
										
									</ul>
								</div>
							</div>
						</section>
						<h3>Step Final</h3>
						<section>
							<div class="form-group clearfix">
								<div class="col-lg-12">
									<input id="acceptTerms-2" name="acceptTerms2" type="checkbox" class="required">
									<label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
								</div>
							</div>
							
						</section>
					</div>
				</form>
			</div>  <!-- End panel-body -->
		<!-- end form wizard -->
					</div>
				</div>
			</div>
		</div> <!-- /Portlet -->
	</div> <!-- end col -->
</div> <!-- End row -->
<script src="<?php echo base_url()?>assets/Dashboard/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	//STUDENT
	var form = $("#form_new");

	function read_img(){
		$('#img_file').change(function(evt) {

        var files = evt.target.files;
        var file = files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

	}	

	form.validate({
		errorPlacement: function errorPlacement(error, element) {
			element.after(error);
		}
	});
	form.children("div").steps({
		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "slideLeft",
		onStepChanging: function (event, currentIndex, newIndex) {
			jQuery('#date_of_birth').datepicker({
				format: 'dd-mm-yyyy'
			});

			var first_name = document.getElementById('first_name').value ;
			var last_name = document.getElementById('last_name').value ;
			var nis = document.getElementById('nis').value ;

			var data = [ first_name, last_name, nis ];
			var html = '';
				html += '<li>'+'<i class="fa fa-envelope"> NIS : </i>'+' '+ nis + '</li>' +
						'<li>'+'<i class="fa fa-user"> First Name : </i>'+' '+ first_name + '</li>' +
						'<li>'+'<i class="fa fa-user"> Last Name : </i>'+' '+ last_name + '</li>' ;			
			document.getElementById("step3").innerHTML = html;

			read_img();
			
			console.log(data);

			form.validate().settings.ignore = ":disabled,:hidden";
			return form.valid();
			
		},
		onFinishing: function (event, currentIndex) {
			form.validate().settings.ignore = ":disabled";
			return form.valid();
		},
		onFinished: function (event, currentIndex) {
			var form_image = document.forms.namedItem("form_new");
			$.ajax({
					 data : new FormData(form_image),
					 processData:false,
					 contentType:false,
					 cache:false,
					 async:true,
					 type : "POST",
					 crossOrigin : true,
					 url : "<?= base_url('conten/User/add_new_student')?>",
					 dataType : "JSON",
					 success : function(data){
						 if (data.data_already) {
							swal('Data Student has been created. Refresh Page','','warning');
						 } else {
							$.Notification.notify('success', 'top right', 'Sample Notification',
						 	'Data has been saved, Thanks ..');
						 }
					 }, error(data) {
					 	swal('Something Error','','warning');
					 }
			})
		}
	});
});
</script>
