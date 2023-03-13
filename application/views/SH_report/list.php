<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Shareholder Incentive
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Ledger/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
      <li class="active">Shareholder Incentive</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="box">
        <form name="" method="post" action="<?php echo base_url(); ?>SH_report/getledger">
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
                              if ($vendor == $row->member_id) {
                                echo "selected";
                              }
                            } ?> value="<?php echo $row->member_id; ?>"><?php echo $row->member_name; ?></option>
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
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
              <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">
                <thead>
                  <tr style="border-color:#d4d6d5;">
                    <th colspan="11" style="border-color:#d4d6d5;">
                      <center>SHAREHOLDER PURCHASE REPORT FROM <?php echo date('d/m/Y',strtotime($cdate)); ?> TO <?php echo date('d/m/Y',strtotime($edate)); ?></center>
                    </th>
                  </tr>
                  <tr>
                    <th style="border-color:#d4d6d5;">DATE</th>
                    <th style="border-color:#d4d6d5;">INVOICE</th>
                    <th style="border-color:#d4d6d5;">TOTAL_QTY</th>
                    <th style="border-color:#d4d6d5;">SALE_AMOUNT</th>
                    <th style="border-color:#d4d6d5;">OLD_BALANCE</th>
                    <th style="border-color:#d4d6d5;">DISCOUNT</th>
                    <th style="border-color:#d4d6d5;">SPECIAL_DISCOUNT</th>
                    <th style="border-color:#d4d6d5;">NET_TOTAL</th>
                    <th style="border-color:#d4d6d5;">PAID_AMOUNT</th>
                    <th style="border-color:#d4d6d5;">NEW_BALANCE</th>
                    <th style="border-color:#d4d6d5;">NARRATION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total1 = 0;
                  $total2 = 0;
                  $total3 = 0;
                  $total4=0;
                  ?>
                  <?php foreach ($sale as $sh_report) { ?>
                    <tr>
                      <td style="border-color:#d4d6d5;"><?php echo date('d/m/Y', strtotime($sh_report->sale_date)); ?></td>
                      <td style="border-color:#d4d6d5;"><?php echo $sh_report->invoice_number; ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo $sh_report->qty; ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($sh_report->total, 2); ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($sh_report->sale_old_balance, 2); ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($sh_report->discount, 2); ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($sh_report->sale_shareholder_discount, 2); ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($sh_report->tprice, 2); ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($sh_report->sale_paid_amount, 2); ?></td>
                      <td style="border-color:#d4d6d5;text-align: center;"><?php echo number_format($sh_report->sale_new_balance, 2); ?></td>
                      <td style="border-color:#d4d6d5;">PURCHASE BILL-<b><?php echo $sh_report->invoice_number; ?></b></td>
                    </tr>
                  <?php 
                  $total1=$total1+$sh_report->tprice;
                  $total2=$total2+$sh_report->sale_paid_amount;
                  $total3=$total3+$sh_report->sale_new_balance;
                  $total4=$total4+$sh_report->tprice;
                  } ?>
                </tbody>
                 <tfoot>
                  <tr>
                    <td style="border-color:#d4d6d5;font-weight: bold;"></td>
                    <td style="border-color:#d4d6d5;font-weight: bold;"></td>
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
            <hr>
            
          </div>
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>SH_report/add">
            <div class="row">
              <div class="col-lg-1"></div>
              <div class="col-lg-10">
            <div class="panel panel-info" style="box-shadow: 4px 3px 4px 3px #172158;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>INCENTIVE FORM</b> <span style="float: right;font-weight: bold;">Date : <?php echo date('d-m-Y'); ?></span></h3>
                </div>
                <div class="panel-body" style="font-weight:bold;background: aliceblue;">
                <?php if(isset($count)){if($count==0){ ?>
                <div class="form-group">
                      <div class="col-md-3">
                      <label>Date</label>
                      <input type="date" name="incent_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                      </div>
                      <div class="col-md-3">
                      <label>Total Purchase Amount</label>
                      <input type="text" name="incent_total_purchase_amt" id="pamt" class="form-control" value="<?php echo $total4; ?>">
                      </div>

                      <div class="col-md-3">
                      <label>Incentive %</label>
                      <input type="text" name="incent_percent" id="percent" class="form-control" value="" onkeyup="getincentive();">
                      </div>

                      <div class="col-md-3">
                      <label>Incentive Amount</label>
                      <input type="text" name="incent_amount" id="incent_amount" class="form-control" value="">
                      </div>

                      <input type="hidden" name="incent_from_date" id="incent_from_date" class="form-control" value="<?php echo $cdate; ?>">
                      <input type="hidden" name="incent_to_date" id="incent_to_date" class="form-control" value="<?php echo $edate; ?>">
                      <input type="hidden" name="incent_member_id_fk" id="incent_member_id_fk" class="form-control" value="<?php echo $vendor; ?>">
                </div>
                <hr>
                <div class="box-footer">
                <div class="row">
                  <div class="col-md-5">
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-danger" onclick="window.location.reload();">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
              <?php }else { echo "INCENTIVE ADDED";}} ?>
                </div></div></div></div>
            </form>
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
  $(document).ready(function() {
    $("#month").datepicker({
      format: 'M-yyyy',
      startView: "months",
      minViewMode: "months"
    });
  });
</script>