
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
                            <div id="line-chart" style="height: 300px;"></div>
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
<script src="<?= base_url('assets/') ?>plugins/flot-old/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?= base_url('assets/') ?>plugins/flot-old/jquery.flot.pie.min.js"></script>

<script>
/*
  * LINE CHART
  * ----------
  */
//LINE randomly generated data

var sin = [],
    cos = []
for (var i = 0; i < 14; i += 0.5) {
  sin.push([i, Math.sin(i)])
}
var line_data1 = {
  data : sin,
  color: '#3c8dbc'
}
$.plot('#line-chart', [line_data1], {
  grid  : {
    hoverable  : true,
    borderColor: '#f3f3f3',
    borderWidth: 1,
    tickColor  : '#f3f3f3'
  },
  series: {
    shadowSize: 0,
    lines     : {
      show: true
    },
    points    : {
      show: true
    }
  },
  lines : {
    fill : false,
    color: ['#3c8dbc', '#f56954']
  },
  yaxis : {
    show: true
  },
  xaxis : {
    show: true
  }
})
//Initialize tooltip on hover
$('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
  position: 'absolute',
  display : 'none',
  opacity : 0.8
}).appendTo('body')
$('#line-chart').bind('plothover', function (event, pos, item) {

  if (item) {
    var x = item.datapoint[0].toFixed(2),
        y = item.datapoint[1].toFixed(2)

    $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
      .css({
        top : item.pageY + 5,
        left: item.pageX + 5
      })
      .fadeIn(200)
  } else {
    $('#line-chart-tooltip').hide()
  }

})
/* END LINE CHART */
</script>