<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Vendor Details

        <small id="date" class="col-md-4"></small>

        <!-- <small>Optional description</small> -->

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="<?php echo base_url();?>Vendor_master/"><i class="fa fa-dashboard"></i> Back to View</a></li>

        <li class="active">Vendor Details</li>

      </ol>

    </section>

	<form class="form-horizontal" method="POST" action="<?php echo base_url();?>Vendor_master/add">

     <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-md-12">

          <div class="box">

		

			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />

            

              <!-- radio -->

               <div class="form-group">

			   <input type="hidden" name="vendor_id" value="<?php if(isset($records->vendor_id)) echo $records->vendor_id ?>"/>

                <?php echo validation_errors(); ?>

			    <div class="box-body">

			    	  <div class="col-lg-2"></div>

              <div class="col-lg-8">

             <div class="panel panel-danger" style="box-shadow:2px 2px 2px 2px black;">

                <div class="panel-heading">

                  <h3 class="panel-title"><b>VENDOR DETAILS</b></h3>

                </div>

                  <div class="panel-body" style="font-weight: bold;">

                  

				<div class="form-group">

					

					  <div class="col-md-6">

					  	  <label>Name <span style="color:red">*</span></label>

						<input type="text"  required  class="form-control" name="vendorname" id="vendorname"  value="<?php if(isset($records->vendorname)) echo $records->vendorname ?>">

					  </div>

				

					  <div class="col-md-6">

					  	 <label>Address<span style="color:red">*</span></label>

						<textarea class="form-control" name="vendoraddress"> <?php if(isset($records->vendoraddress)) echo $records->vendoraddress ?> </textarea>

					  </div>

				</div>

                <div class="form-group">

					

					  <div class="col-md-6">

					  	  <label>Phone</label>

						<input type="text"  class="form-control" name="vendorphone" id="vendorphone"  value="<?php if(isset($records->vendorphone)) echo $records->vendorphone ?>">

					  </div>

				

					  <div class="col-md-6">

					  	  <label>Email</label>

						<input type="text"  class="form-control" name="vendoremail" id="vendoremail"  value="<?php if(isset($records->vendoremail)) echo $records->vendoremail ?>">

					  </div>

				</div>

        <div class="form-group">

          

            <div class="col-md-6">

                <label>State</label>

                  <select name="vendorstate" class="form-control">

                    <option value="">-SELECT-</option>

                    <?php foreach($state as $st){?>

                     <option <?php if(isset($records->vendorstate)) {if($records->vendorstate==$st->state_name."-"." ".$st->state_gst_code){echo "selected";}}  ?> value="<?php echo $st->state_name."-"." ".$st->state_gst_code; ?>"><?php echo $st->state_name."-"." ".$st->state_gst_code; ?></option>

                  <?php } ?>

                    

                  </select>

            </div>

           

              <div class="col-md-6">

                  <label>State Type</label>

                  <select name="vendor_statetype" class="form-control">

                    <option value="">-SELECT-</option>

                     <option <?php if(isset($records->vendor_statetype)) {if($records->vendor_statetype=="INTRA STATE"){echo "selected";}}  ?> value="INTRA STATE">INTRA STATE</option>

                       <option <?php if(isset($records->vendor_statetype)) {if($records->vendor_statetype=="INTER STATE"){echo "selected";}}  ?> value="INTER STATE">INTER STATE</option>

               

                  </select>

              </div>

          </div>

				<div class="form-group">

					

            <div class="col-md-6">

                <label>GST</label>

            <input type="text"  class="form-control" name="vendorgst" id="vendorgst"  value="<?php if(isset($records->vendorgst)) echo $records->vendorgst ?>">

            </div>

           

  					  <div class="col-md-6">

  					  	  <label>Tax Type</label>

                  <select name="vendor_gsttype" class="form-control">

                    <option value="">-SELECT-</option>

                     <option <?php if(isset($records->vendor_gsttype)) {if($records->vendor_gsttype=="GSTR1 B2B"){echo "selected";}}  ?> value="GSTR1 B2B">GSTR1 B2B</option>

                       <option <?php if(isset($records->vendor_gsttype)) {if($records->vendor_gsttype=="GSTR1 B2CL"){echo "selected";}}  ?> value="GSTR1 B2CL">GSTR1 B2CL</option>

                         <option <?php if(isset($records->vendor_gsttype)) {if($records->vendor_gsttype=="GSTR1 B2CS"){echo "selected";}}  ?> value="GSTR1 B2CS">GSTR1 B2CS</option>

                           <option <?php if(isset($records->vendor_gsttype)) {if($records->vendor_gsttype=="GSTR1 B2BA"){echo "selected";}}  ?> value="GSTR1 B2BA">GSTR1 B2BA</option>

                             <option <?php if(isset($records->vendor_gsttype)) {if($records->vendor_gsttype=="GSTR1 B2CLA"){echo "selected";}}  ?> value="GSTR1 B2CLA">GSTR1 B2CLA</option>

                  </select>

  					  </div>

					</div>

          <div class="form-group">

          

            <div class="col-md-6">

               <label>Old Balance</label>

            <input type="text"  class="form-control" placeholder="Old Balance" name="vendor_oldbal" id="vendor_oldbal"  value="<?php if(isset($records->vendor_oldbal)) echo $records->vendor_oldbal ?>">

            </div>

        </div>

                </div>

              <!-- /.box-body -->

              

            

			</div></div></div>

          </div>

          <div class="box-footer">                

                <div class="row">

                  <div class="col-md-5">

                  </div>

                  <div class="col-md-4">

                  <a href="<?php echo base_url(); ?>Vendor_master"  <button type="button" class="btn btn-danger">Cancel</button></a>

                      <button type="submit" class="btn btn-primary">Save</button>

                    </div>

                  </div>

	    </div>

          <!-- /.box -->

        </div>

		

        <!-- /.col -->

        </div>

      

    </section>

	

	</form>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->

