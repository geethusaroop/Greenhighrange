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
<style media="all">
    .page-header {
    padding-bottom: 9px;
    margin: 40px 0 20px;
     border-bottom: 1px solid #eee; 
}

</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>BRSale/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="invoice" >
      <!-- title row -->
      <div id="divName">
<div class="inner" id="invcont" style="font-weight:bold;">
     <div class="row">
        <div class="col-sm-12">
            <h2 class="page-header">
                <center><strong style="font-size: 18px;">
                <?php echo strtoupper("GREENHIGHRANGE FARMERS PRODUCER COMPANY LIMITED"); ?></strong>
                <br><span style="font-weight: bold;font-size: 16px;">[FPO Established under Govt of India scheme by NABARD and Peermade Development Society]</span>
                <br><span style="font-weight: bold;font-size: 16px;">Green Highrange Farmer Producer Company Ltd,Building No, 106/14,Vakachuvadu, Prabhacity,Kanjikuzhy,Idukki, Kerala - 685606</span>
                <br><span style="font-weight:bold;font-size: 16px;"> Ph:+91 7907753352, Email:greenhighrangeidk@gmail.com
                <br></span>
                <span style="font-weight: bold;font-size: 16px;">GSTIN:32BWUPG1355F1ZM</span><br>
                <span style="font-weight: bold;font-size: 16px;">CIN:U01100KL2021PTC071331</span>
              </center>
                
            </h2>
            
        </div>
     </div>
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

                <td style="padding :2px;font-size: 14px;"><strong>Date</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;<span style="color:black;font-style: 'Times New Roman', Times, serif;"><?php if(isset($records[0]->sale_date)){ $pr_date = str_replace('-', '/', $records[0]->sale_date); $pr_date =  date("d/m/Y",strtotime($pr_date));  echo $pr_date; }?></span></td>
               
            </tr>
            <tr>
                  <td style="padding :2px;font-size: 14px;"><strong>Address</strong>&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;&nbsp;<span style="color:black;font-style: 'Times New Roman', Times, serif;"><?php echo $records[0]->member_address;?></span></td>
                  <td style="padding :2px;font-size: 14px;"><center><b style="margin-right:60px;color:black;border:ridge;border-color:#474747;padding-left:50px;padding-right:50px;padding-top:5px;padding-bottom:5px;font-style: 'Times New Roman', Times, serif;">CASH BILL</b></center></td>

                   <td style="padding :2px;"><b style="color:black"></b></td>
                   <td style="padding :2px;"><b style="color:black"></b></td>
                     <td style="padding :2px;"><b style="color:black"></b></td>
                        <td style="padding :2px;"><b style="color:black"></b></td>

                <td style="padding :2px;font-size: 14px;"><strong>Bill No</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;<span style="color:black"><?php echo $records[0]->invoice_number;?></span></td>
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

    
    <div class="col-lg-12">
        <table class="" width="100%" cellpadding="2" cellspacing="0" style="text-transform: uppercase;">
           
         

            <tr style="border:ridge;">
                <th style="text-align: left;padding :2px;border:ridge;font-size: 14px;">SL.No</th>
                <th style="text-align: left;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">Description of Goods</th>
                <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">QTY</th>
                <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">RATE</th>
                <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">Discount(%)</th>
                <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">Taxable_Amount</th>
                <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">GST%</th>
                <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">TaxAmt</th>
                <th style="text-align: right;padding :2px;border:ridge;text-transform:uppercase;font-size: 14px;">TOTAL</th>
            </tr>
                
                <?php $sum = 0; $quantity_sum = 0;$dis=0; $cgst=0; $cgst_amt=0; $totcgst =0;$hsn=0;$i=0;  foreach($records as $value){ $i=$i+1;?>
            <tr style="border:ridge;">
              <td style="padding :2px;text-align: left;border:ridge;font-size: 14px;"><?php echo $i;?></td>
              <td style="padding :2px;text-align: left;border:ridge;font-size: 14px;"><?php echo $value->product_name; ?></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $value->sale_quantity; ?></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $value->sale_price; ?></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $value->discount_price; ?></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $value->taxamount; ?></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $value->sale_igst; ?></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $value->sale_igstamt; ?></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo ($value->total_price); ?></td>
            </tr>
        <?php $sum = $sum + ($value->sale_price *$value->sale_quantity);
              $dis=$dis+$value->discount_price;
              $v=$sum-$dis;
              $quantity_sum = $quantity_sum + $value->sale_quantity;} ?>

              <tr style="font-weight: bold;">
              <td style="padding :2px;text-align: left;border:ridge;font-size: 14px;"></td>
              <td style="padding :2px;text-align: left;border:ridge;font-size: 14px;">Total</td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $quantity_sum; ?></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
              <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo ($records[0]->sale_netamt); ?></td>
              </tr>
          </table>
        
        </div> 



