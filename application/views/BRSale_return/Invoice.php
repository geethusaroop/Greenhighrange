<?php
class numbertowordconvertsconver {
    function convert_number($number) 
    {
        if (($number < 0) || ($number > 999999999)) 
        {
            throw new Exception("Number is out of range");
        }
        $giga = floor($number / 500000);
        // Millions (giga)
        $number -= $giga * 500000;
        $kilo = floor($number / 500);
        // Thousands (kilo)
        $number -= $kilo * 500;
        $hecto = floor($number / 50);
        // Hundreds (hecto)
        $number -= $hecto * 50;
        $deca = floor($number / 5);
        // Tens (deca)
        $n = $number % 5;
        // Ones
        $result = "";
        if ($giga) 
        {
            $result .= $this->convert_number($giga) .  "Million";
        }
        if ($kilo) 
        {
            $result .= (empty($result) ? "" : " ") .$this->convert_number($kilo) . " Thousand";
        }
        if ($hecto) 
        {
            $result .= (empty($result) ? "" : " ") .$this->convert_number($hecto) . " Hundred";
        }
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        if ($deca || $n) {
            if (!empty($result)) 
            {
                $result .= " and ";
            }
            if ($deca < 2) 
            {
                $result .= $ones[$deca * 5 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n) 
                {
                    $result .= "-" . $ones[$n];
                }
            }
        }
        if (empty($result)) 
        {
            $result = "zero";
        }
        return $result;
    }
}
?>


