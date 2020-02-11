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
              <div class="col-12">
                <div class="card-title">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#all" data-toggle="tab">Keseluruhan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#class-ladder" data-toggle="tab">Jenjang Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#courses" data-toggle="tab">Mata Pelajaran</a>
                        </li>
                    </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="chart tab-pane active" id="all">
                        satu
                    </div>
                    <div class="chart tab-pane" id="class-ladder">
                        dua
                    </div>  
                    <div class="chart tab-pane" id="courses">
                        tiga
                    </div>  
                </div>
              <!--  -->
              <?php echo (isset($contents)) ? $contents : '';  ?>
              <!--  -->
              <!--  -->
              <?php echo (isset($pagination_links)) ? $pagination_links : '';  ?>
              <!--  -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>