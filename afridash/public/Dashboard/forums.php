<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); ?>
<?php
if(isset($_GET['coursecode'])){
$class = $_GET['course'];
$class_code = $_GET['coursecode'];
}
?>


<?php
//Insert into the forums table whenever a new thread is started
//Query and confirm if the query was successful
global $connection;
if(isset($_POST['submit'])){
if(!empty($_POST['thread'])){
$thread = htmlentities($_POST['thread']);
$thread = mysqli_real_escape_string($connection, $thread);//Clear the inputed text to prevent any sql injection
$query = "INSERT INTO ";
$query .="forums(student_email, course_code, thread) ";
$query .="VALUES('{$_SESSION['email']}','{$class_code}','{$thread}')";
$post = mysqli_query($connection, $query);
confirm_query($post);
}
}
?>



<?php 
//Find the current user logged in using the email in the session file
global $connection;
$query = "SELECT * FROM students WHERE email = '{$_SESSION['email']}' ";
$user = mysqli_query($connection, $query);
confirm_query($user);
?>

<?php 
//Insert into the comments table any comment submitted by a user
//Store the users details as welll for future reference
global $connection;
if(isset($_POST['comment'])){
    if(!empty($_POST['reply'])){
    $comment = htmlentities($_POST['reply']);
    $comment = mysqli_real_escape_string($connection, $comment);//Clear the inputed text to prevent any sql injection
    $query = "INSERT INTO comments(student_email, post_id, comment, course_code) ";
    $query .= "VALUES('{$_SESSION['email']}', {$_GET['post_id']}, '{$comment}', '{$class_code}') ";
    $submit_comment = mysqli_query($connection, $query);
    confirm_query($submit_comment);
    }
}
?>

<?php 
//Delete any post  that was created by an authorized user
if(isset($_GET['delete_post']) & isset($_GET['post_id'])){
    global $connection;
    $query = "DELETE FROM forums WHERE post_id = {$_GET['post_id']} ";
    $deleted_post = mysqli_query($connection, $query);
    confirm_query($deleted_post);
}
?>
<?php
//Read from the likes table, check if the user has already liked a post.
//If the user has already liked the post, unlike the post, else like the post
if(isset($_GET['like']) & isset($_GET['post_id'])){
    global $connection;
    $update_like_query = "SELECT * FROM forum_likes WHERE student_email = '{$_SESSION['email']}' AND post_id = {$_GET['post_id']}";
    $update_like = mysqli_query($connection, $update_like_query);
    confirm_query($update_like);
    $confirm_like = mysqli_fetch_assoc($update_like);
    if(empty($confirm_like)){
    $query = "INSERT INTO forum_likes(likes, student_email, post_id, course_code) VALUES('1','{$_SESSION['email']}', {$_GET['post_id']}, '{$class_code}')";
    $like = mysqli_query($connection, $query);
    confirm_query($like);   
    }elseif($confirm_like['likes']=='0'){
            $new_query = "UPDATE forum_likes ";
            $new_query .= "SET likes = '1' WHERE student_email = '{$_SESSION['email']}' AND post_id = {$_GET['post_id']}";
            $like_post = mysqli_query($connection, $new_query);
            confirm_query($like_post); 
    }elseif($confirm_like['likes']=='1'){
            $new_query = "UPDATE forum_likes ";
            $new_query .= "SET likes = '0' WHERE student_email = '{$_SESSION['email']}' AND post_id = {$_GET['post_id']}";
            $like_post = mysqli_query($connection, $new_query);
            confirm_query($like_post); 
    }
}
?>

<?php 
//Allow the user to edit their own thread posts
//Update the thread where the post_id was given to in the url
global $connection;
if(isset($_POST['edit'])){
    if(!empty($_POST['edited'])){
        $edited_post = htmlentities($_POST['edited']);
        $safe_post = mysqli_real_escape_string($connection,$edited_post);
        $query = "UPDATE forums ";
        $query .="SET thread = '{$safe_post}' ";
        $query .="WHERE post_id = {$_GET['post_id']}";
        $updated_thread = mysqli_query($connection, $query);
        confirm_query($updated_thread);
        $id =uniqid(mt_rand(),true);
        $link = "forums.php?course={$_GET['course']}&coursecode={$_GET['coursecode']}&id={$id}";
        $_GET['edit_post'] = "false";
        redirect_to("{$link}");
    }
}
?>
<?php require_once("../../includes/header.php");?>
<script>
function change_url(url){
   history.pushState({}, null, url);
}
</script>
<div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            <?php echo $class?></div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Forums</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Forums</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
<div class="col-md-7">
<form method="post" action="">
<div class="form-group">
  <label for="comment" style="color:blue"><h3>Start a Thread</h3></label>
  <textarea class="form-control" rows="2" id="comment" name="thread"></textarea>
