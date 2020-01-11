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
                                    <textarea name="answer" id="editor" class="form-control"><?= $question->answer; ?></textarea>
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
    // console.log($('textarea[id=editor]').html())
    var student_answer = $('input:radio[name=answer]:checked').val();
    if (student_answer == undefined)
        var student_answer = $('textarea[name=answer]').val();
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
    if (student_answer == undefined)
        var student_answer = $('textarea[name=answer]').val();
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
    if (student_answer == undefined)
        var student_answer = $('textarea[name=answer]').val();
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
<!-- <script>
  $(document).ready(function() {
    var detik = <?= $detik; ?>;
    var menit = <?= $menit; ?>;
    var jam = <?= $jam; ?>;

    function hitung() {
        setTimeout(hitung, 1000);

        $('#timer').html(
            '<h4 class="text-danger" align="center">' + jam + ' jam : ' + menit + ' menit : ' + detik + ' detik</h4>'
        );

        detik--;

        if (detik < 0) {
            detik = 59;
            menit--;

            if (menit < 0) {
                menit = 59;
                jam--;

                if (jam < 0) {
                    clearInterval();
                    var formSoal = document.getElementById('formSoal');
                    formSoal.submit();
                }
            }
        }
    }

    function work() {
        setTimeout(work, 1000);

        $.ajax({
            type: 'GET',
            url: '<?= base_url('siswa/tes/working') ?>',
            success: function(data) {
                if (data == 0) {
                    var formSoal = document.getElementById('formSoal');
                    formSoal.submit();
                }
            }
        })
    }
    work();
    hitung();
  });
</script> -->