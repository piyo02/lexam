
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
              <div class="row">
                <div class="col-6">
                  <h5>
                    <?php echo strtoupper($header) ?>
                    <p class="text-secondary"><small><?php echo $sub_header ?></small></p>
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="get">
                                <?= $contents?>
                                <button class="btn btn-sm btn-primary mt-2" type="submit">Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                          <div class="chart">
                            <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- FLOT CHARTS -->
<script src="<?= base_url('assets/') ?>plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?= base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>
<!-- <script src="<?= base_url('assets/') ?>plugins/flot-old/jquery.flot.resize.min.js"></script> -->
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<!-- <script src="<?= base_url('assets/') ?>plugins/flot-old/jquery.flot.pie.min.js"></script> -->

<script>
  let course_id = <?= $course_id; ?>;
  let result = null;
  function result_test() {
    $.ajax({
      type: 'POST', //method
      url: '<?= base_url('student/result_test/result_test') ?>', //action
      data: {
        course_id: course_id,
      }, //data yang dikrim ke action $_POST['id']
      dataType: 'json',
      async: false,
      success: function(data) {
        console.log(data);
        result = data;
      }
    });
  }
  result_test();
  console.log(result);
  var areaChartData = {
      labels  : result.test_name,
      datasets: [
        {
          label               : 'Nilai',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : result.value
        },
      ]
    }
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChartData = jQuery.extend(true, {}, areaChartData)
  var temp1 = areaChartData.datasets[0]
  barChartData.datasets[0] = temp1

  var barChartOptions = {
    responsive              : true,
    maintainAspectRatio     : false,
    datasetFill             : false,
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
          stepSize: 10,
          max: 100
        },
      }]
    }
  }

  var barChart = new Chart(barChartCanvas, {
    type: 'bar', 
    data: barChartData,
    options: barChartOptions
  })
</script>