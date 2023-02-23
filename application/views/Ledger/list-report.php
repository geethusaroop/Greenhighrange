
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
      <li><a href="<?php echo base_url();?>Ledger/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
      <li class="active">  Ledger</li>
    </ol>
  </section>
 
   <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="box">
            <form name="" method="post" action="<?php echo base_url(); ?>Ledger/getledger_report">
          <div class="box-header">
          <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
            
              <div class="col-md-4">
                  <div class="input-group margin">
                      <div class="input-group-btn">
                          <button type="button" class="btn btn-primary nohover">SUPPLIER</button>
                      </div><!-- /btn-group -->

                      <select name="vendor_id_fk" id="vendor_id_fk" class="form-control" style="font-weight: bold;">
                      <option value="">SELECT</option>
                      <?php foreach ($vendor_names as $row){ ?> 
                        <option <?php if(isset($vendor)){if($vendor==$row->vendor_id){echo "selected";}} ?> value="<?php echo $row->vendor_id; ?>"><?php echo $row->vendorname; ?></option>
                        <?php } ?>
                    </select>
                  
              </div><!-- /input-group -->
              </div>
          <div class="col-md-3">
              <div class="input-group margin">
                  <div class="input-group-btn">
                      <button type="button" class="btn btn-primary nohover">From</button>
                  </div><!-- /btn-group -->
                       <input type="date" name="cdate" min="2022-04-01"   class="form-control" value="<?php if(isset($cdate)){echo $cdate;}else{ echo date('Y-m-01');} ?>" style="font-weight: bold;font-size:16px;">
                      
              </div>
          </div>

          <div class="col-md-3">
              <div class="input-group margin">
                  <div class="input-group-btn">
                      <button type="button" class="btn btn-primary nohover">To</button>
                  </div><!-- /btn-group -->
                       <input type="date" name="edate"  class="form-control" value="<?php if(isset($edate)){echo $edate;}else{ echo date('Y-m-t');} ?>" style="font-weight: bold;font-size:16px;">
                      
              </div>
          </div>
          
          <div class="col-sm-2">
                  <div class="input-group">
                      <button type="submit" id="search" class="btn bg-orange btn-flat margin" >Search</button>
                    
                <button type="button" class="btn btn-success"  data-toggle="modal" data-target=".bd-example-modal-lg">Add Opening Balance</button>
                
                  </div>
          </div>

          </div>
            </form>
            <hr>
          
          <!-- /.box-header -->
          <?php if(isset($gid) && isset($cdate) && isset($edate)){ ?>

            <div class="box-body">
            <div class="col-lg-2"></div>  
              <div class="col-lg-8">
       
            <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">
              <thead>
                <tr style="border-color:#d4d6d5;"><th colspan="6" style="border-color:#d4d6d5;"><center>LEDGER BOOK</center></th></tr>
              <tr>
      
         <th style="border-color:#d4d6d5;">DATE</th>
        <th style="border-color:#d4d6d5;">VCH.NO</th>
        <th style="border-color:#d4d6d5;">PARTICULARS</th>
        <th style="border-color:#d4d6d5;text-align: center;">RECEIPTS</th>
        <th style="border-color:#d4d6d5;text-align: center;">PAYMENTS</th>
        <th style="border-color:#d4d6d5;">NARRATION</th>
              </tr>
              
              </thead>
             
              <tbody>
                  <?php
                  $i=0; 
                 
                  $purchases=0;
                  $purchase1s=0;

                  $pay=0;
                  $preturn=0;
                  $obal=0;
             
                 ?>

          <?php
          if($cdate=='2022-04-01'){$val=$cbal2->opening_balance; ?>
          
                <tr>
                   <td style="border-color:#d4d6d5;"></td>
                   <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-transform:uppercase;">Opening Balance</td>
                 <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($val,2); ?></td>
                <td style="border-color:#d4d6d5;text-align: center;"></td>
                <td style="border-color:#d4d6d5;"><b></b></td>
              </tr>
          
          <?php }else { 
          
          foreach($cbal as $rows1){$obal=$obal+($rows1->total_bal);}$val=($obal+$cbal2->opening_balance)-$cbal1->voucher_amount;  ?>
                <tr>
                   <td style="border-color:#d4d6d5;"></td>
                   <td style="border-color:#d4d6d5;"></td>
                 <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-transform:uppercase;">Opening Balance</td>
                 <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($val,2); ?></td>
                <td style="border-color:#d4d6d5;text-align: center;"></td>
                <td style="border-color:#d4d6d5;"><b></b></td>
              </tr>
          <?php } ?>
                

            <?php foreach($purc1 as $rows1){ ?>
                <tr>
                   <td style="border-color:#d4d6d5;"><?php echo date('d/m/Y',strtotime($rows1->purchase_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo $rows1->invoice_number; ?></td>
                 <td style="border-color:#d4d6d5;"><?php echo $rows1->vendorname; ?></td>
                 <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($rows1->pur_new_bal,2); ?></td>
                <td style="border-color:#d4d6d5;text-align: center;"><?php //echo $rows1->pur_paid_amt; ?></td>
                <td style="border-color:#d4d6d5;">PURCHASE BILL-<b><?php echo $rows1->invoice_number; ?></b></td>
              </tr>
            <?php $purchase1s=$purchase1s+$rows1->pur_new_bal;} ?>

            <?php foreach($purc2 as $rows2){ ?>
                <tr>
                   <td style="border-color:#d4d6d5;"><?php echo date('d/m/Y',strtotime($rows2->voucher_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo $rows2->voucher_group; ?></td>
                 <td style="border-color:#d4d6d5;"><?php echo $rows2->vendorname; ?></td>
                 <td style="border-color:#d4d6d5;text-align: center;"></td>
                <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($rows2->voucher_amount,2); ?></td>
                <td style="border-color:#d4d6d5;"><?php echo $rows2->narration; ?>-<b><?php echo $rows2->voucher_group; ?></b></td>
              </tr>
            <?php $pay=$pay+$rows2->voucher_amount;} ?>

         
                        <?php foreach($purchase_return1 as $rows2){ ?>

                          <tr>
                   <td style="border-color:#d4d6d5;"><?php echo date('d/m/Y',strtotime($rows2->purchase_return_date)); ?></td>
                   <td style="border-color:#d4d6d5;"><?php echo $rows2->invoice_number; ?></td>
                 <td style="border-color:#d4d6d5;"><?php echo $rows2->vendorname; ?></td>
                 <td style="border-color:#d4d6d5;text-align: center;"></td>
                <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($rows2->purchase_return_amt,2); ?></td>
                <td style="border-color:#d4d6d5;">Purchase Return-<b><?php echo $rows2->invoice_number; ?></b></td>
              </tr>

             
                      <?php $preturn=$preturn+$rows2->purchase_return_amt;} ?>
           
              </tbody>
             
                  
              <tfoot>
                <tr>
                  <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                  <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                  <td style="border-color:#d4d6d5;font-weight: bold;color:red;">TOTAL</td>
                  <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo number_format(($purchase1s+$val),2); ?></td>
                   <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo number_format(($pay+$preturn),2); ?></td>
                   <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                </tr>

                <tr>
                  <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                  <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                  <td style="border-color:#d4d6d5;font-weight: bold;color:red;">CLOSING BALANCE</td>
                  <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"></td>
                   <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo number_format((($purchase1s+$val)-($pay+$preturn)),2); ?></td>
                   <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                </tr>
              </tfoot>
           
     </table>
   
     
 
          </div>
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



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="exampleModalLabel" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><b>Add Opening Balance</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Ledger/add_opening_balance" enctype="multipart/form-data">
      <div class="modal-body" style="font-weight: bold;">
    

<div class="form-group">

    <div class="col-md-4">
    <label>Supplier Name<span style="color:red"></span></label>
    <select name="vendor_id" id="vendor_id" class="form-control select2" style="font-weight: bold;">
                      <option value="">SELECT</option>
                      <?php foreach ($vendor_names as $row){ ?> 
                        <option <?php if(isset($vendor)){if($vendor==$row->vendor_id){echo "selected";}} ?> value="<?php echo $row->vendor_id; ?>"><?php echo $row->vendorname; ?></option>
                        <?php } ?>
                    </select>
    </div>


    <div class="col-md-4">
       <label>Date<span style="color:red"></span></label>
      <input type="date" data-pms-required="true" autofocus class="form-control" name="cdate_bal"  value="<?php echo "2021-03-31"; ?>">
    </div>
 <div class="col-md-4">
        <label>Opening Balance<span style="color:red"></span></label>
      <input type="text" data-pms-required="true" autofocus class="form-control" name="closing_amt"  value="">
    </div>
</div> 

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div><!--endds add dmlogin-->












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