</div>
<input type="submit" class="btn btn-success" name="submit" value="Post"/>
</form>
    <?php 
    //Select all the forum posts in a certain class and all the data that was stored along it for future reference
    global $connection;
    $query = "SELECT * FROM forums WHERE course_code = '{$class_code}' ORDER BY post_id DESC";
    $forum_posts = mysqli_query($connection, $query);
    confirm_query($forum_posts);
//While we keep getting more forum posts store the associative array as a variable $old_post
    while($old_post = mysqli_fetch_assoc($forum_posts))
    {?>
    <div class="container">
        <h3>
            <?php 
        //If the user decided to edit the old_post, create a textbox and allow the thread post to be edited
            if(isset($_GET['post_id']) & isset($_GET['edit_post'])){
                if($old_post['post_id']==$_GET['post_id'] & $_GET['edit_post']=="true"){     
            ?>
            <form action="" method="post">
             <div class="styled-input">
			<input type="text"  name="edited" value="<?php echo $old_post['thread']?>" class="styled-input">
            <input type="submit" class="btn btn-primary btn-xs" name="edit" value="Update" />
            </div>
        </form>
            <?php }
                //Set the profile picture of whoever started the thread post
                set_profile_picture(35,35, $old_post['student_email']);
                echo "&nbsp&nbsp";
                echo $old_post['thread'];
            }else{
                set_profile_picture(60,60, $old_post['student_email']);
                echo "&nbsp&nbsp";
                 echo $old_post['thread'];
            }
            ?>
            </h3>
        <p><span style="color:grey; font-style:italic;">&nbsp;&nbsp;&nbsp;<?php
        //Select the student who posted the current thread being processed
            global $connection;
        $query = "SELECT * FROM users WHERE email = '{$old_post['student_email']}' ";
        $user = mysqli_query($connection, $query);
        confirm_query($user);//Only one student can post a thread so store that student as pupil(ran out of variable options)
     while($pupil = mysqli_fetch_assoc($user)){
         echo "{$pupil['first_name']} {$pupil['last_name']}" ;//Print the name of that student
     }
      ?></span> <?php $date = new MyDateTime($old_post['time'], new DateTimeZone('PST'));
                echo time_stamp($date->getTimestamp());//Print the date and time that the post was made;?>
            <?php if($_SESSION['email']==$old_post['student_email']){//Allow the student to delete or update a post that they previously made?>
        <a href="?coursecode=<?php echo $_GET['coursecode']?>&course=<?php echo urlencode($_GET['course'])?>&post_id=<?php echo $old_post['post_id']?>&edit_post=true">&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i></a><a href="?coursecode=<?php echo $_GET['coursecode']?>&course=<?php echo urlencode($_GET['course'])?>&post_id=<?php echo $old_post['post_id']?>&delete_post=true" onclick="return confirm('Are you sure?')">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a>
      <?php }?>
        </p>
        <?php 
        //Select from the comments table any comment related to the current thread
            global $connection;
            $query = "SELECT * FROM comments WHERE post_id = {$old_post['post_id']}";
            $previous_comments = mysqli_query($connection, $query);
            confirm_query($previous_comments);
            while($old_comment = mysqli_fetch_assoc($previous_comments)){//Store all the comments returned as $old_comment ?>
                <p align="justify"><?php set_profile_picture(25,25, $old_comment['student_email']); echo " {$old_comment['comment']}"; ?><span style="color:grey; font-style:italic;">&nbsp;&nbsp;&nbsp; <?php
        global $connection;
        //Select the student who commented on the thread, print his name and the time he made the comment 
        $query = "SELECT * FROM students WHERE email = '{$old_comment['student_email']}' ";
        $user = mysqli_query($connection, $query);
        confirm_query($user);
     while($pupil = mysqli_fetch_assoc($user)){
         echo "{$pupil['first_name']} {$pupil['last_name']}" ;
     }
      ?></span> <?php $date = new MyDateTime($old_comment['time'], new DateTimeZone('PST'));
                echo time_stamp($date->getTimestamp());//Print the date and time that the post was made;?>
            <?php 
            }//Allow students to add comment and like posts below!!!
        ?>
     <p><a href="?coursecode=<?php echo $_GET['coursecode']?>&course=<?php echo urlencode($_GET['course'])?>&post_id=<?php echo $old_post['post_id']?>&comment=true"><i class="fa fa-comments fa-lg"></i></a>&nbsp;&nbsp;&nbsp;<a href="?coursecode=<?php echo $_GET['coursecode']?>&course=<?php echo urlencode($_GET['course'])?>&post_id=<?php echo $old_post['post_id']?>&like=true"><i class="fa fa-thumbs-o-up fa-lg"></i></a>
    <?php 
            //Select all likes on the current thread, then count the number of rows returned
    global $connection;
     $query = "SELECT likes from forum_likes WHERE likes = '1'AND post_id = {$old_post['post_id']} ";
     $total_likes = mysqli_query($connection, $query);
     confirm_query($total_likes);
     $num_likes = mysqli_num_rows($total_likes);
     echo $num_likes;//Print the number of rows returned
?></p>
        <?php 
        //Allow a student to comment to a particular post
        if(isset($_GET['comment']) & isset($_GET['post_id'])){
          if($old_post['post_id']==$_GET['post_id']){ ?>
        <form action="" method="post">
             <div class="styled-input">
			<input type="text" required name="reply" placeholder = "Enter a comment" class="styled-input">
            <input type="submit" class="btn btn-primary btn-xs" name="comment" value="Comment" />
            </div>
        </form>
          <?php     
            }  
      }
        ?>
    </div>
    <?php }
    ?>
