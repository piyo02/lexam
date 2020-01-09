  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url()  ?>" class="brand-link">
      <img src="<?= base_url() . FAVICON_IMAGE ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo APP_NAME ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="<?= base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
                <img class="img-circle elevation-2" src="<?php echo $user_image ?>" width="48" height="48" alt="User" />
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo ucwords($this->session->userdata('user_profile_name')) ?></a>
        </div>
      </div>
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-header">DAFTAR MENU</li> -->
          <div class="row">
          <?php

            function print_menus( $datas )
            {
              
              
              $i = 1;
              foreach( $datas as $key => $data ) :
              ?>

                <div class="col-4">
                <?php
                if(!$data->answer)
                  $btn = 'btn-default'; //soal belum di jawab
                if($data->answer)
                  $btn = 'btn-primary'; //soal sudah di jawab
                if($data->uncertain)
                  $btn = 'btn-warning'; //soal sudah di jawab dan ragu-ragu
                ?>
                  <a href="<?= base_url('student/test/' . 'test?number=' . $i . '&id=' . $data->question_id ) ?>" style="color: black" class="mb-3 w-100 btn btn-sm btn <?= $btn ?>"><?= $i . ' ' . $data->choice ?></a>
                </div>

        <?php 
        $i++;  
      endforeach;
              
            }
          
            print_menus( $_menus );
          ?>
            </div>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      <div class="text-center">
        <?= $btn_confirm; ?>
      </div>
    </div>
    <!-- /.sidebar -->
</aside>