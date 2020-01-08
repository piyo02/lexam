<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark"><?php echo $block_header ?></h5>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="col-12">
                <?php
                echo $alert;
                ?>
              </div>
              <div class="row">
                  <h5>
                    <?php echo strtoupper($header) ?>
                  </h5>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="row">
                        <?php foreach ($rows as $key => $row) : ?>
                        <div class="col-lg-4">
                            <div class="carousel-item active">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text"><?= $row->name ?></span>
                                        <span class="info-box-number"><?= $row->duration ?> menit</span>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <span class="info-box-text"><?= $row->user_fullname ?></span>
                                            </div>
                                            <div class="col-lg-2">
                                                <a href="<?= site_url('/' . $row->id ) ?>" class="btn btn-success btn-sm">Kerjakan</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

      </div>
    </div>
  </section>
</div>


