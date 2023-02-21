<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        </a></li>
        <li class="active"></li>
      </ol>
    </section>
<br/>
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <center>       
  <form name="" method="post" action="<?php echo base_url(); ?>Balancesheet/get">
  <div class="row">
      
     <div class="col-md-1"></div> 
      <div class="col-md-4">
         <div class="input-group margin">
           <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">Start Date</button>
          </div><!-- /btn-group -->
          <input type="text" name="cdate" id="month" class="form-control" value="<?php if(isset($sdate))echo date('d-m-Y',strtotime($sdate));?>" placeholder="Start Date">
        </div><!-- /input-group -->
      </div>

      <div class="col-md-4">
         <div class="input-group margin">
           <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">End Date</button>
          </div><!-- /btn-group -->
          <input type="text" name="edate" id="edate" class="form-control" value="<?php if(isset($edate)) echo date('d-m-Y',strtotime($edate));?>" placeholder="End Date">
        </div><!-- /input-group -->
      </div>
      
          
      <div class="col-md-2">
          <div class="input-group">
            <!--<button type="submit" id="search" name="search" class="btn bg-orange btn-flat margin" onclick="<?php //if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>-->
            <button type="submit" class="btn bg-orange btn-flat margin">Search</button>
              <a class="btn btn-primary" onclick="printDiv();"><i class="fa fa-print"></i> Print</a>
          </div>
      </div>
      
    </div>
  </form>
  </center> 
  <hr>
  <?php if(isset($sdate)){if(isset($edate)){ ?>
            <!-- /.box-header -->
            <div id="divName">
           <div class="box-body table-responsive">
             
              <div class="col-lg-3"></div>
       <div class="col-lg-6">
              <table class="table table-bordered" style="border-color:#d4d6d5;">
                <thead>
                  <tr>
                    <th colspan="5"><b style="color:#0f0f0f;font-weight: bold;font-size: 17px;"><center><i><?php echo strtoupper("Venad Poultry Farmers Producer Company.Ltd "); ?></i></center></b></th>
                  </tr>

                   <tr>
                   <tr>

                    <th colspan="5" style="color: #333;border-color:#d4d6d5;text-align: center;color: red;">

                  
                   </th>
                   </tr>
                  </tr>
                   <tr><th colspan="5" style="border-color:#d4d6d5;"><center>RECEIPTS & PAYMENTS</center></th></tr>
                <tr>
                   <th style="border-color:#d4d6d5;">RECEIPTS</th>
                  <th style="border-color:#d4d6d5;">AMOUNT</th>
                   <th style="border-color:#d4d6d5;"></th>
                  <th style="border-color:#d4d6d5;">PAYMENTS</th>        
                  <th style="border-color:#d4d6d5;">AMOUNT</th>
                  
                  
                </tr>
                
                </thead>
                <tbody>
                <?php 
               $opening_cash=0;
                        $tvoucher=0;//debit
                          $treceipt=0;
                          $purchase=0;
                           $test=0;

                            $old_bal=0;

                               $sal=0;
                          $adv=0;

                         
                    
                  ?>
                    
                       <tr style="font-weight: bold;">
                        
                      <td style="border-color:#d4d6d5;color:red;"><?php echo "OPENING CASH BALANCE"; ?></td>
                             
                        <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;"><?php foreach($cbalance as $cbalances){$opening_cash=$opening_cash+$cbalances->cbalance;} echo $opening_cash; ?></td>
                             
                            
                               <td style="border-color:#d4d6d5;"></td> 
                           
                       <td style="border-color:#d4d6d5;color:red;"></td>
                        <td style="border-color:#d4d6d5;color:#0f0f0f;text-align: right;"></td>
                       
                      </tr>

                  


                <!--------------------------------------VOUCHER--------------------------------->

                <?php foreach($payroll as $rows1){ ?>
                  <tr>
                   <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;">TOTAL SALARY PAID TO EMPLOYEES</td>
                  <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;"><?php echo $rows1->salary; ?></td>
                </tr>
              <?php $sal=$sal+$rows1->salary;} ?> 


               <?php foreach($advance as $rows1){ ?>
                  <tr>
                   <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;">ADVANCE SALARY PAID TO EMPLOYEES</td>
                  <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;"><?php echo $rows1->adv_amount; ?></td>
                </tr>
              <?php $adv=$adv+$rows1->adv_amount;} ?> 

                <?php foreach($purc as $rows1){ ?>
                  <tr>
                      <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                   <td style="border-color:#d4d6d5;text-align: right;">PURCHASE ITEMS FROM- <?php echo strtoupper($rows1->vendorname); ?></td>
                  <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;"><?php echo $rows1->pur_paid_amt; ?></td>
                </tr>
              <?php $purchase=$purchase+$rows1->pur_paid_amt;$old_bal=$old_bal+$rows1->old_balance;} ?>


                     <?php foreach($sale as $rows1){ ?>
                  <tr>
                  
                   <td style="border-color:#d4d6d5;"><?php echo "Sale Income"; ?></td>
                 <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;"><?php echo $rows1->total_amount; ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                </tr>
              <?php $test=$test+$rows1->total_amount;} ?>

                 <?php foreach($voucher as $row){ ?>
                  <tr style="font-weight: bold;">
                     <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                   <td style="border-color:#d4d6d5;color: red;text-align: right;"><?php echo $row->vouch_head; ?></td>
                    
                  <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;"><?php echo $row->voucher_amount; ?></td>
                 
                </tr>
              <?php $tvoucher=$tvoucher+$row->voucher_amount;} ?>

               

                <?php foreach($receipt as $rows){ ?>
                  <tr style="font-weight: bold;">
                                    
                     <td style="border-color:#d4d6d5;color: red;"><?php echo $rows->receipt_head; ?></td>
                 <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;"><?php echo $rows->receipt_amount; ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                     <td style="border-color:#d4d6d5;"></td>
                    <td style="border-color:#d4d6d5;"></td>
                </tr>
              <?php $treceipt=$treceipt+$rows->receipt_amount;} ?>

                </tbody>
                <tfoot>
                  <?php 

        $credit=$treceipt+$test;

           $debit=$tvoucher+$purchase+$sal+$adv;

          


            
            // $loanissue=$issue_upnrmloan+$issue_pdsloan+$issue_bankloan+$issue_loan;//asset
            // $gloanrepay=$g_loan+$i_loan+$pdsloan+$bankloan;//asset

            

            // $loanissue1=$issue_upnrmloan+$issue_pdsloan+$issue_bankloan;
            // $loanrepay1=$i_loan+$pdsloan+$bankloan;

              //$credit_sum=

            //  $credit_to=$obalance+$credit;
              $outstanding=$credit-$debit;
               if($outstanding < 0)
              {
                /*$profit=$debit-$credit;
                $loss=0;
                $ctotal=$credit+$profit;
                $dtotal=$debit+$loss;*/
                $profit=$debit-$credit;
               // $loss=0;
                $ctotal=$credit+$profit;
                $dtotal=$debit;
              }

              else
              {
               // $profit=0;
                $profit=$credit-$debit;
                $ctotal=$credit;
                $dtotal=$debit+$profit;
              }
             
            ?>
                  <tr>
                  
                    <td style="border-color:#d4d6d5;"></td>
                   
                     <td style="border-color:#d4d6d5;" id="profits"></td>
                      <td style="border-color:#d4d6d5;"></td> 
                       <td style="border-color:#d4d6d5;color:red;"><b>CASH BALANCE</b></td> 
                    <td style="border-color:#d4d6d5;text-align:right;color:#0f0f0f;" id="losss"><b style=""><?php echo $profit; ?></b></td>
                  </tr>

                   <tr>
                  
                    <td style="border-color:#d4d6d5;color:#0f0f0f;text-align: center;"><b>TOTAL</b></td>
                  
                     <td style="border-color:#d4d6d5;color:#0f0f0f;text-align:right;" id="profits"><b><?php echo $dtotal; ?></b></td>
                       <td style="border-color:#d4d6d5;"></td>
                        <td style="border-color:#d4d6d5;color:#0f0f0f;text-align: center;"><b>TOTAL</b></td> 
                    <td style="border-color:#d4d6d5;color:#0f0f0f;text-align:right;" id="losss"><b><?php echo $ctotal; ?></b></td>
                  </tr>
                  
                </tfoot>
         
       </table>

       <hr>

       <table>
          <table class="table table-bordered" style="border-color:#d4d6d5;">
                  <thead>
                    <tr style="border-color:#d4d6d5;"><th colspan="5" style="border-color:#d4d6d5;color:#0f0f0f;"><center><b>PROFIT AND LOSS ACCOUNT</b></center></th></tr>
                <tr style="border-color:#d4d6d5;">
               
                 
                  <th style="border-color:#d4d6d5;color:#0f0f0f;">Expenditure</th>
                 
                  <th style="text-align: center;border-color:#d4d6d5;color:#0f0f0f;">Amount</th>

                  <th style="border-color:#d4d6d5;"></th>

                  <th style="border-color:#d4d6d5;color:#0f0f0f;">Income</th>
                 
                  <th style="text-align: center;border-color:#d4d6d5;color:#0f0f0f;">Amount</th>
                           
                </tr>
              </thead>
                <tbody>
               <?php 
               

               $expense=0;
               $income=0;
               $purchase=0;
               $test=0;

                 $sal=0;
               $adv=0;
                ?>

                 <?php foreach($payroll as $rows1){ ?>
                  <tr>
                   
                  <td style="border-color:#d4d6d5;color:#0f0f0f;">TOTAL SALARY PAID TO EMPLOYEES</td>
                  <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;"><?php echo $rows1->salary; ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                </tr>
              <?php $sal=$sal+$rows1->salary;} ?> 


               <?php foreach($advance as $rows1){ ?>
                  <tr>
                  
                  <td style="border-color:#d4d6d5;color:#0f0f0f;">ADVANCE SALARY PAID TO EMPLOYEES</td>
                  <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;"><?php echo $rows1->adv_amount; ?></td>
                   <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                </tr>
              <?php $adv=$adv+$rows1->adv_amount;} ?> 

                <?php foreach($purc as $rows1){ ?>
                  <tr>
               
                  <td style="border-color:#d4d6d5;">PURCHASE ITEMS FROM- <?php echo strtoupper($rows1->vendorname); ?></td>
                  <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;"><?php echo $rows1->pur_paid_amt; ?></td>
                 <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                    <td style="border-color:#d4d6d5;"></td>
                
                </tr>
              <?php $purchase=$purchase+$rows1->pur_paid_amt;} ?>

                <?php foreach($sale as $rows1){ ?>
                  <tr>
                  <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"></td>
                   <td style="border-color:#d4d6d5;"><?php echo "Sale Income"; ?></td>
                 <td style="border-color:#d4d6d5;text-align: right;color:#0f0f0f;"><?php echo $rows1->total_amount; ?></td>
                  
                </tr>
              <?php $test=$test+$rows1->total_amount;} ?>


                  <?php foreach($voucher as $row){ ?>
                  <tr style="font-weight: bold;">
                     <td style="border-color:#d4d6d5;color: red;"><?php echo $row->vouch_head; ?></td>
                 <td style="border-color:#d4d6d5;font-weight: bold;text-align: right;color:#0f0f0f;"><?php echo $row->voucher_amount; ?></td>
                 <td style="border-color:#d4d6d5;"></td>
                   <td style="border-color:#d4d6d5;"></td>
                     <td style="border-color:#d4d6d5;"></td>
               
                 
                </tr>
              <?php $expense=$expense+$row->voucher_amount;} ?>
               

                <?php foreach($receipt as $rows){ ?>
                  <tr style="font-weight: bold;">
                          <td style="border-color:#d4d6d5;"></td>           
                     <td style="border-color:#d4d6d5;"></td>
               
                  <td style="border-color:#d4d6d5;"></td>
                     <td style="border-color:#d4d6d5;color:red;"><?php echo $rows->receipt_head; ?></td>
                       <td style="border-color:#d4d6d5;font-weight: bold;text-align:right;color:#0f0f0f;"><?php echo $rows->receipt_amount; ?></td>
                   
                </tr>
              <?php $income=$income+$rows->receipt_amount;} ?>

                    </tbody>
                    <tfoot>
                      <?php

                         $income_tot=$income+$test;

                          $expense_tot=$expense+$purchase+$sal+$adv;
                      ?>
                      <tr>
                        <td style="border-color:#d4d6d5;font-weight: bold;color:#0f0f0f;color:red;">NET PROFIT</td>
                        <td style="border-color:#d4d6d5;font-weight: bold;text-align: right;color:#0f0f0f;">
                          <?php
                           $outstanding1=$income_tot-$expense_tot;
                           
                          if($outstanding1 >0)
                          {
                            echo $tot =$income_tot -$expense_tot;
                            $ctot=$income_tot;
                            $dtot=$expense_tot+$tot;
                          }
                          else
                          {
                             echo $tot=$expense_tot -$income_tot;
                             $ctot=$expense_tot;
                              $dtot=$income_tot+$tot;
                          }
                          ?>
                        </td>
                        <td style="border-color:#d4d6d5;"></td>
                        <td style="border-color:#d4d6d5;"></td>
                        <td style="border-color:#d4d6d5;"></td>
                      </tr>
                      <tr>
                        <td style="border-color:#d4d6d5;font-weight: bold;color:#0f0f0f;text-align: center;">TOTAL</td>
                        <td style="border-color:#d4d6d5;font-weight: bold;text-align: right;color:#0f0f0f;"><?php echo $ctot; ?></td>
                        <td style="border-color:#d4d6d5;"></td>
                        <td style="border-color:#d4d6d5;font-weight: bold;color:#0f0f0f;text-align: center;">TOTAL</td>
                        <td style="border-color:#d4d6d5;font-weight: bold;text-align: right;color:#0f0f0f;"><?php echo $dtot; ?></td>
                      </tr>
                    </tfoot>
                 
               </table>
        <!---------------------------------------------------Balance Sheet--------------------------------------------------------------->
         <hr>
       <table>
          <table class="table table-bordered" style="border-color:#d4d6d5;">
                  <thead>
                    <tr style="border-color:#d4d6d5;"><th colspan="5" style="border-color:#d4d6d5;color:#0f0f0f;"><center><b>BALANCE SHEET</b></center></th></tr>
                <tr style="border-color:#d4d6d5;">
               
                 
                  <th style="border-color:#d4d6d5;color:#0f0f0f;">Liabilities</th>
                 
                  <th style="text-align: center;border-color:#d4d6d5;color:#0f0f0f;">Amount</th>

                  <th style="border-color:#d4d6d5;"></th>

                  <th style="border-color:#d4d6d5;color:#0f0f0f;">Asset</th>
                 
                  <th style="text-align: center;border-color:#d4d6d5;color:#0f0f0f;">Amount</th>
                           
                </tr>
              </thead>
                <tbody>
               <?php 
            
                $cb=0;
                ?>
                 
                <tr>
                    <?php if($old_bal!=0){ ?>
                   <td style="border-color:#d4d6d5;font-weight: bold;color:red;"><?php echo "PURCHASE-OLD BALANCE"; ?></td>
                 
                  <td style="text-align: center;border-color:#d4d6d5;font-weight: bold;color:#0f0f0f;text-align: right;"><?php echo $old_bal; ?></td>
                   <?php }else {?><td style="border-color:#d4d6d5;"></td><td style="border-color:#d4d6d5;"></td><?php } ?>
                  <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                   <?php if($test !=0){ ?>
                  <td style="border-color:#d4d6d5;font-weight: bold;color:red;"><?php echo "OUTSTANDING INCOME"; ?></td>
                 
                  <td style="text-align: center;border-color:#d4d6d5;font-weight: bold;color:#0f0f0f;text-align: right;"><?php echo $test; ?></td>
                   <?php }else {?><td style="border-color:#d4d6d5;"></td><td style="border-color:#d4d6d5;"></td><?php } ?>
                  
   
                </tr>
           
                
               

                 <tr>
                  <td style="border-color:#d4d6d5;font-weight: bold;color:red;"></td>
                 
                  <td style="text-align: center;border-color:#d4d6d5;font-weight: bold;"></td>
                  <td style="border-color:#d4d6d5;font-weight: bold;color:red;"></td>
                   <td style="border-color:#d4d6d5;font-weight: bold;color:red;"><?php echo "CASH BALANCE"; ?></td>
                 
                   <td style="text-align: center;border-color:#d4d6d5;color:red;font-weight: bold;color:#0f0f0f;text-align: right;"><?php echo $profit;$cb=$cb+$profit; ?></td>
                </tr>

                   <tbody>
                    <tr>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:#0f0f0f;">DEBIT TOTAL</td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:#0f0f0f;text-align: right;"><?php echo  $old_bal; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:#0f0f0f;">CREDIT TOTAL</td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:#0f0f0f;text-align: right;"><?php echo $test; ?></td>
                    </tr>
                    <?php
                        $debit=$old_bal;
                        $credit=$test+$cb;
                        $tot=$credit-$debit;
                      ?>

                      <tr>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;">NET PROFIT</td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:#0f0f0f;text-align: right;"><?php echo $tot;  ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:blue;"></td>
                    </tr>  

                      <tr>
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;color:#0f0f0f;">TOTAL</td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:#0f0f0f;text-align: right;"><?php echo $debit+$tot;  ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                       <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;color:#0f0f0f;">TOTAL</td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:#0f0f0f;text-align: right;"><?php echo $credit; ?></td>
                    </tr>  

                    </tbody>
                 
               </table>
       

      </div>
      <div>
      </div>
      <?php }} ?>
       


            </div>
            
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
$( document ).ready(function() {
    $("#month").datepicker({ 
        format: 'dd-mm-yyyy',
         // startView: "months", 
   // minViewMode: "months"
    });
   
}); 

$( document ).ready(function() {
    $("#edate").datepicker({ 
        format: 'dd-mm-yyyy',
         // startView: "months", 
   // minViewMode: "months"
    });
   
}); 

</script>