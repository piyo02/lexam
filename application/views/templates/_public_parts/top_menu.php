        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            </li>
            <?php if ($this->session->identity == null) : ?>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('auth/') ?>register" class="nav-link">Register</a>
                </li> -->
                <li class="nav-item d-sm-inline-block">
                    <a href="<?= base_url('auth/') ?>login" class="btn btn-outline-primary nav-link">Login</a>
                </li>
            <?php else : ?>
                <li class="nav-item d-sm-inline-block">
                    <?php if( $this->ion_auth->user()->row()->group_id == 6){ ?>
                        <a href="<?= site_url("headmaster/student") ?>" class="btn btn-default nav-link">Dashboard</a>
                    <?php } else if( $this->ion_auth->user()->row()->group_id == 4){ ?>
                        <a href="<?= site_url("student/test") ?>" class="btn btn-default nav-link">Dashboard</a>
                    <?php } else{ ?>
                        <a href="<?= site_url().$this->ion_auth->group( $this->ion_auth->user()->row()->group_id )->row()->name ?>" class="btn btn-default nav-link">Dashboard</a>
                    <?php } ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>