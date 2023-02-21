<script type="text/javascript">
  setInterval(function() {
    var d = new Date();
    $('#date').html(d);
  }, 1000);
  // $.ajax({
  //   url: "<?php echo base_url() ?>dashboard/outofservice",
  //   type: 'POST',
  //   dataType: 'json',
  //   success:
  //     function(data)
  //   {
  //     $('#service').html(data);
  //     console.log(data);
  //   },
  //   error: function(e) {
  //     console.log("error");
  //   }
  // });
  // $.ajax({
  //   url: "<?php echo base_url() ?>dashboard/occupied",
  //   type: 'POST',
  //   dataType: 'json',
  //   success:
  //     function(data)
  //   {
  //     $('#occupied').html(data);
  //     $('#upcoming').html(data);
  //     console.log(data);
  //   },
  //   error: function(e) {
  //     console.log("error");
  //   }
  // });
  // $.ajax({
  //   url: "<?php echo base_url() ?>dashboard/available",
  //   type: 'POST',
  //   dataType: 'json',
  //   success:
  //     function(data)
  //   {
  //     $('#available').html(data);
  //     console.log(data);
  //   },
  //   error: function(e) {
  //     console.log("error");
  //   }
  // });
  // $.ajax({
  //   url: "<?php echo base_url() ?>dashboard/bookings",
  //   type: 'POST',
  //   dataType: 'json',
  //   success:
  //     function(data)
  //   {
  //     $('#bookings').html(data);
  //     console.log(data);
  //   },
  //   error: function(e) {
  //     console.log("error");
  //   }
  // });
  // $.ajax({
  //   url: "<?php echo base_url() ?>dashboard/bookings_yr",
  //   type: 'POST',
  //   dataType: 'json',
  //   success:
  //     function(data)
  //   {
  //     $('#bookings_yr').html(data);
  //     console.log(data);
  //   },
  //   error: function(e) {
  //     console.log("error");
  //   }
  // });
  // $.ajax({
  //   url: "<?php echo base_url() ?>dashboard/checkin",
  //   type: 'POST',
  //   dataType: 'json',
  //   success:
  //     function(data)
  //   {
  //     $('#checkin').html(data);
  //     console.log(data);
  //   },
  //   error: function(e) {
  //     console.log("error");
  //   }
  // });
  // $.ajax({
  //   url: "<?php echo base_url() ?>dashboard/checkin_yr",
  //   type: 'POST',
  //   dataType: 'json',
  //   success:
  //     function(data)
  //   {
  //     $('#checkin_yr').html(data);
  //     console.log(data);
  //   },
  //   error: function(e) {
  //     console.log("error");
  //   }
  // });
  $(function() {
    'use strict';
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    //-----------------------
    //- MONTHLY SALES CHART -
    //-----------------------
    // Get context with jQuery - using jQuery's .get() method.
    var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var salesChart = new Chart(salesChartCanvas);
    var salesChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
      datasets: [
        {
          label: "Checkin",
          fillColor: "rgba(60,141,188,0)",
          strokeColor: "rgb(210, 214, 222)",
          pointColor: "rgb(210, 214, 222)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgb(220,220,220)",
          data: [<?php
                  for ($i = 1; $i <= 12; $i++) {
                    echo $rate[$i] . ",";
                  }
                  ?>
          ]
        },
        {
          label: "Checkout",
          fillColor: "rgba(60,141,188,0)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [<?php
                  for ($i = 1; $i <= 12; $i++) {
                    echo $checkout[$i] . ",";
                  }
                  ?>]
        },
        {
          label: "Reservation",
          fillColor: "rgba(60,141,188,0)",
          strokeColor: "rgb(171, 242, 177)",
          pointColor: "rgb(171, 242, 177)",
          pointStrokeColor: "rgb(171, 242, 177)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgb(171, 242, 177)",
          data: [<?php
                  for ($i = 1; $i <= 12; $i++) {
                    echo $reservation[$i] . ",";
                  }
                  ?>]
        },
        // {
        //   label: "Vincent",
        //   fillColor: "rgba(60,141,188,0)",
        //   strokeColor: "rgb(224, 109, 222)",
        //   pointColor: "rgb(224, 109, 222)",
        //   pointStrokeColor: "rgb(224, 109, 222)",
        //   pointHighlightFill: "#fff",
        //   pointHighlightStroke: "rgb(224, 109, 222)",
        //   data: [60, 50, 50, 55, 44, 60, 70]
        // }
      ]
    };
    var salesChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: false
    };
    //Create the line chart
    salesChart.Line(salesChartData, salesChartOptions);
    //---------------------------
    //- END MONTHLY SALES CHART -
    //---------------------------
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      {
        value: 700,
        color: "#f56954",
        highlight: "#f56954",
        label: "Chrome"
      },
      {
        value: 500,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "IE"
      },
      {
        value: 400,
        color: "#f39c12",
        highlight: "#f39c12",
        label: "FireFox"
      },
      {
        value: 600,
        color: "#00c0ef",
        highlight: "#00c0ef",
        label: "Safari"
      },
      {
        value: 300,
        color: "#3c8dbc",
        highlight: "#3c8dbc",
        label: "Opera"
      },
      {
        value: 100,
        color: "#d2d6de",
        highlight: "#d2d6de",
        label: "Navigator"
      }
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 1,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: false,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
      //String - A tooltip template
      tooltipTemplate: "<%=value %> <%=label%> users"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
  });
</script>
<script>
  var response = $("#response").val();
  if (response) {
    console.log(response, 'response');
    var options = $.parseJSON(response);
    noty(options);
  }
  $(function() {
    $table = $('#old_stock_details').DataTable({
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "ajax": {
        "url": "<?php echo base_url(); ?>index.php/dashboard/get/",
        "type": "POST",
        "data": function(d) {
        }
      },
      "createdRow": function(row, data, index) {
        $('td', row).eq(0).html(index + 1);
        var balance_quantity = parseInt(data['purchase_quantity']) - parseInt(data['sale_quantity']);
        $('td', row).eq(7).html(balance_quantity);
      },
      "columns": [
        {
          "data": "stock_id",
          "orderable": false
        },
        {
          "data": "product_name",
          "orderable": false
        },
        {
          "data": "category_name",
          "orderable": false
        },
        {
          "data": "subcategory_name",
          "orderable": false
        },
        {
          "data": "color_name",
          "orderable": false
        },
        {
          "data": "size_name",
          "orderable": false
        },
        {
          "data": "purchase_date",
          "orderable": false
        },
        {
          "data": "stock_id",
          "orderable": false
        }
      ]
    });


    $table2 = $('#product_table').DataTable({
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "ajax": {
        "url": "<?php echo base_url(); ?>index.php/dashboard/getTableReminders/",
        "type": "POST",
        "data": function(d) {
        }
      },
      "createdRow": function(row, data, index) {
        $('td', row).eq(0).html(index + 1);
      },
      "columns": [
        {
          "data": "fc_call_status",
          "orderable": false
        },
        {
          "data": "fc_call_date",
          "orderable": false
        },
        {
          "data": "fc_call_time",
          "orderable": false
        },
        {
          "data": "enquiry_id",
          "orderable": false
        },
        {
          "data": "customername",
          "orderable": false
        },
        {
          "data": "fc_call_remark",
          "orderable": false
        },
      ]
    });
  });
</script>