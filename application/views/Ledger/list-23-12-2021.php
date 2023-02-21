
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Ledger Balance
       <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>GLedger/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">  Ledger</li>
      </ol>
    </section>
   
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
        	  <form name="" method="post" action="<?php echo base_url(); ?>GLedger/getledger">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
			  
				<div class="col-md-3">
					<div class="input-group margin">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary nohover">Ledger Head</button>
						</div><!-- /btn-group -->
					<!--<input type="text"  class="form-control"  id="ledgerbuk_head"  placeholder="Ledger Head">-->
					<select name="ledgerbuk_head"  class="form-control"  id="ledgerbuk_head" style="font-weight: bold;">
						<option value="">-SELECT LEDGER HEAD-</option>
						<?php /*foreach($ledger as $row){?>
							<option <?php if(isset($head)){if($head==$row->head){echo "selected";}} ?> value="<?php echo $row->head; ?>"><?php echo $row->head; ?></option>
						 <?php }*/ ?>
             <option  <?php if(isset($head)){if($head==1){echo "selected";}} ?> value="1">SAVINGS</option>
             <option  <?php if(isset($head)){if($head==2){echo "selected";}} ?> value="2">LOANS</option>
              <option  <?php if(isset($head)){if($head==3){echo "selected";}} ?> value="3">SAVINGS WITHDRAWAL</option>
               <option  <?php if(isset($head)){if($head==4){echo "selected";}} ?> value="4">GROUP DEPOSIT</option>
             <option  <?php if(isset($head)){if($head==5){echo "selected";}} ?> value="5">RECEIPTS & PAYMENTS</option>
              <option  <?php if(isset($head)){if($head==6){echo "selected";}} ?> value="6">OTHER</option>
					</select>
				</div><!-- /input-group -->
				</div>
			<div class="col-md-4">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">Month</button>
					</div><!-- /btn-group -->
						 <input type="text" name="cdate" id="month" class="form-control" value="<?php if(isset($cdate)){echo date('M-Y',strtotime($cdate));}else{ echo date('M-Y');} ?>" style="font-weight: bold;font-size:16px;">
						
				</div>
			</div>
			
			<div class="col-sm-1">
					<div class="input-group">
						<button type="submit" id="search" class="btn bg-orange btn-flat margin" >Search</button>
					</div>
			</div>

            </div>
              </form>
              <hr>
            <!-- /.box-header -->
            <?php if(isset($gid) && isset($cdate) && isset($edate)){ ?>
            	
            <div class="box-body">
              <?php  if($head==1) { ?>
              <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">
                <thead>
                  <tr style="border-color:#d4d6d5;"><th colspan="6" style="border-color:#d4d6d5;"><center>LEDGER BOOK</center></th></tr>
                <tr>
				  <th style="border-color:#d4d6d5;">SL.NO</th>
				  <th style="border-color:#d4d6d5;">NAME</th>
          <th style="border-color:#d4d6d5;text-align: center;">SAVINGS</th>
				  <th style="border-color:#d4d6d5;text-align: center;">MASAVARI</th>
          <th style="border-color:#d4d6d5;text-align: center;">OTHER_INCOME</th>
          <th style="border-color:#d4d6d5;text-align: center;">FINE</th>
                </tr>
                
                </thead>
               
                <tbody>
                    <?php
                    $i=0; 
                   $deposit=0;
                   $masavari=0;
                   $income=0;
                   $fine=0;
                   $g_deposit=0;//debit
                   $fdeposit=0;//debit
                   $fd=0;//debit
                  
                   $widraw=0;//debit
               
                  foreach($data as $value){
                   $i=$i+1; 
                        ?>
                		<tr>
                     <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $i; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $value->member_name; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;">
                        <?php  foreach($data1 as $value1){if($value->member_id==$value1->deposit_member){if($value1->deposit_amount==0){echo "";}else{echo $value1->deposit_amount;}$deposit=$deposit+$value1->deposit_amount;}} ?>
                        
                      </td>
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php foreach($data1 as $value1){if($value->member_id==$value1->deposit_member){if($value1->collection_amt==0){echo "";}else{echo $value1->collection_amt;}$masavari=$masavari+$value1->collection_amt;}} ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php foreach($data1 as $value1){if($value->member_id==$value1->deposit_member){if($value1->other_income==0){echo "";}else{echo $value1->other_income;}$income=$income+$value1->other_income;}} ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php foreach($data1 as $value1){if($value->member_id==$value1->deposit_member){if($value1->fine==0){echo "";}else{echo $value1->fine;} $fine=$fine+$value1->fine;}} ?></td>
                     
                  </tr>
                 
                <?php 
                
                }//member data foreach ?>
             
                </tbody>
               
                    
                <tfoot>
                  <tr>
                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;color:red;">TOTAL</td>
                    <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $deposit; ?></td>
                     <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $masavari; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $income; ?></td>
                       <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $fine; ?></td>
                  </tr>
                </tfoot>
             
			 </table>
			 <?php } ?>


        <?php  if($head==2) { ?>
              <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">
                <thead>
                  <tr style="border-color:#d4d6d5;"><th colspan="6" style="border-color:#d4d6d5;"><center>LEDGER BOOK</center></th></tr>
                  <tr>
                    <th colspan="2" style="border-color:#d4d6d5;">MEMBER DETAILS</th>
                    <th colspan="3" style="border-color:#d4d6d5;">GROUP LOAN</th>
                     <th colspan="3" style="border-color:#d4d6d5;">PDS LOAN</th>
                      <th colspan="3" style="border-color:#d4d6d5;">FEDARATION LOAN</th>
                       <th colspan="3" style="border-color:#d4d6d5;">BANK LOAN</th>
                  </tr>
                <tr>
          <th style="border-color:#d4d6d5;">SL.NO</th>
          <th style="border-color:#d4d6d5;">NAME</th>
          <th style="border-color:#d4d6d5;text-align: center;">PAID AMOUNT</th>
          <th style="border-color:#d4d6d5;text-align: center;">PAID INTREST</th>
          <th style="border-color:#d4d6d5;text-align: center;">REMAINING</th>

          <th style="border-color:#d4d6d5;text-align: center;">PAID AMOUNT</th>
          <th style="border-color:#d4d6d5;text-align: center;">PAID INTREST</th>
          <th style="border-color:#d4d6d5;text-align: center;">REMAINING</th>

           <th style="border-color:#d4d6d5;text-align: center;">PAID AMOUNT</th>
          <th style="border-color:#d4d6d5;text-align: center;">PAID INTREST</th>
          <th style="border-color:#d4d6d5;text-align: center;">REMAINING</th>

           <th style="border-color:#d4d6d5;text-align: center;">PAID AMOUNT</th>
          <th style="border-color:#d4d6d5;text-align: center;">PAID INTREST</th>
          <th style="border-color:#d4d6d5;text-align: center;">REMAINING</th>
                </tr>
                
                </thead>
               
                <tbody>
                    <?php
                    $i=0; 
                  $loan_repayment_amt=0;
                  $loan_intrest_amt=0;
                  $loan_balance=0;

                   $hdsloan_repayment_amt=0;
                  $hdsloan_intrest_amt=0;
                  $hdsloan_balance=0;

                   $upnrmloan_repayment_amt=0;
                        $upnrmloan_intrest_amt=0;
                        $upnrmloan_balance=0;

                        $ksbcdcloan_repayment_amt=0;
                        $ksbcdcloan_intrest_amt=0;
                        $ksbcdcloan_balance=0;
               
                  foreach($data as $value){

                   $i=$i+1; 
                    ?>
                    <tr>
                    
                     <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $i; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $value->member_name; ?></td>
                      
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;">
                        <?php foreach($gloan as $value1) {if($value->member_id==$value1->loan_repay_member){if($value1->loan_repayment_amt==0){echo "";}else{echo $value1->loan_repayment_amt;}$loan_repayment_amt=$loan_repayment_amt+$value1->loan_repayment_amt;}} ?>
                        </td>

                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;">
                         <?php foreach($gloan as $value1) {if($value->member_id==$value1->loan_repay_member){if($value1->loan_intrest==0){echo "";}else{echo $value1->loan_intrest;} $loan_intrest_amt=$loan_intrest_amt+$value1->loan_intrest;}} ?>         
                        </td>
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;">
                          <?php foreach($gloan as $value1) {if($value->member_id==$value1->loan_repay_member){if($value1->loan_balance==0){echo "";}else{echo $value1->loan_balance;} $loan_balance=$loan_balance+$value1->loan_balance;}} ?>                 
                        </td>
                      
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php  foreach($linkloan as $value2){if($value->member_id==$value2->hdsloan_repay_member){ if($value2->hdsloan_repayment_amt==0){echo "";}else{echo $value2->hdsloan_repayment_amt;}$hdsloan_repayment_amt=$hdsloan_repayment_amt+$value2->hdsloan_repayment_amt;}} ?>
                        
                      </td>
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;">

                        <?php  foreach($linkloan as $value2){if($value->member_id==$value2->hdsloan_repay_member){ if($value2->hdsloan_intrest==0){echo "";}else{echo $value2->hdsloan_intrest;} $hdsloan_intrest_amt=$hdsloan_intrest_amt+$value2->hdsloan_intrest;}} ?>
                      </td>
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;">
                         <?php  foreach($linkloan as $value2){if($value->member_id==$value2->hdsloan_repay_member){ if($value2->hdsloan_balance==0){echo "";}else{echo $value2->hdsloan_balance;} $hdsloan_balance=$hdsloan_balance+$value2->hdsloan_balance;}} ?>
                       </td>

                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php foreach($iloan as $value1){if($value->member_id==$value1->upnrmloan_repay_member){ if($value1->upnrmloan_repayment_amt==0){echo "";}else{echo $value1->upnrmloan_repayment_amt;} $upnrmloan_repayment_amt=$upnrmloan_repayment_amt+$value1->upnrmloan_repayment_amt;}} ?>
                        
                      </td>

                       <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php foreach($iloan as $value1){if($value->member_id==$value1->upnrmloan_repay_member){ if($value1->upnrmloan_intrest_amt==0){echo "";}else{echo $value1->upnrmloan_intrest_amt;} $upnrmloan_intrest_amt=$upnrmloan_intrest_amt+$value1->upnrmloan_intrest_amt;}} ?>
                        
                       </td>


                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php foreach($iloan as $value1){if($value->member_id==$value1->upnrmloan_repay_member){ if($value1->upnrmloan_balance==0){echo "";}else{echo $value1->upnrmloan_balance;}  $upnrmloan_balance=$upnrmloan_balance+$value1->upnrmloan_balance;}} ?>
                        
                      </td>
                    
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php foreach($awcloan as $value1){
                      if($value->member_id==$value1->ksbcdcloan_repay_member){if($value1->ksbcdcloan_repayment_amt==0){echo "";}else{echo $value1->ksbcdcloan_repayment_amt;} $ksbcdcloan_repayment_amt=$ksbcdcloan_repayment_amt+$value1->ksbcdcloan_repayment_amt;}} ?>              
                      </td>

                        <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php foreach($awcloan as $value1){
                      if($value->member_id==$value1->ksbcdcloan_repay_member){if($value1->ksbcdcloan_intrest==0){echo "";}else{echo $value1->ksbcdcloan_intrest;} $ksbcdcloan_intrest_amt=$ksbcdcloan_intrest_amt+$value1->ksbcdcloan_intrest;}} ?>
                        
                      </td>

                         <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php foreach($awcloan as $value1){
                      if($value->member_id==$value1->ksbcdcloan_repay_member){if($value1->ksbcdcloan_balance==0){echo "";}else{echo $value1->ksbcdcloan_balance;}$ksbcdcloan_balance=$ksbcdcloan_balance+$value1->ksbcdcloan_balance;}} ?>
                        
                      </td>
                    
                  </tr>
                 
              
               <?php  }//member data foreach ?>
             
                </tbody>
               
                    
                <tfoot>
                  <tr>
                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;color:red;">TOTAL</td>
                    <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $loan_repayment_amt; ?></td>
                     <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $loan_intrest_amt; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $loan_balance; ?></td>

                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $hdsloan_repayment_amt; ?></td>
                     <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $hdsloan_intrest_amt; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $hdsloan_balance; ?></td>

                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $upnrmloan_repayment_amt; ?></td>
                     <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $upnrmloan_intrest_amt; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $upnrmloan_balance; ?></td>

                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $ksbcdcloan_repayment_amt; ?></td>
                     <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $ksbcdcloan_intrest_amt; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $ksbcdcloan_balance; ?></td>
                  </tr>
                </tfoot>
             
       </table>
       <?php } ?>



        <?php  if($head==3) { ?>
              <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">
                <thead>
                  <tr style="border-color:#d4d6d5;"><th colspan="6" style="border-color:#d4d6d5;"><center>LEDGER BOOK</center></th></tr>
                <tr>
          <th style="border-color:#d4d6d5;">SL.NO</th>
          <th style="border-color:#d4d6d5;">NAME</th>
          <th style="border-color:#d4d6d5;text-align: center;">SAVINGS WITHDRAWAL</th>
                </tr>
                
                </thead>
               
                <tbody>
                    <?php
                    $i=0; 
                  
                  
                   $widraw=0;//debit
               
                  foreach($data as $value){

                   
                   
                          $i=$i+1; 
                        ?>
                    <tr>
                     <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $i; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $value->member_name; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php foreach($data2 as $value2){if($value->member_id==$value2->deposit_member){if($value2->deposit_widrawal==0){echo "";}else{echo $value1->deposit_widrawal;}$widraw=$widraw+$value2->deposit_widrawal;}} ?></td>
                   
                  </tr>
                 
                <?php 
              
                }//member data foreach ?>
             
                </tbody>
               
                    
                <tfoot>
                  <tr>
                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;color:red;">TOTAL</td>
                    <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $widraw; ?></td>
                    
                  </tr>
                </tfoot>
             
       </table>
       <?php } ?>


        <?php  if($head==4) { ?>
              <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">
                <thead>
                  <tr style="border-color:#d4d6d5;"><th colspan="6" style="border-color:#d4d6d5;"><center>LEDGER BOOK</center></th></tr>
                <tr>
          <th style="border-color:#d4d6d5;">SL.NO</th>
          <th style="border-color:#d4d6d5;">NAME</th>
          <th style="border-color:#d4d6d5;text-align: center;">BANK DEPOSIT</th>

          <th style="border-color:#d4d6d5;text-align: center;">FEDARATION DEPOSIT</th>
           <th style="border-color:#d4d6d5;text-align: center;">FD</th>
                </tr>
                
                </thead>
               
                <tbody>
                    <?php
                    $i=0; 
                   $group_deposit=0;
                  $fedaration_deposit=0;
                  $fd_amount=0;
               
                  foreach($gdeposit as $value2){
                  
                          $i=$i+1; 
                   ?>
                    <tr>
                     <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $i; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $value2->cag_name; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php if($value2->group_deposit==0){echo "";}else{echo $value2->group_deposit;}?></td>
                       <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php if($value2->fedaration_deposit==0){echo "";}else{echo $value2->fedaration_deposit;}?></td>
                        <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php if($value2->fd_amount==0){echo "";}else{echo $value2->fd_amount;}?></td>
                   
                  </tr>
                 
                <?php 
              $group_deposit=$group_deposit+$value2->group_deposit;
               $fedaration_deposit=$fedaration_deposit+$value2->fedaration_deposit;
               $fd_amount=$fd_amount+$value2->fd_amount;

                }//member data foreach ?>
             
                </tbody>
               
                    
                <tfoot>
                  <tr>
                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;color:red;">TOTAL</td>
                    <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $group_deposit; ?></td>
                     <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $fedaration_deposit; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $fd_amount; ?></td>
                    
                  </tr>
                </tfoot>
             
       </table>
       <?php } ?>


        <?php  if($head==5) { ?>
              <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">
                <thead>
                  <tr style="border-color:#d4d6d5;"><th colspan="6" style="border-color:#d4d6d5;"><center>LEDGER BOOK</center></th></tr>
                <tr>
        
           <th style="border-color:#d4d6d5;">DATE</th>
          <th style="border-color:#d4d6d5;">PARTICULAR</th>
          <th style="border-color:#d4d6d5;text-align: center;">CREDIT</th>
          <th style="border-color:#d4d6d5;text-align: center;">DEBIT</th>
                </tr>
                
                </thead>
               
                <tbody>
                    <?php
                    $i=0; 
                   $tvoucher=0;//debit
                    $treceipt=0;
               
                   ?>
                        <?php foreach($voucher as $row){ ?>
                        <tr>
                           <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($row->voucher_date)); ?></td>
                         <td style="border-color:#d4d6d5;"><?php echo $row->vouch_head; ?></td>
                       <td style="border-color:#d4d6d5;text-align: center;"></td>
                        <td style="border-color:#d4d6d5;text-align: center;"><?php echo $row->voucher_amount; ?></td>
                      </tr>
                      <?php $tvoucher=$tvoucher+$row->voucher_amount;} ?>


                <?php foreach($receipt as $rows){ ?>
                  <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($rows->rept_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo $rows->receipt_head; ?></td>
                 <td style="border-color:#d4d6d5;text-align: center;"><?php echo $rows->receipt_amount; ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                </tr>
              <?php $treceipt=$treceipt+$rows->receipt_amount;} ?>
             
                </tbody>
               
                    
                <tfoot>
                  <tr>
                    <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;color:red;">TOTAL</td>
                     <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $treceipt; ?></td>
                     <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $tvoucher; ?></td>
                    
                  </tr>
                </tfoot>
             
       </table>
       <?php } ?>

       <?php  if($head==6) { ?>
              <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">
                <thead>
                  <tr style="border-color:#d4d6d5;"><th colspan="6" style="border-color:#d4d6d5;"><center>LEDGER BOOK</center></th></tr>
                <tr>
          <th style="border-color:#d4d6d5;">SL.NO</th>
          <th style="border-color:#d4d6d5;">GROUP</th>
          <th style="border-color:#d4d6d5;text-align: center;">PARTICULAR</th>

          <th style="border-color:#d4d6d5;text-align: center;">CREDIT</th>
           <th style="border-color:#d4d6d5;text-align: center;">DEBIT</th>
                </tr>
                
                </thead>
               
                <tbody>
                    <?php
                    $i=0; 
                   $chittyy=0;
                  $busi=0;
                  
               
                   foreach($chitty as $chit){ 
                  
                          $i=$i+1; 
                   ?>
                    <tr>
                     <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $i; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $chit->cag_name; ?></td>
                     
                      <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo "CHITTY" ?></td>
                       <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"></td>
                        <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo $chit->chitty_total; ?></td>
                      </tr>
                      <?php $chittyy=$chittyy+$chit->chitty_total;} ?>

                       <?php foreach($bus as $buss){ $i=$i+1; ?>
                         <tr>
                     <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $i; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $buss->cag_name; ?></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo "BUSINESS PAYMENTS" ?></td>
                       <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"></td>
                        <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo $buss->bus_total; ?></td>
                      <?php $busi=$busi+$buss->bus_total;} ?>
                   
                  </tr>
                 
              
             
                </tbody>
               
                    
                <tfoot>
                  <tr>
                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;color:red;">TOTAL</td>
                    <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"></td>
                     <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"></td>
                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align: center;"><?php echo $busi+$chittyy; ?></td>
                    
                  </tr>
                </tfoot>
             
       </table>
       <?php } ?>




            </div>
          <?php } ?>
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
$( document ).ready(function() {
    $("#month").datepicker({ 
        format: 'M-yyyy',
          startView: "months", 
    minViewMode: "months"
    });
   
}); 

</script>




