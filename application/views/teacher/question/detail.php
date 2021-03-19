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
                $selected = 0;
                foreach ($options as $key => $option) : ?>
                <?php switch ($option->type) {
                  case 'text':
                    echo '<p class="mt-3 ml-1"> ' . $label[$i] . '. ' . $option->answer .'</p>';
                    break;
                  case 'short_answer':
                  case 'essay':
                    echo '<p class="mt-3 ml-1">' . $option->answer .'</p>';
                    break;
                  case 'image':
                    echo '<div class="mt-2 ml-1 mb-1 row">';
                    echo '<p class="mr-1">'. $label[$i] . '. ' .'</p><img src="'.$option->image_answer.'" height="150px">';
                    echo '</div>';
                    break;
                } ?>
                  
                <?php
                $option_select[$option->id] = 'Pilihan ' . $label[$i];
                  if($option->value != 0){
                    $selected = $option->id;
                  }
                    
                    $edit_quest = array(
                      "name" => "Edit",
                      "modal_id" => "edit_option_$option->id",
                      "button_color" => "primary",
                      "url" => $url . 'edit_option',
                      "form_data" => array(
                        "id" => array(
                          'type' => 'hidden',
                          'label' => "id option",
                          'value' => $option->id
                        ),
                        "question_id" => array(
                          'type' => 'hidden',
                          'label' => "id option",
                          'value' => $option->question_id
                        ),
                        "image_old" => array(
                          'type' => 'hidden',
                          'label' => "image_old",
                          'value' => $option->image_old
                        ),
                        "code" => array(
                          'type' => 'hidden',
                          'label' => "id option",
                          'value' => $question->code
                        ),
                        "answer" => array(
                          'type' => 'text',
                          'label' => "Option $label[$i]",
                          'value' => $option->answer
                        ),
                      ),
                      'data' => NULL
                    );
                    if($option->type == "image")
                      $edit_quest['form_data']['answer'] = array (
                        'type' => 'file',
                        'label' => "Option $label[$i]",
                      );
                    if($option->type != "essay")
                      echo $this->load->view('templates/actions/modal_form_multipart_lg', $edit_quest, true ); 

                $i++;
              endforeach; ?>
              </div>
              <div class="content mt-3 col-8">
                <?php 
                  echo form_open($url . 'edit_answer');
                  if( $options[0]->type == 'text' || $options[0]->type == 'image' ){                
                    $form = array(
                      'name' => 'id',
                      'type' => 'select',
                      'class' => 'form-control',  
                    );
                    $form['options'] = $option_select;
                    $form['selected'] = $selected;
                    echo '<label for="" class="control-label">Jawaban</label>';
                    echo form_dropdown( $form );
                    echo '<input type="hidden" name="id_old" class="control-label" value="'. $selected .'">';
                    echo '<input type="hidden" name="type" class="control-label" value="1">';
                  }
                  else {
                    echo '<input type="hidden" name="id" class="control-label" value="'. $options[0]->id .'">';
                    echo '<input type="hidden" name="type" class="control-label" value="0">';
                    echo '<input type="text" name="value" class="form-control" value="'. $options[0]->value .'">';
                  }
                  echo '<input type="hidden" name="question_id" class="control-label" value="'. $question->id .'">';
                  echo '<button type="submit" class="btn btn-primary btn-sm mt-1">Edit</button>';
                  echo form_close();
                ?>
              </div>
              <!--  -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>