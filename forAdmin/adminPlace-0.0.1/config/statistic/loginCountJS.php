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

  var $loginChart = $("#login-chart")
  var loginChart  = new Chart($loginChart, {
    type   : "bar",
    data   : {
      labels  : ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "thứ 7", "Chủ nhật"],
      datasets: [
        {
          backgroundColor: "#007bff",
          borderColor    : "#007bff",
          data           : ['.$loginCount[0].', '.$loginCount[1].', '.$loginCount[2].', '.$loginCount[3].', '.$loginCount[4].', '.$loginCount[5].', '.$loginCount[6].']
        }
      ]
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
            beginAtZero: true,
			suggestedMax: 6,
            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              if (value >= 1000) {
                value /= 1000
                value += "k"
              }
              return value + " người";
            }
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