<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in();
$errors = array();
$questions=array();
$Aoptions = array();
$Boptions = array();
$Coptions = array();
$Doptions = array();
$answers = array();
$missed_op = array();
?>

<?php
if(isset($_POST['submit'])){
    $course_code = htmlentities(isset($_POST["course_code"]) ? trim($_POST["course_code"]): "");
    $due_date = htmlentities(isset($_POST["date"]) ? trim($_POST["date"]): "");
    $fields_required = array("course_code", "date");
	foreach($fields_required as $fields){
		$value = trim($_POST[$fields]);
		if(!has_presence($value)){
            $fields = str_replace("_", " ", $fields);
			$errors[$fields] = ucfirst($fields)." can't be blank";
		}	
	}
    $j=0;
    $num_assignment = htmlentities(isset($_POST["count"]) ? trim($_POST["count"]): "");
    if($num_assignment > 0){
            for($i=1; $i<=$num_assignment; $i++){
        $string = "question".$i;
        if(isset($_POST[$string]) && !empty($_POST[$string])){
            $op1 = "question".$i."optionA";
            $op2 = "question".$i."optionB";
            $op3 = "question".$i."optionC";
            $op4 = "question".$i."optionD";
            $op5 = "answer".$i;
            $fields_required = array($op1,$op2,$op3,$op4,$op5);
        foreach($fields_required as $fields){
		  $value = trim($_POST[$fields]);
		  if(!has_presence($value)){
            $fields = str_replace("_", " ", $fields);
			$errors[$fields] = ucfirst($fields)." can't be blank";
            $missed_op[$fields] = ucfirst($fields)." can't be blank";
		}	
	}
            if(empty($missed_op)){
                $optionA = htmlentities(isset($_POST[$op1]) ? trim($_POST[$op1]): "");
                $optionB = htmlentities(isset($_POST[$op2]) ? trim($_POST[$op2]): "");
                $optionC = htmlentities(isset($_POST[$op3]) ? trim($_POST[$op3]): "");
                $optionD = htmlentities(isset($_POST[$op4]) ? trim($_POST[$op4]): "");
                $answer = htmlentities(isset($_POST[$op5]) ? trim($_POST[$op5]): "");
                 $questions[$j] = $_POST[$string];
                $answers[$j] = $answer;
                $Aoptions[$j] = $optionA;
                $Boptions[$j] = $optionB;
                $Coptions[$j] = $optionC;
                $Doptions[$j] = $optionD;
                
            }
           
            $j++;
        }
    }
     if(empty($errors)){
        global $connection;
        for($i=0; $i<=$j-1; $i++){
             $query = "INSERT INTO midterm_questions(course_code, question, answer, option_a, option_b, option_c, option_d, due_date) VALUES( '{$course_code}','{$questions[$i]}', '{$answers[$i]}', '{$Aoptions[$i]}', '{$Boptions[$i]}', '{$Coptions[$i]}', '{$Doptions[$i]}', '{$due_date}')";
             $assignment = mysqli_query($connection, $query);
            confirm_query($assignment);
        }
         $query = "INSERT INTO activity_notifications(course_code, notif_type, due_date) VALUES('{$course_code}','Midterm', '{$due_date}')";
         $notif = mysqli_query($connection, $query);
         confirm_query($notif);
        redirect_to("courses.php?course={$_GET['course']}&course_code={$_GET['course_code']}");
}
    }
}
?>
<SCRIPT language="javascript" type="text/javascript">
var $ctra = 1;
var counter = 1;
function add() 
{
    for (i=1; i<=5; i++)
    {
        var ni = document.getElementById('myDiv');
        var numi = document.getElementById('theValue');
        var num = (document.getElementById('theValue').value -1) + 2;
        numi.value = num;
        var newdiv = document.createElement('div');
        var divIdName = 'my'+num+'Div';
        newdiv.setAttribute('id',divIdName);
        newdiv.setAttribute('class','form-group');
        if (counter >= 1)
        {
            newdiv.innerHTML ="<textarea rows='2' type='text' name='question"+(counter)+"' class='form-control' placeholder='Add Question "+(counter)+"'></textarea><input type='text' name='question"+(counter)+"optionA' placeholder='Option A'><input type='text' name='question"+(counter)+"optionB' placeholder='Option B'><input type='text' name='question"+(counter)+"optionC' placeholder='Option C'><input type='text' name='question"+(counter)+"optionD' placeholder='Option D'><input type='text' name='answer"+(counter)+"' placeholder='Correct Option'><input type='hidden' name='count' value="+(counter)+">";
            counter = counter + 1
        }
        if($ctra>0)
        {
            ni.appendChild(newdiv);
            $ctra++;
        }
        $total = $ctra;
    }
}
</SCRIPT>
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
                            Add Midterm </div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Midterm</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                            <form method="post" action="" enctype="multipart/form-data">
                                <?php echo form_errors($errors);?>
                                <div class="form-group">
                                     <input type="text" name="weight" placeholder="WEIGHT" class="form-control">
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="course_code" value="<?php echo $_GET['course_code']?>" class="form-control">
                                </div>
                                 <div class="form-group">
                                    <input type="datetime-local" name="date" placeholder="Due Date" class="form-control">
                                </div>
                                <div id="myDiv" class="form-group"></div>
                                <div id="theValue"></div>
                          <div onclick="add();">
                        <INPUT type = "button" value = "Add Questions" class="btn btn-default"/>
                        </div>
                         <input type="submit" name="submit" value="Submit" class="btn btn-success">     
                        </form>
                <div id="area-chart-spline" style="width: 100%; height: 300px; display:none;">
                                                </div>
                     </div>
                </div>
                                

                <!--END CONTENT-->
 <?php require_once('../../includes/footer.php')?>