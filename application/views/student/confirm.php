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
                <h6>KKM : <?php echo $test->kkm ?></h6>
                <img class="img-circle elevation-2" src="<?php echo $user_image ?>" width="80" height="80" alt="User" />
                <h3 class="mt-2"><?php echo ucwords($this->session->userdata('user_profile_name')) ?></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-6 col-sm-12 row">
            <!-- <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <?= $value['correct'] ?> Benar
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        Nilai : <?= $value['value'] ?> 
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <?= $value['total_quest'] - $value['correct'] ?> Salah
                    </div>
                </div>
            </div> -->
            <a href="<?= base_url('student/test'); ?>" class="btn btn-primary btn-sn">Kembali</a>
        </div>
      </div>
    </div>
  </section>
</div>