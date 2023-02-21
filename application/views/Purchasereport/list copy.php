



 



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Purchase Report

        <!-- <small>Optional description</small> -->

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="<?php echo base_url();?>Purchase/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>

        <li class="active">Purchase Report</li>

      </ol>

    </section>



     <!-- Main content -->

    <section class="content">

	
		<div class="row">

        <div class="box">

            <div class="box-header">

            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />

            <div class="col-md-12">
            <div class="row" style="border:ridge;border-radius:20px;box-shadow:2px 2px 2px 2px grey;">

              <div class="col-md-3">

                <div class="input-group margin">

                  <div class="input-group-btn">

                    <button type="button" class="btn btn-primary nohover">Invoice No.</button>

                  </div><!-- /btn-group -->

                  <input type="text" name="purchase_invoice_no" placeholder="Invoice No" id="purchase_invoice_no" class="form-control">

                </div><!-- /input-group -->

              </div>

                <div class="col-md-3">

                  <div class="input-group margin">

                    <div class="input-group-btn">

                      <button type="button" class="btn btn-primary nohover">Supplier Name</button>

                    </div><!-- /btn-group -->

                    <input type="text"  class="form-control"  id="product"  placeholder="Name">

                  </div><!-- /input-group -->

                </div>


                <div class="col-md-3">
                  <div class="input-group margin">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-primary nohover">From </button>
                    </div><!-- /btn-group -->
                      <input id="pmsDateStart" type="date" name="start_date" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
                    
                  </div>
                </div>

                <div class="col-md-3">
                                  <div class="input-group margin">
                                      <div class="input-group-btn">
                                          <button type="button" class="btn btn-primary nohover">To </button>
                                      </div><!-- /btn-group -->
                                          
                                          <input id="pmsDateEnd" type="date" name="end_date" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
                                  </div>
                </div>

					

                <div class="col-sm-2">

                    <div class="input-group">

                      <button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>

                    <a href="<?php echo base_url();?>purchase"><button class="btn bg-navy btn-flat margin" >Refresh</button></a>

                  </div>

                </div>

              </div>

            </div>
            </div>



            

            <!-- /.box-header -->

            <div class="box-body table-responsive" style="border:ridge;border-radius:20px;box-shadow:2px 2px 2px 2px grey;">

              <table id="sale_details_table" class="table table-bordered table-striped">

                <thead>

                <tr>

					<th>SINO</th>

					<th>INVOICE</th>

					<th>SUPPLIER NAME</th>

					<th>SALE DATE</th>

					<th style="text-align:center">PRODUCT COUNT</th>

					<th style="text-align:center">TOTAL PRIZE</th>

					<th>VIEW/INVOICE</th>

                </tr>

                </thead>

                <tbody>

                </tbody>

				<tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:center;font-weight:bold;">TOTAL</td>
                        <td  style="text-align:center;font-weight:bold;"></td>
                        <td style="text-align:center;font-weight:bold;"></td>
                        <td style="text-align:center;font-weight:bold;"></td>
                    </tr>
                        </tfoot>

              </table>

            </div>

            <!-- /.box-body -->

        </div>

	</div>

   </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->













