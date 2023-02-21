
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Ledger
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
             <option  <?php if(isset($head)){if($head==3){echo "selected";}} ?> value="3">RECEIPTS & PAYMENTS</option>
					</select>
				</div><!-- /input-group -->
				</div>
			<div class="col-md-4">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">From</button>
					</div><!-- /btn-group -->
						<input type="text"  name="start_date" id="month" class="col-md-5 form-control" placeholder="dd/mm/yyyy" value="<?php if(isset($cdate)){echo date('d-m-Y',strtotime($cdate));} ?>" style="font-weight: bold;">
						
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">To</button>
					</div><!-- /btn-group -->
						<input type="text" name="end_date" id="edate"  class="col-md-5 form-control" placeholder="dd/mm/yyyy"  value="<?php if(isset($edate)){echo date('d-m-Y',strtotime($edate));} ?>" style="font-weight: bold;">
						
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
            	<div class="col-lg-2"></div>
            <div class="box-body col-lg-8">
			
              <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">
                <thead>
                  <tr style="border-color:#d4d6d5;"><th colspan="4" style="border-color:#d4d6d5;"><center>LEDGER BOOK</center></th></tr>
                <tr>
				  <th style="border-color:#d4d6d5;">DATE</th>
				  <th style="border-color:#d4d6d5;">PARTICULARS</th>
                  <th style="border-color:#d4d6d5;text-align: center;">CREDIT</th>
				  <th style="border-color:#d4d6d5;text-align: center;">DEBIT</th>
                </tr>
                
                </thead>
                <?php 
                  if($head==1)
                  {
                
                    ?>
                <tbody>
                    <?php 
                   $deposit=0;
                   $masavari=0;
                   $income=0;
                   $fine=0;
                   $g_deposit=0;//debit
                   $fdeposit=0;//debit
                   $fd=0;//debit
                  
                      $widraw=0;//debit
               
                  ?>
                	<?php foreach($data1 as $value1){ ?>
                    <?php if($value1->deposit_amount!=0){ ?>
                		<tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($value1->deposit_date)); ?></td>
                      <td style="border-color:#d4d6d5;"><?php echo "SAVINGS FROM"." ".strtoupper($value1->member_name); ?></td>
                     
                  <td style="border-color:#d4d6d5;"><?php if($value1->deposit_amount==0){echo "";}else{echo $value1->deposit_amount;} ?></td>
                <td style="border-color:#d4d6d5;"></td>
                  </tr>
                <?php } ?>
                  <?php if($value1->collection_amt!=0){ ?>
                  <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($value1->deposit_date)); ?></td>
                      <td style="border-color:#d4d6d5;"><?php echo "MASAVARI FROM "." ".strtoupper($value1->member_name); ?></td>
                     
                  <td style="border-color:#d4d6d5;"><?php if($value1->collection_amt==0){echo "";}else{echo $value1->collection_amt;} ?></td>
                <td style="border-color:#d4d6d5;"></td>
                  </tr>
                <?php } ?>
                <?php if($value1->other_income!=0){ ?>
                   <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($value1->deposit_date));?></td>
                      <td style="border-color:#d4d6d5;"><?php echo "OTHER INCOME FROM"." ".strtoupper($value1->member_name); ?></td>
                     
                  <td style="border-color:#d4d6d5;"><?php if($value1->other_income==0){echo "";}else{echo $value1->other_income;} ?></td>
                <td style="border-color:#d4d6d5;"></td>
                  </tr>
                  <?php } ?>
                <?php if($value1->fine!=0){ ?>

                <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($value1->deposit_date)); ?></td>
                      <td style="border-color:#d4d6d5;"><?php echo "FINE FROM"." ".strtoupper($value1->member_name); ?></td>
                     
                  <td style="border-color:#d4d6d5;"><?php if($value1->fine==0){echo "";}else{ echo $value1->fine;} ?></td>
                <td style="border-color:#d4d6d5;"></td>
                  </tr>
                  <?php } ?>
                <?php 
                $deposit=$deposit+$value1->deposit_amount;
                $masavari=$masavari+$value1->collection_amt;
                $income=$income+$value1->other_income;
                $fine=$fine+$value1->fine;
              } ?>
              <?php foreach($data2 as $value2){ ?>
                 <?php if($value2->deposit_widrawal!=0){ ?> 
                   <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($value1->deposit_date)); ?></td>
                      <td style="border-color:#d4d6d5;"><?php echo "SAVINGS WITHDRAWAL BY"." ".strtoupper($value2->member_name); ?></td>
                     
                 
                <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;"><?php if($value2->deposit_widrawal==0){echo "";}else{echo $value2->deposit_widrawal;} ?></td>
                  </tr>
                <?php } ?>
                <?php $widraw=$widraw+$value2->deposit_widrawal;}?>

                <?php foreach($gdeposit as $gd){?>
                  <?php if($gd->group_deposit!=0){ ?> 
                  <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($gd->gdeposit_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "BANK DEPOSIT"; ?></td>
                 <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php if($gd->group_deposit==0){echo "";}else{echo $gd->group_deposit;} ?></td>
      
                </tr>
              <?php } ?> 
              <?php if($gd->fedaration_deposit!=0){ ?> 
                 <tr>
                    <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($gd->gdeposit_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "FEDARATION DEPOSIT"; ?></td>
                 <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php if($gd->fedaration_deposit==0){echo "";}else{echo $gd->fedaration_deposit;} ?></td>
      
                </tr>
                <?php } ?> 
                <?php if($gd->fd_amount!=0){ ?> 
                  <tr>
                   <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($gd->gdeposit_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "PDS FD"; ?></td>
                 <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php if($gd->fd_amount==0){echo "";}else{echo $gd->fd_amount;} ?></td>
                </tr>
                <?php } ?> 
                <?php $g_deposit=$g_deposit+($gd->group_deposit);
                $fdeposit=$fdeposit+($gd->fedaration_deposit);
              $fd=$fd+($gd->fd_amount);
            } ?>
                
                </tbody>
                <tfoot>
                  <tr>
                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;">TOTAL</td>
                    <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $deposit+$masavari+$income+$fine; ?></td>
                     <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $widraw+$g_deposit+$fdeposit+$fd; ?></td>
                  </tr>
                </tfoot>

                    <?php
                
                  }
               
                  ?>

               

                     <?php 
                  if($head==2)
                  {
                
                    ?>
                <tbody>
                    <?php 
                     $g_loan=0;
                   $g_loan_intrest=0;
                   $i_loan=0;
                   $i_loan1=0;//debit
                   $i_loan_intrest=0;
                   $i_loan_intrest1=0;//debit
                   $pdsloan=0;
                   $pdsloanintrest=0;
                    $bankloan=0;
                   $bankloanintrest=0;
                    $pdsloan1=0;//debit
                   $pdsloanintrest1=0;//debit
                    $bankloan1=0;//debit
                   $bankloanintrest1=0;//debit

                    $issue_loan=0;//debit
                    $issue_upnrmloan=0;//debit
                     $issue_pdsloan=0;//debit
                      $issue_bankloan=0;//debit


                  ?>
                  <?php foreach($gloan as $gloans){ 
                    if($gloans->loan_repayment_amt!=0){ ?>
                     <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($gloans->loan_repayment_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "GROUP LOAN REPAYMENT -"." ".strtoupper($gloans->member_name);; ?></td>
                 <td style="border-color:#d4d6d5;"><?php if($gloans->loan_repayment_amt==0){echo "";}else{echo $gloans->loan_repayment_amt;} ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                </tr>
                <?php } ?>
                <?php if($gloans->loan_intrest_amt!=0){ ?>
                 <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($gloans->loan_repayment_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "GROUP LOAN INTEREST PAID-"." ".strtoupper($gloans->member_name);; ?></td>
                 <td style="border-color:#d4d6d5;"><?php if($gloans->loan_intrest_amt==0){echo "";}else{echo $gloans->loan_intrest_amt;} ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                </tr>
                 <?php } ?>
               
                <?php 
                $g_loan=$g_loan+$gloans->loan_repayment_amt;
                $g_loan_intrest=$g_loan_intrest+($gloans->loan_intrest_amt);} ?>
                <?php foreach($iloan as $iloans){ ?>
                   <?php if($iloans->upnrmloan_repayment_amt!=0){ ?>
                  <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($iloans->upnrmloan_repayment_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "FEDARATION LOAN REPAYMENT-"." ".strtoupper($iloans->member_name);; ?></td>
                 <td style="border-color:#d4d6d5;"><?php if($iloans->upnrmloan_repayment_amt==0){echo "";}else{echo $iloans->upnrmloan_repayment_amt;} ?></td>
                  <td style="border-color:#d4d6d5;"><?php if($iloans->upnrmloan_repayment_amt==0){echo "";}else{echo $iloans->upnrmloan_repayment_amt;} ?></td>
                </tr>
              <?php } ?>
               <?php if($iloans->upnrmloan_intrest_amt!=0){ ?>
                 <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($iloans->upnrmloan_repayment_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "FEDARATION LOAN INTEREST PAID-"." ".strtoupper($iloans->member_name);; ?></td>
                 <td style="border-color:#d4d6d5;"><?php if($iloans->upnrmloan_intrest_amt==0){echo "";}else{echo $iloans->upnrmloan_intrest_amt;} ?></td>
                  <td style="border-color:#d4d6d5;"><?php if($iloans->upnrmloan_intrest_amt==0){echo "";}else{echo $iloans->upnrmloan_intrest_amt;} ?></td>
                </tr>
              <?php } ?>
              <?php 
              $i_loan=$i_loan+($iloans->upnrmloan_repayment_amt);
              $i_loan1=$i_loan1+($iloans->upnrmloan_repayment_amt);
               $i_loan_intrest=$i_loan1+($iloans->upnrmloan_intrest_amt);
               $i_loan_intrest1=$i_loan1+($iloans->upnrmloan_intrest_amt);
            } ?> 
               <?php foreach($linkloan as $linkloans){ ?>
                 <?php if($linkloans->hdsloan_repayment_amt!=0){ ?>
                   <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($linkloans->hdsloan_repayment_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "PDS LOAN REPAYMENT-"." ".strtoupper($linkloans->member_name);; ?></td>
                 <td style="border-color:#d4d6d5;"><?php if($linkloans->hdsloan_repayment_amt==0){echo "";}else{echo $linkloans->hdsloan_repayment_amt;} ?></td>
                  <td style="border-color:#d4d6d5;"><?php if($linkloans->hdsloan_repayment_amt==0){echo "";}else{echo $linkloans->hdsloan_repayment_amt;} ?></td>
                </tr>
              <?php } ?>
               <?php if($linkloans->hdsloan_intrest_amt!=0){ ?>

                  <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($linkloans->hdsloan_repayment_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "PDS LOAN INTEREST PAID-"." ".strtoupper($linkloans->member_name);; ?></td>
                 <td style="border-color:#d4d6d5;"><?php if($linkloans->hdsloan_intrest_amt==0){echo "";}else{echo $linkloans->hdsloan_intrest_amt;} ?></td>
                  <td style="border-color:#d4d6d5;"><?php if($linkloans->hdsloan_intrest_amt==0){echo "";}else{echo $linkloans->hdsloan_intrest_amt;} ?></td>
                </tr>
              <?php } ?>
              <?php 
              $pdsloan=$pdsloan+($linkloans->hdsloan_repayment_amt);
              $pdsloan1=$pdsloan1+($linkloans->hdsloan_repayment_amt);
              $pdsloanintrest=$pdsloanintrest+($linkloans->hdsloan_intrest_amt);
              $pdsloanintrest1=$pdsloanintrest1+($linkloans->hdsloan_intrest_amt);
            } ?>

            <?php foreach($awcloan as $awcloans){ ?>
               <?php if($awcloans->ksbcdcloan_repayment_amt!=0){ ?>
                  <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($awcloans->ksbcdcloan_repayment_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "BANK LOAN REPAYMENT-"." ".strtoupper($awcloans->member_name);; ?></td>
                 <td style="border-color:#d4d6d5;"><?php if($awcloans->ksbcdcloan_repayment_amt==0){echo "";}else{echo $awcloans->ksbcdcloan_repayment_amt;} ?></td>
                  <td style="border-color:#d4d6d5;"><?php if($awcloans->ksbcdcloan_repayment_amt==0){echo "";}else{echo $awcloans->ksbcdcloan_repayment_amt;} ?></td>
                </tr>
              <?php } ?>
               <?php if($awcloans->ksbcdcloan_intrest_amt!=0){ ?>
                  <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($awcloans->ksbcdcloan_repayment_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "BANK LOAN INTEREST PAID-"." ".strtoupper($awcloans->member_name);; ?></td>
                 <td style="border-color:#d4d6d5;"><?php if($awcloans->ksbcdcloan_intrest_amt==0){echo "";}else{echo $awcloans->ksbcdcloan_intrest_amt;} ?></td>
                  <td style="border-color:#d4d6d5;"><?php if($awcloans->ksbcdcloan_intrest_amt==0){echo "";}else{echo $awcloans->ksbcdcloan_intrest_amt;} ?></td>
                </tr>
              <?php } ?>
              <?php 
              $bankloan=$bankloan+($awcloans->ksbcdcloan_repayment_amt);
              $bankloan1=$bankloan1+($awcloans->ksbcdcloan_repayment_amt);
              $bankloanintrest=$bankloanintrest+($awcloans->ksbcdcloan_intrest_amt);
              $bankloanintrest1=$bankloanintrest1+($awcloans->ksbcdcloan_intrest_amt);
            } ?>

              <?php  foreach($gloan_issue as $gloans_issue){ ?>
                 <?php if($gloans_issue->loan_amount!=0){ ?>
                  <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($gloans_issue->loan_sdate)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "ISSUED GROUP LOAN TO"." ".strtoupper($gloans_issue->member_name);; ?></td>
                 <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php if($gloans_issue->loan_amount==0){echo "";}else{echo $gloans_issue->loan_amount;} ?></td>
                </tr>
              <?php } ?>
              <?php $issue_loan=$issue_loan+($gloans_issue->loan_amount);} ?>


              <?php  foreach($linkloan_issue as $linkloans_issue){ ?>
                 <?php if($linkloans_issue->hdsloan_amount!=0){ ?>
                     <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($linkloans_issue->hdsloan_sdate)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "ISSUED PDS LOAN TO"." ".strtoupper($linkloans_issue->member_name);; ?></td>
                 <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php if($linkloans_issue->hdsloan_amount==0){echo "";}else{echo $linkloans_issue->hdsloan_amount;} ?></td>
                </tr>
              <?php } ?>
                 <?php $issue_pdsloan=$issue_pdsloan+($linkloans_issue->hdsloan_amount);} ?>

                  <?php  foreach($iloan_issue as $iloans_issue){ ?>
                     <?php if($iloans_issue->upnrmloan_amount!=0){ ?>
                     <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($iloans_issue->upnrmloan_sdate)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "ISSUED FEDARATION LOAN TO"." ".strtoupper($iloans_issue->member_name); ?></td>
                 <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php if($iloans_issue->upnrmloan_amount==0){echo "";}else{echo $iloans_issue->upnrmloan_amount;} ?></td>
                </tr>
              <?php } ?>
                <?php $issue_upnrmloan=$issue_upnrmloan+($iloans_issue->upnrmloan_amount);} ?>
                <?php foreach($awcloan_issue as $awcloans_issue){ ?>
                   <?php if($awcloans_issue->ksbcdcloan_amount!=0){ ?>
                     <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($awcloans_issue->ksbcdcloan_sdate)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo "ISSUED BANK LOAN TO"." ".strtoupper($awcloans_issue->member_name);; ?></td>
                 <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php if($awcloans_issue->ksbcdcloan_amount==0){echo "";}else{echo $awcloans_issue->ksbcdcloan_amount;} ?></td>
                </tr>
              <?php } ?>
              <?php $issue_bankloan=$issue_bankloan+($awcloans_issue->ksbcdcloan_amount);} ?>
                
                </tbody>
                <tfoot>
                  <tr>
                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;">TOTAL</td>
                    <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $g_loan+$g_loan_intrest+$i_loan+$i_loan_intrest+$pdsloan+$pdsloanintrest+$bankloan+$bankloanintrest; ?></td>
                     <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $i_loan1+$i_loan_intrest1+$pdsloan1+$pdsloanintrest1+$bankloan1+$bankloanintrest1+$issue_loan+$issue_bankloan+$issue_upnrmloan+$issue_pdsloan; ?></td>
                  </tr>

                
                </tfoot>

                    <?php
                
                  }
               
                  ?>

                   <?php 
                  
                        $tvoucher=0;//debit
                          $treceipt=0;
                          if($head==3)
                          {
                    ?>
                    <tbody>
                       <?php foreach($voucher as $row){ ?>
                  <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($row->voucher_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo $row->vouch_head; ?></td>
                 <td style="border-color:#d4d6d5;"></td>
                  <td style="border-color:#d4d6d5;"><?php echo $row->voucher_amount; ?></td>
                </tr>
              <?php $tvoucher=$tvoucher+$row->voucher_amount;} ?>


                <?php foreach($receipt as $rows){ ?>
                  <tr>
                     <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y',strtotime($rows->rept_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo $rows->receipt_head; ?></td>
                 <td style="border-color:#d4d6d5;"><?php echo $rows->receipt_amount; ?></td>
                  <td style="border-color:#d4d6d5;"></td>
                </tr>
              <?php $treceipt=$treceipt+$rows->receipt_amount;} ?>
                      
                    </tbody>
                      <tfoot>
                  <tr>
                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;">TOTAL</td>
                    <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $treceipt; ?></td>
                     <td style="border-color:#d4d6d5;font-weight: bold;"><?php echo $tvoucher; ?></td>
                  </tr>

                
                </tfoot>
                  <?php } ?>

				 
			 </table>
			
            </div>
            <!-- /.box-body -->
        <?php } ?>
			<br><br>	<br><br>	<br><br>	<br><br>	<br><br>	<br><br>	<br><br>	  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>    <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>    <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>    <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br>
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




