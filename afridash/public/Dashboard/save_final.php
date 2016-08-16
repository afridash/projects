<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
?>
<?php confirm_if_user_logged_in(); ?>
<?php 
                        global $connection; 
                        if(isset($_POST['submit'])){
                        $academic_year =  isset($_POST["academic_year"]) ? trim($_POST["academic_year"]): "";
                        $course= isset($_POST["course"]) ? trim($_POST["course"]): "";
                        $course_code= isset($_POST["course_code"]) ? trim($_POST["course_code"]): "";
                        $query = "SELECT course_id, course_semester, course_credit FROM courses WHERE course_code = '{$course_code}' ";
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
                                    $string_one = "{$new_member['first_name']}lg";
                                    $string_two = "{$new_member['first_name']}grade";
                                    $string_three = "{$new_member['first_name']}mid";
                                    if((isset($_POST[$string_one]) && !empty($_POST[$string_one])) && (isset($_POST[$string_two]) && !empty($_POST[$string_two])) && !empty($academic_year)){
                                        $user_score = $_POST[$string_two];
                                        $user_grade = $_POST[$string_one];
                                        $mid_grade = $_POST[$string_three];
                                        $query = "SELECT grade FROM final_grades WHERE user_id = {$new_member['user_id']} AND course_code = '{$course_code}' LIMIT 1";
                                        $find_score = mysqli_query($connection, $query);
                                        confirm_query($find_score);
                                        $returned_score = mysqli_fetch_assoc($find_score);
                                        if(empty($returned_score['grade'])){
                                        $query = "INSERT INTO final_grades(user_id, course_code, lg, grade, academic_year, credits, semester, mid) VALUES({$new_member['user_id']}, '{$course_code}', '{$user_grade}', {$user_score},'{$academic_year}',{$new_student_class['course_credit']}, '{$new_student_class['course_semester']}', '{$mid_grade}')";
                                        $store_final=mysqli_query($connection, $query);
                                        confirm_query($store_final);
                                    }else{
                                            $query = "UPDATE final_grades SET grade = {$user_score} AND lg = '{$user_grade}' AND mid = '{$mid_grade}'  WHERE user_id = {$new_member['user_id']} AND course_code = '{$course_code}' "; 
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