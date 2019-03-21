<div class="row">
  <div class="col-sm-12">
    <h4 class="pull-left page-title">Welcome !</h4>
    <ol class="breadcrumb pull-right">
      <li><a href="#">Moltran</a></li>
      <li class="active">Progamme Daily Student</li>
    </ol>
  </div>
</div>


<div class="row" id="list">
</div> <!-- End row -->
<input type="hidden" name="<?= $csrf['name'];?>" id="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> -->
<script src="<?php echo base_url()?>assets/Dashboard/js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       var a = new Date();
        var b = a.getDate();
        var c = a.getMonth()+1;
        var d = a.getFullYear();
        var totaldate = d+'-'+c+'-'+b;
       console.log(totaldate);
        load_dialy();

    function load_dialy()
    {
        $.ajax({
            url: '<?= base_url('student/Dailystudent/activity_everyday') ?>',
            type: 'ajax',
            dataType: 'json',
            success : function(data){
                var card = '';
                var i;
                var user = 1;
                for ( i = 0; i < data.length; i++) {
                card += '<div class="col-lg-12" id="daily_list">'+
                        '<div class="portlet">'+
                            '<div class="portlet-heading bg-success">'+
                                '<h3 class="portlet-title text-white">'+
                                    data[i].name_day+
                                '</h3>'+
                                '<div class="portlet-widgets">'+
                                    '<a href="javascript:void(0);" id="check" data-id_schedule="'+data[i].id_schedule+'" data-id_class="'+data[i].id_class+'" data-name_day="'+data[i].name_day+'" data-schedule_name="'+data[i].schedule_name+'">'+'<i class="fa fa-check" >'+'</i>'+'</a>'+
                                    '<span class="divider" id="space"></span>'+
                                    '<a class="all" href="javascript:;" id="checked">'+'<i class="fa fa-check-circle">'+'</i>'+'</a>'+
                                    '<span class="divider all" id="spaced"></span>'+
                                    '<a href="javascript:;" data-toggle="reload">'+'<i class="ion-refresh">'+'</i>'+'</a>'+
                                    '<span class="divider"></span>'+
                                    '<a data-toggle="collapse" data-parent="#accordion1" href="#bg-success">'+'<i class="ion-minus-round"></i></a>'+
                                    '<span class="divider"></span>'+
                                    '<a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>'+
                                '</div>'+
                                '<div class="clearfix"></div>'+
                            '</div>'+
                            '<div id="bg-default" class="panel-collapse collapse in">'+
                                '<div class="portlet-body">'+
                                 data[i].schedule_name+ ' Time start at : '+ data[i].schedule_time.substring(22,11) + ' until ' + data[i].schedule_finish.substring(22,11) + ' for' + ' ' + data[i].class +
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                }
                $("#list").html(card);
                //$("#checked").hide();
                $(".all").hide();
            }
        });
    }

    $("#list").on('click', '#check', function(){
     
        var id_schedule = $(this).data('id_schedule')
        var name_day = $(this).data('name_day')
        var schedule_name = $(this).data('schedule_name')
        var csrf_test_name = $('[name="csrf_test_name"]').val();
        var id_class = $(this).data('id_class');
        console.log('id class=>'+ id_class + ' '+'schedule =>'+ + id_schedule);

       $.ajax({
           url: '<?= base_url('student/Dailystudent/update_daily_student')?>',
           type: 'post',
           dataType: 'json',
           data: {csrf_test_name: csrf_test_name,
                  id_schedule : id_schedule,
                  id_class : id_class },
          success : function(data){
           if (data.already) {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
                });

                Toast.fire({
                  type: 'warning',
                  title: 'Activity has did.'
                })
             } else if (data.not_student) {
               $.Notification.notify('warning', 'top right', 'Something Wrong',
                'You are not student ..');
             } else {
                $.Notification.notify('success', 'top right', 'Sample Notification',
                'Data has been saved, Thanks ..');
             }
          }, error : function(data){
            $.Notification.notify('warning', 'top right', 'Something Wrong',
                'You are not student ..');
          }
       }); 
    })
});
</script>