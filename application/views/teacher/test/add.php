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

<<<<<<< HEAD

=======
  
>>>>>>> 42332a0e48ecc13a82f50de7f793532a18e12f0b

          <?php echo form_open( site_url( 'teacher/test/add?cr=' . $cr ) );  ?>
          <div class="row">
            <div class="col-lg-7 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo (isset($content_add)) ? $content_add : '';  ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <p>Referensi Soal</p>
                        <input type="hidden" name="cr" value="<?= $cr ?>">
                        <?php for ($i=0; $i < $cr; $i++) : ?>
                          <div class="content mb-3">
                            <div class="row">
                              <div class="col-6">
                                <label for="">Bank Soal</label>
                                <?php
                                  $form = array(
                                    'name' => 'questionnaire_id_' . $i,
                                    'id' => 'questionnaire_id_' . $i,
                                    'type' => 'select',
                                    'class' => 'form-control',
                                    'options' => $list_questionnaire
                                  );
                                  echo form_dropdown($form);
                                ?>
                              </div>
                              <div class="col-2">
                                <label for="">PG</label>
                                <select name="multiple_choice_<?= $i ?>" id="multiple_choice_<?= $i ?>" class="form-control">
                                  <option value=""></option>
                                </select>
                              </div>
                              <div class="col-2">
                                <label for="">Isian</label>
                                <select name="short_answer_<?= $i ?>" id="short_answer_<?= $i ?>" class="form-control">
                                  <option value=""></option>
                                </select>
                              </div>
                              <div class="col-2">
                                <label for="">Esai</label>
                                <select name="essay_<?= $i ?>" id="essay_<?= $i ?>" class="form-control">
                                  <option value=""></option>
                                </select>
                              </div>
                            </div>
                          </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
          </div>
          <button class="btn btn-bold btn-success btn-sm mb-5" style="margin-left: 5px;" type="submit">
                Tambah
          </button>
          <!-- <p><?= $cr ?></p> -->
          <?php echo form_close()  ?>

        </div>
      </div>
    </div>
  </section>
</div>

<?php for ($i = 0; $i < $cr; $i++) : ?>
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
<<<<<<< HEAD
<?php endfor; ?>
=======
<?php endfor; ?>
>>>>>>> 42332a0e48ecc13a82f50de7f793532a18e12f0b
