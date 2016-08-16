<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>

<?php
    if(isset($_POST['submit'])){
        $course_description = htmlentities(isset($_POST["description"]) ? trim($_POST["description"]): "");
        global $connection;
        $query = "UPDATE courses SET course_description = '{$course_description}' WHERE course_code = '{$_GET['course_code']}' ";
        $update_desc = mysqli_query($connection, $query);
        confirm_query($update_desc);
    }
?>
<?php 
if(isset($_POST['submit_syllabus'])){
    global $connection;
        move_uploaded_file($_FILES['file']['tmp_name'],"../../uploads/syllabuses/".$_FILES['file']['name']);
        $query = "INSERT INTO syllabuses(course_code,syllabus) VALUES ('".$_GET['course_code']."','".$_FILES['file']['name']. "')";
        $upload_syllabus = mysqli_query($connection, $query);
        confirm_query($upload_syllabus);
}?>

<?php confirm_if_user_logged_in(); ?>
<?php 
global $connection;
$query = "SELECT * FROM course_reg WHERE student_email = '{$_SESSION['email']}' ";
$student_new = mysqli_query($connection, $query);
confirm_query($student_new);
?>
<?php require_once("../../includes/header.php");?>

            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                           <?php echo $_GET["course"];?>
                           </div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Course</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
            <div class="page-content">
            <div class="row mbl">
        <ul class="nav nav-tabs">
        <li class="<?php if(!isset($quiz)){ echo "active"; } ?>"><a data-toggle="tab" href="#Notifications">Notifications</a></li>
        <li><a data-toggle="tab" href="#About">About</a></li>
        <li><a data-toggle="tab" href="#Syllabus">Syllabus</a></li>
        <li><a data-toggle="tab" href="#Instructor">Instructor</a></li>
        <li><a data-toggle="tab" href="#Assignments">Assignments</a></li>
         <li class="<?php if(isset($quiz)){ echo "active"; } ?>"><a data-toggle="tab" href="#Quizzes">Quizzes</a></li>
          <li><a data-toggle="tab" href="#Tests">Tests</a></li>
        <li><a data-toggle="tab" href="#Midterm">Midterm</a></li>
        <li><a data-toggle="tab" href="#Final">Final</a></li>
            <?php if($_SESSION['access_level']==2){ ?>
           <li><a data-toggle="tab" href="#List">Students</a></li>
            <?php 
                      }?>
    </ul>
    <div class="tab-content">
         <div id="Notifications" class="tab-pane fade <?php if(!isset($quiz)){ echo "in active"; } ?>">
            <?php 
                $query = "SELECT * FROM activity_notifications WHERE course_code = '{$_GET['course_code']}' ORDER BY activity_id DESC";
                $get_notif = mysqli_query($connection, $query);
                confirm_query($get_notif);
                while($notification = mysqli_fetch_assoc($get_notif)){
                    echo "A/An {$notification['notif_type']} was added on ".date('M j Y g:i A', strtotime($notification['notif_time']));
                    echo "<br/><hr/>";
                }
             ?>
        </div>
        <div id="About" class="tab-pane fade ">
            <h5>Course Description</h5>
            <?php 
                global $connection;
                $query = "SELECT * FROM courses WHERE course_code = '{$_GET['course_code']}' LIMIT 1";
                $course_details = mysqli_query($connection, $query);
                confirm_query($course_details);
            while($details = mysqli_fetch_assoc($course_details)){
                if($_SESSION['access_level']==1){
                    echo $details['course_code'];echo "--"; echo $details['course_description'];
                    echo "<br/><br/>";
                    ?>
            <h5>Course Semester</h5>
        <?php echo $details['course_semester'];
            echo "<br/><br/>"; ?> 
        <h5>Course Credits</h5>
                 <?php echo $details['course_credit'];
            echo "<br/><br/>"; ?>     
              <?php  }elseif($_SESSION['access_level']==2){
                    echo $details['course_code'];echo "--&nbsp;"; echo $details['course_description'];
                    echo "<br/>";
                    ?>
            <a class="btn btn-primary" data-toggle="modal" href="#course_description">Edit</a>
            <br/><br/>
            <h5>Course Semester</h5>
            <?php echo $details['course_semester'];
            echo "<br/><br/>"; ?> 
            <h5>Course Credits</h5>
            <?php echo $details['course_credit'];
            echo "<br/><br/>"; ?>
            <?php    }
            }?>
        </div>
        <div id="Syllabus" class="tab-pane fade">
            <h3>Syllabus</h3>
            <?php 
            if($_SESSION['access_level']==1){
                ?>
             <iframe src="<?php load_syllabus($_GET['course_code']); ?>" width="800px" height="600px" ></iframe>
            <?php
            }elseif($_SESSION['access_level']==2){
                ?>
            <iframe src="<?php load_syllabus($_GET['course_code']); ?>" width="100%" height="600px" ></iframe>
            <form enctype="multipart/form-data" method="post" action="" >
                <input class="btn btn-default" type="file" name="file">
                <input class="btn btn-primary" type="submit" name="submit_syllabus" value="Upload">
            </form>
            <?php
            }
            ?>
        </div>
        <div id="Instructor" class="tab-pane fade">
            <h3 align="center">About Instructor</h3>
            <?php 
            global $connection;
            $query = "SELECT * FROM courses WHERE course_code = '{$_GET['course_code']}' LIMIT 1";
            $get_course = mysqli_query($connection, $query);
            confirm_query($get_course);
            $class = mysqli_fetch_assoc($get_course);
            $query = "SELECT * FROM course_reg WHERE course_id = {$class['course_id']} AND faculty = 'YES' LIMIT 1";
            $faculty = mysqli_query($connection, $query);
            confirm_query($faculty);
            $faculty_mail = mysqli_fetch_assoc($faculty);
            $query = "SELECT * FROM faculty WHERE email = '{$faculty_mail['student_email']}' LIMIT 1";
            $faculty_information = mysqli_query($connection, $query);
            confirm_query($faculty_information);
            while($fa_details = mysqli_fetch_assoc($faculty_information)){
            if($_SESSION['access_level']==2){
            ?>
            <div align="center">
                <?php set_profile_picture(200,200,$fa_details['email']); ?>
            
                <?php 
                    echo "<br/><br/>";
                    echo "First Name: {$fa_details['first_name']}<br/>";
                if($fa_details['middle_name']!=""){echo "Middle Name: {$fa_details['middle_name']}<br/>";}
                    echo "Last Name: {$fa_details['last_name']}<br/>";
                    echo "Email: {$fa_details['email']}<br/>";
                    echo "Phone: {$fa_details['faculty_phone_no']}<br/>";
                    echo "Gender: {$fa_details['faculty_gender']}<br/>";
                    echo "About: {$fa_details['description']}<br/>";
                    ?>
            <?php }elseif($_SESSION['access_level']==1){
                ?>
            <div align="center">
                <?php set_profile_picture(200,200,$fa_details['email']); ?>
            
                <?php 
                    echo "<br/><br/>";
                    echo "First Name: {$fa_details['first_name']}<br/>";
                if($fa_details['middle_name']!=""){echo "Middle Name: {$fa_details['middle_name']}<br/>";}
                    echo "Last Name: {$fa_details['last_name']}<br/>";
                    echo "Email: {$fa_details['email']}<br/>";
                    echo "Phone: {$fa_details['faculty_phone_no']}<br/>";
                    echo "Gender: {$fa_details['faculty_gender']}<br/>";
                    echo "About: {$fa_details['description']}<br/>";
                    
            }
            }
            ?></div>

        </div>
        <div id="Assignments" class="tab-pane fade" >
           <!-- <p> This is a test Richard incase you see it!</p> -->
            <?php 
        global $connection;
        $query = "SELECT DISTINCT(assignment_id), due_date, published FROM assignment WHERE course_code = '{$_GET['course_code']}' ORDER BY assignment_id ASC";
        $assignments = mysqli_query($connection, $query);
        confirm_query($assignments);
        $assignment_no = mysqli_num_rows($assignments);
     if($_SESSION['access_level']==2){ ?>
            <table class = "table table-striped">
				<thead>
					<tr>
						<th>TITLE  </th>
						<th>DUE DATE  </th>
                        <th>SEE ASSIGNMENT</th>
						<th>GRADES </th>
						<th>PUBLISH/HIDE</th>
					</tr>
				
				</thead>
				<tbody>
            <?php
         while($assignment = mysqli_fetch_assoc($assignments)){
  ?>  
            <tr>
            <td>Assignment <?php echo $assignment['assignment_id']; ?>  </td>
            <td><?php echo $assignment['due_date'] ?></td>
            <td><a class="btn btn-primary" href="tassignment.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>&id=<?php echo $assignment['assignment_id'] ?>"> VIEW </a></td>
            <td><a class="btn btn-success" href="assignment_grades.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>&id=<?php echo $assignment['assignment_id'] ?>">SEE GRADES</a></td>
            <td><a class="btn btn-danger" href="#"><?php if($assignment['published']=='0'){echo "PUBLISH";}else{echo "HIDE";} ?></a></td>
            </tr>
            <?php }?>
                    </tbody>
			</table>
            <a class="btn btn-default" href="assign.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>">Add Assignment</a>
            <?php
                }elseif($_SESSION['access_level']==1){ ?>
                    <table class = "table table-striped">
				<thead>
					<tr>
						<th>TITLE  </th>
						<th>DUE DATE  </th>
						<th>GRADES </th>
						<th>START</th>
					</tr>
				
				</thead>
				<tbody>
                    <?php
        while($assignment = mysqli_fetch_assoc($assignments)){
     ?>
							<tr>
							<td>Assignment <?php echo $assignment['assignment_id']; ?></td>
							<td><?php echo $assignment['due_date'] ?></td>
							<td> A </td>
							<td><a class="btn btn-danger" href="assignment.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>&id=<?php echo $assignment['assignment_id'] ?>"> START</a></td>
							</tr>
		
	   <?php } ?></tbody>
			</table>
                    <?php
     }

            ?>
        </div>
         <div id="Quizzes" class="tab-pane fade <?php if(isset($quiz)){ echo "in active"; } ?>">
         <?php 
        global $connection;
        $query = "SELECT DISTINCT(quiz_id),due_date, published FROM quiz_questions WHERE course_code = '{$_GET['course_code']}' ORDER BY quiz_id ASC";
        $quizzes = mysqli_query($connection, $query);
        $quiz_number = 0;
        if($_SESSION['access_level']==2){ ?>
                     <table class = "table table-striped">
				<thead>
					<tr>
						<th>TITLE  </th>
						<th>DUE DATE  </th>
                        <th>SEE QUIZ</th>
						<th>GRADES </th>
						<th>PUBLISH/HIDE</th>
					</tr>
				
				</thead>
				<tbody>
                    <?php
             while($quiz = mysqli_fetch_assoc($quizzes)){
            $quiz_number +=1; ?>
                    <tr>
				        <td>Quiz <?php echo $quiz_number ?></td>
				        <td><?php echo $quiz['due_date'];?></td>
                        <td><a class="btn btn-primary" href="view_quiz.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>&id=<?php echo $quiz_number ?>"> VIEW </a></td>
				        <td><a class="btn btn-success" href="qgrades.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>&id=<?php echo $quiz_number?>">SEE GRADES</a></td>
				        <td><a class="btn btn-danger" href="#"><?php if($quiz['published']=='0'){echo "PUBLISH";}else{echo "HIDE";} ?></a></td>
				    </tr> 
             <?php
        } ?>
    </tbody>
             </table>
             <a class="btn btn-default" href="quiz.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>">Add A Quiz</a>  
            <?php
        }elseif($_SESSION['access_level']==1){
            ?>
               <table class = "table table-striped">
				<thead>
					<tr>
						<th>TITLE  </th>
						<th>DUE DATE  </th>
						<th>GRADE </th>
						<th>START</th>
					</tr>
				
				</thead>
				<tbody>
             <?php
        while($quiz = mysqli_fetch_assoc($quizzes)){
            $quiz_number +=1; 
             $query = "SELECT score FROM quiz_scores WHERE quiz_id = {$quiz_number} AND user_id ={$_SESSION['user_id']} AND course_code = '{$_GET['course_code']}' ";
            $scores=mysqli_query($connection, $query);
            confirm_query($scores);
             if($score = mysqli_fetch_assoc($scores)){
                 ?>
                    <tr>
				            <td>Quiz <?php echo $quiz_number ?></td>
							<td><?php echo $quiz['due_date'] ?></td>
							<td> <?php echo $score['score']; ?></td>
							<td><a class="btn btn-danger" href=""> COMPLETED</a></td>
				</tr>
             <?php
             }else{ ?>
             <tr>
				            <td>Quiz <?php echo $quiz_number ?></td>
							<td><?php echo $quiz['due_date'] ?></td>
							<td> NOT STARTED</td>
							<td><a class="btn btn-danger" href="quizzes.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>&id=<?php echo $quiz_number?>"> START</a></td>
				</tr>
           <?php  }
        }
            ?>
                   </tbody></table>
             <?php
    }
             ?>
        </div>
        <div id="Tests" class="tab-pane fade">
        <?php 
        global $connection;
        $query = "SELECT DISTINCT(test_id), due_date, published FROM test_questions WHERE course_code = '{$_GET['course_code']}' ORDER BY test_id ASC";
        $tests = mysqli_query($connection, $query);
        $test_number = 0;
        if($_SESSION['access_level']==2){ ?>
            <table class = "table table-striped">
				<thead>
					<tr>
						<th>TITLE  </th>
						<th>DUE DATE  </th>
                        <th>SEE TEST</th>
						<th>GRADES </th>
						<th>PUBLISH/HIDE</th>
					</tr>
				
				</thead>
				<tbody>
                    <?php
             while($test = mysqli_fetch_assoc($tests)){
            $test_number +=1; ?>
                    <tr>
                        <td>Test <?php echo $test_number ?></td>
                        <td><?php echo $test['due_date'] ?></td>
                        <td><a class="btn btn-primary" href="view_test.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>&id=<?php echo $test_number ?>">VIEW</a></td>
                        <td><a class="btn btn-success" href="tgrades.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>&id=<?php echo $test_number?>">SEE GRADES</a></td>
                        <td><a class="btn btn-danger" href="#"><?php if($test['published']=='0'){echo "PUBLISH";}else{echo "HIDE";} ?></a></td>
                    </tr>
             <br/> 
             <?php
        } ?>
            </tbody>
            </table>
            <a class="btn btn-default" href="test.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>">Add A Test</a>
            <?php
        }elseif($_SESSION['access_level']==1){ ?>
            <table class = "table table-striped">
				<thead>
					<tr>
						<th>TITLE  </th>
						<th>DUE DATE  </th>
						<th>GRADE </th>
						<th>START</th>
					</tr>
				
				</thead>
				<tbody>
            <?php
        while($test = mysqli_fetch_assoc($tests)){
            $test_number +=1; 
             $query = "SELECT score FROM test_scores WHERE test_id = {$test_number} AND user_id ={$_SESSION['user_id']} AND course_code = '{$_GET['course_code']}' ";
            $scores=mysqli_query($connection, $query);
            confirm_query($scores);
             if($score = mysqli_fetch_assoc($scores)){
                 ?>
                    <tr>
                    <td>Test <?php echo $test_number ?></td>
                    <td><?php echo $test['due_date'] ?></td>
                    <td><?php echo $score['score']; ?></td>
                    <td><a class="btn btn-danger" href="">COMPLETED</a></td>
                    </tr>
             <?php
             }else{ ?>
                    <tr>
                    <td>Test <?php echo $test_number ?></td>
                    <td><?php echo $test['due_date'] ?></td>
                    <td>NOT STARTED</td>
                    <td><a class="btn btn-danger" href="tests.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>&id=<?php echo $test_number?>">START</a></td>
                    </tr>     
           <?php  }
        } ?>
                    </tbody>
            </table>
            <?php
    }
             ?>
           
        </div>
        <div id="Midterm" class="tab-pane fade" >
           <!-- <p> This is a test Richard incase you see it!</p> -->
        <?php 
        global $connection;
        $query = "SELECT * FROM midterm_questions WHERE course_code = '{$_GET['course_code']}' ";
        $midterm = mysqli_query($connection, $query);
        confirm_query($midterm);
        if($_SESSION['access_level']==2){ ?>
            <table class = "table table-striped">
				<thead>
					<tr>
						<th>TITLE  </th>
						<th>DUE DATE  </th>
                        <th>SEE MIDTERM</th>
						<th>GRADES </th>
						<th>PUBLISH/HIDE</th>
					</tr>
				
				</thead>
				<tbody>
                    <?php
             while($mid = mysqli_fetch_assoc($midterm)){
            ?>
                    <tr>
                        <td>MIDTERM </td>
                        <td><?php echo $mid['due_date'] ?></td>
                        <td><a class="btn btn-primary" href="view_mid.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>">VIEW</a></td>
                        <td><a class="btn btn-success" href="midgrades.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>">SEE GRADES</a></td>
                        <td><a class="btn btn-danger" href="#"><?php if($mid['published']=='0'){echo "PUBLISH";}else{echo "HIDE";} ?></a></td>
                    </tr>
             <br/> 
             <?php
        } ?>
            </tbody>
            </table>
            <?php 
                if(mysqli_num_rows($midterm) == 0){
                    ?>
             <a class="btn btn-default" href="add_midterm.php?course_code=<?php echo $_GET['course_code']?>&course=<?php echo $_GET['course']?>">ADD MIDTERM</a>
            <?php
                }
            ?>
           
            <?php
        }elseif($_SESSION['access_level']==1){ ?>
            <table class = "table table-striped">
				<thead>
					<tr>
						<th>TITLE  </th>
						<th>DUE DATE  </th>
						<th>GRADE </th>
						<th>START</th>
					</tr>
				
				</thead>
				<tbody>
            <?php
        while($mid = mysqli_fetch_assoc($midterm)){
            $query = "SELECT grade FROM mid_term WHERE user_id ={$_SESSION['user_id']} AND course_code = '{$_GET['course_code']}' ";
            $scores=mysqli_query($connection, $query);
            confirm_query($scores);
             if($score = mysqli_fetch_assoc($scores)){
                 ?>
                    <tr>
                    <td>MIDTERM</td>
                    <td><?php echo $mid['due_date'] ?></td>
                    <td><?php echo $score['grade']; ?></td>
                    <td><a class="btn btn-danger" href="">COMPLETED</a></td>
                    </tr>
             <?php
             }else{ ?>
                    <tr>
                    <td>MIDTERM</td>
                    <td><?php echo $mid['due_date'] ?></td>
                    <td>NOT STARTED</td>
                    <td><a class="btn btn-danger" href="#">START</a></td>
                    </tr>     
           <?php  }
        } ?>
                    </tbody>
            </table>
            <?php
    }
             ?>
        </div>
        <div id="Final" class="tab-pane fade" >
      <?php 
        global $connection;
        $query = "SELECT * FROM final_questions WHERE course_code = '{$_GET['course_code']}' ";
        $finals = mysqli_query($connection, $query);
        confirm_query($finals);
        if($_SESSION['access_level']==2){ ?>
            <table class = "table table-striped">
				<thead>
					<tr>
						<th>TITLE  </th>
						<th>DUE DATE  </th>
                        <th>SEE FINAL</th>
						<th>GRADES </th>
						<th>PUBLISH/HIDE</th>
					</tr>
				
				</thead>
				<tbody>
                    <?php
             while($final = mysqli_fetch_assoc($finals)){
            ?>
                    <tr>
                        <td>FINAL</td>
                        <td><?php echo $final['due_date'] ?></td>
                        <td><a class="btn btn-primary" href="view_final.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>">VIEW</a></td>
                        <td><a class="btn btn-success" href="finalgrades.php?course=<?php echo $_GET['course']?>&course_code=<?php echo $_GET['course_code']?>">SEE GRADES</a></td>
                        <td><a class="btn btn-danger" href="#"><?php if($final['published']=='0'){echo "PUBLISH";}else{echo "HIDE";} ?></a></td>
                    </tr>
             <br/> 
             <?php
        } ?>
            </tbody>
            </table>
            <?php 
                if(mysqli_num_rows($finals) == 0){
                    ?>
             <a class="btn btn-default" href="add_final.php?course_code=<?php echo $_GET['course_code']?>&course=<?php echo $_GET['course']?>">ADD FINAL</a>
            <?php
                }
            ?>
           
            <?php
        }elseif($_SESSION['access_level']==1){ ?>
            <table class = "table table-striped">
				<thead>
					<tr>
						<th>TITLE  </th>
						<th>DUE DATE  </th>
						<th>GRADE </th>
						<th>START</th>
					</tr>
				
				</thead>
				<tbody>
            <?php
        while($final = mysqli_fetch_assoc($finals)){
            $query = "SELECT grade FROM exam_score WHERE user_id ={$_SESSION['user_id']} AND course_code = '{$_GET['course_code']}' ";
            $scores=mysqli_query($connection, $query);
            confirm_query($scores);
             if($score = mysqli_fetch_assoc($scores)){
                 ?>
                    <tr>
                    <td>MIDTERM</td>
                    <td><?php echo $final['due_date'] ?></td>
                    <td><?php echo $score['grade']; ?></td>
                    <td><a class="btn btn-danger" href="">COMPLETED</a></td>
                    </tr>
             <?php
             }else{ ?>
                    <tr>
                    <td>FINAL</td>
                    <td><?php echo $final['due_date'] ?></td>
                    <td>NOT STARTED</td>
                    <td><a class="btn btn-danger" href="#">START</a></td>
                    </tr>     
           <?php  }
        } ?>
                    </tbody>
            </table>
            <?php
    }
             ?>
		   
    </div>
    <div id="List" class="tab-pane fade">
                 <table class = "table table-striped">
				<thead>
					<tr>
						<th>NAME</th>
						<th>DEPARTMENT</th>
						<th>EMAIL</th>
						<th>CLASS</th>
					</tr>
				
				</thead>
				<tbody>
                                    <?php
                        global $connection;
                        $query = "SELECT course_id FROM courses WHERE course_code = '{$_GET['course_code']}' ";
                        $get_student_class = mysqli_query($connection, $query);
                        confirm_query($get_student_class);
                        $student_class = mysqli_fetch_assoc($get_student_class);
                        $query = "SELECT student_email FROM course_reg WHERE course_id = {$student_class['course_id']} AND faculty= 'No' ";
                        $get_forum_students = mysqli_query($connection, $query);
                        confirm_query($get_forum_students);
                        while($forum_students = mysqli_fetch_assoc($get_forum_students)){
                            $query = "SELECT first_name, last_name,student_department,graduation_year, email FROM students WHERE email = '{$forum_students['student_email']}' ";
                            $get_member = mysqli_query($connection, $query);
                            confirm_query($get_member);
                            while($member = mysqli_fetch_assoc($get_member)){
                            ?>
                            <tr>
                            <td><?php set_profile_picture(40,40,$forum_students['student_email']); ?>&nbsp;&nbsp;<a style="text-decoration:none; " href="profile.php?f_name=<?php echo $member['first_name'] ?>&l_name=<?php echo $member['last_name'] ?>"><?php echo "{$member['first_name']} {$member['last_name']}"; ?></a>
                            </td>
                            <td><?php echo $member['student_department']?></td>
                            <td><?php echo $member['email'] ?></td>
                            <td><?php echo $member['graduation_year'] ?></td>
                            </tr>
                        <?php 
                            }
                        }
                    ?>
                </tbody>
            </table>
            </div>
</div>                       
 <div id="area-chart-spline" style="width: 100%; height: 300px; display:none;"></div>
											  
											  
                <!--END CONTENT-->
 <?php require_once('../../includes/footer.php')?>
