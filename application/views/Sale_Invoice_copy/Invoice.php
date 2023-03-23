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
        Sale Invoice
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Sale/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
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
           <img src="<?php echo base_url();?>/Images/logo.jpeg" width="50px" style="border-radius: 100%;">
				<br>
				<strong style="color:red;font-size:16px;"><?php echo strtoupper("Venad Poultry Farmers Producer Company Limited"); ?></strong><br><span style="color:purple;font-weight: bold;font-size: 16px;">NoXIV/542,Opposite Kottarakkara Railway Station,<br>Kottarakkara,Kerala,India, PIN:691506
     </span><br><span style="color:purple;font-weight:bold;font-size: 16px;"> Mobile: <?php echo "0474 245 6225"; ?> , E mail: <?php echo "info@venadfarm.com"; ?><br>LIC NO : 11320002000801</span>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-md-4 invoice-col">
          To
          <address>
            <strong><?php echo strtoupper($records[0]->custname);?></strong><br>
            <?php echo $records[0]->custaddress;?><br>
            Phone: <?php echo $records[0]->custphone;?><br>
            Email: <?php echo $records[0]->custemail;?>
          </address>
        </div>
        <!-- /.col -->
       <div class="col-md-4 invoice-col"></div>
        <!-- /.col -->
        <div class="col-md-4 invoice-col">Invoice
          <address>
          <b>Invoice #<?php echo $records[0]->invoice_number;?></b><br>
         <b>Date: <?php if(isset($records[0]->sale_date)){ $pr_date = str_replace('-', '/', $records[0]->sale_date); $pr_date =  date("d/m/Y",strtotime($pr_date));  echo $pr_date; }?></b><br>
       </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">

          <table width="100%" style="border-right:1px solid #ddd;border-left: 1px solid #ddd;">
            <thead>
              <tr style="border-top: 1px solid #ddd;border-bottom:  1px solid #ddd;">
              <th style="border-right: 1px solid #ddd;padding: 2px;">S.No.</th>
              <th style="border-right: 1px solid #ddd;padding: 2px;">Product Name</th>
              <th style="border-right: 1px solid #ddd;padding: 2px;">HSN/SAC</th>
              <th style="border-right: 1px solid #ddd;padding: 2px;text-align: right;">Quantity</th>
              <th style="border-right: 1px solid #ddd;padding: 2px;">Price</th>
              <th style="border-right: 1px solid #ddd;padding: 2px;">Discount</th>
              <th style="border-right: 1px solid #ddd;padding: 2px;">Tax</th>
              <th style="border-right: 1px solid #ddd;padding: 2px;text-align: right;">Amount</th>
            </tr>
            </thead>
            <tbody>
              <tr style="border-bottom:  1px solid #ddd;"></tr>
      <?php $sum = 0; $quantity_sum = 0; $cgst=0; $cgst_amt=0; $totcgst =0;$hsn=0; for($i=0;$i<count($records);$i++){?>
       <tr>
              <td style="border-right: 1px solid #ddd;padding: 2px;"><?php echo $j = $i + 1;?></td>
              <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: bold;"><?php echo strtoupper($records[$i]->product_name); ?></td>
              <td style="border-right: 1px solid #ddd;padding: 2px;"><?php echo strtoupper($records[$i]->hsn); ?></td>
              <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: bold;text-align: right;"><?php echo $records[$i]->sale_quantity; ?> .Nos</td>
              <td style="border-right: 1px solid #ddd;padding: 2px;">Rs.<?php echo $records[$i]->sale_price; ?></td>
              <td style="border-right: 1px solid #ddd;padding: 2px;"><?php echo $records[$i]->discount_price; ?> %</td>
              <td style="border-right: 1px solid #ddd;padding: 2px;"><?php echo $records[$i]->taxamount; ?> %</td>
              <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: bold;text-align: right;"><?php echo $records[$i]->total_price; ?></td>
          </tr>

      <?php $sum = $sum + $records[$i]->total_price;
          $quantity_sum = $quantity_sum + $records[$i]->sale_quantity;$cgst=($records[$i]->taxamount)/2; $cgst_amt=$sum * ($cgst/50);$totcgst=$totcgst + $records[$i]->taxamount;$hsn=$records[$i]->hsn; } ?>

           <tr>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
             <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
            <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: bold;"></td>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td> <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
             <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: bold;text-align: right;border-top:1px solid #ddd; "><?php echo $sum; ?></td>
            </tr>
           <tr>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td>

            <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: bold;text-align: right;">SGST(<?php echo $cgst." "."%"; ?>)</td>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
             <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td> <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
             <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: bold;text-align: right;"><?php echo $cgst_amt; ?></td>
            </tr>

             <tr>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
            <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: bold;text-align: right;">CGST(<?php echo $cgst." "."%"; ?>)</td>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
            <td style="border-right: 1px solid #ddd;padding: 2px;"></td> <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
             <td style="border-right: 1px solid #ddd;padding: 2px;font-weight: bold;text-align: right;"><?php echo $cgst_amt; ?></td>
            </tr>

          <tr> <td style="border-right: 1px solid #ddd;"></td>
          	 <td style="border-right: 1px solid #ddd;padding: 2px;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;padding :50px;"></td>
          </tr>
            </tbody>
            <tfoot style="font-weight: bold;border-top:  1px solid #ddd;border-bottom: 1px solid #ddd;">

              <tr style="">
                <td style="border-right: 1px solid #ddd;"></td> <td style="border-right: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;text-align: center;">Total</td>  <td style="border-right: 1px solid #ddd;text-align: right;"><?php echo $quantity_sum." "."Nos"; ?></td>  <td style="border-right: 1px solid #ddd;"></td>  <td style="border-right: 1px solid #ddd;"></td>
                   <td style="border-right: 1px solid #ddd;"></td><td style="padding: 2px;border-right: 1px solid #ddd;text-align: right;"><i class="fa
                    fa-inr"></i> <?php echo ($sum+$cgst_amt+$cgst_amt); ?></td>
              </tr>


            </tfoot>
          </table>
           <table width="100%" style="border-right:1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;">
            <tr>
              <td style="padding: 2px;border-bottom: 1px solid #ddd;">Amount Chargable (In Words)<br>
                <?php $class_obj = new numbertowordconvertsconver();
                $convert_number = $sum+$cgst_amt+$cgst_amt;?><span style="font-weight: bold;"> <?php echo "INR". " ".$class_obj->convert_number($convert_number)." "."Only";?></span>

              </td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;" colspan="6"></td>

          </tr>
          <tr style="font-weight: bold;">
          	 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;" colspan="2">HSN/SAC</td>
          	 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;">Taxable Amount</td>
          	 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;" colspan="2">Central Tax</td>
          	 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;" colspan="2">State Tax</td>
          	  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;">Total Tax Amount</td>
          </tr>
          <tr style="font-weight: bold;">
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;" colspan="2"></td>
          	 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;"></td>
          	 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;">Rate </td>
          	 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;">Amount </td>
          	  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;">Rate </td>
          	 <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;">Amount </td>
          	  <td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;"></td></tr>
          <tr style="font-weight: bold;">
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;" colspan="2"><?php echo $hsn ?></td>
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;"></td>
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;border-right:1px solid #ddd; "><?php echo $cgst." "."%"; ?></td>
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;border-right:1px solid #ddd; "><?php echo $cgst_amt; ?></td>
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;border-right:1px solid #ddd; "><?php echo $cgst." "."%"; ?></td>
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;border-right:1px solid #ddd; "><?php echo $cgst_amt; ?></td>
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;text-align: right;"><?php echo $cgst_amt; ?><br><?php echo $cgst_amt; ?></td>
          </tr>
          <tr style="font-weight: bold;">
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding:2px;" colspan="2">Total</td>
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding:2px;"></td>
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding:2px;border-right:1px solid #ddd;text-align: right; " colspan="2"><?php echo $cgst_amt; ?></td>
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;border-right:1px solid #ddd;text-align: right;  " colspan="2"><?php echo $cgst_amt; ?></td>
          	<td style="border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 2px;text-align: right;"><?php echo $cgst_amt+ $cgst_amt; ?></td>
          </tr>

            <tr>
              <td style="padding: 2px;border-bottom: 1px solid #ddd;">Tax Amount (In Words)<br>
                <?php $class_obj = new numbertowordconvertsconver();
                $convert_number = $cgst_amt+$cgst_amt;?><span style="font-weight: bold;"> <?php echo "INR". " ".$class_obj->convert_number($convert_number)." "."Only";?></span>

              </td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;" colspan="6"></td>

          </tr>

          <tr>
              <td style="padding: 2px;border-bottom: 1px solid #ddd;">Paid Amount<br>
                <?php $class_obj = new numbertowordconvertsconver();
                ?><span style="font-weight: bold;"> <?php echo "INR". " ".$records[0]->customer_paid_amt."";?></span>

              </td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;" colspan="6"></td>

          </tr>

          <tr>
              <td style="padding: 2px;border-bottom: 1px solid #ddd;">Old Balance<br>
                <?php $class_obj = new numbertowordconvertsconver();
                ?><span style="font-weight: bold;"> <?php echo "INR". " ".$records[0]->customer_old_bal."";?></span>

              </td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;" colspan="6"></td>

          </tr>

            <tr>
              <td style="padding: 2px;border-bottom: 1px solid #ddd;">Declaration<br>
              <p style="font-weight: bold;">We declare that this invoice shows the actual price of the
              goods described and that all particulars are true and correct</p>

              </td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;font-weight: bold;" colspan="6">For Venad Poultry Farmers Producer Company Limited</td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>
            <td style="padding: 2px;border-bottom: 1px solid #ddd;"></td>

          </tr>
           </table>


        <!-- /.col -->
      </div>
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
          <button type="button" id="genpdf" class="btn btn-success pull-right" style="margin-right: 2px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
      <a href="<?php echo base_url();?>Sale" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> Go to View</a>
         </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
