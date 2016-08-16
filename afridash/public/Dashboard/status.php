<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); ?>
<?php
if(isset($_GET['delete_post']) & isset($_GET['post_id'])){
    delete_post($_GET['post_id'], "index.php");
}
if(isset($_GET['delete_picture']) && isset($_GET['post_id'])){
    delete_picture($_GET['post_id'], "index.php");
}
if(isset($_GET['delete_profile_picture']) && isset($_GET['post_id'])){
    delete_profile_picture($_GET['post_id'], "index.php");
}
if(isset($_GET['delete_cover_photo']) && isset($_GET['post_id'])){
    delete_cover_photo($_GET['post_id'], "index.php");
}
?>
<?php 
global $connection;
if(isset($_GET['post_id'])){
    $query = "SELECT * FROM updates WHERE update_id = {$_GET['post_id']} LIMIT 1";
    $get_post = mysqli_query($connection, $query);
    confirm_query($get_post);
    $query = "UPDATE personal_notifications SET seen = '1' WHERE padi_2 = {$_SESSION['user_id']} AND post_id={$_GET['post_id']}";
    $set_seen = mysqli_query($connection, $query);
    confirm_query($set_seen);
}
?>
<?php require_once("../../includes/header.php");?>
<script type="text/javascript">
$(document).ready(function(){  

$(".like").click(function()
{
var ID = $(this).attr("id");
var sid=ID.split("like"); 
var New_ID=sid[1];
var REL = $(this).attr("rel");
//var URL=$.base_url+'message_like_ajax.php';
var dataString = 'msg_id=<?php echo $_GET['post_id']; ?>';
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
$(document).ready(function()
{
$(".comment_button").click(function(){

var element = $(this);
var I = element.attr("id");

$("#slidepanel"+I).slideToggle(300);
$(this).toggleClass("active"); 
$("#comment_content").focus();
return false;});

});
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#load_comments').load('recorded_comments.php?q=<?php echo $_GET['post_id']; ?>').fadeIn("slow");
}, 30000); // refresh every 10000 milliseconds

$(document).ready(function()
  {
   
  $('#submit_comment').click(function()
  {
  var boxval = $("#comment_content").val();
	var post_id = '<?php echo $_GET['post_id'];?>';
	var dataString = 'comment=' + boxval + '&post_id='+post_id;
  	if(boxval.length > 0)
	{
	if(boxval.length<200)
	{
$.ajax({
		type: "POST",
  url: "insert_comment.php",
   data: dataString,
  cache: false,
  success: function(html){
  $("ol#load_comments").append(html);
   $('#comment_content').val('');
   $('#comment_content').focus();
  }
  
 });
}
else
	{
	alert("Please delete some Text max 200 charts");
	
	}
	}
  return false;
  });
  
  });
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
	
	.comment_panel
	{
	display:none;
	}
    ol#load_comments{
        list-style: none;
        text-align: justify;
        font-size: 12px;
        font-family: sans-serif;
    }
</style>
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                         Updates </div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Status</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="page-content">
                    <div class="row">
                        <?php 
                        global $connection;
                        while($post = mysqli_fetch_assoc($get_post)){
                        $query = "SELECT email FROM users WHERE user_id = {$post['user_id']} LIMIT 1";
                        $get_usr = mysqli_query($connection, $query);
                        confirm_query($get_usr);
                        $usr = mysqli_fetch_assoc($get_usr);
                        ?>
                         <div class="panel">
                        <div class="panel-heading"><div class="caption">
                            <?php $my_name = "{$_GET['f_name']}{$_GET['l_name']}"; ?>
                           <?php set_profile_picture(45,45, $usr['email']); echo "&nbsp&nbsp&nbsp&nbsp<a class='aprofile' href='profile.php?f_name={$_GET['f_name']}&l_name={$_GET['l_name']}'>{$_GET['f_name']} {$_GET['l_name']}</a>";?>
                            <?php if(($_SESSION['user_id'] == $post['user_id']) && !empty($post['user_update'])){
                    ?>
                <a style="float:right" href="?post_id=<?php echo $_GET['post_id'] ?>&delete_post=true" onclick="return confirm('Are you sure?')">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a><a style="float:right" href="?coursecode=<?php echo $_GET['coursecode']?>&course=<?php echo urlencode($_GET['course'])?>&post_id=<?php echo $old_post['post_id']?>&edit_post=true">&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i></a>
                <?php
                }elseif(($_SESSION['user_id'] == $post['user_id']) && $post['type']=="picture"){ ?>
                     <a style="float:right" href="?post_id=<?php echo $_GET['post_id'] ?>&delete_picture=true" onclick="return confirm('Are you sure?')">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a>
            <?php
                }elseif(($_SESSION['user_id'] == $post['user_id']) && $post['type']=="profile picture"){ ?>
                    <a style="float:right" href="?post_id=<?php echo $_GET['post_id'] ?>&delete_profile_picture=true" onclick="return confirm('Are you sure?')">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a>        
            <?php
                }elseif(($_SESSION['user_id'] == $post['user_id']) && $post['type']=="cover photo"){ ?>
                    <a style="float:right" href="?post_id=<?php echo $_GET['post_id'] ?>&delete_cover_photo=true" onclick="return confirm('Are you sure?')">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a>        
            <?php
                }
                ?> 
                        </div></div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
                            if(!empty($post['user_update'])){
                            $stat = html_entity_decode(stripslashes($post['user_update']));
                            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{$stat}"; 
                            echo "<br/>";
                            echo "<br/>";
                            echo "<br/>"; 
                            }else{
                               ?>
                            <div id="ppicture"><?php set_profile_picture_one($usr['email'], $my_name); ?></div>
                            <?php    
                            }
                            $date = new MyDateTime($post['created'], new DateTimeZone('MST'));
                            echo time_stamp($date->getTimestamp());
                            ?>
                        </div>
                    <div class="panel-footer">
                    <?php 
    $get_like_query = "SELECT * FROM friend_likes WHERE user_id = {$_SESSION['user_id']} AND post_id = {$_GET['post_id']} AND likes = '1'";
    $get_like = mysqli_query($connection, $get_like_query);
    confirm_query($get_like);
    $confirm_like = mysqli_fetch_assoc($get_like);
    $get_all = "SELECT * FROM friend_likes WHERE post_id = {$_GET['post_id']} AND user_id <> {$_SESSION['user_id']}";
    $get_all_likes = mysqli_query($connection, $get_all);
    confirm_query($get_all_likes);
    $num_likes = mysqli_num_rows($get_all_likes);
    if(!empty($confirm_like) && $num_likes > 0 ){
        ?>
        <div>
            <a href="#" class="like" id="like103" title="Unlike" rel="Unlike">Unlike</a>
            <a href="#" class="comment_button" id="<?php echo $post['update_id']; ?>">Comment</a>
        </div>
        <div class='likeUsers' id="likes103" >
            <span id="you103"><a href="#">You, </a>and <?php echo $num_likes ?> others like this.</span>
        </div>
<?php
    }elseif(!empty($confirm_like) && $num_likes == 0 ){
        ?>
            <div>
            <a href="#" class="like" id="like103" title="Unlike" rel="Unlike">Unlike</a>
            <a href="#" class="comment_button" id="<?php echo $post['update_id']; ?>">Comment</a>
        </div>
        <div class='likeUsers' id="youlike103" >
            <span id="you103"><a href="#">You</a> like this.</span>
        </div>            
<?php
    }elseif(empty($confirm_like) && $num_likes > 0){
        ?>
        <div>
            <a href="#" class="like" id="like103" title="like" rel="like">Like</a>
            <a href="#" class="comment_button" id="<?php echo $post['update_id']; ?>">Comment</a>
        </div>
        <div class='likeUsers' id="likes103" >
            <span id="you103"><a href="#"><?php echo $num_likes ?></a> likes.</span>
        </div>                    
<?php
    }elseif(empty($confirm_like) && $num_likes == 0){
        ?>
        <div>
            <a href="#" class="like" id="like103" title="like" rel="like">Like</a>
            <a href="#" class="comment_button" id="<?php echo $post['update_id']; ?>">Comment</a>
        </div>
        <div class='likeUsers' id="youlike103" >
            
        </div>  
<?php
    }
?>
    <ol id="load_comments"><?php get_comments($_GET['post_id']); ?> </ol><div id="flash"></div>


<div class='comment_panel' id="slidepanel<?php echo $post['update_id']; ?>">
<form action="" method="post">
<textarea rows="3" placeholder="Write a comment" class="form-control" id="comment_content" name="comment_content"></textarea><br />
<input type="submit" value=" Comment " id="submit_comment"  class="btn btn-default"/>
</form>
</div>
</div>         
                    </div>
            </div>
                        <?php    
                        }
                        ?>
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>


                    </div>

 <?php require_once('../../includes/footer.php')?>