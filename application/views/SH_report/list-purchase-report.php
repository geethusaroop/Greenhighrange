<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Purchase From Shareholder Report
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Ledger/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
      <li class="active">Purchase From Shareholder  Report</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="box">
        <form name="" method="post" action="<?php echo base_url(); ?>SH_report/getpledger_report">
          <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
            <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
            <div class="col-md-4">
              <div class="input-group margin">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-primary nohover">SHAREHOLDER</button>
                </div><!-- /btn-group -->
                <select name="shareholder_id_fk" id="shareholder_id_fk" class="form-control" style="font-weight: bold;">
                  <option value="">SELECT</option>
                  <?php foreach ($member_names as $row) { ?>
                    <option <?php if (isset($vendor)) {
                              if ($vendor == $row->vendor_id) {
                                echo "selected";
                              }
                            } ?> value="<?php echo $row->vendor_id; ?>"><?php echo $row->vendorname; ?></option>
                  <?php } ?>
                </select>
              </div><!-- /input-group -->
            </div>
            <div class="col-md-3">
              <div class="input-group margin">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-primary nohover">From</button>
                </div><!-- /btn-group -->
                <input type="date" name="cdate" min="2022-04-01" class="form-control" value="<?php if (isset($cdate)) {
                                                                                                echo $cdate;
                                                                                              } else {
                                                                                                echo date('Y-m-01');
                                                                                              } ?>" style="font-weight: bold;font-size:16px;">
              </div>
            </div>
            <div class="col-md-3">
              <div class="input-group margin">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-primary nohover">To</button>
                </div><!-- /btn-group -->
                <input type="date" name="edate" class="form-control" value="<?php if (isset($edate)) {
                                                                              echo $edate;
                                                                            } else {
                                                                              echo date('Y-m-t');
                                                                            } ?>" style="font-weight: bold;font-size:16px;">
              </div>
            </div>
            <div class="col-sm-2">
              <div class="input-group">
                <button type="submit" id="search" class="btn bg-orange btn-flat margin">Search</button>
              </div>
            </div>
          </div>
        </form>
        <hr>
        <!-- /.box-header -->
        <?php if (isset($cdate) && isset($edate)) { ?>
          <div class="box-body">
           <!--  <div class="col-lg-1"></div> -->
            <div class="col-lg-12">
              <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">
                <thead>
                  <tr style="border-color:#d4d6d5;">
                    <th colspan="12" style="border-color:#d4d6d5;">
                      <center>PURCHASE FROM SHAREHOLDER REPORT</center>
                    </th>
                  </tr>
                  <tr>
                  
                    <th style="border-color:#d4d6d5;">DATE</th>
                    <th style="border-color:#d4d6d5;">INVOICE</th>
                    <th style="border-color:#d4d6d5;">TOTAL_QTY</th>
                    <th style="border-color:#d4d6d5;">PURCHASE_AMOUNT</th>
                    <th style="border-color:#d4d6d5;">DISCOUNT</th>
                    <th style="border-color:#d4d6d5;">NET_TOTAL</th>
                    <th style="border-color:#d4d6d5;">PAID_AMOUNT</th>
                    <th style="border-color:#d4d6d5;">NEW_BALANCE</th>
                    <th style="border-color:#d4d6d5;">NARRATION</th>
                    <th style="border-color:#d4d6d5;">BRANCH</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total1 = 0;
                  $total2 = 0;
                  $total3 = 0;
                  ?>
                  <?php foreach ($sale as $sh_report) { ?>
                    <tr>
                   
                      <td style="border-color:#d4d6d5;"><?php echo date('d/m/Y', strtotime($sh_report->purchase_date)); ?></td>
                      <td style="border-color:#d4d6d5;"><?php echo $sh_report->invoice_number; ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo $sh_report->qty; ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($sh_report->total, 2); ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($sh_report->discount, 2); ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($sh_report->tprice, 2); ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($sh_report->pur_paid_amt, 2); ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($sh_report->pur_new_bal, 2); ?></td>
                      <td style="border-color:#d4d6d5;">PURCHASE BILL-<b><?php echo $sh_report->invoice_number; ?></b></td>
                      <td style="border-color:#d4d6d5;"><?php echo $sh_report->branch_name; ?></td>
                    </tr>
                  <?php 
                  $total1=$total1+$sh_report->tprice;
                  $total2=$total2+$sh_report->pur_paid_amt;
                  $total3=$total3+$sh_report->pur_new_bal;
                  } ?>
                </tbody>
                 <tfoot>
                  <tr>
                    <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;color:red;text-align:center;">TOTAL</td>
                    <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo $total1; ?></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo $total2; ?></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo $total3; ?></td>
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
      <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>index.php/Ledger/add_opening_balance" enctype="multipart/form-data">
        <div class="modal-body" style="font-weight: bold;">
          <div class="form-group">
            <div class="col-md-4">
              <label>Supplier Name<span style="color:red"></span></label>
              <select name="vendor_id" id="vendor_id" class="form-control select2" style="font-weight: bold;">
                <option value="">SELECT</option>
                <?php foreach ($vendor_names as $row) { ?>
                  <option <?php if (isset($vendor)) {
                            if ($vendor == $row->vendor_id) {
                              echo "selected";
                            }
                          } ?> value="<?php echo $row->vendor_id; ?>"><?php echo $row->vendorname; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-4">
              <label>Date<span style="color:red"></span></label>
              <input type="date" data-pms-required="true" autofocus class="form-control" name="cdate_bal" value="<?php echo "2021-03-31"; ?>">
            </div>
            <div class="col-md-4">
              <label>Opening Balance<span style="color:red"></span></label>
              <input type="text" data-pms-required="true" autofocus class="form-control" name="closing_amt" value="">
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
  $(document).ready(function() {
    $("#month").datepicker({
      format: 'M-yyyy',
      startView: "months",
      minViewMode: "months"
    });
  });
</script>