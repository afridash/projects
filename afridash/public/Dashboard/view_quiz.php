<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in();
?>

<style>
li {
    list-style: none;
    text-align: left;
}</style>
<?php require_once("../../includes/header.php");?>
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            QUIZ <?php echo $_GET['id']; ?></div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Quizzes</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
        <?php 
        global $connection;
        $query = "SELECT * FROM quiz_questions WHERE course_code = '{$_GET['course_code']}' AND quiz_id= '{$_GET['id']}' ";
        $examples  = mysqli_query($connection, $query);
        $count = 0;
        while($example = mysqli_fetch_assoc($examples)){
            if($example['quiz_upload']==""){
            $count +=1;
            ?>
        <ul class="questions">
        <li><?php echo "<strong>{$count}. {$example['question']}</strong>"; ?></li>
        <input type="radio" name="answer<?php echo $count?>" value="a" /><?php echo " A. {$example['option_a']}<br/>";?>
        <input type="radio" name="answer<?php echo $count?>" value="b" /><?php echo " B. {$example['option_b']}<br/>";?>
        <input type="radio" name="answer<?php echo $count?>" value="c" /><?php echo " C. {$example['option_c']}<br/>";?>
         <input type="radio" name="answer<?php echo $count?>" value="d" /><?php echo " D. {$example['option_d']}";?>
        </ul>
        <?php }else{ ?>
         <iframe src="<?php load_quiz($_GET['course_code'], $_GET['id']); ?>" width="100%" height="600px" ></iframe>     
         <?php
            }
        }
        ?>
                <div id="area-chart-spline" style="width: 100%; height: 300px; display:none;">
                                                </div>
                     </div>
                </div>
                                

                <!--END CONTENT-->
 <?php require_once('../../includes/footer.php')?>