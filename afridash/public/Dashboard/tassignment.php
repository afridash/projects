<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); ?>
<?php 
$errors = array();
global $connection;
$score = 0;
$ans = array();
$query = "SELECT answer FROM assignment WHERE assignment_id = {$_GET['id']} AND course_code = '{$_GET['course_code']}'";
$answers = mysqli_query($connection, $query);
$num_questions = mysqli_num_rows($answers);
if(isset($_POST['submit'])){
    for($i=1; $i<=$num_questions; $i++){
        $string = "answer".$i;
        if(isset($_POST[$string])){
            $ans[$i-1] = $_POST[$string];
        }else{
            $ques = "Question" .$i;
            $errors[$ques] = "Question {$i} can not be empty. ";
        }
    }
    if(empty($errors)){
        $counter = 0;
        $db_answers = array();
        while($answer = mysqli_fetch_array($answers)){
            $db_answers[$counter] = $answer[0];
            $counter +=1;
        }
        for($j=0; $j<$num_questions; $j++){
            if($db_answers[$j] == $ans[$j]){
                $score += 1;
            }
        }
        $total = ($score/$num_questions) * 100;
$query = "INSERT INTO assignment_scores (assignment_id, course_code, user_id, score) VALUES({$_GET['id']},'{$_GET['course_code']}',{$_SESSION['user_id']}, {$total})";
    $insert_score = mysqli_query($connection, $query);
    confirm_query($insert_score);
        redirect_to("courses.php?course={$_GET['course']}&course_code={$_GET['course_code']} ");
}
}

?>
<?php 
global $connection;
$query = "SELECT * FROM course_reg WHERE student_email = '{$_SESSION['email']}' ";
$student_new = mysqli_query($connection, $query);
confirm_query($student_new);
?>
<style>
li {
    list-style: none;
    text-align: left;
}</style>
<?php require_once("../../includes/header.php");?>
<div id="contentOneTwo"></div>
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Take Assignment <?php echo $_GET['id']; ?></div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Assignment</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                   
     <form method="post" action="">
        <?php echo form_errors($errors);?>
        <?php 
        global $connection;
        $query = "SELECT * FROM assignment WHERE course_code = '{$_GET['course_code']}' AND assignment_id= '{$_GET['id']}' ";
        $examples  = mysqli_query($connection, $query);
        $count = 0;
        while($example = mysqli_fetch_assoc($examples)){
            if($example['quiz_upload']==""){
            $count +=1;
            ?>
        <ul class="questions">
        <li><?php echo "<strong>{$count}. {$example['assignment_itself']}</strong>"; ?></li>
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
 </form>
<p><?php if(isset($Score_string)){echo $Score_string; }?></p>
                            <div id="area-chart-spline" style="width: 100%; height: 300px; display:none;">
                                                </div>
                            
                                    </div>
                </div>
                                

                <!--END CONTENT-->
 <?php require_once('../../includes/footer.php')?>