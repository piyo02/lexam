    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="text-container">
                            <h1>Website Lexam <br><span id="js-rotating">Kepala Sekolah, Admin Sekolah, Guru, Murid</span></h1>
                            <p class="p-large">Lexam membantu Guru untuk memudahkan berbagai proses Ulangan dengan otomatisasi dan digitalisasi. <i>" Let's use it now! "</i></p>
                            <a class="btn-solid-lg page-scroll" href="#contact"><i class="fas fa-phone"></i> Hubungi Kami</a>
                            <!-- <a class="btn-solid-lg page-scroll" href="#your-link"><i class="fab fa-google-play"></i>PLAY STORE</a> -->
                        </div>
                    </div> 
                    <div class="col-lg-6">
                        <div class="image-container">
                            <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/front.png" alt="alternative">
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </header> 
    
    <div class="slider-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider-container">
                        <?php if( $testimonies ) : ?>
                        <div class="swiper-container card-slider">
                            <div class="swiper-wrapper">
                                <?php foreach ($testimonies as $key => $testimoni) : ?>
                                <div class="swiper-slide">
                                    <div class="card">
                                        <img class="card-image" src="<?= $testimoni->image ?>" alt="<?= $testimoni->name ?>">
                                        <div class="card-body">
                                            <p class="testimonial-text"><?= $testimoni->testimoni ?></p>
                                            <p class="testimonial-author"><?= $testimoni->name ?> - <?= $testimoni->status ?></p>
                                        </div>
                                    </div>
                                </div>     
                                <?php endforeach; ?>
                            </div> 
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div> 
                        <?php else : ?>
                            <h4 class="text-center">Jadilah Pengguna yang Memberikan Testimoni Pertama Kepada Kami !!</h4>
                        <?php endif; ?>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
    
    <div id="features" class="tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Fitur</h2>
                    <div class="p-heading p-large">Lexam menyediakan fitur berbeda untuk tiap-tiap golongan usernya.</div>
                </div> 
            </div> 
            <div class="row">

                
                <ul class="nav nav-tabs" id="lenoTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true"><i class="fas fa-id-badge"></i>Kepala Sekolah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-tab-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false"><i class="fas fa-school"></i>Admin Sekolah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-tab-3" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false"><i class="fas fa-chalkboard-teacher"></i>Guru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-tab-4" data-toggle="tab" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false"><i class="fas fa-user-graduate"></i>Siswa</a>
                    </li>
                </ul>
                


                
                <div class="tab-content" id="lenoTabsContent">
                    
                    
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
                        <div class="container">
                            <div class="row">
                                
                                
                                <div class="col-lg-4">
                                    <div class="card left-pane first">
                                        <div class="card-body">
                                            <div class="text-wrapper">
                                                <h4 class="card-title">Monitoring Pembelajaran</h4>
                                                <p>Monitoring hasil pembelajaran dapat dengan mudah dilakukan dengan memperhatikan hasil dari para siswa dalam menyelesaikan ulangan yang diadakan.</p>
                                            </div>
                                            <div class="card-icon">
                                                <i class="far fa-calendar-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card left-pane">
                                        <div class="card-body">
                                            <div class="text-wrapper">
                                                <h4 class="card-title">Hasil Ulangan</h4>
                                                <p>Hasil Ulangan tiap siswa ditampilkan dalam grafik yang mudah dipahami dan dapat pula mereview jawaban dari para siswa.</p>
                                            </div>
                                            <div class="card-icon">
                                                <i class="far fa-file-code"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                
                                <div class="col-lg-4">
                                    <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/features-iphone-1.png" alt="alternative">
                                </div>
                                
                                
                                
                                <div class="col-lg-4">
                                    <div class="card right-pane first">
                                        <div class="card-body">
                                            <div class="card-icon">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                            <div class="text-wrapper">
                                                <h4 class="card-title">Perkembangan Siswa</h4>
                                                <p>Monitoring perkembangan siswa dari grafik hasil ulangan siswa tersebut.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card right-pane">
                                        <div class="card-body">
                                            <div class="card-icon">
                                                <i class="fas fa-crown"></i>
                                            </div>
                                            <div class="text-wrapper">
                                                <h4 class="card-title">Siswa Berbakat</h4>
                                                <p>Menemukan siswa berbakat diantara seluruh siswa yang ada di sekolah Anda dapat dengan mudah dilakukan dengan aplikasi Lexam ini.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                            </div> 
                        </div> 
                    </div> 
                    

                    
                    <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2">
                        <div class="container">
                            <div class="row">

                                
                                <div class="col-md-4">
                                    <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/dashboard-admin-school.png" alt="alternative">
                                </div>
                                
                                
                                
                                <div class="col-md-8">
                                    <div class="text-area">
                                        <h3>Admin Sekolah</h3>
                                        <p>Admin Sekolah mengatur urusan Administrasi Sekolah</p>
                                    </div> 
                                    
                                    <div class="icon-cards-area">
                                            <div class="card">
                                                <div class="card-icon">
                                                    <i class="fas fa-id-badge"></i>
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title">Kelas</h4>
                                                    <p>Anda dapat menentukan sendiri jumlah kelas sesuai yang Anda inginkan.</p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-icon">
                                                    <i class="fas fa-book"></i>
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title">Mata Pelajaran</h4>
                                                    <p>Custom Mata Pelajaran bukanlah hal yang sulit dilakukan menggunakan Lexam.</p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-icon">
                                                    <i class="fas fa-chalkboard-teacher"></i>
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title">Guru</h4>
                                                    <p>Daftarkan guru yang ada di sekolah Anda sesuai dengan yang Anda inginkan.</p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-icon">
                                                    <i class="fas fa-graduation-cap"></i>
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title">Siswa</h4>
                                                    <p>Maksimalkan akses seluruh siswa untuk menggunakan aplikasi ini agar perkembangan setiap siswa dapat dimaksimalkan.</p>
                                                </div>
                                            </div>
                                    </div> 
                                </div> 
                                

                            </div> 
                        </div> 
                    </div> 
                    

                    
                    <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3">
                        <div class="container">
                            <div class="row">

                                
                                <div class="col-md-8">
                                    <div class="icon-cards-area">
                                        <div class="card">
                                            <div class="card-icon">
                                                <i class="far fa-calendar-check"></i>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">Analisa Ulangan</h4>
                                                <p>Dengan Lexam, analisa ulangan dilakukan otomatis, sehingga Guru memiliki waktu luang untuk mempersiapkan pembelajaran selanjutnya.</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-icon">
                                                <i class="far fa-file-code"></i>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">Ulangan</h4>
                                                <p>Buat Bank Soal, Buat Ulangannya, Siswa yang Anda ajar siap untuk mengerjakan Ulangan tersebut. Kerjasama antar-siswa akan berkurang karena soal akan diacak.</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-icon">
                                                <i class="fas fa-cube"></i>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">Bank Soal</h4>
                                                <p>Dokumentasi Soal? Dengan Lexam bukan masalah lagi, bank soal tersebut dapat dipakai berulang-ulang.</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-icon">
                                                <i class="fas fa-file-invoice"></i>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">Hasil Ulangan</h4>
                                                <p>Dengan satu tombol, hasil ulangan dalam bentuk Excel dapat anda miliki di handphone dan laptop anda.</p>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                </div> 
                                

                                
                                <div class="col-md-4">
                                    <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/menu-guru.png" alt="alternative">
                                </div>
                                
                                    
                            </div> 
                        </div> 
                    </div>
                    
                    <div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="tab-4">
                        <div class="container">
                            <div class="row">
                                
                                
                                <div class="col-lg-4">
                                    <div class="card left-pane first">
                                        <div class="card-body">
                                            <div class="text-wrapper">
                                                <h4 class="card-title">Perkembangan Siswa</h4>
                                                <p>Memantau perkembangan diri dengan Lexam dapat dilakukan dengan mudah</p>
                                            </div>
                                            <div class="card-icon">
                                                <i class="far fa-compass"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card left-pane">
                                        <div class="card-body">
                                            <div class="text-wrapper">
                                                <h4 class="card-title">Hasil Ulangan</h4>
                                                <p>Ditampilkan dengan grafik yang mudah di pahami, dan sehingga siswa dapat lebih peduli dengan hasil ulangannya.</p>
                                            </div>
                                            <div class="card-icon">
                                                <i class="far fa-file-signature"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                
                                <div class="col-lg-4">
                                    <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/history.png" alt="alternative">
                                </div>
                                
                                
                                
                                <div class="col-lg-4">
                                    <div class="card right-pane first">
                                        <div class="card-body">
                                            <div class="card-icon">
                                                <i class="far fa-calendar-check"></i>
                                            </div>
                                            <div class="text-wrapper">
                                                <h4 class="card-title">Ulangan Online</h4>
                                                <p>Ulangan Online, Penilaian Otomatis, Pelajari Pembahasan kapanpun dimanapun.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                            </div> 
                        </div> 
                    </div> 

                </div> 

            </div> 
        </div> 
    </div> 
    


    
    <div id="preview" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>PREVIEW</h2>
                    <div class="p-heading p-large">Klik gambar untuk memperbesar</div>
                </div> 
            </div> 
            <div class="row">
                <div class="col-lg-12">
                    
                    
                    <div class="slider-container">
                        <div class="swiper-container image-slider">
                            <div class="swiper-wrapper">
                                
                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/beranda-guru.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/beranda-guru.png" alt="alternative">
                                    </a>
                                </div>
                                
                                
                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/buat-ulangan.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/buat-ulangan.png" alt="alternative">
                                    </a>
                                </div>
                                

                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/daftar-soal.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/daftar-soal.png" alt="alternative">
                                    </a>
                                </div>
                                

                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/daftar-ulangan.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/daftar-ulangan.png" alt="alternative">
                                    </a>
                                </div>
                                

                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/dashboard-admin-school.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/dashboard-admin-school.png" alt="alternative">
                                    </a>
                                </div>
                                
                                
                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/grafik-nilai.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/grafik-nilai.png" alt="alternative">
                                    </a>
                                </div>
                                

                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/history.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/history.png" alt="alternative">
                                    </a>
                                </div>
                                

                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/kelas.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/kelas.png" alt="alternative">
                                    </a>
                                </div>
                                

                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/landing-page.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/landing-page.png" alt="alternative">
                                    </a>
                                </div>
                                

                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/mapel.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/mapel.png" alt="alternative">
                                    </a>
                                </div>
                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/menu-guru.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/menu-guru.png" alt="alternative">
                                    </a>
                                </div>
                                
                                
                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/menu-siswa.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/menu-siswa.png" alt="alternative">
                                    </a>
                                </div>
                                

                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/penilaian.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/penilaian.png" alt="alternative">
                                    </a>
                                </div>
                                

                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/penilaian-2.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/penilaian-2.png" alt="alternative">
                                    </a>
                                </div>
                                

                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/tambah-bank-soal.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/tambah-bank-soal.png" alt="alternative">
                                    </a>
                                </div>
                                
                                
                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/tambah-guru.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/tambah-guru.png" alt="alternative">
                                    </a>
                                </div>
                                

                                
                                <div class="swiper-slide">
                                    <a href="<?= base_url('users-assets/') ?>images/preview/tambah-ulangan.png" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="<?= base_url('users-assets/') ?>images/preview/tambah-ulangan.png" alt="alternative">
                                    </a>
                                </div>
                                
                            </div> 

                            
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            

                        </div> 
                    </div> 
                    

                </div> 
            </div> 
        </div> 
    </div> 
    
    
    <div class="counter">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                    
                    <div id="counter">
                        <div class="cell">
                            <div class="counter-value number-count" data-count="<?= $schools ?>">1</div>
                            <p class="counter-info">Pengguna Sekolah</p>
                        </div>
                        <div class="cell">
                            <div class="counter-value number-count" data-count="<?= $tests ?>">1</div>
                            <p class="counter-info">Ulangan</p>
                        </div>
                        <div class="cell">
                            <div class="counter-value number-count" data-count="<?= $teachers ?>">1</div>
                            <p class="counter-info">Guru</p>
                        </div>
                        <div class="cell">
                            <div class="counter-value number-count" data-count="<?= $students ?>">1</div>
                            <p class="counter-info">Siswa</p>
                        </div>
                    </div>
                    
                    
                </div> 
            </div> 
        </div> 
    </div> 
    


    
    <div id="contact" class="form">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>KONTAK</h2>
                    <ul class="list-unstyled li-space-lg">
                        <li class="address">Tertarik untuk menggunakan lexam? Hubungi Kami.</li>
                        <li><i class="fas fa-map-marker-alt"></i>BTN GRAHA MANDIRI PERMAI BLOK K/7, Punggolaka, Puuwatu, Kendari</li><br>
                        <li><i class="fas fa-phone"></i><a class="blue" href="tel:081232578168">+62 812 325 781 68</a></li><br>
                        <li><i class="fas fa-envelope"></i><a class="blue" href="mailto:alzidni2000@gmail.com">alzidni2000@gmail.com</a></li>
                    </ul>
                </div> 
            </div> 
        </div> 
    </div> 
    


    
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col">
                        <h4>Tentang Lexam</h4>
                        <p>Memudahan proses Ulangan untuk membantu tiap guru di Indonesia adalah misi kami dalam mengembangkan Lexam. </p>
                    </div>
                </div> 
                <div class="col-md-4">
                </div> 
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Social Media</h4>
                        <span class="fa-stack">
                            <a href="https://www.facebook.com/alwani.es.7">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="https://www.instagram.com/zdn.dev/">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
    
