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
          if ($this->uri->segment(1) == "Company") {
            echo "active";
          } else if ($this->uri->segment(1) == "Finyear") {
            echo "active";
          } else if ($this->uri->segment(1) == "ChangePassword") {
            echo "active";
          }
          else if ($this->uri->segment(1) == "Employee_login") {
            echo "active";
          }
          ?>">
         <a><i class="fa fa-gear"></i><span>Settings</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
           <li class="<?php if ($this->uri->segment(1) == "Company") {echo "active";} ?>">
             <a href="<?php echo base_url(); ?>Company"><i class="glyphicon glyphicon-share-alt"></i><span>Basic Information</span></a>
           </li>
           <li class="<?php if ($this->uri->segment(1) == "Finyear") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Finyear"><i class="fa fa-circle-o"></i> <span>Financial Year</span></a></li>
           <li class="<?php if ($this->uri->segment(1) == "ChangePassword") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Company/ChangePassword"><i class="fa fa-circle-o"></i> <span>Change Password</span></a></li>
           <li class="<?php if ($this->uri->segment(1) == "Employee_login") { echo "active"; } ?>"><a href="<?php echo base_url(); ?>Employee_login"><i class="fa fa-circle-o"></i> <span>Employee Login</span></a></li>
         </ul>
       </li>
      <!--  <li class="treeview <?php
          if ($this->uri->segment(1) == "Taxdetails") {
            echo "active";
          } else if ($this->uri->segment(1) == "HSNcode") {
            echo "active";
          }
          ?>">
         <a><i class="fa fa-cog"></i><span>Masters</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         
           <li class="<?php if ($this->uri->segment(1) == "Taxdetails") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Taxdetails"><i class="fa fa-circle-o"></i> <span>Tax Master</span></a></li>
           <li class="<?php if ($this->uri->segment(1) == "HSNcode") {echo "active";} ?>"><a href="<?php echo base_url(); ?>HSNcode"><i class="fa fa-circle-o"></i> <span>HSN Code</span></a></li>
         </ul>
       </li> -->
       <li class="treeview <?php
          if ($this->uri->segment(1) == "Items") {
            echo "active";
          }
          ?>">
         <a><i class="fa fa-product-hunt"></i><span>Featured Products</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         <li class="<?php if ($this->uri->segment(1) == "Items" && $this->uri->segment(2) == "category") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Items/category"><i class="fa fa-circle-o"></i><span>Products Category</span></a></li>
<!--          <li class="<?php if ($this->uri->segment(1) == "Items" && $this->uri->segment(2) == "subcategory") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Items/subcategory"><i class="fa fa-circle-o"></i><span>Products Sub-Category</span></a></li>
 -->
          <!--  <li class="<?php if ($this->uri->segment(1) == "Items" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Items"><i class="fa fa-circle-o"></i><span>Products</span></a></li>
          -->
<!--           <li class="<?php if ($this->uri->segment(1) == "Products" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Products"><i class="fa fa-circle-o"></i><span>Products</span></a></li>
 -->
          <li class="treeview <?php
          if ($this->uri->segment(1) == "Items") {
            echo "active";
          }
          ?>">
         <a><i class="fa fa-circle-o"></i><span>Manage Products</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         <li class="<?php if ($this->uri->segment(1) == "Items" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Items/"><i class="fa fa-circle-o"></i><span>Curtains & Drapes</span></a></li>
         <li class="<?php if ($this->uri->segment(1) == "Items" && $this->uri->segment(2) == "index1") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Items/index1"><i class="fa fa-circle-o"></i><span>Wallpapers</span></a></li>
         <li class="<?php if ($this->uri->segment(1) == "Items" && $this->uri->segment(2) == "index2") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Items/index2"><i class="fa fa-circle-o"></i><span>Window Blinds</span></a></li>
         <li class="<?php if ($this->uri->segment(1) == "Items" && $this->uri->segment(2) == "index3") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Items/index3"><i class="fa fa-circle-o"></i><span>Mosquito Nets</span></a></li>
         <li class="<?php if ($this->uri->segment(1) == "Items" && $this->uri->segment(2) == "index4") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Items/index4"><i class="fa fa-circle-o"></i><span>Sofas & Furnitures</span></a></li>
         <li class="<?php if ($this->uri->segment(1) == "Items" && $this->uri->segment(2) == "index5") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Items/index5"><i class="fa fa-circle-o"></i><span>Accessories</span></a></li>
        </ul>
          </li>
          </ul>
       </li>
       <li class="<?php if ($this->uri->segment(1) == "Customer") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Customer"><i class="fa fa-users"></i><span>Leads Details</span></a></li>
      
