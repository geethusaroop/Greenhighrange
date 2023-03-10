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

      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="<?php echo base_url(); ?>Ledger"><i class="fa fa-dashboard"></i> Back to Add</a></li>

      <li class="active"> Ledger</li>

    </ol>

  </section>

  <!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="box">

        <form name="" method="post" action="<?php echo base_url(); ?>BLedger/getledger">

          <div class="box-header">

            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />

            <!-- <h3 class="box-title">Data Table With Full Features</h3> -->

            <div class="col-md-2"></div>

            <div class="col-md-4">

              <div class="input-group margin">

                <div class="input-group-btn">

                  <button type="button" class="btn btn-primary nohover">Ledger Head</button>

                </div><!-- /btn-group -->

                <!--<input type="text"  class="form-control"  id="ledgerbuk_head"  placeholder="Ledger Head">-->

                <select name="ledgerbuk_head" class="form-control" id="ledgerbuk_head" style="font-weight: bold;">

                  <option value="">-SELECT LEDGER HEAD-</option>

                  <?php /*foreach($ledger as $row){?>

							<option <?php if(isset($head)){if($head==$row->head){echo "selected";}} ?> value="<?php echo $row->head; ?>"><?php echo $row->head; ?></option>

						 <?php }*/ ?>

                  <option <?php if (isset($head)) {

                            if ($head == 1) {

                              echo "selected";

                            }

                          } ?> value="1">PURCHASE</option>

                  <option <?php if (isset($head)) {

                            if ($head == 2) {

                              echo "selected";

                            }

                          } ?> value="2">SALE</option>

                  <option <?php if (isset($head)) {

                            if ($head == 3) {

                              echo "selected";

                            }

                          } ?> value="3">RECEIPTS & PAYMENTS</option>

                <!--   <option <?php if (isset($head)) {

                            if ($head == 4) {

                              echo "selected";

                            }

                          } ?> value="4">SALARY</option>

                  <option <?php if (isset($head)) {

                            if ($head == 5) {

                              echo "selected";

                            }

                          } ?> value="5">ADVANCE</option> -->

                </select>

              </div><!-- /input-group -->

            </div>

            <div class="col-md-4">

              <div class="input-group margin">

                <div class="input-group-btn">

                  <button type="button" class="btn btn-primary nohover">Month</button>

                </div><!-- /btn-group -->

                <input type="text" name="cdate" id="month" class="form-control" value="<?php if (isset($cdate)) {

                                                                                          echo date('M-Y', strtotime($cdate));

                                                                                        } else {

                                                                                          echo date('M-Y');

                                                                                        } ?>" style="font-weight: bold;font-size:16px;">

              </div>

            </div>

            <div class="col-sm-1">

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

            <div class="col-lg-3"></div>

            <div class="col-lg-6">

              <?php if ($head == 1) { ?>

                <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">

                  <thead>

                    <tr style="border-color:#d4d6d5;">

                      <th colspan="6" style="border-color:#d4d6d5;">

                        <center>LEDGER BOOK</center>

                      </th>

                    </tr>

                    <tr>

                      <th style="border-color:#d4d6d5;">DATE</th>

                      <th style="border-color:#d4d6d5;">SUPPLIER</th>

                      <th style="border-color:#d4d6d5;text-align: center;">PAID AMOUNT</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php

                    $i = 0;

                    $tpurchase = 0; //debit

                    ?>

                    <?php foreach ($purc as $row) { ?>

                      <tr style="font-weight: bold;">

                        <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y', strtotime($row->purchase_date)); ?></td>

                        <td style="border-color:#d4d6d5;"><?php echo $row->vendorname; ?></td>

                        <td style="border-color:#d4d6d5;text-align: center;"><?php echo $row->pur_paid_amt; ?></td>

                      </tr>

                    <?php $tpurchase = $tpurchase + $row->pur_paid_amt;

                    } ?>

                  </tbody>

                  <tfoot>

                    <tr>

                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>

                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;">TOTAL</td>

                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo $tpurchase; ?></td>

                    </tr>

                  </tfoot>

                </table>

              <?php } ?>

              <?php if ($head == 2) { ?>

                <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">

                  <thead>

                    <tr style="border-color:#d4d6d5;">

                      <th colspan="6" style="border-color:#d4d6d5;">

                        <center>LEDGER BOOK</center>

                      </th>

                    </tr>

                    <tr>

                      <th style="border-color:#d4d6d5;">DATE</th>

                      <th style="border-color:#d4d6d5;">CUSTOMER</th>

                      <th style="border-color:#d4d6d5;text-align: center;">AMOUNT</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php

                    $i = 0;

                    $tsale = 0; //debit

                    ?>

                    <?php foreach ($sale as $row) { ?>

                      <tr style="font-weight: bold;">

                        <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y', strtotime($row->sale_date)); ?></td>

                        <td style="border-color:#d4d6d5;"><?php echo $row->member_name; ?></td>

                        <td style="border-color:#d4d6d5;text-align: center;"><?php echo $row->total_price; ?></td>

                      </tr>

                    <?php $tsale = $tsale + $row->total_price;

                    } ?>

                  </tbody>

                  <tfoot>

                    <tr>

                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>

                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;">TOTAL</td>

                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo $tsale; ?></td>

                    </tr>

                  </tfoot>

                </table>

              <?php } ?>

              <?php if ($head == 3) { ?>

                <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">

                  <thead>

                    <tr style="border-color:#d4d6d5;">

                      <th colspan="6" style="border-color:#d4d6d5;">

                        <center>LEDGER BOOK</center>

                      </th>

                    </tr>

                    <tr>

                      <th style="border-color:#d4d6d5;">DATE</th>

                      <th style="border-color:#d4d6d5;">PARTICULAR</th>

                      <th style="border-color:#d4d6d5;text-align: center;">CREDIT</th>

                      <th style="border-color:#d4d6d5;text-align: center;">DEBIT</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php

                    $i = 0;

                    $tvoucher = 0; //debit

                    $treceipt = 0;

                    ?>

                    <?php foreach ($voucher as $row) { ?>

                      <tr style="font-weight: bold;">

                        <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y', strtotime($row->voucher_date)); ?></td>

                        <td style="border-color:#d4d6d5;"><?php echo $row->vouch_head; ?></td>

                        <td style="border-color:#d4d6d5;"></td>

                        <td style="border-color:#d4d6d5;text-align: center;"><?php echo $row->voucher_amount; ?></td>

                      </tr>

                    <?php $tvoucher = $tvoucher + $row->voucher_amount;

                    } ?>

                    <?php foreach ($receipt as $rows) { ?>

                      <tr style="font-weight: bold;">

                        <td style="border-color:#d4d6d5;"><?php echo date('d-m-Y', strtotime($rows->rept_date)); ?></td>

                        <td style="border-color:#d4d6d5;"><?php echo $rows->receipt_head; ?></td>

                        <td style="border-color:#d4d6d5;text-align: center;"><?php echo $rows->receipt_amount; ?></td>

                        <td style="border-color:#d4d6d5;"></td>

                      </tr>

                    <?php $treceipt = $treceipt + $rows->receipt_amount;

                    } ?>

                  </tbody>

                  <tfoot>

                    <tr>

                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>

                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;">TOTAL</td>

                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo $treceipt; ?></td>

                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo $tvoucher; ?></td>

                    </tr>

                  </tfoot>

                </table>

              <?php } ?>

              <?php if ($head == 4) { ?>

                <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">

                  <thead>

                    <tr style="border-color:#d4d6d5;">

                      <th colspan="6" style="border-color:#d4d6d5;">

                        <center>LEDGER BOOK</center>

                      </th>

                    </tr>

                    <tr>

                      <th style="border-color:#d4d6d5;">DATE</th>

                      <th style="border-color:#d4d6d5;">EMPLOYEE</th>

                      <th style="border-color:#d4d6d5;text-align: center;">AMOUNT</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php

                    $i = 0;

                    $purchase = 0;

                    ?>

                    <?php foreach ($payroll as $rows1) { ?>

                      <tr>

                        <td style="border-color:#d4d6d5;"><?php echo date('d/m/Y', strtotime($rows1->payroll_salarydate)); ?></td>

                        <td style="border-color:#d4d6d5;"><?php echo $rows1->emp_name; ?></td>

                        <td style="border-color:#d4d6d5;text-align: center;"><?php echo $rows1->payroll_salary; ?></td>

                      </tr>

                    <?php $purchase = $purchase + $rows1->payroll_salary;

                    } ?>

                  </tbody>

                  <tfoot>

                    <tr>

                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>

                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;">TOTAL</td>

                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo $purchase; ?></td>

                    </tr>

                  </tfoot>

                </table>

              <?php } ?>

              <?php if ($head == 5) { ?>

                <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">

                  <thead>

                    <tr style="border-color:#d4d6d5;">

                      <th colspan="6" style="border-color:#d4d6d5;">

                        <center>LEDGER BOOK</center>

                      </th>

                    </tr>

                    <tr>

                      <th style="border-color:#d4d6d5;">DATE</th>

                      <th style="border-color:#d4d6d5;">EMPLOYEE</th>

                      <th style="border-color:#d4d6d5;text-align: center;">AMOUNT</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php

                    $i = 0;

                    $test = 0;

                    ?>

                    <?php foreach ($advance as $rows1) { ?>

                      <tr>

                        <td style="border-color:#d4d6d5;"><?php echo date('d/m/Y', strtotime($rows1->adv_date)); ?></td>

                        <td style="border-color:#d4d6d5;"><?php echo $rows1->emp_name; ?></td>

                        <td style="border-color:#d4d6d5;text-align: center;"><?php echo $rows1->adv_amount; ?></td>

                      </tr>

                    <?php $test = $test + $rows1->adv_amount;

                    } ?>

                  </tbody>

                  <tfoot>

                    <tr>

                      <td style="border-color:#d4d6d5;font-weight: bold;"></td>

                      <td style="border-color:#d4d6d5;font-weight: bold;color:red;">TOTAL</td>

                      <td style="border-color:#d4d6d5;font-weight: bold;text-align: center;"><?php echo $test; ?></td>

                    </tr>

                  </tfoot>

                </table>

              <?php } ?>

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