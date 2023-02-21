<?php $arTax = array(""=>'---Please Select---',1=>'Yes',2=>'No') ?>
<style>
        h4 {
            display: flex;
            flex-direction: row;
        }
          
        h4:before,
        h4:after {
            content: "";
            flex: 1 1;
            border-bottom: 2px solid #000;
            margin: auto;
        }
          
     
    </style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sale Details Form
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Sale/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Sale Form</li>
      </ol>
    </section>

     <!-- Main content -->
 <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Sale/add/">
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
				<input type="hidden" id="shop_id_fk" class="form-control" name="shpid" value="<?php echo $this->session->userdata('shop_id') ?>" disabled />
					<table>
						<tr>
							
							<td>
								<label for="product_name" class="">Bill No: </label>
							</td>
							<td width="20px"></td>
							<td>
								<input type="text" placeholder="Bill No" class="form-control" name="bill_no" id="bill_no" value="<?php if(isset($records->auto_invoice)){ echo $records->auto_invoice;} ?>"/>
							</td>
							<td width="50px"></td>
							<td>
								<label for="product_name" class=" ">Bill Date: </label></td>
							<td width="20px"></td>
							<td>
								<input type="text" placeholder="Bill Date" data-pms-required="true" class="form-control" name="purchase_date" id="date" value="<?php if(isset($records->purchase_date)) { echo $records->purchase_date;} else{ echo date('Y/m/d');} ?>">
							</td>
							<td width="50px"></td>
							<td>
								<label for="invoice" class="">Invoice No.</label>
							</td>
							<td width="20px"></td>
							<td>
								<input type="text" placeholder="Invoice Number" readonly class="form-control" name="invoice_no" id="invoice_n" value="<?php if(isset($records->invoice_number)){ echo $records->invoice_number;} else{ echo $invno; }?>"/>
							</td>
							<td width="50px"></td>
							<td>
								<label for="invoice" class="">PO Date.</label>
							</td>
							<td width="20px"></td>
							<td>
								<input type="text" placeholder="" data-pms-required="true" class="form-control" name="purchase_date" id="pdate" value="<?php if(isset($records->purchase_date)) { echo $records->purchase_date;} else{ echo date('Y/m/d');} ?>">
							</td>	
						</tr>

						</table>
						<table>
						<tr><td><br/></td></tr>
						<tr>
							<td >
								<label for="customer_name" class="1">Cust Name</label>
							</td>
							<td width="20px"></td>		
							<td>
								<!--input type="text" placeholder="Customer Name" data-pms-required="true" class="form-control" name="customer_name" id="customer_nam" value="<?php if(isset($records->customer_name)) echo $records->customer_name; ?>" /-->

								<select class="form-control" name="customer_name" id="customer_nam"  >
								<option>--SELECT CUSTOMER--</option>
								<?php
								foreach($customer_names AS $row){?>

								<option value="<?php echo $row->cust_id; ?>"><?php echo $row->custname; ?></option>';
								<?php } ?>
								
								?>
								</select>
							</td>
							<td width="30px"></td>								
							<td width="100px">
								<label for="customer_addr" class="">Billing Address</label>
							</td>	

							<td width="200px">
								<textarea class="form-control" name="customer_address" id="customer_addre"></textarea>
							</td>
							<td width="20"></td>
							<td><label for="customer_phone" class="">Customer Mob.No  </label></td>
							<td width="20"></td>
							<td><input type="text" placeholder="Customer Mob.No" data-pms-required="true" class="form-control" name="customer_phone" id="customer_phon" /></td>
							<td width="20"></td>
							<td><label for="" class="">Tax </label></td>
							<td width="10"></td>
							<td>
								<input type="hidden"  id="tax_id" value="<?php if(isset($records->tax_id_fk)) echo $records->tax_id_fk; ?>"/>
        						 <?php echo form_dropdown('tax_id', $tax_names, '', 'id="tax" class="form-control select2"  data-pms-required="true" data-pms-type="dropDown"', 'name="tax_type"' );?>
        					</td>
						</tr>
					</table>
				</div>
				<div class="form-group">
				 <label for="customer_email" class="col-sm-2 control-label"></label>
					<div class="col-sm-4">
					<input type="hidden" placeholder="Customer Email" class="form-control" name="customer_email" id="customer_email" value="0" />
					</div>
				</div>
				<div class="form-group">
				 <label for="customer_phone" class="col-sm-2 control-label"></label>
					<div class="col-sm-4">
					<input type="hidden" placeholder="Customer GST" class="form-control" name="customer_gst" id="customer_gst" />
					</div>
				</div>
				<div class="box-body no-padding">
					<DIV id="product" class="box-body no-padding" ></div>
					<i class="fa fa-fw fa-plus-square pull-left fa-2x" onClick="addMore();" Style="color:green;"></i>
					<br/><br/>
					<i class="col-sm-5"></i>
					<strong id="myDiv">Available Stock is: <span id="quant"></span></strong>
					<i class="fa fa-fw fa-minus-square pull-right fa-2x" onClick="deleteRow();" Style="color:red;"></i>
					<br/><br/>
					<div class="NetTotalAmount pull-righ" style="display: none;">
						<table id="myTable" align="center" border="1" width="1000px">
							<th style="background-color:#008000"><font color="white">Sl no</font></th><th style="background-color:#008000"><font color="white">Product Name</font></th><th style="background-color:#008000"><font color="white">Quanity</font></th><th style="background-color:#008000"><font color="white">Unit price</font></th><th style="background-color:#008000"><font color="white">Total price</font></th>
						</table>
					<div class="pull-right" ><h3>Grand Tot: <b><span id="grand_tota"></span><br/><input type="text" name="net_total" id="net_total" /></b></h3></div>
					</div>
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
                  	<center>
                      <!-- <button type="button" class="btn btn-danger" onclick="window.location.reload();">New</button>
                      <button type="button" class="btn btn-primary" onclick="window.location.reload();">Clear</button> -->
                      <button type="submit" class="btn btn-primary" >Save</button>
                  	  <button type="button" class="btn btn-danger" onclick="window.location.reload();">Cancel</button>
                     <!--  <button class="btn btn-danger" onclick="window.print()">Print</button> -->
                   </center>
                  </div>
              </div>
			</div>
        </div>
        <!--/.col (right) -->
     </div>

    </section>
	</form>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->