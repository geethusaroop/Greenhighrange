<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Daybook
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Ledger"><i class="fa fa-dashboard"></i> Back to List</a></li>
      <li class="active">Daybook</li>
    </ol>
  </section>
  <form class="form-horizontal" id="myForm" method="POST" action="<?php echo base_url(); ?>Daybook/add">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <!-- radio -->
            <div class="row">
              <div class="form-group">
                <div class="col-md-10"></div>
                <div class="col-sm-2">
                  <div class="input-group margin">
                    <div class="input-group-btn">
                      <a href="<?php echo base_url(); ?>Daybook/view" class="btn btn-primary"> Search for prev</a>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <?php echo validation_errors(); ?>
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
                <!-- /.box-body -->
                <div class="box" id="daybuk" style="width:100%;max-width:800px;margin:auto">
                  <div class="box-header with-border">
                    <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
                    <h3 class="box-title">Daybook Details</h3>
                  </div>
                  <div id="checkin"></div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered" id="daybook" data-tableName="Test Table 2">
                      <thead>
                        <tr>
                          <th style="width: 10px">SI</th>
                          <th>Particulars</th>
                          <th>Income</th>
                          <th style="width: 40px">Expense</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td></td>
                          <td>Date :<span id="date"><?php echo date('d/m/Y'); ?></span></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><b>Opening</b></td>
                          <td id="Opening"><?php if (isset($opening[0]->closing_amount)) echo $opening[0]->closing_amount; ?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                          <th>Income</th>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td><b>A</b></td>
                          <td><label>Purchase</label></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <?php for ($i = 0; $i < count($purchase); $i++) { ?>
                          <tr id="Purchase">
                            <td><?php echo $i + 1; ?></td>
                            <td>Name:<?php echo $purchase[$i]->product_name; ?>, Brand:<?php echo $purchase[$i]->product_brand; ?>, Amount:<?php echo $purchase[$i]->purchase_amount; ?></td>
                            <td></td>
                            <td><?php echo $purchase[$i]->purchase_amount; ?></td>
                            <td id="purchasesum" style="display:none;"><?php echo $purchasesum[0]->purchasesum; ?></td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td><b>B</b></td>
                          <td><label>Installation</label></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <?php for ($i = 0; $i < count($installation); $i++) { ?>
                          <tr id="installation">
                            <td><?php echo $i + 1; ?></td>
                            <td>Name:<?php echo $installation[$i]->product_name; ?>, Brand:<?php echo $installation[$i]->product_brand; ?>, Amount:<?php echo $installation[$i]->inst_total; ?></td>
                            <td><?php echo $installation[$i]->inst_total; ?></td>
                            <td id="installationsum" style="display:none;"><?php echo $installationsum[0]->installationsum; ?></td>
                            <td></td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td><b>C</b></td>
                          <td><label>Receipt Entry</label></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <?php for ($i = 0; $i < count($reciept); $i++) { ?>
                          <tr id="Receipt">
                            <td><?php echo $i + 1; ?> </td>
                            <td><?php echo $reciept[$i]->receipt_head; ?></td>
                            <td><?php echo $reciept[$i]->receipt_amount; ?></td>
                            <td></td>
                            <td id="receiptsum" style="display:none;"><?php echo $recieptsum[0]->receiptsum; ?></td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td><b>D</b></td>
                          <th>Voucher Entry</th>
                          <td></td>
                          <td></td>
                        </tr>
                        <?php for ($i = 0; $i < count($voucher); $i++) { ?>
                          <tr id="Voucher">
                            <td><?php echo $i + 1; ?></td>
                            <td><?php echo $voucher[$i]->vouch_head; ?></td>
                            <td></td>
                            <td><?php echo $voucher[$i]->voucher_amount; ?></td>
                            <td id="vouchersum" style="display:none;"><?php echo $vouchersum[0]->vouchersum; ?></td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td><b>E</b></td>
                          <th>Expense Entry</th>
                          <td></td>
                          <td></td>
                        </tr>
                        <?php for ($i = 0; $i < count($expense); $i++) { ?>
                          <tr id="Expense">
                            <td><?php echo $i + 1; ?></td>
                            <td><?php echo $expense[$i]->expense_description; ?></td>
                            <td></td>
                            <td><?php echo $expense[$i]->expense_amount; ?></td>
                            <td id="expensesum" style="display:none;"><?php echo $expensesum[0]->expensesum; ?></td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td></td>
                          <td><label>Total</label></td>
                          <td id="income"></td>
                          <td id="expense"></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><label>Out standing</label></td>
                          <td><b id="Outs"></b></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer clearfix">
                    <div align="right">
                      <button type="button" class="btn btn-success" id="save">Save</button>
                    </div>
                  </div>
                </div>
                <!-- /.box-footer -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.box -->
          </div>
          <!--/.col (right) -->
        </div>
    </section>
  </form>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->