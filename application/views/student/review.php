<div class="row justify-content-end">
    <?php $num = 1; foreach ($lists_question as $key => $question_id) : ?>
        <a href="<?= site_url('student/history/review/') , $test_id . '?number=' . $num . '&question_id=' . $question_id->question_id ?>" class="ml-2 btn btn-sm btn-success"><?= $num ?></a>
    <?php $num++; endforeach;?>
</div>
</div>
</div>
<div class="card">
    <div class="card-body">
        <h4>Nomor <?= $number ?></h4>
        <h6>Kode Soal : <?= $questions[0]->code ?></h6>
        
        <!-- soal -->
        <?php if( $questions[0]->image ) : ?>
            <img src="<?= $questions[0]->image_quest ?>" alt="" width="300rem">
        <?php endif; ?>
        <?= $questions[0]->text ?>
        
        <!-- option -->
        <?php 
        $label = ['A', 'B', 'C', 'D', 'E'];
        $i = 0;
        foreach ($questions as $key => $question) { ?>
        <div class="row">

            <?php if( $question->type_option == 'image' || $question->type_option == 'text' ) : ?>
                <?php
                if( ($student_answer->answer == $question->option_id && $question->value ) || $question->value ){
                    $color = "green";
                }elseif( $student_answer->answer == $question->option_id ) { 
                    $color = "red";
                }else {
                    $color = "black";
                } ?>
            <?php endif; ?>
            
            <div class="col-10 ml-3">
            <?php switch ($question->type_option) {
                case 'image': ?>
                    <span style="color: <?= $color ?>"><?= $label[$i] . '. ' ?></span>&nbsp&nbsp&nbsp<img src="<?= $question->image_answer; ?>" alt="Gambar Option <?= $question->code ?>" height="150">
            <?php   break;
                case 'short_answer': 
                case 'essay':?>
                    <label for="">Jawaban</label>
                    <textarea name="editor" id="editor" class="form-control"><?= $student_answer->answer; ?></textarea>
            <?php   break;
                default: ?>
                    <span style="color: <?= $color ?>"><?= $label[$i] . '. ' ?>&nbsp&nbsp&nbsp<?= $question->answer; ?></span>
            <?php   break;
            }?>
            </div>
        </div>
        <?php $i++; } ?>
        <div class="ml-3 mt-3">
            <p><b>Skor Siswa: <?= $student_answer->skor ?></b></p>
        </div>

