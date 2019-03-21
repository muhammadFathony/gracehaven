<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">List Class Room &nbsp; <button type="button" class="btn btn-info btn-rounded waves-effect waves-light m-b-5" data-toggle="modal" data-target="#add_classroom"><span class="fa fa-plus"></span></button></h3>
			</div>
			<div class="validate alert alert-warning alert-dismissable" style="display:none">
                
            </div>
			
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table id="tb_list" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Class Room</th>
                                        <th>First Name</th>
                                        <th>Inspector</th>
										<th>Used</th>
                                       	<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="show" name="show_user">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End row -->
<!-- modal add -->
<div id="add_classroom" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
				<h4 class="modal-title">Add Dialy</h4> 
			</div> 
			<div class="modal-body">
			<form id="" enctype="multipart/form-data" name="form_edit_user" method="post" action="">
			<input type="hidden" name="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />
				 
				<div class="row"> 
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Class / Room</label>
							<div class="input-group">
							<div class=""><input id="class_room" name="class_room" type="text" class="form-control reset"/>
							</div>
							<span class="input-group-btn">
							<button type="button" class="btn waves-effect waves-light btn-primary">
							<i class="glyphicon glyphicon-time"></i></button></span>
							</div> 
						</div> 
					</div>
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Firstname</label>
							<div class="input-group">
							<div class=""><input id="id_user" readonly="" value="<?php echo $id_user ?>" name="id_user" type="hidden" class="form-control"/>
							<input id="firstname" readonly="" value="<?php echo $firstname ?>" name="firstname" type="text" class="form-control"/></div>
							<span class="input-group-btn">
							<button type="button" class="btn waves-effect waves-light btn-primary">
							<i class="glyphicon glyphicon-time"></i></button></span>
							</div> 
						</div> 
					</div>
					<!-- <div class="row col-md-6"> 
						<div class="col-md-12"> 
							<div class="form-group"> 
								<label for="field-1" class="control-label">Control</label> 
								<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<select name="control" id="control" class="form-control">
									<?php foreach ($control as $key ) {?>
										<option value="<?= $key->id_control?>"><?= $key->control ?></option>
									<?php } ?>	
								</select>
								</div>
							</div> 
						</div> 
					</div>   -->
				</div>
			</form> 
			</div> 
			<div class="modal-footer"> 
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
				<button type="button" class="btn btn-info waves-effect waves-light" id="btn_save">Save </button> 
			</div> 
		</div> 
	</div>
</div><!-- /.modal -->
<!-- edit -->
<!-- modal add -->
<div id="edit_classroom" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
				<h4 class="modal-title">Add Dialy</h4> 
			</div> 
			<div class="modal-body">
			<form id="form_edit" enctype="multipart/form-data" name="form_edit_user" method="post" action="">
			<input type="hidden" name="id_location" id="id_location" />	
			<input type="hidden" name="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />		 
				<div class="row"> 
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Class / Room</label>
							<div class="input-group">
							<div class=""><input id="edit_class_room" name="edit_class_room" type="text" class="form-control reset"/>
							</div>
							<span class="input-group-btn">
							<button type="button" class="btn waves-effect waves-light btn-primary">
							<i class="glyphicon glyphicon-time"></i></button></span>
							</div> 
						</div> 
					</div>
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Firstname</label>
							<div class="input-group">
							<div class=""><input id="edit_firstname" name="edit_firstname" type="text" class="form-control "/></div>
							<span class="input-group-btn">
							<button type="button" class="btn waves-effect waves-light btn-primary">
							<i class="glyphicon glyphicon-time"></i></button></span>
							</div> 
						</div> 
					</div>
					<div class="row col-md-6"> 
						<div class="col-md-12"> 
							<div class="form-group"> 
								<label for="field-1" class="control-label">Control</label> 
								<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<select name="edit_control" id="edit_control" class="form-control">
									<?php foreach ($control as $key ) {?>
										<option value="<?= $key->id_control?>"><?= $key->control ?></option>
									<?php } ?>	
								</select>
								</div>
							</div> 
						</div> 
					</div>
					<div class="row col-md-12"> 
						<div class="col-md-4"> 
							<label for="field-1" class="control-label">QR Code</label> 
							<div class="form-group" id="img-pup"> 
								<img src="" alt="" class="gal-detail thumb" id="preview">
							</div> 
						</div> 
					</div>     
				</div>
			</form> 
			</div> 
			<div class="modal-footer"> 
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
				<button type="button" class="btn btn-info waves-effect waves-light" id="btn_update">Save </button> 
			</div> 
		</div> 
	</div>
