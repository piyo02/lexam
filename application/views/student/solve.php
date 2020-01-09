<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark"><?php echo $test->name ?></h5>
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
                    <div id="timer"></div>
                  </h5>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="col-12">
                <h5><?= 'Soal Nomor ' . $number ?></h5>
                <?php if( $questions[0]->type == 'image' ) : ?>
                    <img src="<?= $questions[0]->image_quest; ?>" alt="Gambar Soal <?= $questions[0]->code ?>" height="150">
                <?php endif; ?>
                <p>
                    <?= $questions[0]->text; ?>
                </p>
              </div>
            </div>
          </div>
        </div>

        <?php
        $label = ['A', 'B', 'C', 'D', 'E'];
        $i = 0;
        foreach ($questions as $key => $question) : ?>
        <div class="col-lg-6 col-sm-12">
            <div class="row">
                <?php if( $question->type_option == 'image' || $question->type_option == 'text' ) : ?>
                    <div class="col-2 col-lg-1 mt-3">
                        <?php if( $question->answer )
                                    $selected = "selected";
                                else 
                                    $selected = "";
                        ?>
                            <?= $label[$i] . '. ' ?><input type="radio" name="" id="" <?= $selected?>>
                    </div>
                <?php endif; ?>
                <div class="col-10 col-lg-11">
                    <div class="card">
                        <div class="card-header">
                            <?php switch ($question->type_option) {
                                case 'image': ?>
                                    <img src="<?= $question->image_answer; ?>" alt="Gambar Option <?= $question->code ?>" height="150">
                            <?php   break;
                                case 'short_answer': 
                                case 'essay':?>
                                    <textarea name="ckeditor" id="editor" class="form-control"></textarea>
                            <?php   break;
                                default: ?>
                                    <p><?= $question->answer; ?></p>
                            <?php   break;
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++; endforeach;  ?>

      </div>
    </div>
  </section>
</div>
?>
<!-- <input type="text" class="form-control" name="answer" id="answer"> -->
<?php   // break; ?>