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
          <div class="row">
            <?php foreach ($rows as $key => $row) : ?>
              <div class="col-lg-4">
                <div class="info-box">
                  <span class="info-box-icon bg-info"><i class="fas fa-file-signature"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text"><?= $row->name ?></span>
                    <span class="info-box-number"><?= $row->duration ?> menit</span>
                    <div class="row">
                      <div class="col-lg-8">
                          <span class="info-box-text"><?= $row->user_fullname ?></span>
                      </div>
                      <div class="col-lg-2">
                      <?php
                        if($row->result_student == NULL){
                          $add_menu = array(
                            "name" => "Kerjakan",
                            "modal_id" => "solve_test_" . $row->id,
                            "button_color" => "success",
                            "url" => site_url( $current_page . "solve/"),
                            "messages" => 'Apakah anda yakin ingin mengerjakan ' . $row->name . ' ?',
                            "form_data" => array(
                              "id" => array(
                                'type' => 'hidden',
                                'label' => "Test Id",
                                'value' => $row->id
                              ),
                            ),
                            'data' => NULL
                          );
                          echo $this->load->view('templates/actions/modal_form_messages', $add_menu, true ); 
                        }
                      ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>          
          </div>
          <?php echo (isset($pagination_links)) ? $pagination_links : '';  ?>

        </div>

      </div>
    </div>
  </section>
</div>


