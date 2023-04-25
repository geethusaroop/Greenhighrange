<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="row">
      <!-- Company Management -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Import</li>
    </ol>
  </section><br>
  <form class="form-horizontal" method="POST" name="import_form"  enctype="multipart/form-data" action="<?php echo base_url();?>Product/insert_Excel_Product">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
          <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
            <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
            <div class="col-md-8">
              <h2 class="box-title"></h2>
            </div>
          </div>
          <div class="box-body">
          <div class="col-lg-2"></div>
            <div class="col-lg-8">
              <div class="panel panel-danger" style="box-shadow:2px 2px 2px 2px black;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>IMPORT EXCEL SHEET OF PRODUCT</b></h3>
                </div>
                <div class="panel-body" style="font-weight:bold;">
              <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            <br><br>
                <div class="form-group">
                  <label for="size_name" class="col-sm-4 control-label" style="font-size: small;">Import Excel<span style="color:red">*</span></label>
                  <div class="col-sm-5">
                    <input type="file"  class="form-control" name="uploadFile" id="uploadFile"  value="" accept=".xlsx, .xls, .csv">
                    <small> ONLY <span style="color:red">CSV, XLS, XLSX</span> FILE TYPES ACCEPTED</small>
                  </div>
                </div>
                </div></div></div>
          </div>
                <div class="box-footer">
            <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-4">
              <a href="<?php echo base_url(); ?>Shareholder"  <button type="button" class="btn btn-danger">Cancel</button></a>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
              
              
          </div>
        </div>
      </div>
    </section>
  </form>
</div>
