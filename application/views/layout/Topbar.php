<style type="text/css">
.circle {
  display: inline-block;
  width: 32px;
  height: 32px;
  border-radius: 20%;
  margin: 0 4px;
}

.circle-1 {
  border: 4px solid  rgb(241, 241, 233);
}

.circle-2 {
  border: 4px solid rgb(42, 78, 176);
}

.circle-3 {
  border: 4px solid rgb(241, 241, 233);
}

.circle-4 {
  border: 4px solid rgb(42, 78, 176);
}
</style>
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="<?= base_url('Dashboard.html')?>" class="logo"><i class="md md-terrain"></i> <span>Moltran </span></a>
        </div>
    </div>
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left">
                        <i class="fa fa-bars"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>
                <form class="navbar-form pull-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control search-bar" placeholder="Type here for search...">
                    </div>
                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                </form>

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="" style="position: absolute; left: 50%;top: 50%;transform: translateX(200%) translateY(-35%);">
                      <div class="circle circle-1"></div>
                      <div class="circle circle-2"></div>
                      <div class="circle circle-3"></div>
                      <div class="circle circle-4"></div>
                    </li>
                    <li class="dropdown hidden-xs">
                        <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                            <i class="md md-notifications"></i> <span class="badge badge-xs badge-danger">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg">
                            <li class="text-center notifi-title">Notification</li>
                            <li class="list-group">
                               <!-- list item-->
                               <a href="javascript:void(0);" class="list-group-item">
                                  <div class="media">
                                     <div class="pull-left">
                                        <em class="fa fa-user-plus fa-2x text-info"></em>
                                     </div>
                                     <div class="media-body clearfix">
                                        <div class="media-heading">New user registered</div>
                                        <p class="m-0">
                                           <small>You have 10 unread messages</small>
                                        </p>
                                     </div>
                                  </div>
                               </a>
                               <!-- list item-->
                                <a href="javascript:void(0);" class="list-group-item">
                                  <div class="media">
                                     <div class="pull-left">
                                        <em class="fa fa-diamond fa-2x text-primary"></em>
                                     </div>
                                     <div class="media-body clearfix">
                                        <div class="media-heading">New settings</div>
                                        <p class="m-0">
                                           <small>There are new settings available</small>
                                        </p>
                                     </div>
                                  </div>
                                </a>
                                <!-- list item-->
                                <a href="javascript:void(0);" class="list-group-item">
                                  <div class="media">
                                     <div class="pull-left">
                                        <em class="fa fa-bell-o fa-2x text-danger"></em>
                                     </div>
                                     <div class="media-body clearfix">
                                        <div class="media-heading">Updates</div>
                                        <p class="m-0">
                                           <small>There are
                                              <span class="text-primary">2</span> new updates available</small>
                                        </p>
                                     </div>
                                  </div>
                                </a>
                               <!-- last list item -->
                                <a href="javascript:void(0);" class="list-group-item">
                                  <small>See all notifications</small>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="hidden-xs">
                        <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
                    </li>
                    <li class="hidden-xs">
                        <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="md md-chat"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                    			<?php if ($this->session->userdata('auth_on')) {?>
                    			<img src="<?php echo base_url('assets/images/'.$this->session->userdata('image'))?>" alt="user-img" class="img-circle">
                    			<?php } ?>
                  			</a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                            <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                            <li><a href="<?= base_url('Auth_user/signout.html')?>"><i class="md md-settings-power"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= base_url()?>assets/js/anime.js"></script>
<script type="text/javascript">
  var circle1 = anime ({
  targets: ['.circle-1'],
  translateY: -24,
    translateX: 52,
    direction: 'alternate',
  loop: true,
  elasticity: 400,
    easing: 'easeInOutElastic',
   duration: 1600,
    delay: 800,
});

var circle2 = anime ({
  targets: ['.circle-2'],
  translateY: 24,
    direction: 'alternate',
  loop: true,
  elasticity: 400,
    easing: 'easeInOutElastic',
   duration: 1600,
    delay: 800,
});

var circle3 = anime ({
  targets: ['.circle-3'],
  translateY: -24,
    direction: 'alternate',
  loop: true,
  elasticity: 400,
    easing: 'easeInOutElastic',
   duration: 1600,
    delay: 800,
});

var circle4 = anime ({
  targets: ['.circle-4'],
  translateY: 24,
    translateX: -52,
    direction: 'alternate',
  loop: true,
  elasticity: 400,
    easing: 'easeInOutElastic',
   duration: 1600,
    delay: 800,
});

</script>