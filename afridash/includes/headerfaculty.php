<?php require_once('db.php');?>
<?php 
if(isset($_GET['changeprofilepicture'])){
        
        if(isset($_POST['submit'])){
        global $connection;
        move_uploaded_file($_FILES['file']['tmp_name'],"../includes/pictures/".$_FILES['file']['name']);
        $query = "UPDATE students SET picture = '".$_FILES['file']['name']. "'WHERE email = '".$_SESSION['email']."'";
        $result = mysqli_query($connection, $query);
}
}?>
<?php 
if(isset($_GET['changecoverphoto'])){
        global $connection;
        move_uploaded_file($_FILES['file']['tmp_name'],"../includes/coverphotos/".$_FILES['file']['name']);
        $query = "UPDATE students SET cover_phooto = '".$_FILES['file']['name']. "'WHERE email = '".$_SESSION['email']."'";
        $result = mysqli_query($connection, $query);
}?>
<?php
if(isset($_GET['description'])){
	if(isset($_POST['submit'])){
		$status = htmlentities(isset($_POST['status'])? $_POST['status']:"");
		global $connection;
		$status = mysqli_real_escape_string($connection, $status);
		$query = "UPDATE students SET description = '{$status}' WHERE email ='{$_SESSION['email']}' ";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
	}
}
?>
<?php 
if (isset($_GET['logout']))
{
    logged_out($_SESSION["user_id"]);
    $_SESSION = array();
    if ($_COOKIE[session_name()])
    {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
    redirect_to('index.php');
}

?>
<?php 
global $connection;
$query = "SELECT * FROM course_reg WHERE student_id = {$_SESSION['user_id']}";
$student = mysqli_query($connection, $query);
confirm_query($student);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Afridash Student Admin</title>
    <link href="generic.css" rel="stylesheet" type="text/css" />
    <link href="css/slider.css" rel="stylesheet" type="text/css" />
    <script src="js/thumbnail-slider.js" type="text/javascript"></script>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
@media(min-width:768px){
        body{margin-top: 80px;}
}
.sidebar{
        margin-top:100px;
    }
    </style>

</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top " role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img src = "../public/images/logo.png" style = "height:45px; width:100px; padding:1px; margin:-12px"></a>
            </div>
            <!-- /.navbar-header -->
            <!--/This for the Academics dropdown-->
            <div class="collapse navbar-collapse myNav" id="myNavbar">
            <ul class="nav navbar-nav navbar-right newNav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><strong>Academics</strong>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-academics sub">
                        <li><a href="#"><i class="fa fa-book fa-fw"></i> Grade</a>
                        </li>
                        <li><a href="#"><i class="fa fa-calculator fa-fw"></i> Grade Point Average Calculator</a>
                        </li>
                        <li><a href="../public/transcript.php"><i class="fa fa-list-alt fa-fw"></i> Transcript</a>
                        </li>
                        <li><a href="#"><i class="fa fa-square-o fa-fw"></i> Program Evaluation</a>
                        </li>
                        <li><a href="../public/registered_classes.php"><i class="fa fa-calendar fa-fw"></i> Class Schedule</a>
                        </li>
                        <li class="divider"></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><strong>Online Registration</strong>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-online registration sub1">
                        <li><a href="../public/class_registration.php"><i class="fa fa-plus fa-fw"></i> Add Class</a>
                        </li>
                        <li><a href="../public/registered_classes.php"><i class="fa fa-plus fa-fw"></i> Drop Class</a>
                        </li>
                        <li><a href="../profile/profile.php"><i class="fa fa-reorder fa-fw"></i> Request Change of Major</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages sub2">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks sub3">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts sub4">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown" style="padding-right:25px;">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">
            <?php 
            set_profile_picture(35,35, $_SESSION['user_id']);
?><?php echo " ".$_SESSION['name'];?>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user sub5">
                        <li><a data-toggle="modal" href="#myModal"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="?logout=1"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            </div>
            
            
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar scroll" role="navigation">
                <div class="sidebar-nav navbar-collapse newDash" id="myNavbar">
                    <ul class="nav dash" id="side-menu">
                        <li class="sidebar-search">
                            <!--
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search..." style = "border-radius: 6px 6px 6px 6px">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search" style = "border:0px"></i>
                                </button>
                            </span>
                            </div>
                            -->
                            
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" id="inputSuccess2" placeholder = "Search..." style = "border-radius:25px 25px 25px 25px"/>
                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                           
                             </div>
                            
                            
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="students.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="../public/transcript.php"><i class="fa fa-graduation-cap fa-fw"></i> Transcript</a>
                        </li>
                        <li>
                            <a href="../public/class_registration.php"><i class="glyphicon-plus"></i> Class Registration</a>
                        </li>
                          <li>
                            <a href="#"><i class="fa fa-comments fa-fw"></i> Forums<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php
                        while($students = mysqli_fetch_assoc($student)){
                            $query = "SELECT * FROM courses WHERE course_id = {$students['course_id']} ORDER BY course_id ASC ";
                            $course = mysqli_query($connection, $query);
                            confirm_query($course);
                
                            while($courses = mysqli_fetch_assoc($course)){
                                $title = urlencode($courses['course_title']);
                                ?>
                                <li><a href="forums.php?course=<?php echo $title?>&coursecode=<?php echo $courses['course_code']?>&id=<?php echo uniqid(mt_rand(),true)?>"><?php echo $courses['course_title'];?></a></li>
                            <?php   
                                    }?>
                            <?php }?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Friends<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Mabel Ogiriki</a>
                                </li>
                                <li>
                                    <a href="#">Pere Perewari</a>
                                </li>
                                <li>
                                    <a href="#">James Uzoma</a>
                                </li>
                                <li>
                                    <a href="#">Richard Igbiriki</a>
                                </li>
                                <li>
                                    <a href="#">Adaka Iguniwei</a>
                                </li>
                                <li>
                                    <a href="#">Donald Nyingifa</a>
                                </li>
                                <li>
                                    <a href="#">Lincoln University</a>
                                </li>
                                <li>
                                    <a href="#">Segunfunmi Oyedele</a>
                                </li>
                                <li>
                                    <a href="#">Ajala Taiwo</a>
                                </li>

                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>