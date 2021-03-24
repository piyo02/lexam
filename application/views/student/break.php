<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-sm-12">
          <div class="card">
            <div class="card-body text-center">
                <h4 class="m-0 mb-2 text-dark"><?php echo $test->name ?></h4>
                <img class="img-circle elevation-2" src="<?php echo $user_image ?>" width="80" height="80" alt="User" />
                <h3 class="mt-2"><?php echo ucwords($this->session->userdata('user_profile_name')) ?></h3>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-6 col-sm-12">
          <div class="card">
            <div class="card-body text-center">
                Anda Sedang dihentikan untuk Mengerjakan Ulangan ini. <br>
                Silahkan Hubungi Guru yang Bersangkutan untuk melanjutkan Ulangan ini!
                <div class="mt-5">
                Sudah tidak diberhentikan? Klik Tombol di bawah! <br>
                  <a href="<?= site_url('student/test/solve/') ?>" class="btn btn-success">Kerjakan Lagi!</a>
                </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>