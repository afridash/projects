<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); ?>
<?php 
                        global $connection; 
                        if(isset($_POST['submit'])){
                        $course= isset($_POST["course"]) ? trim($_POST["course"]): "";
                        $course_code= isset($_POST["course_code"]) ? trim($_POST["course_code"]): "";
                        $query = "SELECT course_id FROM courses WHERE course_code = '{$course_code}' ";
                        $get_new_student_class = mysqli_query($connection, $query);
                        confirm_query($get_new_student_class);
                        $new_student_class = mysqli_fetch_assoc($get_new_student_class);
                        $query = "SELECT student_email FROM course_reg WHERE course_id = {$new_student_class['course_id']} AND faculty = 'No' ";
                        $get_forum_students = mysqli_query($connection, $query);
                        confirm_query($get_forum_students);
                        while($new_forum_students = mysqli_fetch_assoc($get_forum_students)){
                            $query = "SELECT user_id, first_name, last_name FROM users WHERE email = '{$new_forum_students['student_email']}' ";
                            $get_new_member = mysqli_query($connection, $query);
                            confirm_query($get_new_member);
                            while($new_member = mysqli_fetch_assoc($get_new_member)){
                                    $string = "{$new_member['first_name']}";
                                    if(isset($_POST[$string]) && !empty($_POST[$string])){
                                        $assign_score = $_POST[$string];
                                        $query = "SELECT grade FROM exam_score WHERE user_id = {$new_member['user_id']} AND course_code = '{$course_code}' LIMIT 1";
                                        $find_score = mysqli_query($connection, $query);
                                        confirm_query($find_score);
                                        $returned_score = mysqli_fetch_assoc($find_score);
                                        if(empty($returned_score['grade'])){
                                        $query = "INSERT INTO exam_score(user_id, course_code, grade) VALUES({$new_member['user_id']}, '{$course_code}', {$assign_score})";
                                        $store_assignment=mysqli_query($connection, $query);
                                        confirm_query($store_assignment);
                                    }else{
                                           $query = "UPDATE exam_score SET grade = {$assign_score} WHERE user_id = {$new_member['user_id']} AND course_code = '{$course_code}' "; 
                                            $update_score = mysqli_query($connection, $query);
                                            confirm_query($update_score);
                                        }
                            }
             }
                
        }
 redirect_to("grading.php?course={$course}&course_code={$course_code}");                           
}
?>
<?php ob_end_flush()?>