<!-- Content Wrapper. Contains page content -->
 <style type="text/css">
   .table>tfoot>tr>td {
    border-top: 1px solid #ffffff;
}
 </style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Return Invoice
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Sale_Return/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Sale Invoice</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="invoice">

      <div id="divName">
       <div class="panel panel-default">
        <div class="panel-body">
      <!-- title row -->
    <div class="inner" id="invcontent">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
          <b style="float:right;text-transform:uppercase;">Sales Return Invoice</b>
          <br>
          <center style="color:#cb262d;">
            <h4><b>GREENHIGHRANGE FARMERS PRODUCER COMPANY LIMITED</b></h4>
            <p>[FPO Established under Govt of India scheme by NABARD and Peermade Development Society]</p>
            <p>Green Highrange Farmer Producer Company Ltd,Building No, 106/14,Vakachuvadu, Prabhacity,Kanjikuzhy,Idukki, Kerala - 685606</p>
            <p>Ph:+91 7907753352, Email:greenhighrangeidk@gmail.com</p>
          </center>
          <b>GSTIN:32BWUPG1355F1ZM</b><br>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
    <div class="col-lg-12">
        <table class="" width="100%" cellpadding="2" cellspacing="0">
            <tr>
                <td style="padding :2px;font-size: 14px;"><strong>Name</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;<span style="color:black;font-style: 'Times New Roman', Times, serif;"><?php echo strtoupper($records[0]->member_name);?></span></td>

                <td style="padding :2px;"><b style="color:black"></b></td>

                 <td style="padding :2px;"><b style="color:black"></b></td>
                   <td style="padding :2px;"><b style="color:black"></b></td>

                     <td style="padding :2px;"><b style="color:black"></b></td>
                        <td style="padding :2px;"><b style="color:black"></b></td>

                <td style="padding :2px;font-size: 14px;"><strong>Date</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;<span style="color:black;font-style: 'Times New Roman', Times, serif;"><?php if(isset($records[0]->sreturn_date)){ $pr_date = str_replace('-', '/', $records[0]->sreturn_date); $pr_date =  date("d/m/Y",strtotime($pr_date));  echo $pr_date; }?></span></td>
               
            </tr>
            <tr>
                  <td style="padding :2px;font-size: 14px;"><strong>Address</strong>&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;&nbsp;<span style="color:black;font-style: 'Times New Roman', Times, serif;"><?php echo $records[0]->member_address;?></span></td>
                  <td style="padding :2px;font-size: 14px;"><center><b style="margin-right:60px;color:black;border:ridge;border-color:#474747;padding-left:50px;padding-right:50px;padding-top:5px;padding-bottom:5px;font-style: 'Times New Roman', Times, serif;">CASH BILL</b></center></td>

                   <td style="padding :2px;"><b style="color:black"></b></td>
                   <td style="padding :2px;"><b style="color:black"></b></td>
                     <td style="padding :2px;"><b style="color:black"></b></td>
                        <td style="padding :2px;"><b style="color:black"></b></td>

                <td style="padding :2px;font-size: 14px;"><strong>Bill No</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;<span style="color:black"><?php echo $records[0]->sreturn_invoice_number;?></span></td>
            </tr>

            <tr>
            <td style="padding :2px;"><b style="color:black"></b></td>
                            <td style="padding :2px;"><b style="color:black"></b></td>

                <td style="padding :2px;"><b style="color:black"></b></td>
                   <td style="padding :2px;"><b style="color:black"></b></td>
                     <td style="padding :2px;"><b style="color:black"></b></td>
                        <td style="padding :2px;"><b style="color:black"></b></td>
                       
                        <td style="padding :2px;"><b style="color:black"></b></td>
            </tr>
            

        </table></div>
      <!-- /.row -->

      <!-- Table row -->
      <br>  <br>
      <div class="col-lg-12">
      <div class="row">
        
      <table class="" width="100%" cellpadding="2" cellspacing="0" style="text-transform: uppercase;">
            <thead>
           <tr style="border-top: 1px solid #ddd;border-bottom:  1px solid #ddd;">
              <th style="border-right: 1px solid #ddd;padding: 2px;">S.No.</th>
        <th style="border-right: 1px solid #ddd;padding: 2px;">ITEM/COMMODITY</th>
              <th style="border-right: 1px solid #ddd;padding: 2px;">RATE</th>
              <th style="border-right: 1px solid #ddd;padding: 2px;">QTY</th>
              <th style="border-right: 1px solid #ddd;padding: 2px;">TAXABLE_AMOUNT</th>

              <th style="border-right: 1px solid #ddd;padding: 2px;">GST%</th>

              <th style="border-right: 1px solid #ddd;padding: 2px;">GST_AMOUNT</th>

        <th style="border-right: 1px solid #ddd;padding: 2px;text-align: right;">TOTAL</th>
            </tr>
            </thead>
            <tbody>
              <tr style="border-bottom:  1px solid #ddd;"></tr>
      <?php $sum = 0; $quantity_sum = 0;$dis=0; $cgst=0; $cgst_amt=0; $totcgst =0;$hsn=0; for($i=0;$i<count($records);$i++){?>
       <tr>
              <td style="border-right: 1px solid #ddd;padding: 2px;"><?php echo $j = $i + 1;?></td>
        <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: normal;"><?php echo strtoupper($records[$i]->product_name); ?></td>
        <td style="border-right: 1px solid #ddd;padding: 2px;"><?php echo $records[$i]->sale_price.".00"; ?></td>
        <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: normal;"><?php echo $records[$i]->sreturn_qty; ?> </td>
        <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: normal;"><?php echo $records[$i]->sreturn_taxamount; ?> </td>
        <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: normal;"><?php echo $records[$i]->sreturn_igst; ?> </td>
        <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: normal;"><?php echo $records[$i]->sreturn_igstamt; ?> </td>
              <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: normal;text-align: right;"><?php echo (($records[$i]->sreturn_taxamount+$records[$i]->sreturn_igstamt)); ?></td>
          </tr>

      <?php //$sum = $sum + $records[$i]->price;
   $sum = $sum +($records[$i]->sreturn_taxamount+$records[$i]->sreturn_igstamt);
        } ?>

          
          </table>
           <table width="100%" style="border-right:1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;">
            
            <tr style="border-bottom:  1px solid #ddd;"></tr>
      <?php $ttax=0; $cgst=0;$sgst=0;$ta=0;for($i=0;$i<count($records);$i++){?>
      

      <?php  $ttax=$ttax+($records[$i]->sreturn_taxamount+$records[$i]->sreturn_igstamt);} ?>

       <tr style="font-weight: bold;">
            <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding:2px;text-align: right;">Total</td>
          <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td> 
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td> 
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
             <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td> 

            <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;text-align: right;" colspan="6"><i class="fa
                    fa-inr"></i> <?php echo $ttax; ?></td>
          </tr>

          
            <tr style="font-weight: bold;">
         
          <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;border-right:1px solid #ddd;text-align: right;">Net Amount</td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td> 
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td> 
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td> 

            <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;text-align: right;" colspan="6"><?php echo  ($records[0]->sreturn_netamt); ?></td>
          </tr>

           

            <tr>
              <td style="padding: 2px;border-bottom: 1px solid #ddd;">E. & O.E.<br>
              <p style="font-weight: bold;">GOODS ONCE SOLD WILLNOT BE TAKEN BACK OR EXCHANGED .</p>

              </td> 
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td> 
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td> 
            <td style="padding: 2px;border-bottom: 1px solid #ddd;font-weight: normal;" colspan="6">For GREEN HIGHRANGE</td> 
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>

          </tr>
           </table>
          
        
        <!-- /.col -->
      </div>
      </div></div>
      <!-- /.row -->

     
     </div>
      <!-- /.row -->
    </div>
  </div>
</div>

      <!-- this row will not appear when printing -->
      <div class="row no-print"><hr>
        <div class="col-xs-12">
          <a target="_blank" class="btn btn-default" id="print" onclick="printDiv('divName');"><i class="fa fa-print"></i> Print</a>
       
      <a href="<?php echo base_url();?>Sale/Returnlist" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> Go to View</a>
         </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






