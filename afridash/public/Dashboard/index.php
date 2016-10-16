<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in();
check_mobile();
?>
<?php
	if(isset($_POST['submit'])){
		$status = htmlentities(isset($_POST['status'])? $_POST['status']:"");
		global $connection;
		$status = mysqli_real_escape_string($connection, $status);
        if(!empty($status)){
        $query = "INSERT INTO updates(user_update,user_id, type) VALUES('{$status}',{$_SESSION['user_id']},'status')";
        $update = mysqli_query($connection, $query);
        confirm_query($update);
        $query = "SELECT update_id FROM updates WHERE user_id = {$_SESSION['user_id']} ORDER BY update_id DESC LIMIT 1";
        $get_id = mysqli_query($connection, $query);
        confirm_query($get_id);
        $ret_id = mysqli_fetch_assoc($get_id);
        $query = "INSERT INTO notifications(user_id, notif_type, post_id) VALUES({$_SESSION['user_id']},'status', {$ret_id['update_id']})";
        $insert_notif = mysqli_query($connection, $query);
        confirm_query($insert_notif);
        personal_notification($_SESSION['user_id'],$ret_id['update_id']);
        }  
	}
?>

<?php 
global $connection;
if(isset($_POST['submit_comment'])){
   $comment= htmlentities(isset($_POST["comment_content"]) ? trim($_POST["comment_content"]): "");
   $safe_comment = mysqli_real_escape_string($connection, $comment);
    $post_id = isset($_POST["post_id"]) ? trim($_POST["post_id"]): "";
   $query = "INSERT INTO friend_comments(user_id,post_id,comment) VALUES({$_SESSION[user_id]}, {$post_id}, '{$safe_comment}')";
   $insert_comment = mysqli_query($connection, $query);
   confirm_query($insert_comment);
}
?>

<?php 
global $connection;
$query = "SELECT * FROM course_reg WHERE student_email = '{$_SESSION['email']}' ";
$student_new = mysqli_query($connection, $query);
confirm_query($student_new);
?>
<?php require_once("../../includes/header.php");?>

<script type="text/javascript">
$(document).ready(function(){  

$(".comment_like").click(function()
{
var ID = $(this).attr("id");
var sid=ID.split("like"); 
var New_ID=sid[1];
var REL = $(this).attr("rel");
//var URL=$.base_url+'message_like_ajax.php';
var dataString = 'msg_id=' + New_ID;
if(REL=='Like')
{
$.ajax({
type: "POST",
url: "likes.php",
data: dataString,
cache: false,
success: function(html)
{
$("#youlike"+New_ID).slideDown('slow').prepend("<span id='you"+New_ID+"'><a href='#'>You</a> like this.</span>");
$("#likes"+New_ID).prepend("<span id='you"+New_ID+"'><a href='#'>You</a>, </span>");
$('#'+ID).html('Unlike').attr('rel', 'Unlike').attr('title', 'Unlike');
}

});
}
else
{
$.ajax({
type: "POST",
url: "unlike.php",
data: dataString,
cache: false,
success: function(html)
{
$("#youlike"+New_ID).slideUp('slow');
$("#you"+New_ID).remove();
$('#'+ID).attr('rel', 'Like').attr('title', 'Like').html('Like');
}
});

}

});

});
</script> 
<script type="text/javascript">
 function getPosts(post){
 var auto_refresh = setInterval(
function ()
{
$('#load_posts').load('load_posts.php').fadeIn("slow");
}, 300000); // refresh every 10000 milliseconds  
        
    }
</script>
<style>
.likeUsers
{
margin:10px 0px 10px 0px;
}
.comment_box
{
background-color:#D3E7F5; border-bottom:#ffffff solid 1px; padding-top:3px
}
    .comment_panel{
        display: none;
    }
    ol#load_comments{
        list-style: none;
        text-align: justify;
        font-size: 12px;
        font-family: sans-serif;
    }
    .comment_like{
        cursor: pointer;
    }
