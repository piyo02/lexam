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
        <div class="col-lg-8 col-sm-12">
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
              <?php echo form_open();  ?>
              <?php echo (isset($contents)) ? $contents : '';  ?>
              <button class="btn btn-bold btn-success btn-sm " style="margin-left: 5px;" type="submit">
                Simpan
              </button>

              <!--  -->
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                        <input type="hidden" id="total_course" name="total_course" value="0">
                        <a href="#" class="btn btn-primary btn-sm" onclick="addCourse()" id="btn-add-course">Tambah Mapel</a>
                    </div>
                </div>
                <div class="card-body">
                  <div class="" id="add-course"></div>
                </div>
            </div>
        </div>
        <?php echo form_close()  ?>
      </div>
    </div>
  </section>
</div>

<script>
  function addCourse() {
    var totalCourse = document.getElementById('total_course');
    var oldTotal = parseInt(totalCourse.value);
    totalCourse.value = oldTotal + 1;

    $.ajax({
      type: 'POST', //method
      url: '<?= base_url('school_admin/courses/getCourses') ?>', //action
      data: {
          id: 1
      }, //data yang dikrim ke action $_POST['id']
      dataType: 'json',
      async: false,
      success: function(data) {

        var courses = $('#add-course');
        var list_courses = '<option value=""> Mata Pelajaran </option>';

        // var i;
        for (i = 0; i < 2; i++) {
          list_courses += '<option value="' + data[i]['id'] + '"' + '>' + data[i]['name'] + '</option>'
        }
        var select = '<label>Mata Pelajaran</label><select name="course_id_'+ oldTotal +'" class="form-control mb-2">' + list_courses + '</select>';
        console.log(select);
        courses.html( courses.html() + select );
      }
    });
  }
</script>