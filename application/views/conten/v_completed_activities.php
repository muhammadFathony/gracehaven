<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Completed Activities Student&nbsp;  </h3>

			</div>
			<div class="validate alert alert-warning alert-dismissable" style="display:none">
                
            </div>
			
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table id="tb_dialy" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <?php if ($this->session->userdata('id_control')=='1') {?>
                                        <th>Name</th>
                                    	<?php } ?>
                                        <th>Day</th>
                                        <th>Schedule</th>
										<th>Time</th>
										<th>Finish</th>
										<th>Class</th>
										<th>Date</th>
										<?php if ($this->session->userdata('id_control')=='1') { ?>
                                       	<th>Action</th>
                                       	<?php } ?>
                                    </tr>
                                </thead>
                                <tbody id="show" name="show">
                                    
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
<div id="modal_dialy" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
				<h4 class="modal-title">Edit Dialy</h4> 
			</div> 
			<div class="modal-body">
			<form id="form_edit" enctype="multipart/form-data" name="form_edit_user" method="post" action="">
			<input type="hidden" name="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />
			<input type="hidden" name="id" id="id" />
				<div class="row col-md-6"> 
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-1" class="control-label">Day</label> 
							<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<select name="id_day" id="id_day" class="form-control">
								<?php foreach ($day as $key ) {?>
									<option value="<?= $key->id_day?>"><?= $key->name_day ?></option>
								<?php } ?>	
							</select>
							</div>
							
						</div> 
					</div> 
					
				</div> 
				<div class="row col-md-6"> 
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Schedule</label> 
							<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" class="form-control reset" id="schedule_name" name="schedule_name" placeholder="Schedule"> 
							<input type="hidden" class="form-control" id="id_schedule" name="id_schedule" placeholder="Schedule"> 
							<input type="hidden" class="form-control" id="all_time" name="all_time" placeholder="Schedule"> 
							</div>
							
						</div> 
					</div> 
				</div>
				<div class="row"> 
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Time</label>
							<div class="input-group">
							<div class="bootstrap-timepicker"><input id="schedule_time" name="schedule_time" type="text" class="form-control reset"/></div>
							<span class="input-group-btn">
							<button type="button" class="btn waves-effect waves-light btn-primary">
							<i class="glyphicon glyphicon-time"></i></button></span>
							</div> 
						</div> 
					</div>
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-3" class="control-label">Finish</label>
							<div class="input-group">
							<input type="hidden" name="all_finish" id="all_finish">
							<div class="bootstrap-timepicker"><input id="schedule_finish" name="schedule_finish" type="text" class="form-control reset"/></div>
							<span class="input-group-btn">
							<button type="button" class="btn waves-effect waves-light btn-primary">
							<i class="glyphicon glyphicon-time"></i></button></span>
							</div> 
						</div> 
					</div>
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-1" class="control-label">Class</label> 
							<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<select name="id_classedit" id="id_classedit" class="form-control">
								<?php foreach ($class as $key ) {?>
									<option value="<?= $key->id_class?>"><?= $key->class ?></option>
								<?php } ?>	
							</select>
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
	list();
	$('#tb_dialy').dataTable();
	 jQuery('#schedule_time').timepicker({showMeridian: false});
	 jQuery('#schedule_finish').timepicker({showMeridian: false});
	 jQuery('#schedule_time1').timepicker({showMeridian: false});
	 jQuery('#schedule_finish1').timepicker({showMeridian: false});
	// ROOT USER
	var a = new Date();
	var b = a.getDate();
	var c = a.getMonth()+1;
	var d = a.getFullYear();
	var totaldate = d+'-'+c+'-'+b;
	function list(){
		var csrf_test_name = $('[name="csrf_test_name"]').val();
		$.ajax({
			url : "<?= base_url('student/Dailystudent/completed_activities') ?>",
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
								<?php if ($this->session->userdata('id_control')=='1') {?>
								'<td>'+data[index].firstname+'</td>'
								+ <?php } ?> 
								'<td>'+data[index].name_day+'</td>'+
								'<td>'+data[index].schedule_name+'</td>'+
								'<td>'+data[index].schedule_time.substring(22,11)+'</td>'+
								'<td>'+data[index].schedule_finish.substring(22,11)+'</td>'+
								'<td>'+data[index].class+'</td>' +
								'<td>'+data[index].date+'</td>' +
								<?php if ($this->session->userdata('id_control')=='1') {?>
								'<td>'+
								'<a href="javascript:void(0);" class="md-trigger on-default btn-sm edit-dialy"'+
								'data-id_day="'+data[index].id_day+'" data-id_schedule="'+data[index].id_schedule+'" data-date1="'+data[index].schedule_time.substring(10,0)+'" data-schedule_time="'+data[index].schedule_time.substring(22,11)+'" data-schedule_finish="'+data[index].schedule_finish.substring(22,11)+'"'+ 
								'data-schedule_name="'+data[index].schedule_name+'" data-id_classedit="'+data[index].id_class+'" data-id_student="'+data[index].id_student+'">'+
								'<i class="md md-border-color"></i></a>'+ 
								'<a href="javascript:void(0);" class="md-trigger on-default btn-sm delete"'+
								'data-id_schedule="'+data[index].id_schedule+'" data-id_student="'+data[index].id_student+'">'+
								'<i class="md md-clear"></i></a>'+
								'</td>'+
								<?php } ?>
							'</tr>;'
				}
				$("#show").html(html);
			}
		})
	}

	$("#show").on('click', '.edit-dialy', function(){
		var id_day = $(this).data('id_day');
		var id_schedule = $(this).data('id_schedule');
		var schedule_name = $(this).data('schedule_name');
		var schedule_time = $(this).data('schedule_time');
		var schedule_finish = $(this).data('schedule_finish');
		var id_classedit = $(this).data('id_classedit');
		var id_student = $(this).data('id_student');
		var date1 = $(this).data('date1');
		//alert(id_classedit);
		//var ok =schedule_time.substring(start: int, end: int)
		console.log(id_schedule);
		$("#modal_dialy").modal('show');
		$("#id_day").val(id_day);
		$("#id_schedule").val(id_schedule);
		$("#schedule_name").val(schedule_name);
		$("#schedule_time").val(schedule_time);
		$("#schedule_finish").val(schedule_finish);
		$("#id_classedit").val(id_classedit);
		$("#date1").val(date1);
		$("#all_time").val(date1 +' '+schedule_time);
		$("#all_finish").val(date1 +' '+schedule_finish);
	})

	$("#schedule_time").on('change', function(event) {
		var ok = $(this).val();
		$("#all_time").val(totaldate +' '+ ok);
	});

	$("#schedule_finish").on('change', function(event) {
		var finish = $(this).val();
		$("#all_finish").val(totaldate +' '+ finish);
	});
	$("#schedule_time1").on('change', function(event) {
		var ok = $(this).val();
		$("#all_time1").val(totaldate +' '+ ok);
	});
	$("#schedule_finish1").on('change', function(event) {
		event.preventDefault();
		var finish = $(this).val();
		$("#all_finish1").val(totaldate +' '+ finish);
	});

	$("#btn_update").on('click', function(){
		var data = {'id_day' : $("#id_day").val(),
					'id_schedule' : $("#id_schedule").val(),
					'schedule_name' : $("#schedule_name").val(),
					'all_time' : $("#all_time").val(),
					'all_finish' : $("#all_finish").val(),
					'id_classedit': $("#id_classedit").val(),
					'date1' : $("#date1").val(),
					'csrf_test_name' : $('[name="csrf_test_name"]').val()
					};
			
		$.ajax({
			url : "<?= base_url('conten/Dialyprogamme/update_dialy') ?>",
			type : "post",
			data : data , 
			dataType : "json",
			success : function(data){
				if($.isEmptyObject(data.eror)){
					$.Notification.notify('success','top left',
					'Success Message',
					'Update Succeed.')
					$(".validate").css('display', 'none');
					$("#modal_dialy").modal('hide');
					list();
					$('.reset').val("");
				} else {
					$("#modal_dialy").modal('hide');
					$(".validate").css('display', 'block');
					$(".validate").html(data.eror);
				}
			}

		})
	})

	$("#show").on('click', '.delete' , function(){
		var id_schedule = $(this).data('id_schedule');
		var id_student = $(this).data('id_student');
		var csrf_test_name = $('[name="csrf_test_name"]').val();
		console.log(id_student +''+ id_schedule);
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
					data : {id_schedule : id_schedule,
							id_student : id_student,
							csrf_test_name : csrf_test_name
							},
					type : "post",
					url : "<?= base_url('student/Dailystudent/deleted_completed_activities')?>",
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
