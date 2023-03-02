<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header" style="border: solid;padding: 30px;">

    <h1 class="row">

      <small class="col-md-6">Financial Year: <?php echo $fin_year->fin_year; ?></small>

      <small id="date" class="col-md-6"></small>

      <!-- <small>Time: 4:00 PM</small> -->

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Dashboard</li>

    </ol>

  </section><br>

  <!-- Main content -->

  <section class="content" style="min-height:100px;">

    <!-- Info boxes -->

    <div class="row">

      <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">

          <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

          <div class="info-box-content">

            <span class="info-box-text">TOTAL SHARE HOLDERS</span>

            <span class="info-box-number" id="occupied"><?php //echo $tot_lead[0]->tot_lead ?></span>

          </div>

          <!-- /.info-box-content -->

        </div>

        <!-- /.info-box -->

      </div>

      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">

          <span class="info-box-icon bg-green"><i class="fa fa-user-circle-o"></i></span>

          <div class="info-box-content">

            <span class="info-box-text">NO. OF PRODUCTS</span>

            <span class="info-box-number" id="available"><?php //echo $lead_conv[0]->lead_conv ?></span>

          </div>

          <!-- /.info-box-content -->

        </div>

        <!-- /.info-box -->

      </div>

      <!-- /.col -->

      <!-- fix for small devices only -->

     <!--  <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">

          <span class="info-box-icon bg-red"><i class="fa fa-filter"></i></span>

          <div class="info-box-content">

            <span class="info-box-text">NO. OF LEADS IN PIPLINE</span>

            <span class="info-box-number" id="service"><?php echo $lead_pipe[0]->lead_pipe ?></span>

          </div>

        </div>

      </div> -->

      <!-- /.col -->

      <!-- <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">

          <span class="info-box-icon bg-yellow"><i class="fa fa-cog"></i></span>

          <div class="info-box-content">

            <span class="info-box-text">ORDER CONVERSION RATE</span>

            <span class="info-box-number" id="upcoming"><?php echo $lead_rate[0]->lead_rate.'%' ?></span>

          </div>

         

        </div>

       

      </div> -->

      <!-- /.col -->

    </div>

  </section>

  <!-- <section class="content">

      <div class="box">

        <div class="box-header">

          <div class="row">

            <div class="col-sm-8">

              <h3>Reminder</h3>  

            </div>

        </div>

        <div class="box-body">

          <div class="table-responsive">

            <table id="product_table" class="table table-bordered table-striped table-responsive">

                <thead>

                  <tr>

                    <th>SI.NO</th>

                    <th>DATE</th>

                    <th>TIME</th>

                    <th>ENQUIRY ID</th>

                    <th>CUSTOMER NAME</th>

                    <th>CUSTOMER REMARK</th>

                  </tr>

                </thead>

                <tbody>         

                </tbody>

            </table>

            </div>

        </div>

      </div>

    </section> -->

  <!--   <section class="content">

      <div class="box">

        <div class="box-header">

          <div class="row">

            <div class="col-sm-8">

              <h3>Reminder</h3>  

            </div>

          </div>

        </div>

        <div class="box-body">

          <div id='calendar'></div>

        </div>

      </div>

    </section> -->

    <!-- /.row -->

</div>

<script>

document.addEventListener('DOMContentLoaded', function() {

  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {

    initialView: 'dayGridWeek',

    

    events:"<?php echo base_url() ?>dashboard/getCalenderReminder",

  });

  calendar.render();

});

</script>