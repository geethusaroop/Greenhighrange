<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      HSNcode/Tax Master
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>HSNcode/"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">HSNcode/Tax Master</li>
    </ol>
  </section>
  <form class="form-horizontal" method="POST" action="<?php echo base_url();?>HSNcode/add">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="hsn_id" value="<?php if(isset($records->hsn_id)) echo $records->hsn_id ?>"/>
              <?php echo validation_errors(); ?>
              <div class="box-body">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <div class="panel panel-danger" style="box-shadow:2px 2px 2px 2px black;">
                    <div class="panel-heading">
                      <h3 class="panel-title"><b>HSNCODE</b></h3>
                    </div>
                    <div class="panel-body" style="font-weight: bold;">
                      <div class="form-group">
                        <!-- <div class="col-md-6">
                        <label>Project Name<span style="color:red"></span></label>
                        <input type="hidden" data-pms-required="true" autofocus class="form-control" name="pr_pname"  value="<?php if(isset($project->projectmaster_id)) echo $project->projectmaster_id ?>">
                        <input type="text" data-pms-required="true" autofocus class="form-control" name="project_name"  value="<?php if(isset($project->projectmaster_name)) echo $project->projectmaster_name ?>" style="font-weight: bold;">
                      </div> -->
                    </div>
                    <div class="form-group">
                      <div class="col-md-6">
                        <label>HSN code <span style="color:red">*</span></label>
                        <input type="text"  required  class="form-control" name="hsncode" id="hsncode"  value="<?php if(isset($records->hsncode)) echo $records->hsncode ?>">
                      </div>
                      <div class="col-md-6">
                        <label>Unique HSN code</label>
                        <input type="text"    class="form-control" name="unique_hsncode" id="unique_hsncode"  value="<?php if(isset($records->unique_hsncode)) echo $records->unique_hsncode ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6">
                        <label>Description</label>
                        <textarea class="form-control" name="description"> <?php if(isset($records->description)) echo $records->description ?> </textarea>
                      </div>
                      <div class="col-md-6">
                        <label>Goods/Service</label>
                        <select name="goods_service" class="form-control">
                          <option value="">-SELECT-</option>
                          <option <?php if(isset($records->goods_service)){if($records->goods_service=="GOODS"){echo "selected";}} ?> value="GOODS">GOODS</option>
                          <option <?php if(isset($records->goods_service)){if($records->goods_service=="SERVICE"){echo "selected";}} ?> value="SERVICE">SERVICE</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6">
                        <label>IGST</label>
                        <input type="text"  required  class="form-control" name="hsn_igst" id="hsn_igst"  value="<?php if(isset($records->hsn_igst)) echo $records->hsn_igst ?>" onKeyup="getgst();">
                      </div>
                      <div class="col-md-6">
                        <label>SGST</label>
                        <input type="text"  required  class="form-control" name="hsn_sgst" id="hsn_sgst"  value="<?php if(isset($records->hsn_sgst)) echo $records->hsn_sgst ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6">
                        <label>CGST</label>
                        <input type="text"  required  class="form-control" name="hsn_cgst" id="hsn_cgst"  value="<?php if(isset($records->hsn_cgst)) echo $records->hsn_cgst ?>">
                      </div>
                      <div class="col-md-6">
                        <label>CESS</label>
                        <input type="text"    class="form-control" name="hsn_cess" id="hsn_cess"  value="<?php if(isset($records->hsn_cess)) echo $records->hsn_cess ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6">
                        <label>Compensat Cess</label>
                        <input type="text"    class="form-control" name="hsn_comcess" id="hsn_comcess"  value="<?php if(isset($records->hsn_comcess)) echo $records->hsn_comcess ?>">
                      </div>
                      <div class="col-md-6">
                        <label>FLOOD CESS</label>
                        <input type="text"    class="form-control" name="hsn_flood_cess" id="hsn_flood_cess"  value="<?php if(isset($records->hsn_flood_cess)){echo $records->hsn_flood_cess;} else{echo "1";} ?>">
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
                  <a href="<?php echo base_url(); ?>HSNcode"  <button type="button" class="btn btn-danger">Cancel</button></a>
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
    <script type="text/javascript">
    function getgst()
    {
      var igst =document.getElementById("hsn_igst").value;
      document.getElementById("hsn_cgst").value=igst/2;
      document.getElementById("hsn_sgst").value=igst/2;
    }
  </script>
