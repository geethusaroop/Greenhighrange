  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Receipt
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Receipt</li>
      </ol>
    </section>
     <!-- Main content -->
  <section class="invoice">
      <!-- title row -->
    <div class="inner" id="invcontent">
      <div class="row">
        <div class="col-xs-12">
         
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
     
      <!-- Table row -->
        <div id="divName">
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="main" width="100%" cellpadding="0" cellspacing="0" style="background: #fff;
    border: 1px solid #e9e9e9;
    border-radius: 3px;">
                    <tbody><tr>
                        <td class="content-wrap aligncenter" style=" padding: 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody><tr>
                                    <td class="content-block" style="padding: 0 0 20px;">
<center><img src="<?php echo base_url(); ?>/Images/logo.png" align="center" style="width:100px;border-radius: 50px;">
                                      <address><h3 style="margin-top: 3px;"> 
                                          <strong>GREENHIGHRANGE FARMERS PRODUCER COMPANY LIMITED</strong></h3><h4>
                                          No, 106/14,
                                          Vakachuvadu,Prabhacity<br>
                                          Kanjikuzhy, ,Idukki,Kerala,India<br>
                                    PIN:685606<br>Phone:+91 7907753352<br>
                                        </address></h4></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block" style="padding: 0 0 20px;">
                                        <table class="invoices" style=" margin: 40px auto;
    text-align: left;
    width: 80%;">
                                            <tbody>
                                            <tr>
                                                <td style=" padding: 5px 0;">
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tbody>
                                                          <tr>
                                                            <td>Receipt Date</td>
                                                            <td style="font-weight: bold;" class="alignright"><?php echo $records->receipt_date; ?></td>
                                                        </tr>
                                                       
                                                        <tr>
                                                            <td style="padding-top: 20px;">Receipt Head</td>
                                                            <td style="padding-top: 20px;font-weight: bold;" class="alignright"><?php echo "Payment From Member"; ?></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td style="padding-top: 20px;">Amount</td>
                                                            <td style="padding-top: 20px;font-weight: bold;" class="alignright"><i class="fa fa-inr"></i> <?php echo $records->receipt_amount; ?></td>
                                                        </tr>
                                                        
                                                         <tr>
                                                            <td style="padding-top: 20px;">Received From</td>
                                                            <td style="padding-top: 20px;font-weight: bold;" class="alignright"><?php echo $records->member_name; ?></td>
                                                        </tr>
                                                        <tr class="total" style=" border-top: 2px solid #333;
    border-bottom: 2px solid #333;
    font-weight: 700;padding-top: 20px;">
                                                            <td style="padding-top: 20px;" class="alignright" width="80%">TOTAL AMOUNT</td>
                                                            <td style="padding-top: 20px;" class="alignright"><i class="fa fa-inr"></i> <?php echo $records->receipt_amount ; ?></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                               
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
        </div>
      </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <!-- accepted payments column--> 
       <div class="col-xs-4">
			
		</div> 
        <!-- /.col -->
        <div class="col-xs-6">
        
          <div class="table-responsive">
           
          </div>
        </div>
        <!-- /.col -->
      </div>
	   </div>
      <!-- /.row -->
      <!-- this row will not appear when printing -->
      <div class="row no-print"><hr>
        <div class="col-xs-12">
          <a target="_blank" class="btn btn-default" id="print" onclick="printDiv('divName')"><i class="fa fa-print"></i> Print</a>
       
		  <a href="<?php echo base_url();?>Customer_receipt" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> Go to View</a>
         </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