</div>
                <div class="col-md-5">
             <ul class="nav nav-tabs">
                <li class="active"><a href="#TopThreads" data-toggle="tab">Top Threads</a></li>
                <li><a data-toggle="tab" href="#Online">Online Members</a></li>
                <li><a data-toggle="tab" href="#AllMembers">All Members</a></li>
            </ul>
         <div class="tab-content">
         <div id="TopThreads" class="tab-pane fade in active">
            <h3>Top Threads</h3>
        </div>
        <div id="Online" class="tab-pane fade ">
                        <?php
                        global $connection;
                        $query = "SELECT course_id FROM courses WHERE course_code = '{$_GET['coursecode']}' ";
                        $get_student_class = mysqli_query($connection, $query);
                        confirm_query($get_student_class);
                        $student_class = mysqli_fetch_assoc($get_student_class);
                        $query = "SELECT student_email FROM course_reg WHERE course_id = {$student_class['course_id']}";
                        $get_forum_students = mysqli_query($connection, $query);
                        confirm_query($get_forum_students);
                        while($forum_students = mysqli_fetch_assoc($get_forum_students)){
                            $query = "SELECT first_name, last_name, user_id FROM users WHERE logged_in = '1' AND email = '{$forum_students['student_email']}' ";
                            $get_member = mysqli_query($connection, $query);
                            confirm_query($get_member);
                            while($member = mysqli_fetch_assoc($get_member)){
                            ?>
                            <ul class="list-group">
                            <li class="list-group-item" ><?php set_profile_picture(40,40,$forum_students['student_email']); ?>&nbsp;&nbsp;<a  style="text-decoration:none; " href="profile.php?f_name=<?php echo $member['first_name'] ?>&l_name=<?php echo $member['last_name'] ?>&id=<?php echo $member['user_id']; ?>"><?php echo "{$member['first_name']} {$member['last_name']}"; ?></a>
                               &nbsp;&nbsp;&nbsp;&nbsp;
                                </li>
                            </ul>
                        <?php 
                            }
                        }
                    ?>
        </div>
        <div id="AllMembers" class="tab-pane fade">
                                <?php
                        global $connection;
                        $query = "SELECT course_id FROM courses WHERE course_code = '{$_GET['coursecode']}' ";
                        $get_student_class = mysqli_query($connection, $query);
                        confirm_query($get_student_class);
                        $student_class = mysqli_fetch_assoc($get_student_class);
                        $query = "SELECT student_email FROM course_reg WHERE course_id = {$student_class['course_id']}";
                        $get_forum_students = mysqli_query($connection, $query);
                        confirm_query($get_forum_students);
                        while($forum_students = mysqli_fetch_assoc($get_forum_students)){
                            $query = "SELECT first_name, last_name FROM users WHERE email = '{$forum_students['student_email']}' ";
                            $get_member = mysqli_query($connection, $query);
                            confirm_query($get_member);
                            while($member = mysqli_fetch_assoc($get_member)){
                            ?>
                            <ul class="list-group">
                            <li class="list-group-item"> <?php set_profile_picture(40,40,$forum_students['student_email']); ?>&nbsp;&nbsp;<a style="text-decoration:none; " href="profile.php?f_name=<?php echo $member['first_name'] ?>&l_name=<?php echo $member['last_name'] ?>"><?php echo "{$member['first_name']} {$member['last_name']}"; ?></a>
                               &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a><i class="fa fa-envelope fa-lg"></i></a>&nbsp;&nbsp;<a><i class="fa fa-plus-circle fa-lg"></i></a>
                                </li>
                            </ul>
                        <?php 
                            }
                        }
                    ?>
        </div>

        </div>
            </div>
</div>
                         <div class="col-md-12">
                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                             </div>
                        </div>
                    </div>
                </div>
                <!--END CONTENT-->
<?php require_once("../../includes/footer.php");?>
