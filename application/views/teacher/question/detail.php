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
              <!--  -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>