<!--        <li class="<?php if ($this->uri->segment(1) == "JNSale/sale_product") {echo "active";} ?>"><a href="<?php echo base_url(); ?>JNSale/sale_product"><i class="fa fa-list"></i><span>Sale</span></a></li>
 -->      
        <li class="treeview <?php
          if ($this->uri->segment(1) == "Sale_curtains") {
            echo "active";
          }
          ?>">
         <a><i class="fa fa-list"></i><span>Quotation</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         <li class="treeview <?php
          if ($this->uri->segment(1) == "Sale_curtains") {
            echo "active";
          }
          ?>">
         <a><i class="fa fa-circle-o"></i><span>Add Quotation</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         <li class="<?php if ($this->uri->segment(1) == "Sale_curtains" && $this->uri->segment(2) == "add_sale") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Sale_curtains/add_sale"><i class="fa fa-circle-o"></i><span>Curtains & Drapes</span></a></li>              
        
         <li class="<?php if ($this->uri->segment(1) == "Sale_curtains" && $this->uri->segment(2) == "add_wallpaper_sale") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Sale_curtains/add_wallpaper_sale"><i class="fa fa-circle-o"></i><span>Wallpapers</span></a></li>    
         <li class="<?php if ($this->uri->segment(1) == "Sale_curtains" && $this->uri->segment(2) == "add_blind_sale") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Sale_curtains/add_blind_sale"><i class="fa fa-circle-o"></i><span>Window Blinds</span></a></li>    
         
         <li class="<?php if ($this->uri->segment(1) == "Sale_curtains" && $this->uri->segment(2) == "add_net_sale") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Sale_curtains/add_net_sale"><i class="fa fa-circle-o"></i><span>Mosquito Nets</span></a></li>    
         <li class="<?php if ($this->uri->segment(1) == "Sale_curtains" && $this->uri->segment(2) == "add_sofa_sale") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Sale_curtains/add_sofa_sale"><i class="fa fa-circle-o"></i><span>Sofa & Furnitures</span></a></li>              
         
         <!-- <li class="<?php if ($this->uri->segment(1) == "Sale_curtains" && $this->uri->segment(2) == "add_acc_sale") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Sale_curtains/add_acc_sale"><i class="fa fa-circle-o"></i><span>Accessories</span></a></li>  -->
        </ul>
          </li>
         <li class="<?php if ($this->uri->segment(1) == "Sale_curtains" && $this->uri->segment(2) == "sale_product") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Sale_curtains/sale_product"><i class="fa fa-circle-o"></i><span>View Quotation</span></a></li>
         </ul>
       </li>
       <li class="<?php if ($this->uri->segment(1) == "Purchase_quotation") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Purchase_quotation"><i class="fa fa-shopping-cart"></i><span>Purchase</span></a></li>
       <li class="treeview <?php
          if ($this->uri->segment(1) == "Employee") {
            echo "active";
          }
          ?>">
         <a><i class="fa fa-users"></i><span>HR</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         <li class="<?php if ($this->uri->segment(1) == "Employee" && $this->uri->segment(2) == "add") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Employee/add"><i class="fa fa-circle-o"></i><span>Add Employees</span></a></li>
         <li class="<?php if ($this->uri->segment(1) == "Employee" && $this->uri->segment(2) == "") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Employee/"><i class="fa fa-circle-o"></i><span>Manage Employess</span></a></li>
         </ul>
       </li>
       <li class="treeview <?php
          if ($this->uri->segment(1) == "Reports" && $this->uri->segment(2) == "quotation_report") {
            echo "active";
          }
          else    if ($this->uri->segment(1) == "Reports" && $this->uri->segment(2) == "leads_report") {
            echo "active";
          }
          ?>">
         <a><i class="fa fa-file"></i><span>Reports</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
         <li class="<?php if ($this->uri->segment(1) == "Reports" && $this->uri->segment(2) == "quotation_report") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Reports/quotation_report"><i class="fa fa-circle-o"></i><span>Quotation Reports</span></a></li>
         <li class="<?php if ($this->uri->segment(1) == "Reports" && $this->uri->segment(2) == "leads_report") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Reports/leads_report"><i class="fa fa-circle-o"></i><span>Leads Reports</span></a></li>
         </ul>
       </li>
      
      
       <li class="treeview <?php if ($this->uri->segment(1) == "category") { echo "active"; } ?>">
         <a href="#">
           <i class="glyphicon glyphicon-dashboard"></i>
           <span>Control Panel</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu ">
           <li class="<?php if ($this->uri->segment(1) == 'Daybook' && $this->uri->segment(2) == 'add') {echo "active";} ?>"><a href="<?php echo base_url(); ?>index.php/Dashboard/database_backup"><i class="fa fa-circle-o"></i>Backup</a></li>
          
         </ul>
       </li>
       <li class=""><a href="<?php echo base_url(); ?>index.php/login/logout"><i class="fa fa-sign-out"></i>Log out</a></li>
       
     </ul>
     <?php } ?>
     <?php if($this->session->userdata['user_type'] == "E"){ ?>
      <li class="<?php if ($this->uri->segment(1) == "ChangePassword") {echo "active";} ?>"><a href="<?php echo base_url(); ?>Company/ChangePassword"><i class="fa fa-key"></i> <span>Change Password</span></a></li>

      <li class="<?php if ($this->uri->segment(1) == "ECustomer") {echo "active";} ?>"><a href="<?php echo base_url(); ?>ECustomer"><i class="fa fa-users"></i> <span>Leads</span></a></li>


      <li class="treeview <?php
         if ($this->uri->segment(1) == "ESale_curtains") {
           echo "active";
         }
         ?>">
        <a><i class="fa fa-list"></i><span>Quotation</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu ">
        <li class="treeview <?php
         if ($this->uri->segment(1) == "Sale_curtains") {
           echo "active";
         }
         ?>">
        <a><i class="fa fa-circle-o"></i><span>Add Quotation</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu ">
        <li class="<?php if ($this->uri->segment(1) == "ESale_curtains" && $this->uri->segment(2) == "add_sale") {echo "active";} ?>"><a href="<?php echo base_url(); ?>ESale_curtains/add_sale"><i class="fa fa-circle-o"></i><span>Curtains & Drapes</span></a></li>              
       
        <li class="<?php if ($this->uri->segment(1) == "ESale_curtains" && $this->uri->segment(2) == "add_wallpaper_sale") {echo "active";} ?>"><a href="<?php echo base_url(); ?>ESale_curtains/add_wallpaper_sale"><i class="fa fa-circle-o"></i><span>Wallpapers</span></a></li>    
        <li class="<?php if ($this->uri->segment(1) == "ESale_curtains" && $this->uri->segment(2) == "add_blind_sale") {echo "active";} ?>"><a href="<?php echo base_url(); ?>ESale_curtains/add_blind_sale"><i class="fa fa-circle-o"></i><span>Window Blinds</span></a></li>    
        
        <li class="<?php if ($this->uri->segment(1) == "ESale_curtains" && $this->uri->segment(2) == "add_net_sale") {echo "active";} ?>"><a href="<?php echo base_url(); ?>ESale_curtains/add_net_sale"><i class="fa fa-circle-o"></i><span>Mosquito Nets</span></a></li>    
        <li class="<?php if ($this->uri->segment(1) == "ESale_curtains" && $this->uri->segment(2) == "add_sofa_sale") {echo "active";} ?>"><a href="<?php echo base_url(); ?>ESale_curtains/add_sofa_sale"><i class="fa fa-circle-o"></i><span>Sofa & Furnitures</span></a></li>              
        
       </ul>
         </li>
        <li class="<?php if ($this->uri->segment(1) == "ESale_curtains" && $this->uri->segment(2) == "sale_product") {echo "active";} ?>"><a href="<?php echo base_url(); ?>ESale_curtains/sale_product"><i class="fa fa-circle-o"></i><span>View Quotation</span></a></li>
        </ul>
      </li>
   <li class="<?php if($this->uri->segment(1)=="login" && $this->uri->segment(2)=="logout"){echo "active";}?>" ><a  href="<?php echo base_url();?>login/logout"><i class="fa fa-sign-out"></i>  <span>Logout</span></a></li>

     <?php } ?> 
     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>