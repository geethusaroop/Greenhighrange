<?php
 
/* $dataPoints = array( 
	array("y" => 7,"label" => "March" ),
	array("y" => 12,"label" => "April" ),
	array("y" => 28,"label" => "May" ),
	array("y" => 18,"label" => "June" ),
	array("y" => 41,"label" => "July" )
); */
 
?>
<style type="text/css">
  .card {
    padding-bottom: 30px;
    border: none;
    height: 100%;
    background-color: initial;
  }

  .card-body {
    padding: 15px 30px 30px;
    background-color: #0e0908;
    border-radius: 4px;
    -webkit-box-shadow: 0px 10px 20px 0px rgba(229, 229, 229, 0.75);
    box-shadow: 0px 10px 20px 0px rgba(229, 229, 229, 0.75);
  }

  .dashboard-card-ten .card-body .student-info .media {
    margin-bottom: 6px;
  }

  .media {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: start;
    align-items: flex-start;
  }

  .dashboard-card-ten .card-body .student-info .media .item-img {
    background-color: #0e0908;
    height: 115px;
    width: 115px;
    line-height: 129px;
    text-align: center;
    border-radius: 50%;
    overflow: hidden;
  }

  .dashboard-card-ten .card-body .student-info .media .item-img img {
    margin-right: 5px;
  }

  img {
    max-width: 100%;
    height: auto;
  }

  img {
    vertical-align: middle;
    border-style: none;
  }

  .media-body {
    margin-left: 3rem;
  }

  .media-body {
    -ms-flex: 1;
    flex: 1;
  }

  .dashboard-card-ten .card-body .student-info .media .media-body .item-title {
    color: #111111;
    font-weight: 500;
    margin-bottom: 10px;
  }

  h3 {
    font-size: 22px;
  }

  h3,
  h4,
  h5,
  h6 {
    line-height: 1.4;
  }

  .table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
  }

  .text-nowrap {
    white-space: nowrap !important;
  }

  .table {
    width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
  }

  table {
    border-collapse: collapse;
  }

  *,
  ::after,
  ::before {
    box-sizing: border-box;
  }

  user agent stylesheet table {
    display: table;
    border-collapse: separate;
    box-sizing: border-box;
    text-indent: initial;
    border-spacing: 2px;
    border-color: grey;
  }

  .dashboard-card-ten .card-body .student-info .info-table .table tbody tr td {
    border: none;
    padding: 8px;
  }

  .table td,
  .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
  }

  .text-dark-medium {
    color: #111111;
  }

  .font-medium {
    font-weight: 500;
  }

  .text-nowrap {
    white-space: nowrap !important;
  }

  table {
    border-collapse: collapse;
  }

  table {
    border-collapse: separate;
    text-indent: initial;
    border-spacing: 2px;
  }

  .dashboard-content-one {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    overflow: auto;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    padding: 0 30px;
  }

  .dashboard-card-ten .card-body .student-info .info-table .table tbody tr td {
    border: none;
    padding: 8px;
  }

  .col-8-xxxl {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 66.666667%;
    flex: 0 0 66.666667%;
    max-width: 66.666667%;
  }

  .col-12-xxxl,
  .col-11-xxxl,
  .col-10-xxxl,
  .col-9-xxxl,
  .col-8-xxxl,
  .col-7-xxxl,
  .col-6-xxxl,
  .col-5-xxxl,
  .col-4-xxxl,
  .col-3-xxxl,
  .col-2-xxxl,
  .col-1-xxxl {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
  }

  .bg-light-red {
    background: #0e0908;
  }

  .company-product .productDiv {
    background-color: #fff;
    position: relative;
    top: -50px;
    border-radius: 4px;
    box-shadow: 0 2px 6px 0 rgb(0 0 0 / 20%);
    padding: 25px 45px 20px;
  }

  .company-product.products .productDiv .productBox {
    padding: 55px 25px 20px;
    box-shadow: 0 2px 6px 0 rgb(0 0 0 / 20%);
    background: #fafafa;
  }

  .company-product .productDiv .productBox .productSlider {
    margin-bottom: 15px;
    padding: 0 50px;
    position: relative;
  }

  .company-product.products .productDiv .productBox .productSlider .bx-wrapper {
    margin-bottom: 35px;
    background: #fafafa;
    border: none;
  }

  #coming-prev.productBtn {
    left: 0px;
  }

  .productBtn {
    position: absolute;
    top: 50%;
    margin-top: -32px;
  }

  .productBtn a {
    width: 35px;
    height: 64px;
    display: inline-block;
    text-indent: -99999px;
    background: url(https://cdn.connect2india.com/global/images/coming-control.png) no-repeat 0px 0px;
  }

  #coming-next.productBtn {
    right: 0px;
  }

  .productBtn {
    position: absolute;
    top: 50%;
    margin-top: -32px;
  }

  #coming-next.productBtn a {
    background-position: -35px 0px;
  }

  .productBtn a {
    width: 35px;
    height: 64px;
    display: inline-block;
    text-indent: -99999px;
    background: url(https://cdn.connect2india.com/global/images/coming-control.png) no-repeat 0px 0px;
  }

  .company-menu.new {
    background: #e9b90b;
    border: none;
  }

  .company-menu {
    padding: 0px;
    background: #1c2866;
    border-top: 1px solid #bbc3ce;
  }

  .company-container {
    max-width: 1440px;
  }

  .company-container {
    width: 93%;
    margin: auto;
  }

  /* #################### */
  .dropbtn {
    background-color: #04AA6D;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    border-radius: 999px;
  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 260px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  .dropdown-content li {
    color: black;
    padding: 12px 16px 4px 1px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content li:hover {
    background-color: #ddd;
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .dropdown:hover .dropbtn {
    background-color: #3e8e41;
  }

  .fa-stack[data-count]:after {
    position: absolute;
    right: 0%;
    top: 1%;
    content: attr(data-count);
    font-size: 30%;
    padding: .6em;
    border-radius: 999px;
    line-height: .75em;
    color: white;
    background: rgba(255, 0, 0, .85);
    text-align: center;
    min-width: 2em;
    font-weight: bold;
  }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
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
  <section class="content">
    <!-- Info boxes -->
    <!-- /.row -->
   
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <?php if ($this->session->userdata['user_type'] == 'A') { ?>
          <div class="row">
      <div class="">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3><?php echo $branch_total;  ?></h3>
            <p>Total Branches</p>
          </div>
          <div class="icon">
            <i class="fa fa-window-restore"></i>
          </div>
          <a href="<?php echo base_url(); ?>Branch" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $share_holder;  ?></h3>
            <p>Total Share Holders</p>
          </div>
          <div class="icon">
            <i class="fa fa-snowflake-o"></i>
          </div>
          <a href="<?php echo base_url(); ?>Shareholder" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $members;  ?></h3>
            <p>Total Members</p>
          </div>
          <div class="icon">
            <i class="fa fa-feed"></i>
          </div>
          <a href="<?php echo base_url(); ?>Member" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo $total_board;  ?></h3>
            <p>Board Of Directors(Total)</p>
          </div>
          <div class="icon">
            <i class="fa fa-hourglass"></i>
          </div>
          <a href="<?php echo base_url(); ?>Direct_details" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3>&#8377; &nbsp;&nbsp;<?php echo number_format($purchase_total,2);  ?></h3>
            <p>Total Purchase</p>
          </div>
          <div class="icon">
            <i class="fa fa-recycle"></i>
          </div>
          <a href="<?php echo base_url(); ?>Purchaseitem" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>&#8377; &nbsp;&nbsp;<?php echo number_format($sales_total,2);  ?></h3>
            <p>Total Sales</p>
          </div>
          <div class="icon">
            <i class="fa fa-sliders"></i>
          </div>
          <a href="<?php echo base_url(); ?>Sale" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $stock_transfer_req_count;  ?></h3>
            <p>Total Branch Stock Transfer</p>
          </div>
          <div class="icon">
            <i class="fa fa-arrows"></i>
          </div>
          <a href="<?php echo base_url(); ?>Branch_transfer" class="small-box-footer">More info
            <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $product_count;  ?></h3>
            <p>Total Products</p>
          </div>
          <div class="icon">
            <i class="fa fa-ravelry"></i>
          </div>
          <a href="<?php echo base_url(); ?>Stock" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    </div>

    <!-------------------------------------------->

    <div id="chartContainer" style="height: 370px; width: 100%;"></div>

  </div>
        <?php } ?>


        <?php if ($this->session->userdata['user_type'] == 'B') { ?>
          <div class="row">
     
    

    <div class="">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $members;  ?></h3>
            <p>Total Members</p>
          </div>
          
          <div class="icon">
            <i class="fa fa-feed"></i>
          </div>
          <a href="<?php echo base_url(); ?>Member" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    
    <div class="">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3>&#8377; &nbsp;&nbsp;<?php echo number_format($purchase_total,2);  ?></h3>
            <p>Total Purchase</p>
          </div>
          <div class="icon">
            <i class="fa fa-recycle"></i>
          </div>
          <a href="<?php echo base_url(); ?>Purchaseitem" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>&#8377; &nbsp;&nbsp;<?php echo number_format($sales_total,2);  ?></h3>
            <p>Total Sales</p>
          </div>
          <div class="icon">
            <i class="fa fa-sliders"></i>
          </div>
          <a href="<?php echo base_url(); ?>Sale" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

   

    <div class="">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $product_count;  ?></h3>
            <p>Total Products</p>
          </div>
          <div class="icon">
            <i class="fa fa-ravelry"></i>
          </div>
          <a href="<?php echo base_url(); ?>Stock" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    </div>

    <!-------------------------------------------->

    <div id="chartContainer" style="height: 370px; width: 100%;"></div>

  </div>
        <?php } ?>
       
  </section>
  <!-- /.content -->
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

   <script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Sale Report"
	},
	axisY: {
		title: "Revenue (in INR)",
		includeZero: true,
		prefix: "INR",
		
	},
	data: [{
		type: "bar",
		yValueFormatString: "INR#,##0",
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontWeight: "bolder",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
