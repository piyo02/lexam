<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Beranda</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <!-- <li class="breadcrumb-item active">Beranda</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-3">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $teachers; ?></h3>

                <p>Guru</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-sm-12 col-md-6 col-lg-3">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $classrooms; ?></h3>

                <p>Kelas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-sm-12 col-md-6 col-lg-3">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?= $courses; ?></h3>

                <p>Mata Pelajaran</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-sm-12 col-md-6 col-lg-3">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= $students; ?></h3>

                <p>Siswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 col-sm-12">
            <p>Untuk memudahkan dalam penginputan data siswa, Anda dapat mendownload file excel sebagai template untuk mengimport data siswa ke dalam sistem. Import data siswa berpatokan pada kelas</p>
            <a href="<?= base_url('uploads/asset/') ?>ImportSiswa.xlsx" class="btn btn-sm btn-primary" download>Download File <br> Import Siswa</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>