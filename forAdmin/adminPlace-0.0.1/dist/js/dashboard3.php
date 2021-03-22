<?php
include "dist/js/statistic.php";
/*echo '
<script>
$(function () {
  "use strict"

  var ticksStyle = {
    fontColor: "#495057",
    fontStyle: "bold"
  }

  var mode      = "index"
  var intersect = true

  var $loginChart = $("#login-chart");
  var loginChart  = new Chart($loginChart, {
    type   : "bar",
    data   : {
      labels  : ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "thứ 7", "Chủ nhật"],
      datasets: [
        {
          backgroundColor: "#007bff",
          borderColor    : "#007bff",
          data           : ['.$perOfWeek[0].', '.$perOfWeek[1].', '.$perOfWeek[2].', '.$perOfWeek[3].', '.$perOfWeek[4].', '.$perOfWeek[5].', '.$perOfWeek[6].']
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
  //salesChart
  var $salesChart = $("#sales-chart")
	var salesChart  = new Chart($salesChart, {
    data   : {
      labels  : ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
      datasets: [{
        type                : "line",
        data           : ['.$proOfWeek[0].', '.$proOfWeek[1].', '.$proOfWeek[2].', '.$proOfWeek[3].', '.$proOfWeek[4].', '.$proOfWeek[5].', '.$proOfWeek[6].'],
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
';*/
?>