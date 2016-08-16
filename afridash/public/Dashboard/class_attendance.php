<?php ob_start()?>
<?php
require 'class.phpmailer.php';
function Send_Mail($to,$subject,$body)
{
$from       = "donotreply@afri-dash.com";
$mail       = new PHPMailer();
$mail->IsSMTP(true);            // use SMTP
$mail->IsHTML(true);
//$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = 'localhost'; // SMTP host
$mail->Port       = 25;                    // set the SMTP port
//$mail->Username   = 'richard.igbiriki@afri-dash.com';  // SMTP  username
//$mail->Password   = '08103182386';  // SMTP password
$mail->SetFrom($from, 'Afri-Dash');
$mail->AddReplyTo($from,'Afri-Dash');
$mail->Subject    = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);
$mail->Send(); 
}
?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php 
global $connection;
if(isset($_GET['risk']) && $_GET['risk']=='true'){
    $query = "SELECT email from users WHERE user_id = {$_GET['id']} LIMIT 1";
    $getMail = mysqli_query($connection, $query);
    confirm_query($getMail);
    $Mail = mysqli_fetch_assoc($getMail);
    $to = $Mail['email'];
    $subject = 'AT RISK';
    $body = 'You are at risk of failing a class. You are approaching your maximum number of absences. Please, see your instructor. <br/>Course: '.$_GET['course'].'<br/>Course Code: '.$_GET['course_code'].'<br/><br/>The Afri-Dash Team';
    Send_Mail($to, $subject, $body);
}
?>
<?php confirm_if_user_logged_in(); ?>
<?php 
$errors= array();
$fnames = array();
$nameCounter = 0;
$nnames = array();
global $connection;
if(isset($_POST['register'])){
                        $date = isset($_POST["due_date"]) ? trim($_POST["due_date"]): "";
                        global $connection;
                        $query = "SELECT course_id FROM courses WHERE course_code = '{$_GET['course_code']}' ";
                        $get_student_class = mysqli_query($connection, $query);
                        confirm_query($get_student_class);
                        $student_class = mysqli_fetch_assoc($get_student_class);
                        $query = "SELECT student_email FROM course_reg WHERE course_id = {$student_class['course_id']} AND faculty = 'No' ";
                        $get_forum_students = mysqli_query($connection, $query);
                        confirm_query($get_forum_students);
                        while($forum_students = mysqli_fetch_assoc($get_forum_students)){
                            $query = "SELECT user_id, first_name, last_name FROM users WHERE email = '{$forum_students['student_email']}' ";
                            $get_member = mysqli_query($connection, $query);
                            confirm_query($get_member);
                            while($member = mysqli_fetch_assoc($get_member)){
                                $nameCounter +=1;
                                if(isset($_POST[$member['first_name']])){
                                    if($_POST[$member['first_name']]==1){
                                   $query = "UPDATE attendances SET presents = presents + 1 WHERE user_id = {$member['user_id']} AND course_id = {$student_class['course_id']}";
                                    $update = mysqli_query($connection, $query);
                                        confirm_query($update);
                                    }elseif($_POST[$member['first_name']] == 0){
                                    $query = "UPDATE attendances SET absents =absents + 1 WHERE user_id = {$member['user_id']} AND course_id = {$student_class['course_id']}";
                                    $update = mysqli_query($connection, $query);
                                        confirm_query($update);
                                        $to=$forum_students['student_email'];
                                        $subject="Absence Recorded";
                                        $body='An absence has been recorded in your attendance report. <br/><br/> Course: '.$_GET['course'].'Date: '.$date.'<br/><br/> If you think this was a mistake, please contact your instructor.<br/><br/>The Afri-Dash Team';
                                        Send_Mail($to,$subject,$body);
                                    }elseif($_POST[$member['first_name']] == 2){
                                     $query = "UPDATE attendances SET tardies = tardies + 1 WHERE user_id = {$member['user_id']} AND course_id = {$student_class['course_id']}";
                                    $update = mysqli_query($connection, $query);
                                        confirm_query($update);
                                    }
                                }elseif(isset($_POST[$member['last_name']])){
                                    $query = "UPDATE attendances SET excuses = excuses + 1 WHERE user_id = {$member['user_id']} AND course_id = {$student_class['course_id']}";
                                    $update = mysqli_query($connection, $query);
                                        confirm_query($update);
                                
                                }else{
                                    $str = "Student".$nameCounter;
                                    $errors[$str] = "{$member['first_name']} {$member['last_name']} has not been marked! ";
                            }
            }
    }
}
?>
<?php require_once("../../includes/header.php");?>
    <link rel="stylesheet" href="styles/BeatPicker.min.css"/>
    <link rel="stylesheet" href="styles/prism.css"/>
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Class Roster</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Class Registration</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
              <div class="row mbl">
   <button class="btn btn-default"><i class="fa fa-check-square"> Mark All Present</i></button><button class="btn btn-default"><i class="fa fa-times"> Clear</i></button> <button class="btn btn-default"><i class="fa fa-check-square"> Mark Remaining Absent</i></button><br/>
    <form role="form" method="post" action="">
    <?php echo form_errors($errors);?>
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                    <th></th>
                     <th>Student</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Tardy</th>
                    <th>Excused</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        global $connection;
                        $query = "SELECT course_id FROM courses WHERE course_code = '{$_GET['course_code']}' ";
                        $get_student_class = mysqli_query($connection, $query);
                        confirm_query($get_student_class);
                        $student_class = mysqli_fetch_assoc($get_student_class);
                        $query = "SELECT student_email FROM course_reg WHERE course_id = {$student_class['course_id']} AND faculty = 'No' ";
                        $get_forum_students = mysqli_query($connection, $query);
                        confirm_query($get_forum_students);
                        while($forum_students = mysqli_fetch_assoc($get_forum_students)){
                            $query = "SELECT user_id, first_name, last_name FROM users WHERE email = '{$forum_students['student_email']}' ";
                            $get_member = mysqli_query($connection, $query);
                            confirm_query($get_member);
                            while($member = mysqli_fetch_assoc($get_member)){
                                $nameCounter ++;
                             $query = "SELECT presents, absents FROM attendances WHERE course_id = {$student_class['course_id']} AND user_id = {$member['user_id']} LIMIT 1";
                            $getAttendance = mysqli_query($connection, $query);
                            confirm_query($getAttendance);
                            $attendance = mysqli_fetch_assoc($getAttendance);
                            ?>
  <tr>
            <td><?php echo "{$attendance['presents']} ({$attendance['absents']})" ?></td>
            <td><?php echo "{$member['first_name']} {$member['last_name']}" ?></td>
            <td><input id="1" type="radio" name="<?php echo $member['first_name']?>" value="1"></td>
            <td><input id="2" type="radio" name="<?php echo $member['first_name']?>" value="0"></td>
            <td><input id="3" type="radio" name="<?php echo $member['first_name']?>" value="2"></td>
            <td><input type="checkbox" name="<?php echo $member['last_name']?>" value="1"></td>
            <td><a href="class_attendance.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>&risk=true&id=<?php echo $member['user_id']?>">Is At Risk</a></td>
            </tr>
                        <?php 
                            }
                        }
                    ?>
                            </tbody>
                            </table>
            
        </div><label>Pick a date</label>
        <input name="due_date" type="text" data-beatpicker="true" data-beatpicker-position="['right','bottom']" data-beatpicker-format="['DD','MM','YYYY']"/>
        </div>
<input type="submit" name="register" value="Save Attendance" class="btn btn-default">              
</form>

</div>
 
                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                            </div>


                    </div>
                    </div>
                
<script type="text/javascript">
function mark() {
var counter = "<?php echo $nameCounter; ?>";
for(i=1; i<=counter; i++){
    document.getElementById("1").checked=true;
}
}

</script>
    <script src="script/BeatPicker.min.js"></script>
    <script src="script/prism.js"></script>
 <?php require_once('../../includes/footer.php')?>