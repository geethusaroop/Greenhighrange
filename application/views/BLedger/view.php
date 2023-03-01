<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daybook
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Checkin"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Daybook</li>
      </ol>
    </section>
	<form class="form-horizontal" id="myForm" method="POST" action="<?php echo base_url();?>Daybook/add">
     <!-- Main content -->
    <section class="content">
      <div class="row">
		<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
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
				<div class="col-md-2"></div>
				<div class="col-md-4">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">Date</button>
					</div><!-- /btn-group -->
						<input type="text" class="form-control" id="daybuk_date" Placeholder="Date">
				</div><!-- /input-group -->	
				</div>
				<div class="col-md-2">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" id="search" class="btn btn-primary nohover" >Search</button>
					</div>
				</div>
				</div>
				<div class="col-md-1">
				<div class="input-group margin">
					<button type="button" id="clear" class="btn btn-primary nohover">Refresh</button>
				</div>
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
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
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
                  <td>Date : <span  id="date"></span></td>
                  <td></td>
                  <td></td>  
                </tr>
				<tr>
                  <td></td>
                  <td><b>Opening</b></td>
                  <td id="Opening"></td>
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
				
				<tr id="Purchase">
                  <td></td>
                  <td></td>
				  <td></td>
                  <td id="purchasesum" style="display:none;"></td>
                  <td></td>
                </tr>
				<tr>
                  <td><b>B</b></td>
                  <td><label>Installation</label></td>
                  <td></td>
                  <td></td>
                </tr>
				<tr id="installation">
                  <td></td>
                  <td></td>
				  <td></td>
                  <td id="installationsum" style="display:none;"></td>
                  <td></td>
                </tr>
				<tr>
                  <td><b>C</b></td>
                  <td><label>Receipt Entry</label></td>
                  <td></td>
                  <td></td>
                </tr>
				<tr id="Receipt">
                  <td></td>
                  <td></td>
                  <td></td>
				  <td></td>
                  <td id="recieptsum" style="display:none;"></td>
                </tr>
				<tr>
                  <td><b>D</b></td>
                  <th>Voucher Entry</th>
                  <td></td>
                  <td></td>  
                </tr>
                <tr id="Voucher">
                  <td></td>
                  <td></td>
                  <td></td>
				  <td></td>
                  <td id="vouchersum" style="display:none;"></td>
                </tr>
				<tr>
                  <td><b>D</b></td>
                  <th>Expense Entry</th>
                  <td></td>
                  <td></td>  
                </tr>
                <tr id="Expense">
                  <td></td>
                  <td></td>
                  <td></td>
				  <td></td>
                  <td id="expensesum" style="display:none;"></td>
                </tr>
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






