
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
              <div class="row">
                <div class="col-6">
                  <h5>
                    <?php echo strtoupper($header) ?>
                    <p class="text-secondary"><small><?php echo $sub_header ?></small></p>
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="get">
                                <?= $contents?>
                                <button class="btn btn-sm btn-primary mt-2" type="submit">Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-8 col-sm-12">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>