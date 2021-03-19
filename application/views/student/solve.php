<?php
  if( isset( $solve_test ) && isset( $test->duration ) ){
    
    $start = $solve_test->time_start;
    $time_elapsed = time() - $start;
    $time = (int) $test->duration;

    $temp_hours = $time * 60 - $time_elapsed;
    $temp_minutes = (int) ($temp_hours / 60);
    $temp_seconds = $temp_hours % 60;

    if ($temp_minutes < 60) {
        $hours   = 0;
        $minutes = $temp_minutes;
        $seconds = $temp_seconds;
    } else {
        $hours   = (int) ($temp_minutes / 60);
        $minutes = $temp_minutes % 60;
        $seconds = $temp_seconds;
    }

    // var_dump($temp_minutes); die;
  }
?>

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
                <input type="hidden" name="uncertain" id="uncertain" value="<?= $lists_question[$number - 1]->uncertain ?>">
                <input type="hidden" name="question_id" id="question_id" value="<?= $questions[0]->id ?>">
                <input type="hidden" name="type_option" id="type_option" value="<?= $questions[0]->type_option ?>">
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
                        <?php
                        // var_dump($question->answer);
                        // var_dump(); die;
                        if( $lists_question[$number - 1]->answer == $question->option_id ){
                          $checked = "checked";
                        }else{
                          $checked = "";
                        } 
                        ?>
                            <?= $label[$i] . '. ' ?><input type="radio" name="answer" id="answer" value="<?= $question->option_id . '-' . $label[$i] ?>" <?= $checked?>> 
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
                                    <label for="">Jawaban</label>
                                    <textarea name="editor" id="editor" class="form-control"><?= $lists_question[$number - 1]->answer; ?></textarea>
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
      <div class="row mb-2 justify-content-center">
        <button onclick="back(<?= $number ?>)" class="btn btn-sm btn-secondary mr-2">Kembali</button>
        <button onclick="answer(<?= $number ?>)" class="btn btn-sm btn-success mr-2">Jawab</button>
        <button onclick="uncertain(<?= $number ?>)" class="btn btn-sm btn-warning mr-2">Ragu-ragu</button>
        <button onclick="next(<?= $number ?>)" class="btn btn-sm btn-primary mr-2">Lewati</button>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="finish" role="dialog">
  <div class="modal-dialog">
  <!-- Modal content-->
    <div class="modal-content">
      <form id="formConfirm" action="<?= site_url() ?>student/test/assessment/" method="post" accept-charset="utf-8">
        <div class="modal-header">
          <h5 class="modal-title">Selesai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah anda yakin telah selesai mengerjakan <?= $test->name ?> ?                
          <br>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn  btn-success">Ok</button>
          <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- tombol kembali -->
<script>
  function back(number) {
    // if(number == 1){
    //   break;
    // }
    var btn_question = document.getElementById('question_' + (number - 1));
    btn_question.submit();
  }
</script>

<!-- tombol jawab -->
<script>
  function answer(number) {
    console.log($('input:radio[name=answer]:checked').val());
    var student_answer = $('input:radio[name=answer]:checked').val();
    if (student_answer == undefined)
        var student_answer = CKEDITOR.instances['editor'].getData();
    if (student_answer != undefined && student_answer != '') {
        var id = $('#question_id').val();
        var type_option = $('#type_option').val();
        $.ajax({
            type: 'POST', //method
            url: '<?= base_url('student/test/answer') ?>', //action
            data: {
                question_id: id,
                answer: student_answer,
                type_option: type_option
            }, //data yang dikrim ke action $_POST['id']
            dataType: 'json',
            async: false,
            success: function(data) {
                console.log(data);
                if (data) {
                    setTimeout((funcntion) => {
                        location.reload();
                    }, 0001);
                }
            }
        });
    }
  }
</script>

<!-- tombol ragu-ragu -->
<script>
  function uncertain(number) {
    var student_answer = $('input:radio[name=answer]:checked').val();
    if (student_answer == undefined && CKEDITOR.instances['editor'] !== undefined){
      var student_answer = CKEDITOR.instances['editor'].getData();
    }
    if (student_answer != undefined && student_answer != '') {
        var id = $('#question_id').val();
        var type_option = $('#type_option').val();
        $.ajax({
            type: 'POST', //method
            url: '<?= base_url('student/test/uncertain') ?>', //action
            data: {
                question_id: id,
                answer: student_answer,
                type_option: type_option
            }, //data yang dikrim ke action $_POST['id']
            dataType: 'json',
            async: false,
            success: function(data) {
                console.log(data);
                if (data) {
                    setTimeout((funcntion) => {
                        location.reload();
                    }, 0001);
                }
            }
        });
    }
  }
</script>

<!-- tombol lewati -->
<script>
  function next(number) {
    var uncertain = $('#uncertain').val();
    var student_answer = $('input:radio[name=answer]:checked').val();
    if (student_answer == undefined && CKEDITOR.instances['editor'])
        var student_answer = CKEDITOR.instances['editor'].getData();
    if (student_answer != undefined && student_answer != '' && uncertain != '1') {
        var id = $('#question_id').val();
        var type_option = $('#type_option').val();
        $.ajax({
            type: 'POST', //method
            url: '<?= base_url('student/test/answer') ?>', //action
            data: {
                question_id: id,
                answer: student_answer,
                type_option: type_option
            }, //data yang dikrim ke action $_POST['id']
            dataType: 'json',
            async: false,
            success: function(data) {
                console.log(data);
                if (data) {
                  var btn_question = document.getElementById('question_' + (number + 1));
                  btn_question.submit();
                }
            }
        });
    } else {
      var btn_question = document.getElementById('question_' + (number + 1));
      btn_question.submit();
    }
  }
</script>

<!-- script timer -->
<script>
  console.log('timer')
  $(document).ready(function() {
    var seconds = <?php echo $seconds; ?>;
    var minutes = <?php echo $minutes; ?>;
    var hours = <?php echo $hours; ?>;

    function timer() {
        setTimeout(timer, 1000);

        is_break();
        $('#timer').html(
            '<h4 class="text-danger" align="center">' + hours + ' jam : ' + minutes + ' menit : ' + seconds + ' detik</h4>'
        );

        seconds--;

        if (seconds < 0) {
            seconds = 59;
            minutes--;

            if (minutes < 0) {
                minutes = 59;
                hours--;

                if (hours < 0) {
                    clearInterval();
                    var formSoal = document.getElementById('formConfirm');
                    formSoal.submit();
                }
            }
        }
    }

    function is_break() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('student/test/is_break') ?>',
            success: function(data) {
                if (data == 1) {
                  document.location.href = "<?= site_url('student/test/break') ?>"
                }
            }
        })
    }
    // work();
    timer();
  });
</script>
<script>
  $(window).blur(function () {
    alert('Anda membuka tab lain. Anda otomatis akan diberhentikan');
    $.ajax({
      type: 'POST',
      url: '<?= base_url('student/test/is_break') ?>',
      success: function(data) {
        console.log(data)
        if (data == 1) {
          $.ajax({
            type: 'POST', //method
            url: '<?= base_url('student/test/break') ?>', //action
            data: {
              break: 1,
            }, //data yang dikrim ke action $_POST['id']
            dataType: 'json',
            async: false,
            success: function(data) {
              document.location.href = "<?= site_url('student/test/break') ?>"
            }
          });
        }
      }
    })
  });

</script>