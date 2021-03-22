<?php
	echo '
<script>
$(function () {
  "use strict"

  var ticksStyle = {
    fontColor: "#495057",
    fontStyle: "bold"
  }

  var mode      = "index"
  var intersect = true

  
    var $soldProChart = $("#sold-product-chart");
	var soldProChart  = new Chart($soldProChart, {
    data   : {
      labels  : ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
      datasets: [{
        type                : "line",
        data           : ['.$soldProCount[0].', '.$soldProCount[1].', '.$soldProCount[2].', '.$soldProCount[3].', '.$soldProCount[4].', '.$soldProCount[5].', '.$soldProCount[6].'],
        backgroundColor     : "transparent",
        borderColor         : "#007bff",
        pointBorderColor    : "#007bff",
        pointBackgroundColor: "#007bff",
        fill                : false
        // pointHoverBackgroundColor: "#007bff",
        // pointHoverBorderColor    : "#007bff"
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : "4px",
            color        : "rgba(0, 0, 0, .2)",
            zeroLineColor: "transparent"
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 6
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
})

</script>
';
?>