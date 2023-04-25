<style>
    #invoice-POS {
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        padding: 2mm;
        margin: 0 auto;
        width: 44mm;
        background: #FFF;


        ::selection {
            background: #f31544;
            color: #FFF;
        }

        ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        h1 {
            font-size: 1.5em;
            color: #222;
        }

        h2 {
            font-size: .9em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #top,
        #mid,
        #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #top {
            min-height: 100px;
        }

        #mid {
            min-height: 80px;
        }

        #bot {
            min-height: 50px;
        }

        #top .logo {
            //float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
        }

        .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        .info {
            display: block;
            //float:left;
            margin-left: 0;
        }

        .title {
            float: right;
        }

        .title p {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            //padding: 5px 0 5px 15px;
            //border: 1px solid #EEE
        }

        .tabletitle {
            //padding: 5px;
            font-size: .5em;
            background: #EEE;
        }

        .service {
            border-bottom: 1px solid #EEE;
        }

        .item {
            width: 24mm;
        }

        .itemtext {
            font-size: .5em;
        }

        #legalcopy {
            margin-top: 5mm;
        }



    }
</style>
<?php
class numbertowordconvertsconver
{
    function convert_number($number)
    {
        if (($number < 0) || ($number > 999999999)) {
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
        if ($giga) {
            $result .= $this->convert_number($giga) .  "Million";
        }
        if ($kilo) {
            $result .= (empty($result) ? "" : " ") . $this->convert_number($kilo) . " Thousand";
        }
        if ($hecto) {
            $result .= (empty($result) ? "" : " ") . $this->convert_number($hecto) . " Hundred";
        }
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        if ($deca || $n) {
            if (!empty($result)) {
                $result .= " and ";
            }
            if ($deca < 2) {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n) {
                    $result .= "-" . $ones[$n];
                }
            }
        }
        if (empty($result)) {
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
            <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>Sale/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
            <li class="active">Invoice</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
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
                                <td style="padding :2px;font-size: 14px;"><strong>Name</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;<span style="color:black;font-style: 'Times New Roman', Times, serif;"><?php echo strtoupper($records[0]->member_name); ?></span></td>

                                <td style="padding :2px;"><b style="color:black"></b></td>

                                <td style="padding :2px;"><b style="color:black"></b></td>
                                <td style="padding :2px;"><b style="color:black"></b></td>

                                <td style="padding :2px;"><b style="color:black"></b></td>
                                <td style="padding :2px;"><b style="color:black"></b></td>

                                <td style="padding :2px;font-size: 14px;"><strong>Date</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;<span style="color:black;font-style: 'Times New Roman', Times, serif;"><?php if (isset($records[0]->sale_date)) {
                                                                                                                                                                                                                                                $pr_date = str_replace('-', '/', $records[0]->sale_date);
                                                                                                                                                                                                                                                $pr_date =  date("d/m/Y", strtotime($pr_date));
                                                                                                                                                                                                                                                echo $pr_date;
                                                                                                                                                                                                                                            } ?></span></td>

                            </tr>
                            <tr>
                                <td style="padding :2px;font-size: 14px;"><strong>Address</strong>&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;&nbsp;<span style="color:black;font-style: 'Times New Roman', Times, serif;"><?php echo $records[0]->member_address; ?></span></td>
                                <td style="padding :2px;font-size: 14px;">
                                    <center><b style="margin-right:60px;color:black;border:ridge;border-color:#474747;padding-left:50px;padding-right:50px;padding-top:5px;padding-bottom:5px;font-style: 'Times New Roman', Times, serif;">CASH BILL</b></center>
                                </td>

                                <td style="padding :2px;"><b style="color:black"></b></td>
                                <td style="padding :2px;"><b style="color:black"></b></td>
                                <td style="padding :2px;"><b style="color:black"></b></td>
                                <td style="padding :2px;"><b style="color:black"></b></td>

                                <td style="padding :2px;font-size: 14px;"><strong>Bill No</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;<span style="color:black"><?php echo $records[0]->invoice_number; ?></span></td>
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


                        </table>
                    </div>


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

                            <?php $sum = 0;
                            $quantity_sum = 0;
                            $dis = 0;
                            $cgst = 0;
                            $cgst_amt = 0;
                            $totcgst = 0;
                            $hsn = 0;
                            $i = 0;
                            foreach ($records as $value) {
                                $i = $i + 1; ?>
                                <tr style="border:ridge;">
                                    <td style="padding :2px;text-align: left;border:ridge;font-size: 14px;"><?php echo $i; ?></td>
                                    <td style="padding :2px;text-align: left;border:ridge;font-size: 14px;"><?php echo $value->product_name; ?></td>
                                    <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $value->sale_quantity; ?></td>
                                    <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $value->sale_price; ?></td>
                                    <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $value->discount_price; ?></td>
                                    <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $value->taxamount; ?></td>
                                    <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $value->sale_igst; ?></td>
                                    <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $value->sale_igstamt; ?></td>
                                    <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo ($value->sale_netamt); ?></td>
                                </tr>
                            <?php $sum = $sum + ($value->sale_price * $value->sale_quantity);
                                $dis = $dis + $value->discount_price;
                                $v = $sum - $dis;
                                $quantity_sum = $quantity_sum + $value->sale_quantity;
                            } ?>

                            <tr style="font-weight: bold;">
                                <td style="padding :2px;text-align: left;border:ridge;font-size: 14px;"></td>
                                <td style="padding :2px;text-align: left;border:ridge;font-size: 14px;">Total</td>
                                <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo $quantity_sum; ?></td>
                                <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
                                <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
                                <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
                                <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
                                <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"></td>
                                <td style="text-align: right;padding :2px;border:ridge;font-size: 14px;"><?php echo ($records[0]->total_price); ?></td>
                            </tr>
                        </table>

                    </div>



                    <div class="col-lg-12">
                        <table class="" width="100%" cellpadding="2" cellspacing="0">



                            <?php $ttax = 0;
                            $cgst = 0;
                            $sgst = 0;
                            $ta = 0;
                            for ($i = 0; $i < count($records); $i++) { ?>

                            <?php //$ttax = $ttax + ($records[$i]->sale_price * $records[$i]->sale_quantity);
                            $ttax=$records[0]->total_price;
                            } ?>

                            <tr>
                                <td style="padding :2px;"><span style="font-weight: bold;font-size: 14px;">Amount Chargable (In Words)<br> <?php
                                                                                                                                            /**
                                                                                                                                             * Created by PhpStorm.
                                                                                                                                             * User: sakthikarthi
                                                                                                                                             * Date: 9/22/14
                                                                                                                                             * Time: 11:26 AM
                                                                                                                                             * Converting Currency Numbers to words currency format
                                                                                                                                             */
                                                                                                                                            $number = ($records[0]->sale_net_total);
                                                                                                                                            $no = floor($number);
                                                                                                                                            $point = round($number - $no, 2) * 100;
                                                                                                                                            $hundred = null;
                                                                                                                                            $digits_1 = strlen($no);
                                                                                                                                            $i = 0;
                                                                                                                                            $str = array();
                                                                                                                                            $words = array(
                                                                                                                                                '0' => '', '1' => 'one', '2' => 'two',
                                                                                                                                                '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                                                                                                                                                '7' => 'seven', '8' => 'eight', '9' => 'nine',
                                                                                                                                                '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                                                                                                                                                '13' => 'thirteen', '14' => 'fourteen',
                                                                                                                                                '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                                                                                                                                                '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
                                                                                                                                                '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                                                                                                                                                '60' => 'sixty', '70' => 'seventy',
                                                                                                                                                '80' => 'eighty', '90' => 'ninety'
                                                                                                                                            );
                                                                                                                                            $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
                                                                                                                                            while ($i < $digits_1) {
                                                                                                                                                $divider = ($i == 2) ? 10 : 100;
                                                                                                                                                $number = floor($no % $divider);
                                                                                                                                                $no = floor($no / $divider);
                                                                                                                                                $i += ($divider == 10) ? 1 : 2;
                                                                                                                                                if ($number) {
                                                                                                                                                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                                                                                                                                                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                                                                                                                                    $str[] = ($number < 21) ? $words[$number] .
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
                                                                                                                                            echo "INR" . " " . ucwords($result) . "Only/-";
                                                                                                                                            ?> </span>
                                </td>
                                <td style="padding :2px;"></td>
                                <td style="padding :2px;"></td>
                                <td style="padding :2px;"></td>
                                <td style="padding :2px;"></td>
                                <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;">Total Amount</td>
                                <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i> <?php echo $records[0]->total_price; ?></td>

                            </tr>
                            <?php if ($records[0]->member_type == 1) { ?>
                                <tr>
                                    <td style="padding :2px;"></td>
                                    <td style="padding :2px;"></td>
                                    <td style="padding :2px;"></td>
                                    <td style="padding :2px;"></td>
                                    <td style="padding :2px;"></td>
                                    <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;">Share Holder Discount Amount</td>
                                    <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i> <?php echo $records[0]->sale_shareholder_discount_amount; ?></td>
                                </tr>
                            <?php } ?>

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
                                <td style="text-align: right;padding :2px;font-weight:bold;font-size: 14px;"><i class="fa fa-inr"></i> <?php echo ($records[0]->sale_net_total); ?></td>
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
                <!-- <a target="_blank" style="cursor: pointer;" class="btn btn-info" id="print" onclick="printPOS('<?php echo $records[0]->auto_invoice; ?>');"><i class="fa fa-print"></i> Print POS</a> -->

                <!-- <a href="<?php echo base_url(); ?>Sale/POS_print/<?php echo $records[0]->auto_invoice ?>" target="_blank" style="cursor: pointer;" class="btn btn-info" id="print" ><i class="fa fa-print"></i> Print POS</a> -->
                <!-- <button type="button" class="btn btn-info" onclick="connect();">Print POS</button> -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Print POS</button>
                <a class="btn btn-success pull-right" href="<?php echo base_url(); ?>Sale/Pdf_Sale/<?php echo $records[0]->auto_invoice ?>"><i class="fa fa-download"></i> Generate PDF</a>
                <a href="<?php echo base_url(); ?>Sale" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> Go to View</a>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.5/bluebird.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->

<!--IMPORTANT: BE SURE YOU HONOR THIS JS LOAD ORDER-->
<!-- <script src="https://jsprintmanager.azurewebsites.net/scripts/cptable.js"></script>
    <script src="https://jsprintmanager.azurewebsites.net/scripts/cputils.js"></script>
    <script src="https://jsprintmanager.azurewebsites.net/scripts/JSESCPOSBuilder.js"></script>
    <script src="https://jsprintmanager.azurewebsites.net/scripts/JSPrintManager.js"></script>
    <script src="https://jsprintmanager.azurewebsites.net/scripts/zip.js"></script>
    <script src="https://jsprintmanager.azurewebsites.net/scripts/zip-ext.js"></script>
    <script src="https://jsprintmanager.azurewebsites.net/scripts/deflate.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/js/epos-2.24.0.js"></script> -->

<!-- Modal -->
<div id="myModal" class="modal fade " role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>SALE INVOICE POS</center></h4>
            </div>
            <div class="modal-body">
            <div id="pos_reciepts">
                <div style="width: 300px; margin: 0 auto; border: 1px solid #f2f2f2; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); padding: 15px;" >
                    <div>
                        <h3 style="text-align: center; margin: 0px;font-size: 12px;" ><b>GREENHIGHRANGE FARMERS PRODUCER COMPANY LIMITED<b></h3>
                    </div>

                    <h6 style="text-align: center; font-size: 15px; margin: 5px 0px;font-size: 12px;">Green Highrange Farmer Producer Company Ltd,Building No, 106/14 <br>Vakachuvadu, Prabhacity,Kanjikuzhy,Idukki, Kerala - 685606<br>GSTIN:32BWUPG1355F1ZM<br>CIN:U01100KL2021PTC071331</h6>

                    <h6 style="text-align: center; font-size: 17px; margin:10px 0px">Tel: +91 7907753352 </h6>

                    <div class="row" style="border:1px solid #e0d7d7;font-weight:bold;">
                   
                       <span style="width: 150px;border-bottom:1px solid #e0d7d7;"><center>Tax Invoice</center></span>
                       <table style="text-align: center;border-collapse: collapse;width: 100%;">
                            <tbody>
                          
                                <tr style="border: 1px solid #dddddd;">
                                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;width:50px;">Name</td>
                                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?php echo strtoupper($records[0]->member_name); ?></td>
                                </tr>

                                <tr style="border: 1px solid #dddddd;">
                                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;width:50px;">Address</td>
                                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?php echo $records[0]->member_address; ?></td>
                                </tr>

                                <tr style="border: 1px solid #dddddd;">
                                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;width:50px;">GSTIN</td>
                                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?php echo $records[0]->member_gst; ?></td>
                                </tr>

                                <tr style="border: 1px solid #dddddd;">
                                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;width:50px;">Bill No</td>
                                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?php echo $records[0]->invoice_number; ?></td>
                                </tr>

                                <tr style="border: 1px solid #dddddd;">
                                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;width:50px;">Date</td>
                                    <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?php if (isset($records[0]->sale_date)) { $pr_date = str_replace('-', '/', $records[0]->sale_date);$pr_date =  date("d/m/Y", strtotime($pr_date));echo $pr_date;}; ?></td>
                                </tr>
                                
                            </tbody>
                        </table>
                         
                    

                     
                  <!--   ===================================== -->
                    <table style="border-collapse: collapse;width: 100%;">
                        <tr>
                            <th style="width: 100px ;border: 1px solid #dddddd;text-align: left;padding: 8px;"><center><b>SL.No.</b></center></th>
                            <th style="width: 120px;border: 1px solid #dddddd;text-align: left;padding: 8px;"><center>GOODS</center></th>
                            <th style="width: 120px;border: 1px solid #dddddd;text-align: left;padding: 8px;"><center>RATE</center></th>
                            <th style="width: 120px;border: 1px solid #dddddd;text-align: left;padding: 8px;"><center>QTY</center></th>
                            <th style="width: 120px;border: 1px solid #dddddd;text-align: left;padding: 8px;"><center>TOTAL</center> </td>
                        </tr>
                    </table>
                  <!--   ===================================== -->

                    <table style="text-align: center;border-collapse: collapse;width: 100%;">
                        <tbody>
                            <?php $i=1;$tot = 0; $qty = 0;
                             foreach($records as $rec){
                                 ?>
                            <tr>
                                <td style="width: 100px;border: 1px solid #dddddd;text-align: left;padding: 8px;"><?php echo $i; ?></td>
                                <td style="width: 120px;border: 1px solid #dddddd;text-align: left;padding: 8px;"><?php echo $rec->product_name; ?></td>
                                <td style="width: 120px;border: 1px solid #dddddd;text-align: left;padding: 8px;"><?php echo $rec->sale_price; ?></td>
                                <td style="width: 120px;border: 1px solid #dddddd;text-align: left;padding: 8px;"><?php
                                $qty += $rec->sale_quantity; echo $rec->sale_quantity; ?></td>
                                <td style="width: 120px;border: 1px solid #dddddd;text-align: left;padding: 8px;  text-align: left"><?php $tot+=$rec->total_price; echo $rec->total_price; ?></td>
                            </tr>

                            <tr>
                                        <td colspan="3" style="border: 1px solid #dddddd;">
                                            <center>Total</center>
                                        </td>
                                        <td style="border: 1px solid #dddddd;width: 120px;text-align: left;padding: 8px;"><?php echo $qty; ?></td>
                                        <td style="border: 1px solid #dddddd;width: 120px;text-align: left;padding: 8px;"><?php echo $tot; ?></td>
                                    </tr>
                            <?php $i++; }  ?>
                        </tbody>

                        <tr>
                                    <td style="width: 50px;font-size:9px;border: 1px solid #dddddd;">CGST:</td>
                                    <td style="width: 120px;border: 1px solid #dddddd;">0.00</td>
                                    <td style="width: 120px;font-size:9px;border: 1px solid #dddddd;" colspan="2">Discount:</td>
                                    <td style="width: 120px;border: 1px solid #dddddd;">0.00</td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;font-size:9px;border: 1px solid #dddddd;">SGST:</td>
                                    <td style="width: 120px;border: 1px solid #dddddd;">0.00</td>
                                    <td style="width: 120px;font-size:9px;border: 1px solid #dddddd;" colspan="2">Roundoff:</td>
                                    <td style="width: 120px;border: 1px solid #dddddd;">0.00</td>
                                </tr>
                                <tr>
                                    <td style="width: 120px;border: 1px solid #dddddd;" colspan="4"><?php
                                                                                                                                            /**
                                                                                                                                             * Created by PhpStorm.
                                                                                                                                             * User: sakthikarthi
                                                                                                                                             * Date: 9/22/14
                                                                                                                                             * Time: 11:26 AM
                                                                                                                                             * Converting Currency Numbers to words currency format
                                                                                                                                             */
                                                                                                                                            $number = ($records[0]->sale_netamt) - ($records[0]->sale_discount + $records[0]->sale_shareholder_discount);
                                                                                                                                            $no = floor($number);
                                                                                                                                            $point = round($number - $no, 2) * 100;
                                                                                                                                            $hundred = null;
                                                                                                                                            $digits_1 = strlen($no);
                                                                                                                                            $i = 0;
                                                                                                                                            $str = array();
                                                                                                                                            $words = array(
                                                                                                                                                '0' => '', '1' => 'one', '2' => 'two',
                                                                                                                                                '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                                                                                                                                                '7' => 'seven', '8' => 'eight', '9' => 'nine',
                                                                                                                                                '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                                                                                                                                                '13' => 'thirteen', '14' => 'fourteen',
                                                                                                                                                '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                                                                                                                                                '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
                                                                                                                                                '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                                                                                                                                                '60' => 'sixty', '70' => 'seventy',
                                                                                                                                                '80' => 'eighty', '90' => 'ninety'
                                                                                                                                            );
                                                                                                                                            $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
                                                                                                                                            while ($i < $digits_1) {
                                                                                                                                                $divider = ($i == 2) ? 10 : 100;
                                                                                                                                                $number = floor($no % $divider);
                                                                                                                                                $no = floor($no / $divider);
                                                                                                                                                $i += ($divider == 10) ? 1 : 2;
                                                                                                                                                if ($number) {
                                                                                                                                                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                                                                                                                                                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                                                                                                                                    $str[] = ($number < 21) ? $words[$number] .
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
                                                                                                                                            echo "INR" . " " . ucwords($result) . "Only/-";
                                                                                                                                            ?> </span></td>
                                    <td style="width: 50px;border: 1px solid #dddddd;" colspan=""><?php echo $records[0]->sale_netamt; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 120px;font-size:10px;border: 1px solid #dddddd;" colspan="4">Account No: 346701010170098<br>
                                    IFSC: UBIN0534676<br>
                                    Greenhighrange farmers Producer CO LTD<br>
                                    Union Bank,Idukki
                                </td>
                                    <td style="width: 50px;border: 1px solid #dddddd;" colspan="">E&OE</td>
                                </tr>
                      
                    </table>


                   <!--  ===================================== -->
                   
            </div>
            </div>
            </div>
            <div class="modal-footer">
                <center><button type="button" class="btn btn-success" onclick="printPOS('pos_reciepts');">Print</button></center>
            </div>
        </div>

    </div>
</div>