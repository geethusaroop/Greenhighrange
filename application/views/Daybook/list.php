<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Day Book
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Daybook"><i class="fa fa-dashboard"></i> Back to List</a></li>
      <li class="active"> Day Book</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <form name="" method="post" action="<?php echo base_url(); ?>Daybook/getdaybook">
        <div class="box">
          <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
            <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
            <div class="col-md-4">
              <h2 class="box-title"></h2>
            </div>
            <div class="col-md-4">
              <div class="input-group margin">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-primary nohover">Date</button>
                </div><!-- /btn-group -->
                <input type="date" class="form-control" id="daybuk_date" name="daybuk_date" value="<?php if (isset($sdate)) {
                                                                                                      echo  $sdate;
                                                                                                    }  ?>" style="font-weight: bold;font-size: 16px;">
              </div><!-- /input-group -->
            </div>
            <div class="col-md-4">
              <div class="input-group margin">
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-primary nohover" id="search">Search</button>
                  <!--<span style="padding-left: 20px;">
                 <a href="<?php echo base_url(); ?>GDaybook/view" class="btn btn-success">  Search for prev</a>
               </span> -->
                </div>
              </div><!-- /input-group -->
            </div>
          </div>
          <!-- /.box-header -->
      </form>
      <div class="box-body">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
          <table class="table table-bordered table-striped" style="border-color:#d4d6d5;">
            <thead>
              <tr>
                <th colspan="4" style="border-color:#d4d6d5;">
                  <center>DAYBOOK</center>
                </th>
              </tr>
              <tr>

                <th style="border-color:#d4d6d5;">LEDGER NAME</th>
                <th style="border-color:#d4d6d5;">BILL NO</th>
                <th style="border-color:#d4d6d5;">RECEIPTS</th>
                <th style="border-color:#d4d6d5;">PAYMENTS</th>
              </tr>
              <tr style="font-weight: bold;color:red;">

                <td style="border-color:#d4d6d5;"><strong>Opening Balance</strong></td>
                 <td style="border-color:#d4d6d5;"></td>
                <?php $obalance = 0;
                $obalance1 = 0; ?>
                <!-- <td style="border-color:#d4d6d5;"><?php if (isset($opening->closing_amount)) {
                                                          if ($opening->credit == 2) {
                                                            echo $opening->closing_amount;
                                                            $obalance = $obalance + $opening->closing_amount;
                                                          }
                                                        } else {
                                                          echo "0";
                                                          $obalance;
                                                        } ?></td>
                    <td style="border-color:#d4d6d5;"><?php if (isset($opening->closing_amount)) {
                                                        if ($opening->credit == 1) {
                                                          echo $opening->closing_amount;
                                                          $obalance = $obalance + $opening->closing_amount;
                                                        }
                                                      } else {
                                                        echo "0";
                                                        $obalance;
                                                      } ?></td>-->
                <td style="border-color:#d4d6d5;"><?php if (isset($opening)) {
                                                    if ($opening->credit_status == 2) {
                                                      echo $opening->closing_amt;
                                                    }
                                                  } ?></td>
                <td style="border-color:#d4d6d5;"><?php if (isset($opening)) {
                                                    if ($opening->credit_status == 1) {
                                                      echo $opening->closing_amt;
                                                    }
                                                  } ?></td>
              </tr>
            </thead>
            <tbody style="font-weight: bold;">
              <?php
              $tvoucher = 0; //debit
              $treceipt = 0;
              $purchase = 0;
              $return = 0;
              $sreturn = 0;
              $feedpurchase = 0;
              $test = 0;
              $sal = 0;
              $adv = 0;
              $vvoucher=0;
              $bankdep=0;
              $sfund=0;
              $tfund=0;
              $mbtsale=0;
              $creceipt=0;
              ?>
              <?php foreach ($payroll as $rows1) {if($rows1->salary!=0){ ?>
                <tr>

                  <td style="border-color:#d4d6d5;">TOTAL SALARY PAID TO EMPLOYEES </td>
                   <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php if(!empty($rows1->salary)){ echo $rows1->salary; } else { echo 0; } ?></td>
                </tr>
              <?php $sal = $sal + $rows1->salary;
              }} ?>
              <?php foreach ($advance as $rows1) {if($rows1->adv_amount!=0){ ?>
                <tr>

                  <td style="border-color:#d4d6d5;">ADVANCE SALARY PAID TO EMPLOYEES</td>
                   <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php if(!empty($rows1->adv_amount)){  echo $rows1->adv_amount; } else { echo 0; } ?></td>
                </tr>
              <?php $adv = $adv + $rows1->adv_amount;
              }} ?>
              <?php foreach ($purc as $rows1) {if($rows1->pur_paid_amt!=0){ ?>
                <tr>

                  <td style="border-color:#d4d6d5;">Purchase Items from <?php echo $rows1->vendorname; ?></td>
                  <td style="border-color:#d4d6d5;"><?php echo $rows1->invoice_number; ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php if($rows1->pur_paid_amt){ echo $rows1->pur_paid_amt; } else { echo 0; } ?></td>
                </tr>
              <?php $purchase = $purchase + $rows1->pur_paid_amt;
              }} ?>
             
              <?php foreach ($saleincome as $rows) {if($rows->total_amount!=0){ ?>
                <tr>

                  <td style="border-color:#d4d6d5;"><?php echo "Sale Income"; ?></td>
                 <td style="border-color:#d4d6d5;"><?php echo $rows->invoice_number; ?></td>
                  <td style="border-color:#d4d6d5;"><?php if(!empty($rows->total_amount)) { echo $rows->total_amount; } else { echo 0; } ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                </tr>
              <?php $test = $test + $rows->total_amount;
              }} ?>

            <?php foreach ($mbtsaleincome as $rows) {if($rows->total_amount!=0){ ?>
                <tr>
                  <td style="border-color:#d4d6d5;"><?php echo "Master To Branch Sale Income- ".$rows->branch_name." "."Branch"; ?></td>
                 <td style="border-color:#d4d6d5;"><?php echo $rows->invoice_number; ?></td>
                  <td style="border-color:#d4d6d5;"><?php if(!empty($rows->total_amount)) { echo $rows->total_amount; } else { echo 0; } ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                </tr>
              <?php $mbtsale = $mbtsale + $rows->total_amount;
              }} ?>

            <?php foreach ($bdeposit as $rows) {if($rows->bd_amount!=0){ ?>
                <tr>

                  <td style="border-color:#d4d6d5;"><?php echo "Amount Deposited to" .$rows->bank_name; ?></td>
                    <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php echo $rows->bd_amount; ?></td>
                </tr>
              <?php $bankdep = $bankdep + $rows->bd_amount;
              }} ?>

              <?php foreach ($share_deposit as $rows) {if($rows->member_share_no_shares!=0){ ?>
                <tr>

                  <td style="border-color:#d4d6d5;"><?php echo "Share Holder Fund"; ?></td>
                    <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php echo $rows->member_share_no_shares; ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                </tr>
              <?php $sfund = $sfund + $rows->member_share_no_shares;
              }} ?>

              <?php foreach ($fund as $rows) {if($rows->fund_amount!=0){ ?>
                <tr>

                  <td style="border-color:#d4d6d5;"><?php $rows->ftype_name; ?></td>
                    <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php echo $rows->fund_amount; ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                </tr>
              <?php $tfund = $tfund + $rows->fund_amount;
              }} ?>

                <?php foreach($venodr_voucher as $row){if($row->voucher_amount!=0){ ?>
                  <tr>
                   <td style="border-color:#d4d6d5;"><?php echo $row->vendorname; ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo $row->voucher_group; ?></td>
                 <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php echo /*(int)*/$row->voucher_amount; ?></td>
                </tr>
              <?php $vvoucher=$vvoucher+$row->voucher_amount;}} ?>

              <?php foreach($customer_receipt as $row){if($row->receipt_amount!=0){ ?>
                  <tr>
                   <td style="border-color:#d4d6d5;"><?php echo "Purchase Amount Paid By-". $row->member_name; ?></td>

                   <td style="border-color:#d4d6d5;"><?php echo $row->receipt_group; ?></td>
                 
                  <td style="border-color:#d4d6d5;"><?php echo /*(int)*/$row->receipt_amount; ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                </tr>
              <?php $creceipt=$creceipt+$row->receipt_amount;}} ?>
              <!-------------------------------------------------------------------------------------------------------->
              <?php foreach ($voucher as $row) { ?>
                <tr>

                  <td style="border-color:#d4d6d5;"><?php echo $row->vouch_head; ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo $row->voucher_number; ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php echo $row->voucher_amount; ?></td>
                </tr>
              <?php $tvoucher = $tvoucher + $row->voucher_amount;
              } ?>
              <!-------------------------------------------------------------------------------------------------------->
              <?php foreach ($receipt as $rows) { ?>
                <tr>

                  <td style="border-color:#d4d6d5;"><?php echo $rows->receipt_head; ?></td>
                    <td style="border-color:#d4d6d5;"><?php echo $rows->receipt_number; ?></td>
                  <td style="border-color:#d4d6d5;"><?php echo $rows->receipt_amount; ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                </tr>
              <?php $treceipt = $treceipt + $rows->receipt_amount;
              } ?>
            </tbody>
            <tfoot>
              <?php
              if (isset($opening)) {
                if ($opening->credit_status == 2) {
                  $obalance = $opening->closing_amt;
                } else {
                  $obalance = 0;
                }
              }
              if (isset($opening)) {
                if ($opening->credit_status == 1) {
                  $obalance1 = $opening->closing_amt;
                } else {
                  $obalance1 = 0;
                }
              }
              $credit = $treceipt + $obalance + $test+$sfund+$tfund+$mbtsale+$creceipt;
              $debit = $tvoucher + $obalance1 + $purchase + $feedpurchase + $sal + $adv+$vvoucher+$bankdep;
              //$credit_sum=
              // $credit_to=$obalance+$credit;
              //$outstanding=$credit_to-$debit;
              $outstanding = $credit - $debit;
              if ($outstanding < 0) {
                //$profit=$debit-$credit_to;
                $profit = $debit - $credit;
                $loss = 0;
                // $ctotal=$credit_to+$profit;
                $ctotal = $credit + $profit;
                $dtotal = $debit + $loss;
                $stat = 1; //
              } else {
                $profit = 0;
                //$loss=$credit_to-$debit;
                //$ctotal=$credit_to-$profit;
                $loss = $credit - $debit;
                $ctotal = $credit - $profit;
                $dtotal = $debit + $loss;
                $stat = 2;
              }
              ?>
              <tr>
                <td style="border-color:#d4d6d5;"></td>
                <td style="border-color:#d4d6d5;font-weight: bold;color:blue;">TOTAL</td>
                <td style="border-color:#d4d6d5;"><b style="color:blue;"><?php echo $credit; ?></b> </td>
                <td style="border-color:#d4d6d5;"><b style="color:blue;"><?php echo $debit; ?></b> </td>
              </tr>
              <tr style="font-weight: bold;color:red;">
                <td style="border-color:#d4d6d5;"></td>
                <td style="border-color:#d4d6d5;"><strong>Closing Balance</strong></td>
                <td style="border-color:#d4d6d5;"></td>
                <td style="border-color:#d4d6d5;"><?php echo $outstanding; ?>
                  <!--<input type ="hidden" id="profit_amt" value="<?php if ($outstanding < 0) {
                                                                      echo $profit;
                                                                    } else {
                                                                      echo $loss;
                                                                    } ?>">-->
                  <input type="hidden" id="profit_amt" value="<?php echo $outstanding; ?>">
                  <input type="hidden" id="stat" value="<?php echo $stat; ?>">
                </td>
              </tr>
              <tr style="font-weight: bold;">
                <td style="border-color:#d4d6d5;"></td>
                <td style="border-color:#d4d6d5;"><strong>Total</strong></td>
                <td style="border-color:#d4d6d5;"><?php echo $ctotal; ?></td>
                <td style="border-color:#d4d6d5;"><?php echo $dtotal; ?></td>
              </tr>
              <tr>
                <td colspan="6" style="border-color:#d4d6d5;">
                  <center><button type="submit" class="btn btn-success" id="save">Save</button></center>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script>
  // $(document).ready(function() {
  //   $("#daybuk_date").datepicker({
  //     format: 'M-yyyy',
  //     startView: "months",
  //     minViewMode: "months"
  //   });
  // });
