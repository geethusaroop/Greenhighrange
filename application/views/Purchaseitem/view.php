<?php $arTax = array(""=>'---Please Select---',1=>'Yes',2=>'No') ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase Details Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Purchaseitem/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Purchase Form</li>
      </ol>
    </section>
     <!-- Main content -->
 <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Purchaseitem/add">
    <section class="content">
      <div class="row">
          <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
			       
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            <!-- radio -->
               <div class="form-group">
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label> 
                </div>
                <div class="box-body">
                    <div class="form-group">
					
					<div class="col-sm-6 invoice-col">
					<strong>VENDOR DETAILS</strong><br>
					  Vendor Name: <?php echo $records[0]->vendorname;?><br>
					  Vendor Address: <?php echo $records[0]->vendoraddress;?><br>
					  Vendor GST: <?php echo $records[0]->vendorgst;?><br>
					  
					  Phone: <?php echo $records[0]->vendorphone;?><br>
					  Email: <?php echo $records[0]->vendoremail;?>
					</div>
					
					 <div class="col-sm-4 invoice-col">
					 
						<b>Invoice :<?php echo $records[0]->invoice_number;?></b>
						
					 </div>
					 <div class="pull-right">
					 <div class="col-sm-12 ">
					 
						<b>Date :<?php $date = $records[0]->purchase_date;
						$date = date("d/m/Y", strtotime($date));
						echo $date;?></b><br>
						
					 </div>
					 </div>
					 </div>	
                    </div>
                    <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
				<th>Slno</th>
				<th>Product Name</th>
				<th>Qty</th>
				<th>Price</th>
				<th>Return Qty</th>
        <th>Return Date</th>
				<!-- <th>Edit/Delete</th> -->
            </tr>
            </thead>
            <tbody>
			<?php $sum = 0; for($i=0;$i<count($records);$i++){?>
			<tr>
				<td><?php echo $j = $i + 1;?></td>
				<td><?php echo $records[$i]->product_name; ?></td>
				<td><?php echo $records[$i]->purchase_quantity; ?> Nos.</td>
				<td>Rs.<?php echo $records[$i]->purchase_price; ?></td>
				<td><?php echo $records[$i]->purchase_return; ?></td>
        <td><?php echo $records[$i]->purchase_return_date ? $records[$i]->purchase_return_date : '00/00/0000'; ?></td>
				<!-- <td>&nbsp;&nbsp;&nbsp;<?php if(($records[$i]->stockstatus) == 0){?>
				<a href="<?php echo base_url();?>Purchaseitem/purc/<?php echo $records[$i]->purchase_id; ?>"><i class="fa fa-edit iconFontSize-medium"></i></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>Purchaseitem/delete/<?php echo $records[$i]->purchase_id; ?>"><i class="fa fa-trash-o iconFontSize-medium" ></i></a><?php } 
				else{ ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>Purchaseitem/"><i class="fa fa-refresh  iconFontSize-medium"></i></a>
				<?php } ?></td> -->
            </tr>
			<?php $sum = $sum + $records[$i]->total_price;} ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
              </div>
              <!-- /.box-footer -->
            
          </div>
          <!-- /.box -->
			<div class="box-footer">                
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-4">
                    <button onclick="history.go(-1);">Back </button>
                    </div>
                  </div>
			</div>
        </div>
        <!--/.col (right) -->
     </div>
    </section>
	</form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->