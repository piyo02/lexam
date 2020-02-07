<nav class="navbar navbar-expand-md navbar-dark navbar-custom fixed-top">
        <a class="navbar-brand" href="index.html"><img src="<?= base_url('users-assets/') ?>images/text-lexam.png" alt="alternative" width="90rem"></a> 
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#header">BERANDA <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#features">FITUR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#preview">PREVIEW</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#contact">KONTAK</a>
                </li>
                <?php if ($this->session->identity == null) : ?>
                <li class="nav-item">
                    <a href="<?= base_url('auth/') ?>login" class="nav-link btn btn-outline-primary nav-link">Login</a>
                </li>
                <?php else : ?>
                <li class="nav-item">
                    <a href="<?= site_url().$this->ion_auth->group( $this->ion_auth->user()->row()->group_id )->row()->name ?>" class="nav-link">DASHBOARD</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
