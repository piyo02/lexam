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
                <div class="col-6">
                  <h5>
                    <?php echo strtoupper($header) ?>
                    <p class="text-secondary"><small><?php echo $sub_header ?></small></p>
                  </h5>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                      <div class="float-right">
                        <?php echo (isset($header_button)) ? $header_button : '';  ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-7 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo (isset($content)) ? $content : '';  ?>
                        <?php echo (isset($edit_test)) ? $edit_test : '';  ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <p>Referensi Soal</p>
                        <?php for ($i=0; $i < count($references); $i++) : ?>
                          <div class="content mb-3">
                            <div class="row">
                              <div class="col-6">
                                <label for="">Bank Soal</label>
                                <input type="text" name="" id="" class="form-control form-control-sm" value="<?= $references[$i]->questionnaire_name ?>" readonly>
                              </div>
                              <div class="col-2">
                                <label for="">PG</label>
                                <input type="text" name="" id="" class="form-control form-control-sm" value="<?= $references[$i]->multiple_choice ?>" readonly>
                              </div>
                              <div class="col-2">
                                <label for="">Isian</label>
                                <input type="text" name="" id="" class="form-control form-control-sm" value="<?= $references[$i]->short_answer ?>" readonly>
                              </div>
                              <div class="col-2">
                                <label for="">Esai</label>
                                <input type="text" name="" id="" class="form-control form-control-sm" value="<?= $references[$i]->essay ?>" readonly>
                              </div>
                            </div>
                          </div>
                          <?php 
                            $data = array(
                              "name" => "Edit",
                              "modal_id" => "edit_ref_" . $i,
                              "button_color" => "primary",
                              "url" => $url,
                              "form_data" => array(
                                'test_id' => array(
                                  'type' => 'hidden',
                                  'label' => "Bank Soal",
                                  'value' => $references[$i]->test_id,
                                ),
                                "id" => array(
                                  'type' => 'hidden',
                                  'label' => "Bank Soal",
                                  'value' => $references[$i]->id,
                                ),
                                "index" => array(
                                  'type' => 'hidden',
                                  'label' => "Bank Soal",
                                  'value' => $i,
                                ),
                                "questionnaire_id_$i" => array(
                                  'type' => 'select',
                                  'label' => "Bank Soal",
                                  'options' => $list_questionnaire,
                                  'selected' => $references[$i]->questionnaire_id
                                ),
                                "multiple_choice_$i" => array(
                                  'type' => 'select',
                                  'label' => "Pilihan Ganda",
                                  'options' => array(),
                                ),
                                "short_answer_$i" => array(
                                  'type' => 'select',
                                  'label' => "Isian",
                                  'options' => array(),
                                  'selected' => $references[$i]->short_answer
                                ),
                                "essay_$i" => array(
                                  'type' => 'select',
                                  'label' => "Esai",
                                  'options' => array(),
                                  'selected' => $references[$i]->essay
                                ),
                              ),
                              'data' => NULL
                            );
                            echo $this->load->view('templates/actions/modal_form', $data, true);
                          ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php for ($i = 0; $i < count($references); $i++) : ?>
    <script>
        $(document).ready(function() {
            $('#questionnaire_id_' + <?= $i ?>).change(function() {
                var questionnaire_id = $(this).val();
                console.log(questionnaire_id);
                $.ajax({
                    type: 'POST', //method
                    url: '<?= base_url('teacher/questionnaire/count_type') ?>', //action
                    data: {
                        id: questionnaire_id
                    }, //data yang dikrim ke action $_POST['id']
                    dataType: 'json',
                    async: false,
                    success: function(data) {
                        var html_multiple_choice = '<option value=""> - </option>';
                        var html_short_answer = '<option value=""> - </option>';
                        var html_essay = '<option value=""> - </option>';

                        var i;
                        for (i = 1; i <= data.multiple_choice; i++) {
                            html_multiple_choice += '<option value="' + i + '"' + '>' + i + '</option>'
                        }
                        for (i = 1; i <= data.short_answer; i++) {
                            html_short_answer += '<option value="' + i + '"' + '>' + i + '</option>'
                        }
                        for (i = 1; i <= data.essay; i++) {
                            html_essay += '<option value="' + i + '"' + '>' + i + '</option>'
                        }
                        console.log(data);
                        $('#multiple_choice_<?= $i ?>').html(html_multiple_choice);
                        $('#short_answer_<?= $i ?>').html(html_short_answer);
                        $('#essay_<?= $i ?>').html(html_essay);
                    }
                });
            })
        });
    </script>
    <script>
      function getOption(select, index) {
            var questionnaire_id = $(select).val();
            console.log(questionnaire_id);
            $.ajax({
                type: 'POST', //method
                url: '<?= base_url('teacher/questionnaire/count_type') ?>', //action
                data: {
                    id: questionnaire_id
                }, //data yang dikrim ke action $_POST['id']
                dataType: 'json',
                async: false,
                success: function(data) {
                    var html_multiple_choice = '<option value=""> - </option>';
                    var html_short_answer = '<option value=""> - </option>';
                    var html_essay = '<option value=""> - </option>';

                    var i;
                    for (i = 1; i <= data.multiple_choice; i++) {
                      if(i == <?= $references[$i]->multiple_choice ?>){
                        html_multiple_choice += '<option value="' + i + '"' + ' selected>' + i + '</option>'
                      }else{
                        html_multiple_choice += '<option value="' + i + '"' + '>' + i + '</option>'
                      }
                    }
                    for (i = 1; i <= data.short_answer; i++) {
                      if(i == <?= $references[$i]->short_answer ?>){
                        html_short_answer += '<option value="' + i + '"' + ' selected>' + i + '</option>'
                      }else{
                        html_short_answer += '<option value="' + i + '"' + '>' + i + '</option>'
                      }
                    }
                    for (i = 1; i <= data.essay; i++) {
                      if(i == <?= $references[$i]->essay ?>){
                        html_essay += '<option value="' + i + '"' + ' selected>' + i + '</option>'
                      }else{
                        html_essay += '<option value="' + i + '"' + '>' + i + '</option>'
                      }
                    }
                    console.log(data);
                    $('#multiple_choice_' + index).html(html_multiple_choice);
                    $('#short_answer_' + index).html(html_short_answer);
                    $('#essay_' + index).html(html_essay);
                }
            });
        }
        $(document).ready(function() {
            if($('#questionnaire_id_' + <?= $i ?>).val() != ''){
               getOption($('#questionnaire_id_' + <?= $i ?>), <?= $i ?>);
            }
        });
    </script>
<?php endfor; ?>