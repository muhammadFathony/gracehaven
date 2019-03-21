<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">List Student</h3>
			</div>
			<div class="validate alert alert-warning alert-dismissable" style="display:none">
                
            </div>
			
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table id="tb_listuser" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
										<th>Date Of Birth</th>
										<th>Class</th>
                                       	<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="show_user" name="show_user">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End row -->
<!-- editfull -->
<div id="edit_student" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="full-width-modalLabel">Modal Heading</h4>
            </div>
            <div class="modal-body">
             	<form id="form_edit" enctype="multipart/form-data" name="form_edit" method="post" action="">
				<input type="hidden" name="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />
				<input type="hidden" name="id_student" id="id_student" />
					<div class="row col-md-12">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="nis" id="nis" placeholder="NIS" class="form-control">
							</div>
						</div>
					</div>
					<div class="row col-md-6"> 
						<div class="col-md-12"> 
							<div class="form-group"> 
								<label for="field-1" class="control-label">First Name</label> 
								<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"> 
								</div>
								
							</div> 
						</div> 
					</div> 
					<div class="row col-md-6"> 
						<div class="col-md-12"> 
							<div class="form-group"> 
								<label for="field-3" class="control-label">Last Name</label> 
								<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"> 
								</div>
								
							</div> 
						</div> 
					</div>
					<div class="row"> 
						<div class="col-md-12">
							<div class="col-md-4"> 
								<div class="form-group"> 
									<label for="field-3" class="control-label">Date Of Birth</label>
									<div class="input-group">
									<input type="text" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date Of Birth"> 
									<span class="input-group-btn">
									<button type="button" class="btn waves-effect waves-light btn-primary">
									<i class="fa fa-envelope-o"></i></button></span>
									</div> 
								</div> 
							</div> 
							<div class="col-md-4"> 
								<div class="form-group"> 
									<label for="field-3" class="control-label">Class</label>
									<div class="input-group">
									<select name="id_class" id="id_class" class="required form-control">
										<option></option>
										<?php foreach ($class as $key ) {?>
										<option value="<?= $key->id_class ?>"><?= $key->class ?> </option>
										<?php } ?>
									</select>
									<span class="input-group-btn">
									<button type="button" class="btn waves-effect waves-light btn-primary">
									<i class="fa fa-envelope-o"></i></button></span>
									</div> 
								</div> 
							</div> 
						</div>
					</div>
					<div class="row"> 
						<div class="col-md-12">
							<div class="col-md-6">
						 		<div class="form-group"> 
								<label for="field-3" class="control-label">Address</label>
								<div class="">
									<textarea class="form-control" id="address" name="address"></textarea>
								</div> 
							</div> 
						 	</div> 
						</div> 
					</div>
					<div class="row">
					  	<div class="col-md-12">
					  		<div class="col-md-4">
					  			<div class="form-group"> 
									<label for="field-3" class="control-label">Image</label>
									<div class="input-group">
										<input type="file" class="form-control" id="image" name="image" placeholder="Image"> 
										<span class="input-group-btn">
										<button type="button" class="btn waves-effect waves-light btn-primary">
										<i class="fa fa-envelope-o"></i></button></span>
									</div> 
								</div>
					  		</div>
					  		<div class="col-md-4">
					  			<div class="form-group"> 
									<div class="input-group" id="img-pup">
										<img id="preview" src="<?= base_url()?>assets/images/back1.jpg" alt="" style="width: auto;height: 100px">
									</div> 
								</div>
					  		</div>
					  	</div>
					</div>  
				</form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="btn_update">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo base_url()?>assets/Dashboard/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	list_student();
	$('#tb_listuser').dataTable();
	jQuery('#date_of_birth').datepicker({
				format: 'dd-mm-yyyy'
	});
	
	function read_img(){
		$('#image').change(function(evt) {

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
	// ROOT USER
	function list_student(){
		var csrf_test_name = $('[name="csrf_test_name"]').val();
		$.ajax({
			url : "<?= base_url('conten/User/list_student') ?>",
			type : "ajax",
			async : false,
			data : { csrf_test_name : csrf_test_name }, 
			dataType : "json",
			success : function(data){
				csrf_test_name = data.csrf_test_name;
				var html = '';
				var index;
				var user = 1;
				for (let index = 0; index < data.length; index++, user++) {
					html += '<tr>'+
								'<td>'+user+'</td>'+
								'<td>'+data[index].nis+'</td>'+
								'<td>'+data[index].firstname+'</td>'+
								'<td>'+data[index].lastname+'</td>'+
								'<td>'+data[index].date_of_birth+'</td>'+
								'<td>'+data[index].class+'</td>'+
								'<td>'+
								'<a href="javascript:void(0);" class="md-trigger on-default btn-sm edit_user"'+
								'data-nis="'+data[index].nis+'" data-firstname="'+data[index].firstname+'"'+ 
								'data-lastname="'+data[index].lastname+'" data-date_of_birth="'+data[index].date_of_birth+'"'+
								'data-id_class="'+data[index].id_class+'" data-address="'+data[index].address+'" data-id_student="'+data[index].id_student+'" data-image="'+data[index].image+'">'+
								'<i class="md md-border-color"></i></a>'+ 
								'<a href="javascript:void(0);" class="md-trigger on-default btn-sm delete"'+
								'data-id_student="'+data[index].id_student+'">'+
								'<i class="md md-clear"></i></a>'+
								'</td>'+
							'</tr>;'
				}
				$("#show_user").html(html);
			}
		})
	}

	$("#show_user").on('click', '.edit_user', function(){
		var id_student = $(this).data('id_student');
		var nis = $(this).data('nis');
		var firstname = $(this).data('firstname');
		var lastname = $(this).data('lastname');
		var date_of_birth = $(this).data('date_of_birth');
		var id_class = $(this).data('id_class');
		var address = $(this).data('address');	
		var image = $(this).data('image');
		
		$("#edit_student").modal('show');
		$("#id_student").val(id_student);
		$("#nis").val(nis);
		$("#firstname").val(firstname);
		$("#lastname").val(lastname);
		$("#date_of_birth").val(date_of_birth);
		$("#id_class").val(id_class);
		$("#address").val(address);
		read_img();
		$("#img-pup").html("<img id='preview' src=" + "../../assets/images/student/" + image +" style='width: auto;height: 100px'/>"); //dan ini bisa juga
		
	})

	$("#btn_update").on('click', function(){
		var form = document.forms.namedItem("form_edit");
		$.ajax({
			url : "<?= base_url('conten/User/update_student') ?>",
			type : "post",
			data : new FormData(form),
			processData:false,
			contentType:false,
			cache:false,
			dataType : "json",
			success : function(data){
				//var url = window.location.href;
				//window.history.pushState("", "", url+"/data.url+data?");
				if($.isEmptyObject(data.eror)){
					$.Notification.notify('success','top left',
					'Success Message',
					'Update Succeed.')
					$(".validate").css('display', 'none');
					$("#edit_student").modal('hide');
					list_student();
				} else {
					$("#edit_student").modal('hide');
					$(".validate").css('display', 'block');
					$(".validate").html(data.eror);
				}
			}

		})
	})

	$("#show_user").on('click', '.delete' , function(){
		var id_student = $(this).data('id_student');
		var csrf_test_name = $('[name="csrf_test_name"]').val();
		console.log(id_student);
		swal({   
		title: "Are you sure?",   
		text: "You will delete this data!",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, delete it!",   
		closeOnConfirm: false 
		}, function(){  
			
				$.ajax({
					data : {id_student : id_student,
							csrf_test_name : csrf_test_name
							},
					type : "post",
					url : "<?= base_url('conten/User/delete_student')?>",
					crossOrigin : false,
					dataType : 'JSON',
					success : function(data){
						list_student();
						csrf_test_name = data.csrf_test_name;
						swal("Deleted!", "Your data has been deleted.", "success"); 
					}
				})
				
		});
	})

});
</script>	
