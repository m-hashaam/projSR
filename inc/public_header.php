<?php




 
$footer = '
<div class="page-header" id="page-header-top">
    <div class="page-header-top tour-compatible">
        <a href="javascript:" class="menu-toggler"></a>
        <div class="page-header-menu">  
            <div class="container-fluid">
                <div class="hor-menu">
                    <ul class="nav navbar-nav navbar-fixed-top">
                        <li id="logo2">
                            <select id="topSelectProduct" class="form-control select-lg" style="margin-left: 20%; margin-top: 5%; width: 155px; border-radius: 10px !important; background: #007496; border-color: #007496; color: white; font-weight: bold; font-size: larger;">
                                            <option >No Product</option>
                                        </select>
                        </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </ul>
                </div>
                <div class="hor-menu" style="margin-left: 36%;">
                    <ul class="nav navbar-nav navbar-fixed-top">
                        <li id="logo">
                            <img id="header-logo" style="cursor:pointer;" class="aligncenter size-full wp-image-260" onclick="location.href=\'index.php\'" alt="Sweet Referrals Logo" src="assets/logo_white.png">
                        </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </ul>
                </div>
            </div>
        </div>
        
        

        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username bold">Guest</span> <i class="fa fa-caret-down fa-2x"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="account.php">
                                <i class="icon-user"></i> Account
                            </a>
                        </li>
                        <li>
                            <a href="company.php">
                                <i class="icon-globe"></i> Company
                            </a>
                        </li>
                        <li class="divider">
                        </li>
                                                <li>
                            <a href="reports.php">
                                <i class="fa fa-area-chart"></i> Reports Center
                            </a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <a href="http://brand.sweetreferrals.com/contact-us/">
                                <i class="icon-call-in"></i> Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="http://brand.sweetreferrals.com/faqs/">
                                <i class="icon-support"></i> Help &amp; FAQ
                            </a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <a name="logout" class="logout" href="authentication/logout.php">
                                <i class="icon-key"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>


';

echo $footer;