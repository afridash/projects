<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); ?>
<?php require_once("../../includes/header.php");?>
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Email </div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Email</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="page-content">
                    <div class="row mbl">
                    <?php 
                        $authhost="{imap.gmail.com:993/imap/ssl/novalidate-cert}";
                        $user="imorobebhrichard@gmail.com";
                        $pass="08103182386";
                        if ($mbox=imap_open( "{$authhost}INBOX", $user, $pass ))
                            {
                            echo "<h1>Connected</h1>\n";
                            imap_close($mbox);
                                } else
                                {
                                echo "<h1>FAIL!</h1>\n";
                                }
                        ?>
                    </div>
<div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>
 <?php require_once('../../includes/footer.php')?>