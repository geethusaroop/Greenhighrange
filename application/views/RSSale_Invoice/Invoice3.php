<?php
class numbertowordconvertsconver {
    function convert_number($number)
    {
        if (($number < 0) || ($number > 999999999))
        {
            throw new Exception("Number is out of range");
        }
        $giga = floor($number / 1000000);
        // Millions (giga)
        $number -= $giga * 1000000;
        $kilo = floor($number / 1000);
        // Thousands (kilo)
        $number -= $kilo * 1000;
        $hecto = floor($number / 100);
        // Hundreds (hecto)
        $number -= $hecto * 100;
        $deca = floor($number / 10);
        // Tens (deca)
        $n = $number % 10;
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
                $result .= $ones[$deca * 10 + $n];
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
          <!-- <h2 class="page-header">
            <i class="fa fa-file"></i> <b>Invoice #<?php echo $records[0]->invoice_number;?></b>
            <small class="pull-right">Date: <?php echo date('d-m-Y');?></small>
          </h2> -->
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <!-- <div class="row invoice-info"> -->
      <div class="row">
        <div class="col-md-12">
          <small class="pull-right"><b>CIN:UO1100KL2016PTC04526</b></small><br>
          <center style="color:#cb262d;">
            <h4><b>Venad Poultry Farmers Producer Company LTD</b></h4>
            <p>[FPO Established under Govt of India scheme by NABARD and Kerala Agri University]</p>
            <p>NO.XIV/542,Opp.Rlwy Station Kottarakara, Kollam, Kerala - 691506, Br.Ezhammile, Kadampanad</p>
            <p>Ph:8111884656, 8111884441, 8111884442, Email:veandpfpc@gmail.com</p>
          </center>
          <b>GSTIN: 32AAFCV4857J1Z1</b><br>
          <p class="pull-right">Date: <?php if(isset($records[0]->sale_date)){ $pr_date = str_replace('-', '/', $records[0]->sale_date); $pr_date =  date("d/m/Y",strtotime($pr_date));  echo $pr_date; }?></p>
          Invoice No. <b><?php echo $records[0]->invoice_number;?></b>
          <br><br>
          Buyer Details: <strong><?php echo strtoupper(@$records[0]->custname);?></strong>,
           <?php echo @$records[0]->custaddress;?>,
          , Phone: <?php echo @$records[0]->custphone;?>
          , Email: <?php echo @$records[0]->custemail;?>
      </div>
    </div>
    <br>
      <!-- /.row -->
      <!-- Table row -->
      <div class="row">
          <table width="100%" style="border-right:1px solid #ddd;border-left: 1px solid #ddd;">
            <thead>
           <tr style="border-top: 1px solid #ddd;border-bottom:  1px solid #ddd;">
              <th style="border-right: 1px solid #ddd;padding: 10px;">S.No.</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;">Particular or Discription of Goods</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;text-align: right;">HSN/SAC</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;">Unit Price</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;">Rate After Discount</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;text-align:center;">QTY</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;">Amount</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;">GST%</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;text-align:center;">TAX Amount</th>
              <th style="border-right: 1px solid #ddd;padding: 10px;">Total Amount</th>
          </tr>
            </thead>
            <tbody>
              <tr style="border-bottom:  1px solid #ddd;"></tr>
              <?php $sum = 0; for($i=0;$i<count($records);$i++){?>
            <tr>
              <td style="border-right: 1px solid #ddd;padding: 10px;"><?php echo $j = $i + 1;?></td>
              <td style="border-right: 1px solid #ddd;padding: 10px;font-weight: bold;"><?php echo strtoupper($records[$i]->item_name); ?></td>
              <td style="border-right: 1px solid #ddd;padding: 10px;font-weight: bold;"><?php echo strtoupper($records[$i]->sale_hsn); ?></td>
              <td style="border-right: 1px solid #ddd;padding: 10px;">Rs.<?php echo $records[$i]->sale_price; ?></td>
              <td style="border-right: 1px solid #ddd;padding: 10px;">Rs.<?php echo $records[$i]->discount_price; ?></td>
              <td style="border-right: 1px solid #ddd;padding: 10px;"><?php echo $records[$i]->sale_quantity; ?></td>
              <td style="border-right: 1px solid #ddd;padding: 10px;"><?php echo $records[$i]->total_price; ?></td>
              <td style="border-right: 1px solid #ddd;padding: 10px;"><?php echo $records[$i]->sale_price-$records[$i]->discount_price; ?>%</td>
              <td style="border-right: 1px solid #ddd;padding: 10px;">Rs.<?php echo $records[$i]->taxamount; ?></td>
              <td style="border-right: 1px solid #ddd;padding: 10px;font-weight: bold;">Rs.<?php echo $records[$i]->total_price; ?></td>
            </tr>
            <?php $sum += $records[$i]->total_price; } ?>
          <tr> <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;"></td>
            <td style="border-right: 1px solid #ddd;padding :100px;"></td>
          </tr>
            </tbody>
            <tfoot style="font-weight: bold;border-top:  1px solid #ddd;border-bottom: 1px solid #ddd;">
              <tr style="">
                <td style="border-right: 1px solid #ddd;" colspan="8"></td>  <td style="border-right: 1px solid #ddd;text-align: center;">Total</td><td style="padding: 10px;border-right: 1px solid #ddd;text-align: right;"><i class="fa fa-inr"></i><?php echo $sum; ?></td>
              </tr>
            </tfoot>
          </table>
           <table width="100%" style="border-right:1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;">
            <tr>
              <td style="padding: 10px;">Amount Chargable (In Words)<br>
                <span style="font-weight: bold;">Three Thousand Six Hundred and Twenty Rupees Only/-</span>
              </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
           </table>
           <div class="row">
             <div class="col-md-6">
               <table width="100%" style="border-right:1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;">
                 <tr style="padding: 10px;border-bottom: 1px solid #ddd;">
                   <th style="border-right: 1px solid #ddd;padding: 10px;">TAX AMOUNT</th>
                   <th style="border-right: 1px solid #ddd;padding: 10px;">TAXABLE</th>
                   <th style="border-right: 1px solid #ddd;padding: 10px;">CGST</th>
                   <th style="border-right: 1px solid #ddd;padding: 10px;">SGST</th>
                 </tr>
               <tr style="font-weight: bold;height:120px;">
                 <?php
                    $igst_amount=intval($sum)*intval($records[0]->sale_igst)/100;
                  ?>
                 <td style="border-right: 1px solid #ddd;padding: 10px;"><?php echo $igst_amount; ?>%</td>
                 <td style="border-right: 1px solid #ddd;padding: 10px;"><i class="fa fa-inr"></i><?php echo $sum; ?></td>
                 <?php
                    $cgst_amount=intval($sum)*intval($records[0]->sale_cgst)/100;
                    $sgst_amount=intval($sum)*intval($records[0]->sale_sgst)/100;
                  ?>
                 <td style="border-right: 1px solid #ddd;padding: 10px;">&#8377;<?php echo $cgst_amount; ?></td>
                 <td style="border-right: 1px solid #ddd;padding: 10px;">&#8377;<?php echo $sgst_amount; ?></td>
               </tr>
                </table>
             </div>
             <div class="col-md-6">
               <table width="100%">
                 <tr>
                   <br><br><br><br><br><br>
                   <td><center>Authorised Signatory & Seal<center></td>
                 </tr>
               </table>
             </div>
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
          <button type="button" id="genpdf" class="btn btn-success pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
      <a href="<?php echo base_url();?>Salekss" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> Go to View</a>
         </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
