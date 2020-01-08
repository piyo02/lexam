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
                <div class="col-12">
                  <h5>
                    <?php echo strtoupper($header) ?>
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
        <section class="content">
            <div class="container-fluid">                
                <div class="row">
                    <div class="col-md-12">
                        <div class="timeline">
                            <div class="time-label">
                                <span class="bg-red">Ulangan</span>
                            </div>
                            <div>
                                <i class="fas fa-file-alt    bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 03-01-2020</span>
                                    <h3 class="timeline-header"><a href="#">Ulangan Harian</h3>
                                    <div class="timeline-body">

                                    </div>
                                    <div class="timeline-footer">
                                        <a href="<?= $current_page ?>" class="btn btn-success btn-sm mr-2">Review</a>
                                        <button class="btn btn-primary btn-sm">Nilai</button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        </div>
      </div>
    </div>
  </section>
</div>