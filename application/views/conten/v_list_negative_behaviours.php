<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">List Negative Behaviours &nbsp; <button type="button" class="btn btn-info btn-rounded waves-effect waves-light m-b-5" data-toggle="modal" data-target="#add"><span class="fa fa-plus"></span></button></h3>
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
                                        <th>Negative Behaviours</th>
                                        <th>Level</th>
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
<div id="add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
				<h4 class="modal-title">Add Negative Behaviours</h4> 
			</div> 
			<div class="modal-body">
			<form id="form_add" enctype="multipart/form-data" name="form_add" method="post">
			<input type="hidden" name="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />
				 
				<div class="row"> 
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Name of negative behaviours</label>
							<div class="input-group">
							<div class=""><input id="negativebehaviours" name="negativebehaviours" type="text" placeholder="Negative Behaviours" class="form-control reset"/>
							</div>
							<span class="input-group-btn">
							<button type="button" class="btn waves-effect waves-light btn-primary">
							<i class="glyphicon glyphicon-time"></i></button></span>
							</div> 
						</div> 
					</div>
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Level</label>
							<div class="input-group">
							<select name="level" id="level" class="form-control">
								<option ></option>
								<?php foreach ($level as $key ) {?>
								<option value="<?php echo $key->id_level ?>"><?php echo $key->level?></option>
								<?php } ?> 
							</select>
							<span class="input-group-btn">
							<button type="button" class="btn waves-effect waves-light btn-primary">
							<i class="glyphicon glyphicon-time"></i></button></span>
							</div> 
						</div> 
					</div>
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
<!-- modal-->
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
				<h4 class="modal-title">Add Dialy</h4> 
			</div> 
			<div class="modal-body">
			<form id="form_edit" enctype="multipart/form-data" name="form_edit" method="post" >
			<input type="hidden" name="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />
				 
				<div class="row"> 
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Name of negative behaviours</label>
							<div class="input-group">
							<div class=""><input id="edit_negativebehaviours" name="edit_negativebehaviours" type="text" placeholder="Negative Behaviours" class="form-control reset"/>
							<input id="nomer" name="nomer" type="hidden" placeholder="Negative Behaviours" class="form-control reset"/>	
							</div>
							<span class="input-group-btn">
							<button type="button" class="btn waves-effect waves-light btn-primary">
							<i class="glyphicon glyphicon-time"></i></button></span>
							</div> 
						</div> 
					</div>
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Level</label>
							<div class="input-group">
							<select name="edit_level" id="edit_level" class="form-control">
								<option ></option>
								<?php foreach ($level as $key ) {?>
								<option value="<?php echo $key->id_level ?>"><?php echo $key->level?></option>
								<?php } ?> 
							</select>
							<span class="input-group-btn">
							<button type="button" class="btn waves-effect waves-light btn-primary">
							<i class="glyphicon glyphicon-time"></i></button></span>
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
	
	// ROOT USER
	function list(){
		var csrf_test_name = $('[name="csrf_test_name"]').val();
		$.ajax({
			url : "<?= base_url('conten/Incidents/List_negative_behaviours') ?>",
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
								'<td>'+data[index].negativebehaviours+'</td>'+
								'<td>'+data[index].level+'</td>'+
								'<td>'+
								'<a href="javascript:void(0);" class="md-trigger on-default btn-sm edit"'+
								'data-nomer="'+data[index].nomer+'" data-negativebehaviours="'+data[index].negativebehaviours+'" data-id_level="'+data[index].id_level+'">'+
								'<i class="md md-border-color"></i></a>'+
								'<a href="javascript:void(0);" class="md-trigger on-default btn-sm delete"'+
								'data-nomer="'+data[index].nomer+'">'+
								'<i class="md md-clear"></i></a>'+
								'</td>'+
							'</tr>;'
				}
				$("#show").html(html);
			}
		})
	}
	$('#btn_save').on('click', function(event) {
		var str = $('#negativebehaviours').val();
		var data = { 'negativebehaviours' : str,
					 'level' : $('#level').val(),
					 'csrf_test_name' : $('[name="csrf_test_name"]').val()
					}
		$.ajax({
			url: url_abs+'conten/Incidents/add_negative_behaviours',
			type: 'POST',
			dataType: 'JSON',
			cache:false,
			data: data,
			success : function(data){
				if ($.isEmptyObject(data.eror)) {
					list();
					$('.reset').val("");
					$('#add').modal('hide');
					swal("Addedd!", "Your data has been add.", "success");
					$(".validate").css('display', 'none');
					$('#add').modal('hide');
				} else {
					$('#add').modal('hide');
					$(".validate").css('display', 'block');
					$(".validate").html(data.eror);
				}
			}
		})
	});

	$("#show").on('click', '.edit', function(){
		var nomer = $(this).data('nomer');
		var negativebehaviours = $(this).data('negativebehaviours');
		var id_level = $(this).data('id_level');

		$('#nomer').val(nomer);
		$('#edit_negativebehaviours').val(negativebehaviours);
		$('#edit_level').val(id_level);
		$('#edit').modal('show');
	})

	$("#btn_update").on('click', function(){
		var form = document.forms.namedItem("form_edit");
		$.ajax({
			url : url_abs+'conten/Incidents/update_negative_behaviours',
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
					$("#edit").modal('hide');
					list();
				} else {
					$("#edit").modal('hide');
					$(".validate").css('display', 'block');
					$(".validate").html(data.eror);
				}
			}

		})
	})

	$("#show").on('click', '.delete' , function(){
		var nomer = $(this).data('nomer');
		var csrf_test_name = $('[name="csrf_test_name"]').val();
		
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
					data : {nomer : nomer,
							csrf_test_name : csrf_test_name
							},
					type : "post",
					url : url_abs+'conten/Incidents/delete_negative_behaviours',
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