</style>
<div id="contentOneTwo"></div>
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Dashboard</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li id="StartTour" onclick="init()"><a href="#"><i class="fa fa-cog"></i>&nbsp;Start Tour<i class="fa fa-angle-right"></i></a>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
                        <div id="sum_box">
                            <?php   
            while($students = mysqli_fetch_assoc($student_new)){
            $query = "SELECT * FROM courses WHERE course_id = {$students['course_id']} ORDER BY course_id ASC ";
            $course = mysqli_query($connection, $query);
            confirm_query($course);
            while($courses = mysqli_fetch_assoc($course)){
            ?>
              <a href="courses.php?course=<?php echo $courses['course_title']?>&course_code=<?php echo $courses['course_code']?>">
                <div class="col-sm-6 col-md-2">
                    <div class="panel panel-blue db mbm">
                        <div class="panel-body">
                                        <h4><p class="description">
                                            <?php echo $courses['course_code']; ?></p></h4>
                                    </div>
                                </div>
                            </div></a>
            <?php   
            }?>
             <?php }?>
              </div>   </div>
                        </div>
                        <div class="row mbl">
                                   <div class="col-lg-8" id="wrap">
                                <div class="panel">
                                        <div class="panel-heading">
                                            <div class="caption">Timeline</div>
                                    </div>
                                    <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#UpdateStatus" data-toggle="tab" class="btn btn-sm">Update Status</a></li>
                <li><a data-toggle="tab" href="#AddPhoto" class="btn btn-sm">Add  Photo</a></li>
                                                </ul>
            <div class="tab-content">
                <div id="UpdateStatus" class="tab-pane fade in active">
                    <form action="" method="POST">
                <div class="form-group">
		          <textarea class="form-control" rows="1" id="comment"  placeholder="What's on your mind" name="status"></textarea>
		          </div>
		          <input type="submit" class="btn btn-primary btn-sm" name="submit" value="Share">
		          </form>
                </div>
                   <div id="AddPhoto" class="tab-pane fade" >
            <form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
			<div id="drop">
				Drop Here

				<a><i class="fa fa-upload fa-2x"></i> Choose a file</a>
				<input type="file" name="upl" multiple />
			</div>

			<ul style="width:20px;">
				<!-- The file uploads will be shown here -->
			</ul>

		</form>
                </div>
             </div>
                 </div>
                </div><div id="load_posts">
 <?php //Right now I am  just redisplaying the current status,later the recent activities will show  up here
		global $connection;
        $query = "SELECT U.user_id, U.email, U.first_name, U.last_name, D.user_update, D.picture, D.type,D.created, D.update_id FROM users U, updates D, padi F WHERE D.user_id = U.user_id AND CASE WHEN F.padi_1 = {$_SESSION['user_id']} THEN F.padi_2 = D.user_id WHEN F.padi_2 = {$_SESSION['user_id']} THEN F.padi_1 = D.user_id END AND F.status > '0' ORDER BY D.update_id DESC LIMIT 30";
        $get_updates = mysqli_query($connection, $query);
        confirm_query($get_updates);
        while($updates = mysqli_fetch_assoc($get_updates)){ 
                            $my_name = "{$updates['first_name']}{$updates['last_name']}";
                            $msgID = $updates['update_id'];  
                            if($updates['type']=="profile_picture"){
                                $update_type = str_replace("_"," ", $updates['type']);
                                $updates['type'] = $update_type;
                               }elseif($updates['type']=="cover_photo"){
                                $update_type = str_replace("_"," ", $updates['type']);
                                   $updates['type'] = $update_type;   
                               }
                               ?>
                    <div class="panel" id="update_panelBox<?php echo $msgID ?>">
                    <div class="panel-heading">
                        <input type="hidden" name="id" id="id" value="<?php echo $msgID ?>">
                        <div class="caption"><?php set_profile_picture(35,35, $updates['email']); echo "&nbsp&nbsp";
                            echo "<a href='profile.php?f_name={$updates['first_name']}&l_name={$updates['last_name']}'>{$updates['first_name']} {$updates['last_name']}</a> made a {$updates['type']} update ";  
                ?><?php if(($_SESSION['user_id'] == $updates['user_id']) && !empty($updates['user_update'])){
                    ?>
                <a style="float:right" href="#" id="delete_post" data-id="<?php echo $msgID ?>">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a><a style="float:right" href="#" class="edit_my_post"><i class="fa fa-pencil"></i></a>
                <?php
                }elseif(($_SESSION['user_id'] == $updates['user_id']) && $updates['type']=="picture"){ ?>
                     <a style="float:right" href="#" id="delete_picture" data-id="<?php echo $msgID ?>">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a>
            <?php
                }elseif(($_SESSION['user_id'] == $updates['user_id']) && $updates['type']=="profile picture"){ ?>
                    <a style="float:right" href="#" data-id="<?php echo $msgID ?>" id="delete_profile_picture" >&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a>        
            <?php
                }elseif(($_SESSION['user_id'] == $updates['user_id']) && $updates['type']=="cover photo"){ ?>
                    <a style="float:right" href="#" data-id="<?php echo $msgID ?>" id="delete_cover_photo">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a>        
            <?php
                }
                ?>
                </div></div>
                  
                    <div id="<?php echo $msgID; ?>" class="panel-body post_box">
                        <?php 
            if(!empty($updates['user_update'])){ 
                $stat = html_entity_decode(stripslashes($updates['user_update'])); 
                echo "<p>{$stat}</p><br/><br/>";
                }elseif($updates['type']=="profile picture"){
                ?>
                        <div id="timelineProfile" class="open-mikes-modal"><?php set_profile_picture_one($updates['email'], $my_name);?></div>
                <?php
            }elseif($updates['type']=="picture"){ ?>
                        <div id="timelineProfile"><img height="100%" width="100%" src="<?php echo "../../Users/{$my_name}/pictures/{$updates['picture']}"?>"></div>
           <?php
                 }elseif($updates['type']=="cover photo"){ ?>
                        <div id="timelineProfile"><img height="100%" width="100%" src="<?php set_profile($updates['email']); ?>"></div>
           <?php
                 }
                        ?>
                        <?php $date = new MyDateTime($updates['created'], new DateTimeZone('PST'));
                            echo time_stamp($date->getTimestamp()); ?>
                    </div>
                    <div class="panel-footer">
                         <?php 
    $get_like_query = "SELECT * FROM friend_likes WHERE user_id = {$_SESSION['user_id']} AND post_id = {$msgID} AND likes = '1'";
    $get_like = mysqli_query($connection, $get_like_query);
    confirm_query($get_like);
    $confirm_like = mysqli_fetch_assoc($get_like);
    $get_all = "SELECT * FROM friend_likes WHERE post_id = {$msgID} AND user_id <> {$_SESSION['user_id']}";
    $get_all_likes = mysqli_query($connection, $get_all);
    confirm_query($get_all_likes);
    $num_likes = mysqli_num_rows($get_all_likes);
    if(!empty($confirm_like) && $num_likes > 0 ){
        ?>
        <div>
            <a class="comment_like" id="like<?php echo $msgID; ?>" title="Unlike" rel="Unlike">Unlike</a>
        </div>
        <div class='likeUsers' id="likes<?php echo $msgID; ?>" >
            <span id="you<?php echo $msgID; ?>"><a href="#">You, </a>and <?php echo $num_likes ?> others like this.</span>
        </div>
<?php
    }elseif(!empty($confirm_like) && $num_likes == 0 ){
        ?>
            <div>
            <a class="comment_like" id="like<?php echo $msgID; ?>" title="Unlike" rel="Unlike">Unlike</a>
        </div>
        <div class='likeUsers' id="youlike<?php echo $msgID; ?>" >
            <span id="you<?php echo $msgID; ?>"><a href="#">You</a> like this.</span>
        </div>            
<?php
    }elseif(empty($confirm_like) && $num_likes > 0){
        ?>
        <div>
            <a class="comment_like" id="like<?php echo $msgID; ?>" title="like" rel="like">Like</a>
        </div>
        <div class='likeUsers' id="likes<?php echo $msgID; ?>" >
            <span id="you<?php echo $msgID; ?>"><a href="#"><?php echo $num_likes ?></a> likes.</span>
        </div>                    
<?php
    }elseif(empty($confirm_like) && $num_likes == 0){
        ?>
        <div>
            <a class="comment_like" id="like<?php echo $msgID; ?>" title="like" rel="like">Like</a>
        </div>
        <div class='likeUsers' id="youlike<?php echo $msgID; ?>" >
            
        </div>  
<?php
    }
?>
     <ol id="load_comments"><?php get_comments($updates['update_id']); ?> </ol><div id="flash"></div>
<div class='likeUsers' id="youlike<?php echo $msgID; ?>" >
	</div>
<script>getPosts(<?php echo $msgID; ?>)</script>
</div>
</div>
       <?php }
		
?></div>
                </div>

    <div class="col-lg-4">
        <?php
            require("todo.php");
        ?>
    </div>
<div id="area-chart-spline" style="width: 100%; height: 300px; display:none;"></div>
                <!--END CONTENT-->
<script type="text/javascript" src="script/todo.js"></script>
<script src="script/demo.js"></script>
<script src="script/hopscotch.js"></script>
<script src="script/demo.js"></script>
<script src="script/hopscotch.js"></script>
<script src="js/jquery.knob.js"></script>
<!-- jQuery File Upload Dependencies -->
<script src="js/jquery.ui.widget.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<script src="js/script.js"></script>
 <?php require_once('../../includes/footer.php')?>