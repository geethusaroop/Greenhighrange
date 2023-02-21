<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pay Slip
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Sale/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Pay Slip</li>
      </ol>
    </section>
     <!-- Main content -->
    <section class="invoice" >
      <!-- title row -->
<div class="inner" id="invcont" >
     <div class="row">
		<div class="col-sm-12">
			<h2 class="page-header">
				<center><strong>Venad Poultry Farmers Producer Company.Ltd</strong></center>
			</h2>
		</div>
	 </div>
<div class="row invoice-info" >
	<div class="col-sm-12 invoice-col">
	<h4><center><strong>PAY SLIP</strong></center></h4>
		<table class="" border="1" width="100%" cellpadding="2" cellspacing="0">
			<tr>
				<td colspan="2"><strong><center>Employee Name</center></strong></td>
				<td colspan="2"><center><?php echo $records->emp_name; ?></center></td>
			</tr>
			<tr>
				<td colspan="2"><strong><center>Designation<center></strong></td>
				<td colspan="2"></td>
			</tr>
		
			<tr>
				<td><strong><center>Total Days</center></strong></td>
				<td></td>
				<td><strong><center>Leave Taken</center></strong></td>
				<td></td>
			</tr>
			<tr>
				<th><center>DESCRIPTION</center></th>
				<th><center>EARNING</center></th>
				<th><center>DESCRIPTION</center></th>
				<th><center>DEDUCTION</center></th>
			</tr>
			<tr>
			  <td><center>Basic Salary</center></td>
			  <td><center><?php echo $records->payroll_basicsalary; ?></center></td>
			  <td><center>Leave Deduction</center></td>
			  <td><center><?php echo $records->payroll_leaveded; ?></center></td>
            </tr>
			<tr>
			  <td><center>DA</center></td>
			  <td><center></center></td>
			  <td><center>EPF</center></td>
			  <td><center><?php echo $records->payroll_epf; ?></center></td>
            </tr>
			<tr>
			  <td><center>HRA</center></td>
			  <td><center></center></td>
			  <td><center>Advance Payment</center></td>
			  <td><center><?php echo ($records->advance_pay) ? $records->advance_pay : 0; ?></center></td>
            </tr>
			<tr>
			  <td><center>Overtime</center></td>
			  <td><center><?php echo ($records->overtime_pay) ? $records->overtime_pay : 0; ?></center></td>
			  <td><center></center></td>
			  <td><center></center></td>
            </tr>
			<tr>
			</tr>
			<tr>
				<td align="right" colspan="2"><strong><center>NET PAY</center></strong></td>
				<td align="right" colspan="2"><strong><center>Rs. <?php echo $records->payroll_salary; ?></center></strong></td>
			</tr>
			<tr>
				<td colspan="2"><strong></br></br></br><center>Date : <?php if(isset($records->payroll_salarydate)){ $sl_date = str_replace('-', '/', $records->payroll_salarydate); $sl_date =  date("d/m/Y",strtotime($sl_date));  echo $sl_date; }?></center></strong></td>
				<td colspan="2" align="right"><strong></br></br></br>Approved By</strong></td>
			</tr>
		</table>
		<center><b>.....</b></center>
	</div>
</div>
</div>
	<div class="row no-print">
        <div class="col-xs-12">
			<a target="_blank" class="btn btn-default" id="print"><i class="fa fa-print"></i> Print</a>
			<!--	<button type="button" id="genpdf" class="btn btn-success pull-right" style="margin-right: 5px;">
					<i class="fa fa-download"></i> Generate PDF
				</button>-->
			<a href="<?php echo base_url();?>Payroll" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> Go to View</a>
		</div>
	</div>
</section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
