<?php 
    $email = $this->session->userdata('email');
    $firstname = $this->session->userdata('firstname');
    $query = $this->db->query('SELECT user_rule.firstname, user_rule.email, user_rule.control, parent.desc as parentdesc, parent.parent, child.desc as childdesc, child.child FROM page INNER JOIN user_rule ON page.id_user=user_rule.id_user INNER JOIN parent ON page.id_parent = parent.id_parent INNER JOIN child on page.id_child = child.id_child WHERE user_rule.email="admin@gmail.com"');
  
?>
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
						<?php if ($this->session->userdata('auth_on')){ ?>
                            <img src="<?php echo base_url('assets/images/'.$this->session->userdata('image'))?>" alt="" class="thumb-md img-circle">
						<?php } ?>
						</div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?= $this->session->userdata('firstname') ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                                    <?php if ($this->session->userdata('control')=='administrator') {?>
                                    <li><a href="<?= base_url('conten/User') ?>"><i class="md md-settings"></i> Settings</a></li>
                                    <li><a href="<?= base_url('conten/User/view_create_user') ?>"><i class="md md-group-add"></i> Create User</a></li>
                                    <?php } ?>
                                    <li><a href="<?= base_url('Auth_user/signout') ?>"><i class="md md-settings-power"></i> Logout</a></li>
                                </ul>
                            </div>
                            
                            <p class="text-muted m-0"><?= $this->session->userdata('control') ?></p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <?php $data = $query->row();
                                $b = $this->db->query('SELECT DISTINCT user_rule.firstname, user_rule.email, user_rule.control, parent.desc as parendesc, parent.parent FROM page INNER JOIN user_rule ON page.id_user=user_rule.id_user INNER JOIN parent ON page.id_parent = parent.id_parent  WHERE user_rule.email="admin@gmail.com"');
                            foreach ($b->result() as $key ) {?>

                            <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="fa fa-book"></i> <span><?= $key->parendesc ?></span> <span class="pull-right"><i class="md md-add"></i></span></a>
                                <ul class="list-unstyled">
                                    <?php 
                                      $a = $this->db->query('SELECT * FROM `page` WHERE have_child=1');
                                        if ($a->row()) {
                                        $b = $this->db->query('SELECT * FROM `child`INNER JOIN parent ON child.id_parent = parent.id_parent');
                                        }
                                      ?>
                                </ul>
                            </li>
                          
                            <?php } ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
