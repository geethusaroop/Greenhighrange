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
  <form class="form-horizontal" method="POST" name="import_form"  enctype="multipart/form-data" action="<?php echo base_url();?>Shareholder/insert_Excel_Sharholder">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <fieldset>
              <legend>Shareholder List Import</legend>
              <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            <br><br>
                <div class="form-group">
                  <label for="size_name" class="col-sm-4 control-label" style="font-size: small;">Import Excel<span style="color:red">*</span></label>
                  <div class="col-sm-5">
                    <input type="file"  class="form-control" name="import_excel" id="import_excel"  value="" accept=".xlsx, .xls, .csv">
                    <small> ONLY <span style="color:red">CSV, XLS, XLSX</span> FILE TYPES ACCEPTED</small>
                  </div>
                </div>
                <div class="form-group">
                  <center> <button type="submit" class="btn btn-primary">Save</button></center>
                </div>
            </fieldset>
          </div>
        </div>
      </div>
    </section>
  </form>
</div>