</script>
<script>
  //var k = new Date();
  //var n = k.toString();
  //var c=n.substr(0,34);
  //var d=c+"(IST)";
  // $('#date').html(d);
  $(document).on('click', '#save', function() {
    //alert('hai');
    //var Outs = $('#losss').text();
    // var Outs1 = $('#profits').text();
    // var Outs = parseFloat(Outs);
    // var Outs1 = parseFloat(Outs1);
    var profit_amt = $('#profit_amt').val();
    var cdate = $('#daybuk_date').val();
    var stat = $('#stat').val();
    alert(cdate);
    // if(Outs!=0)
    // {
    // alert(Outs);
    $.ajax({
      //alert(Outs);
      url: "<?php echo base_url(); ?>Daybook/updates",
      data: {
        profit_amt: profit_amt,
        cdate: cdate,
        stat: stat
      },
      method: "POST",
      datatype: "json",
      success: function(data) {
        if (data) {
          var options1 = {
            'title': 'Success',
            'style': 'notice',
            'message': 'Saved Successfully....!',
            'icon': 'success',
          };
          var n1 = new notify(options1);
          n1.show();
          setTimeout(function() {
            n1.hide();
          }, 3000);
          location.reload();
        }
      }
    });
    // }
    /* else{
       //alert(Outs1)
       $.ajax({
         //alert(Outs);
               url:"<?php echo base_url(); ?>GDaybook/update",
               data:{Outs1:Outs1,cdate:cdate},
               method:"POST",
               datatype:"json",
               success:function(data){
           if(data)
           {

             var options1 = {
             'title': 'Success',
             'style': 'notice',
             'message': 'Saved Successfully....!',
             'icon': 'success',
             };
             var n1 = new notify(options1);
             n1.show();
             setTimeout(function(){
             n1.hide();
              }, 3000);
              location.reload();
           }
               }
           });
     }*/
  });
</script>
