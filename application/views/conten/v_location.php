 <style>
  #load { height: 100%; width: 100%; }
  #load {
    position    : fixed;
    z-index     : 99999; /* or higher if necessary */
    top         : 0;
    left        : 0;
    overflow    : hidden;
    text-indent : 100%;
    font-size   : 0;
    opacity     : 0.6;
    background  : #E0E0E0  url(<?php echo base_url('assets/images/load.gif');?>) center no-repeat;
  }
  
  .RbtnMargin { margin-left: 5px; }
  
  
  </style>
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Please Scan QR Code</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#">Gracehaven</a></li>
            <li><a href="#">Movement Type</a></li>
            <li class="active">Location</li>
        </ol>
    </div>
</div>
<div class="row">
<div class="col-md-12">
   <form id="" enctype="multipart/form-data" name="form_edit_user" method="post" action="">
    <input type="hidden" name="<?= $csrf['name'];?>" value="<?= $this->security->get_csrf_hash();?>" />
        <?php $config['csrf_protection'] = TRUE; echo $this->security->get_csrf_hash(); ?>  
        <div class="row"> 
            <div class="row col-md-6"> 
                <div class="col-md-12"> 
                    <div class="form-group"> 
                        <label for="field-1" class="control-label">Class Room</label> 
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <select name="class_room" id="class_room" class="form-control">
                            <option></option>
                            <?php foreach ($class_room as $key ) {?>
                                <option value="<?= $key->id_location?>"><?= $key->class_room ?></option>
                            <?php } ?>  
                        </select>
                        </div>
                    </div> 
                </div> 
            </div>   
        </div>
    </form> 
</div>
</div>

<!-- SECTION FILTER
================================================== -->  
<!-- <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 ">
        <div class="portfolioFilter">
            <a href="#" data-filter="*" class="current">All</a>
            <a href="#" data-filter=".webdesign">Web Design</a>
           
        </div>
    </div>
</div> -->

<div class="row port">
    <div class="container">
        <div class="row">
            <div class="col-md-12 graphicdesign illustrator photography">
                <div class="gal-detail thumb" id="qrcode" style="text-align: center;">
                    <div id="load">Please wait ...</div>
                        <img src="<?php echo base_url()?>assets/images/qr-code.png"/>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End row -->
<div id="edit_classroom" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Input Your Password</h4> 
            </div> 
            <div class="modal-body">
            <form id="form_edit" enctype="multipart/form-data" name="form_edit_user" method="post" action="">
            <input type="hidden" name="id_location" id="id_location" /> 
            <input type="hidden" name="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />         
                <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group"> 
                            <label for="field-3" class="control-label">Email</label>
                            <div class="input-group">
                            <div class=""><input id="email" name="email" type="email" class="form-control reset"/>
                            </div>
                            <span class="input-group-btn">
                            <button type="button" class="btn waves-effect waves-light btn-primary">
                            <i class="glyphicon glyphicon-time"></i></button></span>
                            </div> 
                        </div> 
                    </div>  
                </div>
                 <div class="row"> 
                    <div class="col-md-12"> 
                        <div class="form-group"> 
                            <label for="field-3" class="control-label">Password</label>
                            <div class="input-group">
                            <div class=""><input id="password" name="password" type="text" class="form-control reset"/>
                            </div>
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
                <button type="button" class="btn btn-info waves-effect waves-light" id="btn_login">Save </button> 
            </div> 
        </div> 
    </div>
</div><!-- /.modal -->
            
<script src="<?php echo base_url()?>assets/Dashboard/js/jquery.min.js"></script>
<script type="text/javascript">
    $(window).load(function(){
        var $container = $('.portfolioContainer');
        $container.isotope({
            filter: '*',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });

        $('.portfolioFilter a').click(function(){
            $('.portfolioFilter .current').removeClass('current');
            $(this).addClass('current');

            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });L
            return false;
        }); 
    });
    $(document).ready(function() {
        const url_abs = '<?php echo base_url()?>';
        $("#load").hide();
        $('.image-popup').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-fade',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            }
        });

        $('#class_room').on('change', function(event) {
            const class_room = $(this).val();
            $('#edit_classroom').modal('show');
            $('#id_location').val(class_room);
        });

        $('#btn_login').click(function(event) {
            var email = $('#email').val();
            var password = document.getElementById('password').value;
            var id_location = $('#id_location').val();

            $.ajax({
                url: url_abs+'conten/Location/login',
                type: 'POST',
                dataType: 'json',
                async : false,
                data: {email: email,
                       password : password,
                       id_location : id_location 
                    },
                success : function(data){
                   var html = '';
                   var i;
                   for (i = 0; i < data.length; i++) {
                       html += 
                                '<img src="<?php echo base_url()?>assets/images/qrcode/'+data[i].qrcode+'" class="thumb-img" alt="work-thumbnail"  style="width: 30%;">'+
                                '<h4>'+data[i].class_room+'</h4>';
                   }
                   $('#qrcode').html(html);
                   $('#edit_classroom').modal('hide');
                   $("#load").show();
                }, error : function(){
                    $('#edit_classroom').modal('hide');
                    $.Notification.notify('info', 'top right', 'Failed load QR','there is something wrong. !');
                    console.log('image not found');
                    $("#qrcode").html("<img src='<?php echo base_url()?>assets/images/qr-code.png'>"); //dan ini bisa juga
                }
            })
        });
    });
</script>