<div class="col-lg-12">
        <table class="" width="100%" cellpadding="2" cellspacing="0">
       
            

            <?php $ttax=0; $cgst=0;$sgst=0;$ta=0;for($i=0;$i<count($records);$i++){?>

            <?php  $ttax=$ttax+($records[$i]->sale_price *$records[$i]->sale_quantity);} ?>

            <tr>
            <td style="padding :2px;"><span style="font-weight: bold;font-size: 14px;">Amount Chargable (In Words)<br>  <?php
  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
$number = ($records[0]->sale_netamt)-($records[0]->sale_discount+$records[0]->sale_shareholder_discount);
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  echo "INR"." ".ucwords($result) . "Only/-";
 ?> </span>
                </td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;">Total Amount</td>
                <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i> <?php echo $records[0]->sale_netamt; ?></td>
                 
            </tr>
            <?php if($records[0]->member_type==1){ ?>
            <tr>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;">Share Holder Discount Amount</td>
                <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i> <?php echo $records[0]->sale_shareholder_discount; ?></td>
            </tr>
            <?php }?>

            <tr>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;">Discount Amount</td>
                <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i> <?php echo $records[0]->sale_discount; ?></td>
            </tr>

            <tr>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;">Net Amount</td>
                <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i> <?php echo ($records[0]->sale_netamt)-($records[0]->sale_discount+$records[0]->sale_shareholder_discount); ?></td>
            </tr>
            <tr>
            <td style="padding :2px;border-bottom: ridge;"></td>
                <td style="padding :2px;border-bottom: ridge;"></td>
                <td style="padding :2px;border-bottom: ridge;"></td>
                <td style="padding :2px;border-bottom: ridge;"></td>
                <td style="padding :2px;border-bottom: ridge;"></td>
                <td style="text-align: right;padding :2px;border-bottom: ridge;font-weight:bold;font-size: 14px;">Received Amount</td>
                <td style="text-align: right;padding :2px;border-bottom: ridge;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i> <?php echo $records[0]->sale_paid_amount; ?></td>
            </tr>

            <tr> 
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
                <td style="padding :2px;"></td>
          </tr>
            
            <tr>
              <td style="padding: 2px;border:none;font-weight:bold;font-size: 14px;">Declaration<br>
              <p style="font-weight: bold;font-size: 14px;">We declare that this invoice shows the actual price of the goods<br> described and that all particulars are true and correct.</p>

              </td> 
              <td style="padding: 2px;border:none;font-weight: bold;"></td> 
            <td style="padding: 2px;border:none;"></td>
            <td style="padding: 2px;border:none;font-weight: bold;"></td> 
            <td style="padding: 2px;border:none;"></td>
            <td style="padding: 2px;border:none;"><span style="float:right;font-weight: bold;font-size: 14px;">Authorised Signatory & Seal</span></td>

          </tr>

          
            
        </table>
        </div>  
    
</div>
</div>
</div>
<hr>
    <div class="row no-print">
        <div class="col-xs-12">
            <a target="_blank" style="cursor: pointer;" class="btn btn-default" id="print" onclick="printDiv('divName');"><i class="fa fa-print"></i> Print</a>
            <a class="btn btn-success pull-right" href="<?php echo base_url();?>BRSale/Pdf_Sale/<?php echo $records[0]->auto_invoice ?>"><i class="fa fa-download"></i> Generate PDF</a>
          <a href="<?php echo base_url();?>BRSale" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> Go to View</a>
        </div>
    </div>

</section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->






