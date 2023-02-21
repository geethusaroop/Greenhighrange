<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sale Invoice
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Sale/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Sale Invoice</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="invoice" >
      <!-- title row -->
<div class="inner" id="invcont" >
     <div class="row">
		<div class="col-sm-12">
			<h2 class="page-header">
				<center><strong><?php echo $records[0]->shopname;?></strong><br>Customer : <?php echo $records[0]->custname;?><br><?php echo $records[0]->custaddress;?><br>Phone: <?php echo $records[0]->custphone; ?> <br></center>
				<center><small class="pull-right" ><b>GSTIN: <?php echo $records[0]->custgst;?></b></small></center>
			</h2>
			<h2 class="page-header">
				<center><strong>TAX INVOICE</strong></center>
			</h2>
		</div>
	 </div>
<div class="row invoice-info" >
	<div class="col-sm-12 invoice-col">
		<table class="" border="1" width="100%" cellpadding="2" cellspacing="0">
			<tr>
				<td colspan="1"><strong>Invoice Number:</strong></td>
				<td colspan="2"><b style="color:blue"><?php echo $records[0]->invoice_number;?></b></td>
				<td colspan="4"><strong>Transport Mode:</strong></td>
				<td colspan="5"></td>
			</tr>
			<tr>
				<td colspan="1"><strong>Invoice Date:</strong></td>
				<td colspan="2"><?php if(isset($records[0]->sale_date)){ $sl_date = str_replace('-', '/', $records[0]->sale_date); $sl_date =  date("d/m/Y",strtotime($sl_date));  echo $sl_date; }?></td>
				<td colspan="4"><strong>Vehicle Number:</strong></td>
				<td colspan="5"></td>
			</tr>
			<tr>
				<td colspan="1"><strong>Reverse Charge (Y/N):</strong></td>
				<td colspan="2"></td>
				<td colspan="4"><strong>Date of Supply:</strong></td>
				<td colspan="5"><?php if(isset($records[0]->sale_date)){ $sl_date = str_replace('-', '/', $records[0]->sale_date); $sl_date =  date("d/m/Y",strtotime($sl_date));  echo $sl_date; }?></td>
			</tr>
			<tr>
				<td colspan="1"><strong>State:</strong></td>
				<td colspan="1"></td>
				<td colspan="1"><strong>Code:</strong></td>
				
				<td colspan="4"><strong>Place of Supply:</strong></td>
				<td colspan="5"></td>
			</tr>
			<tr>
				<td colspan="12"><br></td>
			</tr>
			<tr>
				<td colspan="3"><strong><center>Bill to Party</center></strong></td>
				<td colspan="8"><strong><center>Ship to Party</center></strong></td>
			</tr>
			<tr>
				<td colspan="1"><strong>Name:</strong></td>
				<td colspan="2"><?php echo $records[0]->customer_name;?></td>
				<td colspan="4"><strong>Name:</strong></td>
				<td colspan="5"><?php echo $records[0]->customer_name;?></td>
			</tr>
			<tr>
				<td colspan="1" rowspan="2"><strong>Address:</strong></td>
				<td colspan="2" rowspan="2"><?php echo $records[0]->customer_address;?></td>
				<td colspan="4" rowspan="2"><strong>Address:</strong></td>
				<td colspan="5" rowspan="2"><?php echo $records[0]->customer_address;?></td>
			</tr>
			<tr>
				<td colspan="12"><br></td>
			</tr>
			<tr>
				<td colspan="1"><strong>GSTIN:</strong></td>
				<td colspan="2"><?php echo $records[0]->customer_gst;?></td>
				<td colspan="4"><strong>GSTIN:</strong></td>
				<td colspan="5"><?php echo $records[0]->customer_gst;?></td>
			</tr>
			<tr>
				<td colspan="1"><strong>State:</strong></td>
				<td colspan="1"></td>
				<td colspan="1"><strong>Code:</strong></td>
				
				<td colspan="4"><strong>State:</strong></td>
				<td colspan="2"></td>
				<td colspan="1"><strong>Code:</strong></td>
				<td colspan="1"></td>
			</tr>
			<tr>
				<td colspan="12"><br></td>
			</tr>			
			<tr>
				<th><center>S.No</center></th>
				<th><center>PRODUCT DESCRIPTION</center></th>
				<th><center>QTY</center></th>
				<th><center>RATE</center></th>
				<th><center>SGST %</center></th>
				<th><center>SGST AMT</center></th>
				<th><center>CGST %</center></th>
				<th><center>CGST AMT</center></th>
				<th><center>DISCOUNT</center></th>
				<th colspan="2"><center>TOTAL</center></th>
			</tr>
				<?php $sum = 0; $totrate = 0; $totcgst = 0; for($i=0;$i<count($records);$i++){?>
			<tr>
			  <td><center><?php echo $j = $i + 1;?></center></td>
			  <td><center><?php echo $records[$i]->item_name; ?></center></td>
			  <td><center><?php echo $records[$i]->sale_quantity; ?> Nos.</center></td>
			  <td><center>Rs. <?php echo $records[$i]->rate; ?></center></td>
			  <td><center><?php echo $records[$i]->taxper; ?>%</center></td>
			  <td><center>Rs. <?php echo $records[$i]->sgst; ?></center></td>
			  <td><center><?php echo $records[$i]->taxper; ?>%</center></td>
			  <td><center>Rs. <?php echo $records[$i]->sgst; ?></center></td>
			  <td align="right"><center><?php echo $records[$i]->discount_price; ?>%</center></td>
			  <td align="right" colspan="2"><center>Rs.<?php echo $records[$i]->total_price; ?></center></td>
            </tr>
				<?php
				$totrate = $totrate + $records[$i]->rate;
				$totcgst = $totcgst + $records[$i]->sgst;
				$sum = $sum + $records[$i]->total_price;
				} ?>
			<tr>
				<td rowspan="5" colspan="2"><strong>Total Amount in Words:</strong></br></br></br></br></td>
				<td colspan="8">Total Amount before Tax</td>
				<td><center>Rs. <?php echo $totrate; ?></center></td>
			</tr>
			<tr>
				<td colspan="8">CGST</td>
				<td><center>Rs. <?php echo $totcgst; ?></center></td>
			</tr>
			<tr>
				<td colspan="8">SGST</td>
				<td><center>Rs. <?php echo $totcgst; ?></center></td>
			</tr>
			<tr>
				<td colspan="8">Total Tax Amount</td>
				<td><center>Rs. <?php echo ($totcgst*2); ?></center></td>
			</tr>
			<tr>
				<td colspan="8"><strong>Total Amount after Tax:</strong></td>
				<td align="center"><strong>Rs.<?php echo $sum; ?></strong></td>
			</tr>
			<tr>
				<td colspan="2"><strong>Terms & Conditions:</strong></br>WE DECLARE THAT THIS INVOICE SHOWS THE ACTUAL</br>PRICE OF THE GOODS DESCRIBED AND THAT ALL</br>PARTICULARS ARE TRUE AND CORRECT.</br><strong>BANK ACCOUNT DETAILS:</strong></br>Name of the Bank: SOUTH INDIAN BANK</br>Account Number: 0484073000000329</br>IFSC: SIBL0000484</td>
				<td colspan="3"><center>Common Seal</center></td>
				<td colspan="6"><center><strong>For Venad Poultry Farmers Producer Company.Ltd</strong></br></br></br></br>Authorized Signatory</center></td>
			</tr>
		</table>
			<center><b>Venad Poultry Farmers Producer Company.Ltd</b></center>
	</div>
</div>

</div>
	<div class="row no-print">
        <div class="col-xs-12">
			<a target="_blank" class="btn btn-default" id="print"><i class="fa fa-print"></i> Print</a>
			
			<a href="<?php echo base_url();?>sale" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> Go to View</a>
		</div>
	</div>

</section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->






