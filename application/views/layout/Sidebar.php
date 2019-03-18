
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
						<?php if ($this->session->userdata('id_control')=='1' || $this->session->userdata('id_control')=='2'){ ?>
                            <img src="<?php echo base_url('assets/images/user/'.$this->session->userdata('image'))?>" alt="" class="thumb-md img-circle">
						<?php } else {?>
                            <img src="<?php echo base_url('assets/images/student/'.$this->session->userdata('image'))?>" alt="" class="thumb-md img-circle">
                        <?php } ?>
						</div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?= $this->session->userdata('firstname')  ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                                    <?php if ($this->session->userdata('id_control')=='1') {?>
                                    <li><a href="<?= base_url('conten/User') ?>"><i class="md md-settings"></i> Settings</a></li>
                                    <li><a href="<?= base_url('conten/User/view_create_user') ?>"><i class="md md-group-add"></i> Create User</a></li>
                                    <?php } ?>
                                    <li><a href="<?= base_url('Auth_user/signout') ?>"><i class="md md-settings-power"></i> Logout</a></li>
                                </ul>
                            </div>
                            <p class="text-muted m-0"><?= $this->session->userdata('class') ?></p>
                            <p class="text-muted m-0"><?= $this->session->userdata('control') ?></p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <li>
                                <a href="<?= base_url('conten/Dashboard.html')?>" class="waves-effect"><i class="md md-home"></i><span>Dashboard</span></a>
                            </li>
                        <?php
                        $id_control = $this->session->userdata('id_control'); 
                        $a = $this->db->query("SELECT * FROM `rbac` INNER JOIN sidebar on rbac.id = sidebar.id  WHERE rbac.id_control = '$id_control'");
                          
                            foreach ($a->result() as $main ) {
                                if ($main->child == 0 ) { ?>
                            <li>
                                <a href="<?= base_url($main->url)?>" class="waves-effect <?php $a= $this->uri->segment(1); $b= $this->uri->segment(2); $c = $a.'/'.$b; if($c == $main->url){ echo "active";}  ?>"><i class="<?php echo $main->icon ?>" style="color: <?php echo $main->color ?>;"></i><span><?= $main->title ?></span></a>
                            </li>
                        <?php } elseif ($main->child == 1) { 
                            // $d = $this->db->query("SELECT * FROM `sidebar` WHERE parent = $main->id");
                            $child = $this->db->query("SELECT * FROM rbac JOIN sidebar ON rbac.id = sidebar.id WHERE rbac.id_control = $id_control AND sidebar.parent = '$main->id'")
                            ?>
                             <li class="has_sub">
                                <a href="# <?php echo $main->url; ?>" class="waves-effect <?php $first= $this->uri->segment(1); $two= $this->uri->segment(2); $third = $this->uri->segment(3); $c = $first.'/'.$two.'#'; $d =  $first.'/'.$two.'/'.$third; if($c == $main->url){ echo "active subdrop";} ;?>">
                                <i class="<?php echo $main->icon ?>" style="color: <?php echo $main->color ?>;"></i><span> <?= $main->title ?> </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                <ul class="list-unstyled">
                                   <?php foreach ($child->result() as $key ) { ?>
                                    <li><a href="<?= base_url($key->url) ?>"><?= $key->title ?> </a></li>
                                    <?php } ?>                                    
                                </ul>
                            </li>
                        <?php } } ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
