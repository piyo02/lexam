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
            <div class="card-body">
              <!--  -->
              <input type="hidden" name="question_id" id="question_id" value="<?= $question_id; ?>">
              <div class="content">
                <div class="mb-2 ml-1">
                  <?php
                    if($question->type == 'image') {
                      echo "<img src='$question->image_quest' height='150px'>";
                    }
                  ?>
                </div>
                <?php echo (isset($edit_image_quest)) ? $edit_image_quest : '';  ?>
                <div class="ml-1">
                  <p><?= $question->text ?></p>
                </div>
                <?php echo (isset($edit_quest)) ? $edit_quest : '';  ?>
              </div>
              <div class="content mt-4">
                <?php 
                $label = ['A', 'B', 'C', 'D', 'E'];
                $i = 0;
                foreach ($options as $key => $option) : ?>
                  <p class="mt-3 ml-1"><?= $label[$i] . ". " . $option->answer ?></p>
                <?php
                    $edit_quest = array(
                      "name" => "Edit",
                      "modal_id" => "edit_option_$option->id",
                      "button_color" => "primary",
                      "url" => $url . 'edit',
                      "form_data" => array(
                        "id" => array(
                          'type' => 'hidden',
                          'label' => "id option",
                          'value' => $option->id
                        ),
                        "answer" => array(
                          'type' => 'text',
                          'label' => "Option $label[$i]",
                          'value' => $option->answer
                        ),
                      ),
                      'data' => NULL
                    );
                    echo $this->load->view('templates/actions/modal_form_lg', $edit_quest, true ); 

                $i++;
              endforeach; ?>
              </div>
              <!--  -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>