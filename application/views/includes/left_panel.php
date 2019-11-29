<nav class="navbar navbar-expand-sm navbar-default">
    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="<?php echo site_url('Welcome')?>"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
            </li>
            <li class="menu-title">Administrator</li><!-- /.menu-title -->

<li class="">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fas fa-users-cog"></i>Employee</a>
  
</li>

<li class="">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fas fa-users"></i>User</a>
   
</li>

<li class="">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fas fa-user-tag"></i>Roles</a>
    
</li>

<li class="">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Regulation</a>
               
            </li>

            <li class="">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-award"></i>Certification</a>
                
            </li>

            
            <li class="">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fas fa-concierge-bell"></i>Service</a>
                
            </li>


                  <li class="menu-title">Sales & Operations</li><!-- /.menu-title -->

            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fas fa-user-tie"></i>Costumer</a>
                <ul class="sub-menu children dropdown-menu">                     
                    <li><i class="fas fa-user-tie"></i> <a href="<?php echo site_url('Customer')?>">Registration Request</a></li>
                </ul>
                <ul class="sub-menu children dropdown-menu">                     
                    <li><i class="fas fa-user-tie"></i> <a href="<?php echo site_url('Customer')?>">Customer List</a></li>
                </ul>
            </li>
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Order</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="fa fa-table"></i><a href="<?php echo site_url('Order')?>">Pending Order</a></li>
                </ul>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="fa fa-table"></i><a href="<?php echo site_url('Order')?>">Inprogress Order</a></li>
                </ul>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="fa fa-table"></i><a href="<?php echo site_url('Order')?>">Finished Order</a></li>
                </ul>
            </li>
           
            <li class="">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-chart-line"></i>Activity</a>
               
            </li>

            <li class="menu-title">Accounting</li><!-- /.menu-title -->
            <li class="">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-tasks"></i>Inprogress Order</a>
               
            </li>
            
            <li class="">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fas fa-file-invoice-dollar"></i>Invoice</a>
               
            </li>
            
            <li class="menu-title">Extras</li><!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Pages</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="menu-icon fa fa-sign-in"></i><a href="<?php echo site_url('Login/Log_page');?>">Login</a></li>
                    <li><i class="menu-icon fa fa-sign-in"></i><a href="<?php echo site_url('Register/Register_page');?>">Register</a></li>
                    <li><i class="menu-icon fa fa-paper-plane"></i><a href="pages-forget.html">Forget Pass</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav> 