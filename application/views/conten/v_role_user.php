<div class="row">
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Role User</h3></div>
        <div class="panel-body">
        <div>
          <form method="post" action="<?= base_url('conten/User/search_role_user') ?>">
          <input type="hidden" name="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />
          <div class="row"> 
            <div class="col-md-12">
              <div class="col-md-4"> 
                <div class="form-group"> 
                  <label for="field-3" class="control-label">Name</label>
                  <div class="input-group">
                  <input type="text" required="" class="form-control" id="firstname" name="firstname" placeholder="Firstname" value="<?= $firstname ?>"> 
                   <input type="hidden" required="" class="form-control" id="firstname" name="firstname" placeholder="ID User" value="<?= $id_user ?>"> 
                  <span class="input-group-btn">
                  <button type="button" class="btn waves-effect waves-light btn-primary" data-toggle="modal" data-target="#modal_user">
                  <i class="md md-person-add"></i></button></span>
                  </div> 
                </div> 
              </div> 
              <div class="col-md-4"> 
                <div class="form-group"> 
                  <label for="field-3" class="control-label">Position</label>
                  <div class="input-group">
                    <input type="hidden" required="" value="<?= $id_control ?>" readonly="" class="form-control" id="control" name="control" placeholder="Control">  
                  <select name="id_control" id="id_control" class="required form-control">
                    <option value=""><?= $control ?></option>
                  </select>
                  <span class="input-group-btn">
                  <button type="button" class="btn waves-effect waves-light btn-primary">
                  <i class="fa fa-envelope-o"></i></button></span>
                  </div> 
                </div> 
              </div> 
              <div class="col-md-4"> 
                <div class="form-group"> 
                   <button type="submit" target="" class="btn btn-info btn-rounded waves-effect waves-light m-b-5">.Change</button>
                </div> 
              </div>
            </div>
          </div>
        </form> 
        </div>
            <form class="form-horizontal" role="form">
            <?php $a = $this->db->query("SELECT * FROM `sidebar`  ORDER BY id ASC"); 
            foreach ($a->result() as $main ) { 
                if ($main->child == 0) { ?>

                <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label class="col-sm-6 control-label" style="text-align: center;"><?= $main->title?></label>
                         <div class="checkbox checkbox-primary">
                            <input id="check<?= $main->id ?>"value="<?= $main->id ?>" type="checkbox">
                            <label for="checkbox2"></label>
                        </div>
                    </div>
                  <!--   <div class="col-sm-6 form-group">
                        <div class="toggle toggle-primary"></div>
                    </div> -->
                </div>      
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="col-sm-6 control-label"><?= $main->title ?></label>
                            <div class="col-sm-6 control-label">
                                <div class="toggle toggle-default" id="toggle<?= $main->id?>" data-ortu="<?= $main->id ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>                                  
            </div>
            <?php } elseif ($main->child == 1) { $a = $this->db->query("SELECT * FROM `sidebar`  ORDER BY id ASC");
            $child = $this->db->query("SELECT * FROM `sidebar` WHERE parent = $main->id"); 
            
            ?>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label class="col-sm-6 control-label" style="text-align: left;"><?= $main->title?></label>
                        <div class="checkbox checkbox-primary">
                            <input id="check<?= $main->id ?>"value="<?= $main->id ?>" type="checkbox">
                            <label for="checkbox2"></label>
                        </div>
                    </div>
                </div> 
                <?php foreach ($child->result() as $key) { ?>     
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="col-sm-6 control-label"><?= $key->title ?></label>
                            <div class="col-sm-6 control-label">
                                <div class="toggle toggle-default" id="toggle<?= $key->id?>" data-id="<?= $key->id ?>" data-ortu="<?= $main->id ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>                                  
            </div>
            <?php } } ?>
            <input type="hidden" name="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />
            </form>
        </div> <!-- panel-body -->
    </div> <!-- panel -->
</div> <!-- col -->
  <div id="modal_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-full">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="full-width-modalLabel">Modal Heading</h4>
              </div>
              <div class="modal-body">
                  <div class="row"> 
                            <div class="col-lg-6" style="width: 100%;"> 
                                <div class="panel-group" id="accordion-test-2"> 
                                    <div class="panel panel-info panel-color"> 
                                        <div class="panel-heading"> 
                                            <h4 class="panel-title"> 
                                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                                    Student
                                                </a> 
                                            </h4> 
                                        </div> 
                                        <div id="collapseOne-2" class="panel-collapse collapse"> 
                                            <div class="panel-body">
                                               <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table class="table table-hover" id="tuser">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Username</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="show">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div> 
                                        </div> 
                                    </div>
                                    <div class="panel panel-purple panel-color"> 
                                        <div class="panel-heading"> 
                                            <h4 class="panel-title"> 
                                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed" aria-expanded="false">
                                                    USER
                                                </a> 
                                            </h4> 
                                        </div> 
                                        <div id="collapseTwo-2" class="panel-collapse collapse in"> 
                                            <div class="panel-body">
                                               <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table class="table table-hover" id="tstudent">
                                                    <thead>
                                                        <tr>
                                                            <th>NIS</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Class</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="show_student">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div> 
                                        </div> 
                                    </div> 
                                </div> 
                            </div>
                        </div> <!-- end row -->
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div> <!-- End row -->
<script src="<?php echo base_url()?>assets/Dashboard/js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tstudent').dataTable();
        $('#tuser').dataTable();
        // Simplest way:
        $('.toggle').toggles();
        list_student();
        list_user();
        //looping sidebar
        <?php
          $id_user = $this->session->userdata('id_user');
          $id_student = $this->session->userdata('id_student');
          if ($id_user) {
            $this->db->where('id_user', 1);
            $a = $this->db->get('rbac');   
          } 
         $b = $this->db->get('sidebar'); 
         foreach ($a->result() as $key ) {?>
            $('#check<?= $key->id ?>').click(function() {
              if (this.checked) {
                var ortu = $("#check<?= $key->id ?>").val()
                var csrf_test_name = $('[name="csrf_test_name"]').val();
                console.log(ortu)
                
                } else { console.log('check')
                var ortu = $("#check<?= $key->id ?>").val()
                var csrf_test_name = $('[name="csrf_test_name"]').val();
                // $(".toggle").toggles({
                //   on : false
                // })
                $.ajax({
                    url: '<?= base_url('conten/Role_user/remove_role') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: {csrf_test_name:csrf_test_name,
                            ortu : ortu},
                    success : function(data){
                      console.log('sukses');
                    }
                  });
              }
            });
            $('#check<?= $key->id ?>').prop('checked', true);
            $('#toggle<?= $key->id ?>').toggles({
                on : true
            })
        <?php } foreach ($b->result() as $b) {?>
        //looping sidebar
        //inser role by looping and toggle
          $("#check<?= $b->id ?>").click(function(e, checked) {
            if (this.checked) {
              var ortu = $(this).val();
              var csrf_test_name = $('[name="csrf_test_name"]').val();
              $.ajax({
                url: '<?= base_url('conten/Role_user/insert_role') ?>',
                type: 'post',
                dataType: 'json',
                data: {csrf_test_name:csrf_test_name,
                        ortu : ortu},
                success : function(data){
                  console.log('sukses');
                }
              });
            } else{
              console.log('b');
            }
          });
        <?php }  ?>
        
       
          // $('.toggles').toggles({
          //   on: true
          // });
       
        // Form Toggles
        $('.toggle').on('toggle', function(e, active) {
          var a =1 ;
          var b =0 ;
          var id = $(this).data('id');
          var ortu = $(this).data('ortu');
          var csrf_test_name = $('[name="csrf_test_name"]').val();
          if (active) {
            $.ajax({
              url: '<?= base_url('conten/Role_user/insert_role') ?>',
              type: 'post',
              dataType: 'json',
              data: {csrf_test_name:csrf_test_name,
                      id : id,
                      ortu : ortu},
              success : function(data){
                console.log('sukses');
              }
            });
            //console.log(id +'=>'+a);
          } else {
            //console.log(id +'=>'+b);
            $.ajax({
              url: '<?= base_url('conten/Role_user/remove_role') ?>',
              type: 'post',
              dataType: 'json',
              data: {csrf_test_name:csrf_test_name,
                      id : id,
                      ortu : ortu},
              success : function(data){
                console.log('sukses');
              }
            });
          }
        });
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
                '<td>'+[user++]+'</td>'+
                '<td>'+data[index].firstname+'</td>'+
                '<td>'+data[index].lastname+'</td>'+
                '<td>'+data[index].email+'</td>'+
                '<td>'+
                '<a href="javascript:void(0);" class="md-trigger on-default btn-sm choose"'+
                'data-nis="'+data[index].id_user+'" data-firstname="'+data[index].firstname+'"'+ 
                'data-lastname="'+data[index].lastname+'" data-id_control="'+data[index].id_control+'" >'+
                '<i class="fa fa-reply-all"></i></a>'+ 
                '</td>'+
              '</tr>;'
        }
        $("#show").html(html);
      }
    })
}

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
                '<td>'+data[index].nis+'</td>'+
                '<td>'+data[index].firstname+'</td>'+
                '<td>'+data[index].lastname+'</td>'+
                '<td>'+data[index].class+'</td>'+
                '<td>'+
                '<a href="javascript:void(0);" class="md-trigger on-default btn-sm choose"'+
                'data-nis="'+data[index].nis+'" data-firstname="'+data[index].firstname+'"'+ 
                'data-lastname="'+data[index].lastname+'" data-id_control="'+data[index].id_control+'" >'+
                '<i class="fa fa-reply-all"></i></a>'+ 
                '</td>'+
              '</tr>;'
        }
        $("#show_student").html(html);
      }
    })
  }

  $("#show_student").on('click', '.choose', function(event) {
    event.preventDefault();
    var firstname = $(this).data('firstname');
    var id_control = $(this).data('id_control');
    console.log(firstname + ' as ' + id_control );
    $("#firstname").val(firstname);
    $("#id_control").val(id_control);
    $("#modal_user").modal('hide');
  });

  $("#show").on('click', '.choose', function(event) {
    event.preventDefault();
    var firstname = $(this).data('firstname');
    var id_control = $(this).data('id_control');
    console.log(firstname + ' as ' + id_control );
    $("#firstname").val(firstname);
    $("#id_control").val(id_control);
    $("#modal_user").modal('hide');
  });
});
</script>