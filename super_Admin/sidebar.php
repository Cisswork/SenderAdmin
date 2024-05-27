<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="width: 248px;">
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
          <a href="dashboard.php"><img src="dist/img/Cerber Logo - Black on White.svg" style="width: 90%;padding-left: 10%;"></a>
       </div>
     <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
        <!--<li class="header">MAIN NAVIGATION</li>-->
            <li class="">
                  <a href="dashboard.php">
                    <i class="fa fa-dashboard" style="font-size: 17px;"></i> <span>Dashboard</span>
                  </a>
            </li>
            <li class="treeview">
                      <a href="viewcustomer.php">
                        <img src="dist/img/customer.png" style="width:18px;"> 
                        <span>User Management</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                <ul class="treeview-menu">
                    <li><a href="addcustomer.php"><i class="fa fa-user"></i> Add User</a></li>
                    <li><a href="viewcustomer.php"><i class="fa fa-street-view"></i>View Users</a></li>
                </ul>
            </li>
            <li class="treeview">
                      <a href="adddriver.php">
                        <img src="dist/img/driver1.png" style="width:20px;"> 
                        <span>Driver Management</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                  <ul class="treeview-menu">
                    <li><a href="adddriver.php"><i class="fa fa-street-view"></i> Add Drivers</a></li>
                    <li><a href="viewdriver.php"><i class="fa fa-street-view"></i> View Drivers</a></li>
                   </ul>
            </li>
            <li><a href="review.php"> <img src="dist/img/driver1.png" style="width:20px;"> <span>Driver Ratings</span></a> </li>
            <li><a href="bookinghistory.php"><i class="fa fa-file-text"></i> Trip History</a></li> 
            <li class="">
                  <a href="view_package.php">
                   <img src="dist/img/vehicle.png " style="width:18px;"> <span>Package Management</span>
                  </a>
            </li>
            <li class="treeview">
                      <a href="viewdriver.php">
                        <img src="dist/img/driver1.png" style="width:20px;"> 
                        <span>Area Management</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                  <ul class="treeview-menu">
                    <li><a href="AreaNameList.php"><i class="fa fa-user"></i>Area List</a></li>
                    <li><a href="AreaZipcodeList.php"><i class="fa fa-street-view"></i>Area Zipcode List</a></li>
                    <li><a href="AreaListRoutes.php"><i class="fa fa-street-view"></i>List of Routes</a></li>
                   </ul>
            </li>
            <li><a href="cancel_reason.php"><i class="fa fa-question" aria-hidden="true"></i><span>Cancellations</span></a> </li>
            <li><a href="notification.php"><i class="fa fa-bell" aria-hidden="true"></i><span>Notification System</span></a> </li>
            <li class="treeview">
                      <a href="">
                        <img src="dist/img/customer.png" style="width:18px;"> 
                        <span>FAQ</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                    <ul class="treeview-menu">
                    <li><a href="faq.php"><i class="fa fa-user"></i>User FAQ</a></li>
                    <li><a href="driver_faq.php"><i class="fa fa-user"></i>Driver FAQ</a></li>
                    </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <img src="dist/img/customer.png" style="width:18px;"> 
                    <span>Terms & Conditions</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="add_user_termscondition.php"><i class="fa fa-user"></i>User T&C</a></li>
                    <li><a href="add_driver_termscondition.php"><i class="fa fa-user"></i>Company T&C</a></li>
                </ul>
            </li> 
            <li class="treeview">
                 <a href="">
                    <img src="dist/img/customer.png" style="width:18px;"> 
                    <span>Privacy Policy</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="add_user_privacypolicy.php"><i class="fa fa-user"></i>User Privacy & Policy</a></li>
                    <li><a href="add_driver_privacypolicy.php"><i class="fa fa-user"></i>Company Privacy & Policy</a></li>
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fw fa-phone" style="font-size: 17px;"></i> 
                    <span>Support Call Center</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="inquiry.php"><i class="fa fa-question"></i> Enquiry</a></li>
                    <li><a href="about_us.php"><i class="fa fa-address-card-o" aria-hidden="true"></i> About Us</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <img src="dist/img/customer.png" style="width:18px;"> 
                    <span>Write Support</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="user_write_support.php"><i class="fa fa-user"></i>Users Support Messages</a></li>
                    <li><a href="driver_write_support.php"><i class="fa fa-user"></i>Drivers Support Messages</a></li>
                </ul>
            </li>
       </ul>
    </section>
    <!-- /.sidebar -->
  </aside>