</div><!-- /.modal -->

<script src="<?php echo base_url()?>assets/Dashboard/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	const url_abs = '<?php echo base_url()?>';
	list();
	$('#tb_list').dataTable();
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
	function list(){
		var csrf_test_name = $('[name="csrf_test_name"]').val();
		$.ajax({
			url : "<?= base_url('conten/Movement_tracking/list_place') ?>",
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
								'<td>'+data[index].class_room+'</td>'+
								'<td>'+data[index].firstname+'</td>'+
								'<td>'+data[index].control+'</td>'+
								'<td>'+data[index].last_time+'</td>'+
								'<td>'+
								'<a href="javascript:void(0);" class="md-trigger on-default btn-sm edit"'+
								'data-id_location="'+data[index].id_location+'" data-class_room="'+data[index].class_room+'"'+ 
								'data-firstname="'+data[index].firstname+'" data-last_time="'+data[index].last_time+'"'+
								'data-id_control="'+data[index].id_control+'" data-qrroom="'+data[index].qrroom+'">'+
								'<i class="md md-border-color"></i></a>'+ 
								'<a href="javascript:void(0);" class="md-trigger on-default btn-sm delete"'+
								'data-id_location="'+data[index].id_location+'">'+
								'<i class="md md-clear"></i></a>'+
								'</td>'+
							'</tr>;'
				}
				$("#show").html(html);
			}
		})
	}
	$('#btn_save').on('click', function(event) {
		var str = $('#class_room').val();
		var data = { 'class_room' : str,
					 'id_user' : $('#id_user').val(),
					 'csrf_test_name' : $('[name="csrf_test_name"]').val()
					}
		if (str.match(' ')) {
		    $.Notification.notify('info','top left','Failed Input','Field must be string');
		} else {
					
		$.ajax({
			url: url_abs+'conten/Movement_tracking/add_place',
			type: 'POST',
			dataType: 'JSON',
			cache:false,
			data: data,
			success : function(data){
				if ($.isEmptyObject(data.eror)) {
					list();
					$('.reset').val("");
					$('#add_classroom').modal('hide');
					swal("Addedd!", "Your data has been add.", "success");
					$(".validate").css('display', 'none');
					$('#add_classroom').modal('hide');
				} else {
					$('#add_classroom').modal('hide');
					$(".validate").css('display', 'block');
					$(".validate").html(data.eror);
				}
			}
		})
	}
	});

	$("#show").on('click', '.edit', function(){
		var id_location = $(this).data('id_location');
		var class_room = $(this).data('class_room');
		var firstname = $(this).data('firstname');
		var id_control = $(this).data('id_control');
		var qrroom = $(this).data('qrroom')
		alert(qrroom);
		$('#id_location').val(id_location);
		$('#edit_class_room').val(class_room);
		$('#edit_firstname').val(firstname);
		$('#edit_control').val(id_control);
		$("#img-pup").html("<img id='preview' src=" + "../assets/images/qrcode/" + qrroom +" style='width: auto;height: 100px'/>");
		$('#edit_classroom').modal('show');
	})

	$("#btn_update").on('click', function(){
		var form = document.forms.namedItem("form_edit");
		$.ajax({
			url : url_abs+'conten/Movement_tracking/update_place',
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
					$("#edit_classroom").modal('hide');
					list();
				} else {
					$("#edit_classroom").modal('hide');
					$(".validate").css('display', 'block');
					$(".validate").html(data.eror);
				}
			}

		})
	})

	$("#show").on('click', '.delete' , function(){
		var id_location = $(this).data('id_location');
		var csrf_test_name = $('[name="csrf_test_name"]').val();
		console.log(id_location);
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
					data : {id_location : id_location,
							csrf_test_name : csrf_test_name
							},
					type : "post",
					url : url_abs+'conten/Movement_tracking/delete_place',
					crossOrigin : false,
					dataType : 'JSON',
					success : function(data){
						list();
						csrf_test_name = data.csrf_test_name;
						swal("Deleted!", "Your data has been deleted.", "success"); 
					}
				})
				
		});
	})

});
</script>	
