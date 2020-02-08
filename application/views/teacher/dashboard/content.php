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
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $questionnaire ?></h3>

                <p>Bank Soal</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-th"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $test ?></h3>

                <p>Ulangan</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-file-signature"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?= $course ?></h3>

                <p>Mata Pelajaran</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-book"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= $student ?></h3>

                <p>Siswa</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-users"></i>
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
  <div class="container-fluid">
    <div class="col-sm-12 col-lg-3">
      <div class="card">
        <div class="card-body">
            <p>Untuk memudahkan dalam penginputan data soal, Anda dapat mendownload file excel sebagai template untuk mengimport data soal ke dalam sistem. Import data soal berpatokan pada bank soal. Dan jenis soal yang dapat di import hanyalah soal dengan tipe jawaban pilihan ganda teks, isian singkat atau esai</p>
            <a href="<?= base_url('uploads/asset/') ?>import-soal.xlsx" class="btn btn-sm btn-primary" download>Download File <br> Import Soal</a>
        </div>
      </div>
    </div>
  </div>
</div>