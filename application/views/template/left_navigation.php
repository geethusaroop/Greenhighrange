<style type="text/css">
.divider{
 margin-top:5px;
 margin-bottom:5px;
 height:1px;
 width:100%;
 border-top:1px solid gray;
}
</style>
 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
     <!-- Sidebar Menu -->
     <ul class="sidebar-menu" id="navi" data-widget="tree">
       <!--<li class="header"></li>-->
       <!-- Optionally, you can add icons to the links -->
       <li class="<?php if ($this->uri->segment(1) == "dashboard") {echo "active";} ?>"><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
       <!-- Settings -->

       <?php if($this->session->userdata['user_type'] == "A"){ ?>
       <li class="treeview <?php
          if ($this->uri->segment(1) == "Finyear") {
            echo "active";
          } else if ($this->uri->segment(1) == "ChangePassword") {
            echo "active";
          }
          else if ($this->uri->segment(1) == "Branchlogin") {
            echo "active";
          }
          else if ($this->uri->segment(1) == "Routsalelogin") {
            echo "active";
          }
         
          ?>">
         <a><i class="fa fa-gear"></i><span>Settings</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
          
           <li class="<?php if ($this->uri->segment(1) == "Finyear") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Finyear"><i class="fa fa-circle-o"></i> <span>Financial Year</span></a></li>
           <li class="<?php if ($this->uri->segment(1) == "ChangePassword") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Company/ChangePassword"><i class="fa fa-circle-o"></i> <span>Change Password</span></a></li>
          
           <li class="<?php if($this->uri->segment(1)=="Branchlogin"){echo "active";}?>" ><a href="<?php echo base_url();?>Branchlogin"><i class="fa fa-circle-o"></i><span>Branch Login</span></a></li>
           <li class="<?php if($this->uri->segment(1)=="Routsalelogin"){echo "active";}?>" ><a href="<?php echo base_url();?>Routsalelogin"><i class="fa fa-circle-o"></i><span>Routsale Login</span></a></li>
          
          </ul>
       </li>

       <li class="treeview <?php
          if ($this->uri->segment(1) == "Company") {
            echo "active";
          } else if ($this->uri->segment(1) == "Branch") {
            echo "active";
          }
          ?>">
         <a><i class="glyphicon glyphicon-share-alt"></i><span>Basic Info</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
           <li class="<?php if ($this->uri->segment(1) == "Company") {echo "active";} ?>">
             <a href="<?php echo base_url(); ?>Company"><i class="fa fa-circle-o"></i><span>Basic Information</span></a>
           </li>
           <li class="<?php if ($this->uri->segment(1) == "Licenses") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Licenses"><i class="fa fa-circle-o"></i> <span>Licenses</span></a></li>

           <li class="<?php if ($this->uri->segment(1) == "Branch") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Branch"><i class="fa fa-circle-o"></i> <span>Branches</span></a></li>
          </ul>
       </li>

       <li class="treeview <?php
          if ($this->uri->segment(1) == "Direct_details") {
            echo "active";
          }
          else   if ($this->uri->segment(1) == "Shareholder") {
            echo "active";
          }
          ?>">
         <a><i class="fa fa-university"></i><span>Administration</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
           <li class="<?php if ($this->uri->segment(1) == "Direct_details") {echo "active";} ?>">
             <a href="<?php echo base_url(); ?>Direct_details"><i class="fa fa-circle-o"></i><span>Board Of Directors</span></a>
           </li>

           <li class="<?php if ($this->uri->segment(1) == "Shareholder") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Shareholder"><i class="fa fa-circle-o"></i><span>Share Holders Details</span></a></li>

           <li class="<?php if ($this->uri->segment(1) == "Member") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Member"><i class="fa fa-circle-o"></i><span>Members</span></a></li>

          </ul>
       </li>


       <li class="treeview <?php
          if ($this->uri->segment(1) == "Vendor_master") {
            echo "active";
          }
          else if ($this->uri->segment(1) == "HSNcode") {
            echo "active";
          }

          else if ($this->uri->segment(1) == "Product") {
            echo "active";
          }
          ?>">
         <a><i class="fa fa-laptop"></i><span>Masters</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
           <li class="<?php if ($this->uri->segment(1) == "Vendor_master") {echo "active";} ?>">
             <a href="<?php echo base_url(); ?>Vendor_master"><i class="fa fa-circle-o"></i><span>Vendor Master</span></a>
           </li>

           <li class="<?php if ($this->uri->segment(1) == "HSNcode") {echo "active";} ?>"><a href="<?php echo base_url(); ?>HSNcode"><i class="fa fa-circle-o"></i><span>Tax Master</span></a></li>

           <li class="<?php if ($this->uri->segment(1) == "Product") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Product"><i class="fa fa-circle-o"></i><span>Purchase Products</span></a></li>

          </ul>
       </li>

       <li class="treeview <?php
          if ($this->uri->segment(1) == "Purchaseitem") {
            echo "active";
          }
          else if ($this->uri->segment(1) == "Stock") {
            echo "active";
          }

          else if ($this->uri->segment(1) == "StockStatus") {
            echo "active";
          }

          else if ($this->uri->segment(1) == "Sale") {
            echo "active";
          }

          ?>">
         <a><i class="fa fa-shopping-cart"></i><span>Inventory</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">


         <li class="<?php if ($this->uri->segment(1) == "Sale" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Sale"><i class="fa fa-circle-o"></i><span>Sale</span></a></li>

         <li class="<?php if ($this->uri->segment(1) == "Sale" && $this->uri->segment(2) == "SaleReturn") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Sale/SaleReturn"><i class="fa fa-circle-o"></i><span>Sale Return</span></a></li>

         
           <li class="<?php if ($this->uri->segment(1) == "Purchaseitem") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Purchaseitem"><i class="fa fa-circle-o"></i><span>Purchase</span></a></li>

           <li class="<?php if ($this->uri->segment(1) == "Purchaseitem"  && $this->uri->segment(2) == "purchase_return") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Purchaseitem/purchase_return"><i class="fa fa-circle-o"></i><span>Purchase Return</span></a></li>


           <li class="<?php if ($this->uri->segment(1) == "Stock") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Stock"><i class="fa fa-circle-o"></i><span>Stock Details</span></a></li>

           <li class="<?php if ($this->uri->segment(1) == "StockStatus") {echo "active";} ?>"><a href="<?php echo base_url(); ?>StockStatus"><i class="fa fa-circle-o"></i><span>Stock Status</span></a></li>

          </ul>
       </li>
       <li class="divider"></li> 
       <li class="treeview"> <a><i class="fa fa-product-hunt" style="color:#c03110;"></i> <span style="font-weight:bold;text-shadow:2px 2px #c03110;">PRODUCTION UNIT</span>  </a></li>
             
       <li class="treeview <?php
          if ($this->uri->segment(1) == "ProductTransfer") {
            echo "active";
          }
     
          ?>">
         <a><i class="fa fa-truck"></i><span>Transfer To Production Unit</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         
           <li class="<?php if ($this->uri->segment(1) == "ProductTransfer" && $this->uri->segment(2) == "add") {echo "active";} ?>"><a href="<?php echo base_url(); ?>ProductTransfer/add"><i class="fa fa-circle-o"></i><span>Add</span></a></li>

           <li class="<?php if ($this->uri->segment(1) == "ProductTransfer" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>ProductTransfer/"><i class="fa fa-circle-o"></i><span>Manage Production Unit</span></a></li>

          </ul>
       </li>

       <li class="<?php if ($this->uri->segment(1) == "Production" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Production"><i class="fa fa-list"></i><span>Production Items</span></a></li>


       <li class="treeview <?php
         if ($this->uri->segment(1) == "Productionitem") {
            echo "active";
          }

          ?>">
         <a><i class="fa fa-product-hunt"></i><span>Transfer To Stock</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         
           <li class="<?php if ($this->uri->segment(1) == "Productionitem" && $this->uri->segment(2) == "view") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Productionitem/view"><i class="fa fa-circle-o"></i><span>Add Stock</span></a></li>

           <li class="<?php if ($this->uri->segment(1) == "Productionitem" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Productionitem"><i class="fa fa-circle-o"></i><span>Manage Production Stock</span></a></li>

          </ul>
       </li>



       <li class="divider"></li> 

       <li class="treeview"> <a><span style="font-weight:bold;text-shadow:2px 2px green;">BRANCH STOCK TRANSFER</span>  </a></li>
       <li class="treeview <?php
         if ($this->uri->segment(1) == "Branch_transfer") {
            echo "active";
          }

          ?>">
         <a><i class="fa fa-product-hunt"></i><span>Stock Transfer</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         
           <li class="<?php if ($this->uri->segment(1) == "Branch_transfer" && $this->uri->segment(2) == "add") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Branch_transfer/add"><i class="fa fa-circle-o"></i><span>Add Stock</span></a></li>

           <li class="<?php if ($this->uri->segment(1) == "Branch_transfer" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Branch_transfer"><i class="fa fa-circle-o"></i><span>Manage Stock Transfer</span></a></li>

          </ul>
       </li>

       <li class="<?php if ($this->uri->segment(1) == "BStock" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>BStock"><i class="fa fa-crop"></i><span>Branch Stock Status</span></a></li>

       <li class="<?php if ($this->uri->segment(1) == "BSale" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>BSale"><i class="fa fa-crop"></i><span>Branch Sale Details</span></a></li>

       <li class="divider"></li> 

   
      <li class="treeview"> <a> <i class="fa fa-truck" style="color:#c03110;"></i> <span style="font-weight:bold;text-shadow:2px 2px #c03110;">ROUT SALE</span>  </a></li>
      
      <li class="treeview <?php
         if ($this->uri->segment(1) == "Routsale") {
            echo "active";
          }

          ?>">
         <a><i class="fa fa-crop"></i><span>Rout Sale Stock</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">

         <li class="<?php if ($this->uri->segment(1) == "Routsale" && $this->uri->segment(2) == "add") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Routsale/add"><i class="fa fa-circle-o"></i><span>Add Rout Sale Stock</span></a></li>
       
         <li class="<?php if ($this->uri->segment(1) == "Routsale" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Routsale/"><i class="fa fa-circle-o"></i><span>Manage Rout Sale Stock</span></a></li>

          </ul>
       </li>


      <li class="treeview <?php
         if ($this->uri->segment(1) == "RSSale") {
            echo "active";
          }

          ?>">
         <a><i class="fa fa-shopping-cart"></i><span>Sale Details</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         
           <li class="<?php if ($this->uri->segment(1) == "RSSale" && $this->uri->segment(2) == "view") {echo "active";} ?>"><a href="<?php echo base_url(); ?>RSSale/view"><i class="fa fa-circle-o"></i><span>Today's Sale Details</span></a></li>

           <li class="<?php if ($this->uri->segment(1) == "RSSale" && $this->uri->segment(2) == "admin_view") {echo "active";} ?>"><a href="<?php echo base_url(); ?>RSSale/admin_view"><i class="fa fa-circle-o"></i><span>Sale Report</span></a></li>

          </ul>
       </li>

       <li class="<?php if ($this->uri->segment(1) == "RSreturn" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>RSreturn/"><i class="fa fa-arrow-left"></i><span>Return To Stock</span></a></li>



      <li class="divider"></li> 


       

       <li class="treeview <?php
            if($this->uri->segment(1)=="Voucherhead")
            {echo "active";}
            else if($this->uri->segment(1)=="Receipthead")
            {echo "active";}
            else if($this->uri->segment(1)=="Voucher")
            {echo "active";}
            else if($this->uri->segment(1)=="Receipt")
            {echo "active";}
            else if($this->uri->segment(1)=="Vendor_voucher")
             {echo "active";}
            //   else if($this->uri->segment(1)=="Journal")
            //{echo "active";}
            else if($this->uri->segment(1)=="Daybook")
            {echo "active";}
            else if($this->uri->segment(1)=="Ledger")
            {echo "active";}
            else if($this->uri->segment(1)=="Balancesheet")
            {echo "active";}
            // else if($this->uri->segment(1)=="GIncome")
            //  {echo "active";}
            ?>">
            <a href="#"><i class="fa fa-money"></i><span>Accounts</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu ">
              <li class="treeview
              <?php
              if($this->uri->segment(1)=='Voucherhead')
              {echo "active";}
              else if($this->uri->segment(1)=='Receipthead')
              {echo "active";}
              ?>">
              <a href="#"><i class="fa fa-circle-o"></i>Create account heads
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($this->uri->segment(1)=='Voucherhead'){echo "active";}?>" ><a href="<?php echo base_url();?>Voucherhead"><i class="fa fa-circle-o"></i>Voucher</a></li>
                <li class="<?php if($this->uri->segment(1)=='Receipthead'){echo "active";}?>" ><a href="<?php echo base_url();?>Receipthead"><i class="fa fa-circle-o"></i>Receipt</a></li>
              </ul>
            </li>
            <li class="<?php if($this->uri->segment(1)=='Voucher' && $this->uri->segment(2)==''){echo "active";}?>" ><a href="<?php echo base_url();?>Voucher"><i class="fa fa-circle-o"></i>Voucher Entry</a></li>
            <li class="<?php if($this->uri->segment(1)=='Receipt' && $this->uri->segment(2)==''){echo "active";}?>" ><a href="<?php echo base_url();?>Receipt"><i class="fa fa-circle-o"></i>Receipt Entry</a></li>
           <li class="<?php if($this->uri->segment(1)=='Vendor_voucher' && $this->uri->segment(2)==''){echo "active";}?>" ><a href="<?php echo base_url();?>Vendor_voucher"><i class="fa fa-circle-o"></i>Vendor Voucher</a></li>
           
           <li class="<?php if($this->uri->segment(1)=="Daybook"){echo "active";}?>" ><a  href="<?php echo base_url();?>Daybook"><i class="fa fa-circle-o"></i> <span>Daybook</span></a></li>
           
           <li class="<?php if($this->uri->segment(1)=="Ledger" && $this->uri->segment(2)==''){echo "active";}?>" ><a  href="<?php echo base_url();?>Ledger"><i class="fa fa-circle-o"></i> <span>Ledger</span></a></li>
            
            <li class="<?php if($this->uri->segment(1)=="Ledger" && $this->uri->segment(2)=='report'){echo "active";}?>" ><a  href="<?php echo base_url();?>Ledger/report"><i class="fa fa-circle-o"></i> <span>Ledger Report</span></a></li>

            <li class="<?php if($this->uri->segment(1)=="Balancesheet"){echo "active";}?>" ><a  href="<?php echo base_url();?>Balancesheet"><i class="fa fa-circle-o"></i> <span>Balance Sheet</span></a></li>
          </ul>
        </li>

        <li class="treeview <?php
          if($this->uri->segment(1)=="Employee")
          {echo "active";}
          else if($this->uri->segment(1)=="Emp_attendence")
          {echo "active";}
          else if($this->uri->segment(1)=="Advancepayments")
          {echo "active";}
          else if($this->uri->segment(1)=="Overtime")
          {echo "active";}
          else if($this->uri->segment(1)=="Payroll")
          {echo "active";}
          else if($this->uri->segment(1)=="Payslip")
          {echo "active";}
          ?>">
          <a><i class="fa fa-industry"></i><span>HR Department</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu ">
            <li class="<?php if($this->uri->segment(1)=="Employee"){echo "active";}?>" ><a  href="<?php echo base_url();?>Employee"><i class="fa fa-circle-o"></i> <span>Employee Master</span></a></li>
            <li class="<?php if($this->uri->segment(1)=="Emp_attendence"){echo "active";}?>" ><a href="<?php echo base_url();?>Emp_attendence"><i class="fa fa-circle-o"></i> <span>Employee Attendance</span></a></li>
            <li class="<?php if($this->uri->segment(1)=="Advancepayments"){echo "active";}?>" ><a href="<?php echo base_url();?>Advancepayments"><i class="fa fa-circle-o"></i> <span>Advance Payments</span></a></li>
            <li class="<?php if($this->uri->segment(1)=="Overtime"){echo "active";}?>" ><a href="<?php echo base_url();?>Overtime"><i class="fa fa-circle-o"></i> <span>Overtime Details</span></a></li>
            <li class="<?php if($this->uri->segment(1)=="Payroll"){echo "active";}?>" ><a href="<?php echo base_url();?>Payroll"><i class="fa fa-circle-o"></i> <span>Payroll</span></a></li>
          </ul>
        </li>

        <li class="treeview <?php 
       
       if($this->uri->segment(1)=="Stock_Reports")
                 {echo "active";}
 
       else  if($this->uri->segment(1)=="Purchasereport")
       {echo "active";}
 
       else  if($this->uri->segment(1)=="Purchase_Report")
       {echo "active";}
 
       else if($this->uri->segment(1)=="Salereport")
       {echo "active";}
 
       else  if($this->uri->segment(1)=='Sale_Report'){echo "active";}
       ?>">
           <a><i class="fa fa-laptop"></i><span>Reports</span>
             <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
             </span>
           </a>
           <ul class="treeview-menu ">
       <li class="treeview 
       <?php 
       if($this->uri->segment(1)=='Stock_Reports'){echo "active";}
       ?>">
            <a href="#"><i class="fa fa-circle-o"></i> Stock Report
             <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
             </span>
            </a>
       <ul class="treeview-menu">
         <li class="<?php if($this->uri->segment(2)=='saleWisestock' && $this->uri->segment(1)=="Stock_Reports"){echo "active";}?>" ><a href="<?php echo base_url();?>Stock_Reports/saleWisestock"><i class="fa fa-circle-o"></i>Supplier Wise Stock</a></li>
         <li class="<?php if($this->uri->segment(2)=='physicalStock' && $this->uri->segment(1)=="Stock_Reports"){echo "active";}?>" ><a href="<?php echo base_url();?>Stock_Reports/physicalStock"><i class="fa fa-circle-o"></i>Physical Stock</a></li>
      </ul>
       </li>
       <li class="treeview 
       <?php 
       if($this->uri->segment(1)=='Purchasereport'){echo "active";}
       else if($this->uri->segment(1)=='Purchase_Report'){echo "active";}
       ?>">
            <a href="#"><i class="fa fa-circle-o"></i> Purchase Report
             <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
             </span>
            </a>
       <ul class="treeview-menu">
         <li class="<?php if($this->uri->segment(1)=="Purchasereport" && $this->uri->segment(2)==""){echo "active";}?>" ><a href="<?php echo base_url();?>Purchasereport"><i class="fa fa-circle-o"></i> <span>Purchase Report</span></a></li>
         <li class="<?php if($this->uri->segment(1)=="Purchase_Report" && $this->uri->segment(2)=="suppilerPurchase"){echo "active";}?>" ><a href="<?php echo base_url();?>Purchase_Report/suppilerPurchase"><i class="fa fa-circle-o"></i> <span>Supplier Purchase Report</span></a></li>
         <li class="<?php if($this->uri->segment(1)=="Purchase_Report" && $this->uri->segment(2)=="itemPurchase"){echo "active";}?>" ><a href="<?php echo base_url();?>Purchase_Report/itemPurchase"><i class="fa fa-circle-o"></i> <span>Item Purchase Report</span></a></li>
      </ul>
       </li>
        <li class="treeview 
       <?php 
       if($this->uri->segment(1)=='Salereport'){echo "active";}
       else  if($this->uri->segment(1)=='Sale_Report'){echo "active";}
       ?>">
            <a href="#"><i class="fa fa-circle-o"></i> Sale Report
             <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
             </span>
            </a>
       <ul class="treeview-menu">
       <li class="<?php if($this->uri->segment(1)=="Salereport" && $this->uri->segment(2)==""){echo "active";}?>" ><a href="<?php echo base_url();?>Salereport"><i class="fa fa-circle-o"></i> <span>Sales Report</span></a></li>
       <li class="<?php if($this->uri->segment(1)=="Sale_Report" && $this->uri->segment(2)=="cutomerSaleRport"){echo "active";}?>" ><a href="<?php echo base_url();?>Sale_Report/cutomerSaleRport"><i class="fa fa-circle-o"></i> <span>Customer Sale Report</span></a></li>
       <li class="<?php if($this->uri->segment(1)=="Sale_Report" && $this->uri->segment(2)=="supplierSaleRport"){echo "active";}?>" ><a href="<?php echo base_url();?>Sale_Report/supplierSaleRport"><i class="fa fa-circle-o"></i> <span>Supplier Sale Report</span></a></li>
       <li class="<?php if($this->uri->segment(1)=="Sale_Report" && $this->uri->segment(2)=="itemSaleRport"){echo "active";}?>" ><a href="<?php echo base_url();?>Sale_Report/itemSaleRport"><i class="fa fa-circle-o"></i> <span>Item Sale Report</span></a></li>
      </ul>
       </li> 
     </ul>
         </li>
 
    


    
       
      
       <li class=""><a href="<?php echo base_url(); ?>index.php/login/logout"><i class="fa fa-sign-out"></i>Log out</a></li>
       
     </ul>
     <?php } ?>


     <?php if($this->session->userdata['user_type'] == "B"){ ?>
       <li class="treeview <?php
          if ($this->uri->segment(1) == "Finyear") {
            echo "active";
          } else if ($this->uri->segment(1) == "ChangePassword") {
            echo "active";
          }
         
          ?>">
         <a><i class="fa fa-gear"></i><span>Settings</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
          
           <li class="<?php if ($this->uri->segment(1) == "Finyear") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Finyear"><i class="fa fa-circle-o"></i> <span>Financial Year</span></a></li>
           <li class="<?php if ($this->uri->segment(1) == "ChangePassword") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Company/ChangePassword"><i class="fa fa-circle-o"></i> <span>Change Password</span></a></li>
          </ul>
       </li>

       <li class="treeview <?php
         if ($this->uri->segment(1) == "Shareholder") {
            echo "active";
          }
          else  if ($this->uri->segment(1) == "Member") {
            echo "active";
          }
          ?>">
         <a><i class="fa fa-university"></i><span>Administration</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         
           <li class="<?php if ($this->uri->segment(1) == "Shareholder") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Shareholder"><i class="fa fa-circle-o"></i><span>Share Holders Details</span></a></li>

           <li class="<?php if ($this->uri->segment(1) == "Member") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Member"><i class="fa fa-circle-o"></i><span>Members</span></a></li>

          </ul>
       </li>


       <li class="<?php if ($this->uri->segment(1) == "Product") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Product"><i class="fa fa-truck"></i><span>Stock From Master Branch</span></a></li>


       <li class="treeview <?php
         if ($this->uri->segment(1) == "Stock") {
            echo "active";
          }

          else if ($this->uri->segment(1) == "StockStatus") {
            echo "active";
          }

          else if ($this->uri->segment(1) == "Sale") {
            echo "active";
          }

          ?>">
         <a><i class="fa fa-shopping-cart"></i><span>Inventory</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">


         <li class="<?php if ($this->uri->segment(1) == "Sale" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Sale"><i class="fa fa-circle-o"></i><span>Sale</span></a></li>


           <li class="<?php if ($this->uri->segment(1) == "Stock") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Stock"><i class="fa fa-circle-o"></i><span>Stock Details</span></a></li>

<!--            <li class="<?php if ($this->uri->segment(1) == "StockStatus") {echo "active";} ?>"><a href="<?php echo base_url(); ?>StockStatus"><i class="fa fa-circle-o"></i><span>Stock Status</span></a></li>
 -->
          </ul>
       </li>

       <li class="divider"></li> 
       <li class="treeview"> <a><i class="fa fa-product-hunt" style="color:#227b05;"></i> <span style="font-weight:bold;text-shadow:2px 2px #227b05;">PRODUCTION UNIT</span>  </a></li>
             
       <li class="treeview <?php
          if ($this->uri->segment(1) == "ProductTransfer") {
            echo "active";
          }
     
          ?>">
         <a><i class="fa fa-truck"></i><span>Transfer To Production Unit</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         
           <li class="<?php if ($this->uri->segment(1) == "ProductTransfer" && $this->uri->segment(2) == "add") {echo "active";} ?>"><a href="<?php echo base_url(); ?>ProductTransfer/add"><i class="fa fa-circle-o"></i><span>Add</span></a></li>

           <li class="<?php if ($this->uri->segment(1) == "ProductTransfer" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>ProductTransfer/"><i class="fa fa-circle-o"></i><span>Manage Production Unit</span></a></li>

          </ul>
       </li>

       <li class="<?php if ($this->uri->segment(1) == "Production" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Production"><i class="fa fa-list"></i><span>Production Items</span></a></li>


       <li class="treeview <?php
         if ($this->uri->segment(1) == "Productionitem") {
            echo "active";
          }

          ?>">
         <a><i class="fa fa-product-hunt"></i><span>Transfer To Stock</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         
           <li class="<?php if ($this->uri->segment(1) == "Productionitem" && $this->uri->segment(2) == "view") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Productionitem/view"><i class="fa fa-circle-o"></i><span>Add Stock</span></a></li>

           <li class="<?php if ($this->uri->segment(1) == "Productionitem" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Productionitem"><i class="fa fa-circle-o"></i><span>Manage Production Stock</span></a></li>

          </ul>
       </li>



       <li class="divider"></li> 



       <li class=""><a href="<?php echo base_url(); ?>index.php/login/logout"><i class="fa fa-sign-out"></i>Log out</a></li>
       
       <?php } ?>
     <!--------------------------------------------------------------------------------------------------------------------------->

     <?php if($this->session->userdata['user_type'] == "RS"){ ?>
       <li class="treeview <?php
          if ($this->uri->segment(1) == "Finyear") {
            echo "active";
          } 
         
          ?>">
         <a><i class="fa fa-gear"></i><span>Settings</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">

           <li class="<?php if ($this->uri->segment(1) == "Finyear") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Finyear"><i class="fa fa-circle-o"></i> <span>Financial Year</span></a></li>
          </ul>
       </li>

       <li class="<?php if ($this->uri->segment(1) == "RSStock") {echo "active";} ?>"><a href="<?php echo base_url(); ?>RSStock"><i class="fa fa-truck"></i><span>Daily Stock</span></a></li>


       <li class="treeview <?php
          if ($this->uri->segment(1) == "RSSale") {
            echo "active";
          } 
         
          ?>">
         <a><i class="fa fa-shopping-cart"></i><span>Sale</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">

         <li class="<?php if ($this->uri->segment(1) == "RSSale" && $this->uri->segment(2) == "add") {echo "active";} ?>"><a href="<?php echo base_url(); ?>RSSale/add"><i class="fa fa-circle-o"></i><span>Add Sale</span></a></li>
         
         <li class="<?php if ($this->uri->segment(1) == "RSSale" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>RSSale/"><i class="fa fa-circle-o"></i><span>Sale Details</span></a></li>
         
        
        </ul>
       </li>


       <li class="<?php if ($this->uri->segment(1) == "RSSale" && $this->uri->segment(2) == "view") {echo "active";} ?>"><a href="<?php echo base_url(); ?>RSSale/view"><i class="fa fa-list"></i><span>Daily Sale Details</span></a></li>
        

       <li class="treeview <?php
          if ($this->uri->segment(1) == "RSreturn") {
            echo "active";
          } 
         
          ?>">
         <a><i class="fa fa-arrow-left"></i><span>Return Stock</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">

         <li class="<?php if ($this->uri->segment(1) == "RSreturn" && $this->uri->segment(2) == "addreturn_view") {echo "active";} ?>"><a href="<?php echo base_url(); ?>RSreturn/addreturn_view"><i class="fa fa-circle-o"></i><span>Add Return Stock</span></a></li>
         
         <li class="<?php if ($this->uri->segment(1) == "RSreturn" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>RSreturn/"><i class="fa fa-circle-o"></i><span>Manage Return Stock</span></a></li>
         
        
        </ul>
       </li>

       <li class=""><a href="<?php echo base_url(); ?>index.php/login/logout"><i class="fa fa-sign-out"></i>Log out</a></li>
       
       <?php } ?>

     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>