<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">User Root</h3>
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
                                        <th>First Name</th>
                                        <th>Last Name</th>
										<th>Email</th>
										<th>Control</th>
                                        <th>Create at</th>
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
<!-- modal edit -->
<div id="modal_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
				<h4 class="modal-title">Edit User</h4> 
			</div> 
			<div class="modal-body">
			<form id="form_edit_user" enctype="multipart/form-data" name="form_edit_user" method="post" action="">
			<input type="hidden" name="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />
			<input type="hidden" name="id" id="id" />
				<div class="row col-md-6"> 
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-1" class="control-label">First Name</label> 
							<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"> 
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
							<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"> 
							</div>
							
						</div> 
					</div> 
				</div>
				<div class="row"> 
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Email</label>
							<div class="input-group">
							<input type="email" class="form-control" id="email" name="email" placeholder="Email"> 
							<span class="input-group-btn">
							<button type="button" class="btn waves-effect waves-light btn-primary">
							<i class="fa fa-envelope-o"></i></button></span>
							</div> 
						</div> 
					</div> 
				</div>
				<div class="row"> 
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Password</label>
							<div class="input-group">
							<input type="password" class="form-control" id="password" name="password" placeholder="Password"> 
							<span class="input-group-addon">
							<i class="fa fa-cogs"></i></span>
							</div> 
						</div> 
					</div> 
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Repeat Password</label>
							<div class="input-group">
							<input type="password" class="form-control" id="repeat" name="repeat" placeholder="Repeat Password"> 
							<span class="input-group-addon">
							<i class="fa fa-cogs"></i></span>
							</div> 
						</div> 
					</div> 
				</div>
				<div class="row"> 
					<div class="col-md-6"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Control</label>
							<div class="input-group">
								<select name="control" id="control" class="form-control">
									<option></option>
								<?php foreach ($control as $key) { ?>
									<option value="<?= $key->id_control ?>"><?= $key->control ?> </option>
								<?php } ?>
								</select>
							<span class="input-group-btn">
							<button type="button" class="btn waves-effect waves-light btn-primary">
							<i class="fa fa-wrench"></i></button></span>
							</div> 
							
						</div> 
					</div> 
				</div>  
			</form> 
			</div> 
			<div class="modal-footer"> 
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
				<button type="submit" class="btn btn-info waves-effect waves-light" id="btn_update">Save changes</button> 
			</div> 
		</div> 
	</div>
</div><!-- /.modal -->
<!-- end of modal edit -->
<script src="<?php echo base_url()?>assets/Dashboard/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	list_user();
	$('#tb_listuser').dataTable();

	// ROOT USER
	function list_user(){
		var csrf_test_name = $('[name="csrf_test_name"]').val();
		$.ajax({
			url : "<?= base_url('conten/User/all_user') ?>",
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
								'<td>'+data[index].firstname+'</td>'+
								'<td>'+data[index].lastname+'</td>'+
								'<td>'+data[index].email+'</td>'+
								'<td>'+data[index].control+'</td>'+
								'<td>'+data[index].create_at+'</td>'+
								'<td>'+
								'<a href="javascript:void(0);" class="md-trigger on-default btn-sm edit_user"'+
								'data-id="'+data[index].id_user+'" data-firstname="'+data[index].firstname+'"'+ 
								'data-lastname="'+data[index].lastname+'" data-email="'+data[index].email+'"'+
								'data-control="'+data[index].control+'" data-id_control="'+data[index].id_control+'" data-password="'+data[index].password+'">'+
								'<i class="md md-border-color"></i></a>'+ 
								'<a href="javascript:void(0);" class="md-trigger on-default btn-sm delete"'+
								'data-id_user="'+data[index].id_user+'">'+
								'<i class="md md-clear"></i></a>'+
								'</td>'+
							'</tr>;'
				}
				$("#show_user").html(html);
			}
		})
	}

	$("#show_user").on('click', '.edit_user', function(){
		var id = $(this).data('id');
		var first_name = $(this).data('firstname');
		var last_name = $(this).data('lastname');
		var email = $(this).data('email');
		var id_control = $(this).data('id_control');	
		
		$("#modal_user").modal('show');
		$("#id").val(id);
		$("#first_name").val(first_name);
		$("#last_name").val(last_name);
		$("#email").val(email);
		$("#control").val(id_control);
	})

	$("#btn_update").on('click', function(){
		var data = {'id' : $("#id").val(),
					'first_name' : $("#first_name").val(),
					'last_name' : $("#last_name").val(),
					'email' : $("#email").val(),
					'control' : $("#control").val(),
					'password' : $("#password").val(),
					'repeat' : $("#repeat").val(),
					'csrf_test_name' : $('[name="csrf_test_name"]').val()
					};
		console.log(control);
	
		$.ajax({
			url : "<?= base_url('conten/User/edit_user') ?>",
			type : "post",
			data : data , 
			dataType : "json",
			success : function(data){
				if($.isEmptyObject(data.eror)){
					$.Notification.notify('success','top left',
					'Success Message',
					'Update Succeed.')
					$(".validate").css('display', 'none');
					$("#modal_user").modal('hide');
					list_user();
					//alert("1");
				} else {
					$("#modal_user").modal('hide');
					$(".validate").css('display', 'block');
					$(".validate").html(data.eror);
				}
			}

		})
	})

	$("#show_user").on('click', '.delete' , function(){
		var id_user = $(this).data('id_user');
		var csrf_test_name = $('[name="csrf_test_name"]').val();
		console.log(id_user);
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
					data : {id_user : id_user,
							csrf_test_name : csrf_test_name
							},
					type : "post",
					url : "<?= base_url('conten/User/delete_user')?>",
					crossOrigin : false,
					dataType : 'JSON',
					success : function(data){
						list_user();
						csrf_test_name = data.csrf_test_name;
						swal("Deleted!", "Your data has been deleted.", "success"); 
					}
				})
				
		});
	})

});
</script>	
