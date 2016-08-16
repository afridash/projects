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
    delete_post($_GET['post_id'], "profile.php?f_name={$_SESSION['first_name']}&l_name={$_SESSION['last_name']}");
}
if(isset($_GET['delete_picture']) && isset($_GET['post_id'])){
    delete_picture($_GET['post_id'], "profile.php?f_name={$_SESSION['first_name']}&l_name={$_SESSION['last_name']}");
}
if(isset($_GET['delete_profile_picture']) && isset($_GET['post_id'])){
    delete_profile_picture($_GET['post_id'], "profile.php?f_name={$_SESSION['first_name']}&l_name={$_SESSION['last_name']}");
}
if(isset($_GET['delete_cover_photo']) && isset($_GET['post_id'])){
    delete_cover_photo($_GET['post_id'], "profile.php?f_name={$_SESSION['first_name']}&l_name={$_SESSION['last_name']}");
}

?>
<?php 
global $connection;
if(isset($_POST['submit'])){
    if(!empty($_POST['msg'])){
        $msg = mysqli_real_escape_string($connection, $_POST['msg']);
        $usr_id = $_POST['userID'];
        $query= "SELECT c.c_id FROM convo c WHERE CASE WHEN c.user1 = {$_SESSION['user_id']} THEN c.user2 = {$usr_id} WHEN c.user2 = {$_SESSION['user_id']} THEN c.user1 = {$usr_id} END 
        AND ( c.user1 = {$_SESSION['user_id']} OR c.user2 = {$_SESSION['user_id']} ) LIMIT 1";
        $get_list1 = mysqli_query($connection, $query);
        confirm_query($get_list1);
        $con_exist = mysqli_fetch_assoc($get_list1);
        $conversation = mysqli_num_rows($get_list1);
        if($conversation == 0 ){
            $query = "INSERT INTO convo(user1,user2,status)VALUES({$_SESSION['user_id']}, {$usr_id}, 1)";
            $start_convo = mysqli_query($connection, $query);
            confirm_query($start_convo);
            
            $query= "SELECT c.c_id FROM convo c WHERE CASE WHEN c.user1 = {$_SESSION['user_id']} THEN c.user2 = {$usr_id} WHEN c.user2 = {$_SESSION['user_id']} THEN c.user1 = {$usr_id} END 
        AND ( c.user1 = {$_SESSION['user_id']} OR c.user2 = {$_SESSION['user_id']} ) LIMIT 1";
        $get_list1 = mysqli_query($connection, $query);
            confirm_query($get_list1);
            $convo_id = mysqli_fetch_assoc($get_list1);
            $query = "INSERT INTO convoReply(reply, userID, convoID, status)VALUES('{$msg}', {$_SESSION['user_id']}, {$convo_id['c_id']}, 0)";
            $store_reply = mysqli_query($connection, $query);
            confirm_query($store_reply);
        }else{
             $query = "INSERT INTO convoReply(reply, userID, convoID, status)VALUES('{$msg}', {$_SESSION['user_id']}, {$con_exist['c_id']}, 0)";
            $store_reply = mysqli_query($connection, $query);
            confirm_query($store_reply);
        }
    }
}

if(isset($_POST['Message'])){
    if(!empty($_POST['msg']) && !empty($_POST['user'])){
        $msg = mysqli_real_escape_string($connection, $_POST['msg']);
        $usr_id = $_POST['user'];
        $query= "SELECT c.c_id FROM convo c WHERE CASE WHEN c.user1 = {$_SESSION['user_id']} THEN c.user2 = {$usr_id} WHEN c.user2 = {$_SESSION['user_id']} THEN c.user1 = {$usr_id} END 
        AND ( c.user1 = {$_SESSION['user_id']} OR c.user2 = {$_SESSION['user_id']} ) LIMIT 1";
        $get_list1 = mysqli_query($connection, $query);
        confirm_query($get_list1);
        $con_exist = mysqli_fetch_assoc($get_list1);
        $conversation = mysqli_num_rows($get_list1);
        if($conversation == 0 ){
            $query = "INSERT INTO convo(user1,user2,status)VALUES({$_SESSION['user_id']}, {$usr_id}, 1)";
            $start_convo = mysqli_query($connection, $query);
            confirm_query($start_convo);
            $query= "SELECT c.c_id FROM convo c WHERE CASE WHEN c.user1 = {$_SESSION['user_id']} THEN c.user2 = {$usr_id} WHEN c.user2 = {$_SESSION['user_id']} THEN c.user1 = {$usr_id} END 
        AND ( c.user1 = {$_SESSION['user_id']} OR c.user2 = {$_SESSION['user_id']} ) LIMIT 1";
        $get_list1 = mysqli_query($connection, $query);
            confirm_query($get_list1);
            $convo_id = mysqli_fetch_assoc($get_list1);
            $query = "INSERT INTO convoReply(reply, userID, convoID, status)VALUES('{$msg}', {$_SESSION['user_id']}, {$convo_id['c_id']}, 0)";
            $store_reply = mysqli_query($connection, $query);
            confirm_query($store_reply);
        }else{
             $query = "INSERT INTO convoReply(reply, userID, convoID, status)VALUES('{$msg}', {$_SESSION['user_id']}, {$con_exist['c_id']}, 0)";
            $store_reply = mysqli_query($connection, $query);
            confirm_query($store_reply);
        }
    }
}
 ?>
<?php
global $connection;
$query = "SELECT * FROM users WHERE first_name ='{$_GET['f_name']}' AND last_name = '{$_GET['l_name']}' LIMIT 1";
$student = mysqli_query($connection, $query);
confirm_query($student);
$student_details = mysqli_fetch_assoc($student);
if(isset($_GET['id'])){
    $request_id = $_GET['id'];
}
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
$(document).ready(function()
{
$(".comment_button").click(function(){

var element = $(this);
var I = element.attr("id");

$("#slidepanel"+I).slideToggle(300);
$(this).toggleClass("active"); 
$("#comment_content"+I).focus();
return false;});

});
</script>
<script type="text/javascript">
 function getPosts(post){
 var auto_refresh = setInterval(
function ()
{
$('#tab2').load('load_profile.php').fadeIn("slow");
}, 300000); // refresh every 10000 milliseconds  
        
    }
</script>
<script type="text/javascript">
$(document).ready(function()
  {
  $('#submit_comment').click(function()
  {
      var post_id = $("#pID").val();
  var boxval = $("#comment_content"+post_id).val();
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
   $('#comment_content'+post_id).val('');
   $('#comment_content'+post_id).focus();
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
    .comment_like{
        cursor: pointer;
    }
</style>
<?php 
global $connection;
if(isset($_GET['add']) AND $_GET['add']=='true'){
    $query = "INSERT INTO padi(padi_1,padi_2) VALUES({$_SESSION['user_id']},{$student_details['user_id']})";
    $add_friend = mysqli_query($connection, $query);
    confirm_query($add_friend);
    $query = "INSERT INTO friend_requests(padi_1,padi_2) VALUES({$_SESSION['user_id']}, {$student_details['user_id']})";
    $add_request=mysqli_query($connection, $query);
    confirm_query($add_request);
}
?>
<?php 
global $connection;
if(isset($_GET['accept_request'])){
 $query = "UPDATE padi ";
$query .="SET status = '1' ";
$query .="WHERE padi_1 = {$student_details['user_id']} AND padi_2 ={$_SESSION['user_id']}";
$confirm_friend=mysqli_query($connection, $query);
confirm_query($confirm_friend);
$query = "INSERT INTO accepted_requests(padi_1,padi_2) VALUES({$student_details['user_id']}, {$_SESSION['user_id']})";
$accept_request = mysqli_query($connection, $query);
confirm_query($accept_request);
}
?>
<?php 
global $connection;
if(isset($_GET['view']) && $_GET['view']=='true'){
    $query = "UPDATE accepted_requests SET seen = '1' WHERE padi_1 = {$_SESSION['user_id']} AND padi_2 = {$student_details['user_id']}";
    $update_acceptance = mysqli_query($connection, $query);
    confirm_query($update_acceptance);
}

if(isset($_GET['req'])){
    $query = "UPDATE friend_requests SET seen = '1' WHERE padi_1 = {$student_details['user_id']} AND padi_2 = {$_SESSION['user_id']}";
    $update_seen = mysqli_query($connection, $query);
    confirm_query($update_seen);
}
?>
<?php require_once("../../includes/header.php");?>



            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Profile</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Profile</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->

<script>
$(document).ready(function(){
    $("[data-toggle=popover]").popover({
    html: true, 
	content: function() {
          return $('#popover-content').html();
        }
});   
});
</script>
                <div class="page-content">
                    <div id="tab-general">
                        <div class="col-lg-12 col-sm-12">

    <div id="timelineContainer">
<!-- timeline background -->
<div id="timelineBackground">
<img src="<?php set_profile($student_details['email'])?>" class="bgImage" style="margin-top: -40px">
</div>
<!-- timeline background -->
        <?php 
            if($student_details['user_id'] === $_SESSION['user_id']){
    ?>
        <div style="background:url(../images/timeline_shade.png);" id="timelineShade">
    <a href="#ChangeCover" data-toggle="modal" class="uploadFile timelineUploadBG"></a>
</div>
        <?php
}
        ?>

<!-- timeline profile picture -->
<a  href="">
 <div id="timelineProfilePic" class="open-mikes-modal">
 <?php
     $my_name = "{$student_details['first_name']}{$student_details['last_name']}";
     set_profile_picture_one($student_details['email'], $my_name); ?>
</div>
    <?php if($student_details['user_id']===$_SESSION['user_id']){ ?>
<a id="popover-link" data-toggle="modal" href="#ChangeProfile"><i class="fa fa-camera fa-2x"></i></a>
    <?php
                                                                }
    ?>
</a>

<!-- timeline title -->
<div id="timelineTitle"><?php echo $_GET['f_name']?> <?php echo $_GET['l_name']; ?></div>

   
        
  
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">

        <div class="btn-group" role="group">
            <button type="button" id="start" class="btn btn-primary "><span class="fa fa-star fa-fw" aria-hidden="true"></span>
               <a data-toggle="modal" href="#SendMessage"> <div class="hidden-xs">Send Message</div></a>
            </button>
        </div>
         
        
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary active" href="#tab2" data-toggle="tab"><span class="fa fa-star fa-fw" aria-hidden="true"></span>
                <div class="hidden-xs">Posts</div>
            </button>
        </div>
        <div class="btn-group" role="group">
                <?php if($_SESSION['email'] == $student_details['email']){ ?>
    <button type="button" id="favorites" class="btn btn-primary" href="#tab3" data-toggle="tab"><span class="fa fa-user fa-fw" aria-hidden="true"></span>
    <div class="hidden-xs">Friends</div>
<?php }else {
        global $connection;
        $query = "SELECT * FROM padi WHERE (padi_1 = {$_SESSION['user_id']} OR padi_2={$_SESSION['user_id']}) AND (padi_1 ={$student_details['user_id']} OR padi_2 = {$student_details['user_id']}) ";
        $find_friend = mysqli_query($connection, $query);
        confirm_query($find_friend);
        $friends = mysqli_fetch_assoc($find_friend);
        if($friends['padi_1'] == $_SESSION['user_id'] & $friends['padi_2']== $student_details['user_id'] & $friends['status'] == '0'){
        ?>
    <button type="button" id="favorites" class="btn btn-primary"><a class = "arequest" href="#"><span class="fa fa-check" aria-hidden="true"></span>
        <div class="hidden-xs">Request Sent</div></a>    </button>     
<?php  }elseif ($friends['padi_1'] == $student_details['user_id'] & $friends['status'] == '0'){ ?>
           <button type="button" id="favorites" class="btn btn-primary"><a class = "arequest" href="profile.php?f_name=<?php echo $_GET['f_name']?>&l_name=<?php echo $_GET['l_name']?>&accept_request=true&id=<?php echo $request_id?>"><span class="fa fa-check" aria-hidden="true"></span>
               <div class="hidden-xs">Confirm Friend</div></a>  </button>
        <?php }elseif(empty($friends)){ ?>
               <button type="button" id="favorites" class="btn btn-primary"><a class = "arequest" href="profile.php?f_name=<?php echo $_GET['f_name']?>&l_name=<?php echo $_GET['l_name']?>&add=true"><span class="fa fa-user-plus" aria-hidden="true"></span>
        <div class="hidden-xs">Request Friend</div></a>      </button>
            
        <?php }else{ ?>
    <button type="button" id="favorites" class="btn btn-primary"  href="#tab3" data-toggle="tab"><a class = "arequest"><span class="fa fa-user fa-fw" aria-hidden="true"></span>
        <div class="hidden-xs">Friends</div></a>   </button>
        </button>
    <?php    }
    }
                   ?>    
           
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-primary" href="#tab4" data-toggle="tab"><span class="fa fa-heart fa-fw" aria-hidden="true"></span>
                <div class="hidden-xs">About</div>
            </button>
        </div>
                <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-primary" href="#tab5" data-toggle="tab"><span class="fa fa-heart fa-fw" aria-hidden="true"></span>
                <div class="hidden-xs">Gallery</div>
                    </button>
        </div>
    </div>
 </div>
        <div class="well">
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab2">
          <?php
        global $connection;
        $query="";
        $user = 0;
        if($_SESSION['email'] === $student_details['email']){
            $user = $_SESSION['user_id'];
            $query = "SELECT U.user_id,U.email, U.first_name, U.last_name, D.type, D.user_update, D.picture, D.created, D.update_id FROM users U, updates D, padi F WHERE D.user_id = U.user_id AND CASE WHEN F.padi_1 = {$_SESSION['user_id']} THEN F.padi_2 = D.user_id WHEN F.padi_2 = {$_SESSION['user_id']} THEN F.padi_1 = D.user_id END AND F.status > '1' ORDER BY D.update_id DESC";    
        }else{
            $user = $student_details['user_id'];
            $query = "SELECT U.user_id, U.email, U.first_name, U.last_name, D.type,D.picture, D.user_update, D.created, D.update_id FROM users U, updates D, padi F WHERE D.user_id = U.user_id AND CASE WHEN F.padi_1 = {$_SESSION['user_id']} THEN F.padi_2 = D.user_id WHEN F.padi_2 = {$_SESSION['user_id']} THEN F.padi_1 = D.user_id END AND F.status > '0' ORDER BY D.update_id DESC";
        }
        $get_updates = mysqli_query($connection, $query);
        confirm_query($get_updates);
        while($updates = mysqli_fetch_assoc($get_updates)){
            $msgID = $updates['update_id']; 
               if($updates['type']=="profile_picture"){
                                   $update_type = str_replace("_"," ", $updates['type']);
                                   $updates['type'] = $update_type;
                               }elseif($updates['type']=="cover_photo"){
                                $update_type = str_replace("_"," ", $updates['type']);
                                   $updates['type'] = $update_type;   
                               }
            ?>
            
                                           <div class="panel">
                    <div class="panel-heading">
                        <input type="hidden" name="id" id="id" value="<?php echo $msgID ?>">
                        <div class="caption"><?php set_profile_picture(35,35, $updates['email']); echo "&nbsp&nbsp";
                            echo "<a href='profile.php?f_name={$updates['first_name']}&l_name={$updates['last_name']}'>{$updates['first_name']} {$updates['last_name']}</a> made a {$updates['type']} update ";  
                ?><?php if(($_SESSION['user_id'] == $updates['user_id']) && !empty($updates['user_update'])){
                    ?>
                <a style="float:right" href="?post_id=<?php echo $msgID ?>&delete_post=true" onclick="return confirm('Are you sure?')">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a><a style="float:right" href="#" class="edit_my_post"><i class="fa fa-pencil"></i></a>
                <?php
                }elseif(($_SESSION['user_id'] == $updates['user_id']) && $updates['type']=="picture"){ ?>
                     <a style="float:right" href="?post_id=<?php echo $msgID ?>&delete_picture=true" onclick="return confirm('Are you sure?')">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a>
            <?php
                }elseif(($_SESSION['user_id'] == $updates['user_id']) && $updates['type']=="profile picture"){ ?>
                    <a style="float:right" href="?post_id=<?php echo $msgID ?>&delete_profile_picture=true" onclick="return confirm('Are you sure?')">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a>        
            <?php
                }elseif(($_SESSION['user_id'] == $updates['user_id']) && $updates['type']=="cover photo"){ ?>
                    <a style="float:right" href="?post_id=<?php echo $msgID ?>&delete_cover_photo=true" onclick="return confirm('Are you sure?')">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></a>        
            <?php
                }
                ?></div>
                         </div>
                    <div id="<?php echo $msgID; ?>" class="panel-body post_box">
                        <?php 
            if(!empty($updates['user_update'])){ 
                $stat = html_entity_decode(stripslashes($updates['user_update'])); 
                echo "<p>{$stat}</p><br/><br/>";
                }elseif($updates['type']=="profile picture"){
                $my_name = "{$updates['first_name']}{$updates['last_name']}";
                ?>
                <div id="timelineProfile" ><?php set_profile_picture_one($updates['email'], $my_name);?></div>
                <?php
            }elseif($updates['type']=="picture"){ ?>
                        <div id="timelineProfile"><img height="100%" width="100%" src="<?php echo "../../Users/{$my_name}/pictures/{$updates['picture']}"?>"></div>
           <?php
                 }else{ ?>
                        <div id="timelineProfile" ><img src="<?php set_profile($updates['email']);?>"></div>
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
            <!--<a href="#" class="comment_button" id="<?php //echo $msgID; ?>">Comment</a>!-->
        </div>
        <div class='likeUsers' id="likes<?php echo $msgID; ?>" >
            <span id="you<?php echo $msgID; ?>"><a href="#">You, </a>and <?php echo $num_likes ?> others like this.</span>
        </div>
<?php
    }elseif(!empty($confirm_like) && $num_likes == 0 ){
        ?>
            <div>
            <a class="comment_like" id="like<?php echo $msgID; ?>" title="Unlike" rel="Unlike">Unlike</a>
           <!--<a href="#" class="comment_button" id="<?php //echo $msgID; ?>">Comment</a>!-->
        </div>
        <div class='likeUsers' id="youlike<?php echo $msgID; ?>" >
            <span id="you<?php echo $msgID; ?>"><a href="#">You</a> like this.</span>
        </div>            
<?php
    }elseif(empty($confirm_like) && $num_likes > 0){
        ?>
        <div>
            <a class="comment_like" id="like<?php echo $msgID; ?>" title="like" rel="like">Like</a>
           <!--<a href="#" class="comment_button" id="<?php //echo $msgID; ?>">Comment</a>!-->
        </div>
        <div class='likeUsers' id="likes<?php echo $msgID; ?>" >
            <span id="you<?php echo $msgID; ?>"><a href="#"><?php echo $num_likes ?></a> likes.</span>
        </div>                    
<?php
    }elseif(empty($confirm_like) && $num_likes == 0){
        ?>
        <div>
            <a class="comment_like" id="like<?php echo $msgID; ?>" title="like" rel="like">Like</a>
            <!--<a href="#" class="comment_button" id="<?php //echo $msgID; ?>">Comment</a>!-->
        </div>
        <div class='likeUsers' id="youlike<?php echo $msgID; ?>" >
            
        </div>  
<?php
    }
?>
<ol id="load_comments"><?php get_comments($updates['update_id']); ?> </ol><div id="flash"></div>
                        <!--
<div class='comment_panel' id="slidepanel<?php //echo $msgID; ?>">
<form action="" method="post">
<textarea rows="3" placeholder="Write a comment" class="form-control" id="comment_content<?php //echo $msgID; ?>" name="comment_content"></textarea><br />
<input type="hidden" id="pID" name="pID" value="<?php //echo $msgID; ?>">
<input type="submit" value=" Comment " id="submit_comment"  class="btn btn-default"/>
</form>
</div>
!-->
<script>getPosts(<?php echo $msgID; ?>)</script>
</div>
 </div>
       <?php }
            ?>
        </div>
          <div class="tab-pane fade" id="tab3">
         <div class="row">
<?php
        global $connection;
        $query = "SELECT U.user_id, U.email, U.first_name, U.last_name, F.status FROM users U, padi F WHERE CASE WHEN F.padi_1 = {$user} THEN F.padi_2 = U.user_id WHEN F.padi_2 = {$user} THEN F.padi_1 = U.user_id END AND F.status = '1' ";
            $get_friends = mysqli_query($connection, $query);
            confirm_query($get_friends);
            while($friends_list = mysqli_fetch_assoc($get_friends)){ ?>
           <a class="aprofile" href="<?php echo "profile.php?f_name={$friends_list['first_name']}&l_name={$friends_list['last_name']}"?>">         
                <div class="col-md-3">
                    <div class="panel panel-blue db mbm">
                        <div class="panel-body">
                            <?php set_profile_picture(30,30, $friends_list['email'])?>
                            <p>
                            <?php echo $friends_list['first_name']; ?>
                            <?php echo $friends_list['last_name']; ?>
                            </p>    
                        </div>
                                </div>

                            </div></a>
                            <?php    }
            ?>
             </div>
          </div>
          <style>
              .acct{
                  font-size: 36px;
                  font-weight: bold;
                  color: cornflowerblue;
              }
              .about{
                  padding-top: 8px;
              }
              
              .formic{
                  font-family: sans-serif;
                  font-size: 14px;
                  padding-top: 20px;
              }
              
              .abs{
                  padding-bottom: 20px;
              }
          </style>
        <div class="tab-pane fade" id="tab4">
            <h1 class="acct">Student Profile</h1>
            <form class="form-horizontal" role="form">
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Name</label>
                <div class="col-md-8">
                    <p class="about"><?php echo $_GET['f_name']?> <?php echo $_GET['l_name']; ?></p>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Email</label>
                <div class="col-md-8">
                    <p class="about">richard.ajala@lincoln.edu</p>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Change Password</label>
                <div class="col-md-8">
                    <p class="about"></p>
                    <a style="float:right" href="#" class="edit_about1" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil abs"></i></a>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Major</label>
                <div class="col-md-8">
                    <p class="about">Computer Science</p>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Courses</label>
                <div class="col-md-8">
                    <p class="about"><?php echo $courses['course_code']; ?></p>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Matric Number</label>
                <div class="col-md-8">
                    <p class="about"><i>023456</i></p>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Student Id</label>
                <div class="col-md-8">
                    <p class="about"><i>000000</i></p>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Gender</label>
                <div class="col-md-8">
                    <p class="about">Not Accounted for</p>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Birthday</label>
                <div class="col-md-8">
                    <p class="about">09/25/1996</p>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Classification</label>
                <div class="col-md-8">
                    <p class="about">Senior</p>
                    <a style="float:right" href="#" class="edit_about3" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil abs"></i></a>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Enrollment Date</label>
                <div class="col-md-8">
                    <p class="about">01/04/2015</p>
                    <a style="float:right" href="#" class="edit_about3" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil abs"></i></a>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Dormitory</label>
                <div class="col-md-8">
                    <p class="about"><i>Apartment Style Living</i></p>
                    <a style="float:right" href="#" class="edit_about3" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil abs"></i></a>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Home Address</label>
                <div class="col-md-8">
                    <p class="about">1570 Baltimore Pike</p>
                    <a style="float:right" href="#" class="edit_about3" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil abs"></i></a>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Phone Number</label>
                <div class="col-md-8">
                    <p class="about"><i>000-000-0000</i></p>
                    <a style="float:right" href="#" class="edit_about3" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil abs"></i></a>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Extracurricular Activities</label>
                <div class="col-md-8">
                    <p class="about"><i>Playing soccer and video games</i></p>
                    <a style="float:right" href="#" class="edit_about2" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil abs"></i></a>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Facebook Username</label>
                <div class="col-md-8">
                    <p class="about"><i>Ajala Richard Taiwo</i></p>
                    <a style="float:right" href="#" class="edit_about3" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil abs"></i></a>
                </div>
              </div>
                <div class="form-group formic">
                <label class="control-label col-sm-2" for="email">Instagram Username</label>
                <div class="col-md-8">
                    <p class="about"><i>arts_richard</i></p>
                    <a style="float:right" href="#" class="edit_about3" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil abs"></i></a>
                </div>
              </div>
            </form>
                <!--<tbody>
                    <tr>
                        <td>Name</td>
                        <td>Richard Ajala</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>richard.ajala@lincoln.edu</td>
                    </tr>
                    <tr>
                        <td>Change Password</td>
                        <td><p>kkkkkk</p></td>
                        <td><a style="float:right" href="#" class="edit_about1" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                    <tr>
                        <td>Major</td>
                        <td>Computer Science</td>
                    </tr>
                    <tr>
                        <td>Courses</td>
                        <td><?php echo $courses['course_code']; ?></td>
                    </tr>
                    <tr>
                        <td>Hobbies</td>
                        <td><p>Playing soccer and video games</p></td>
                        <td><a style="float:right" href="#" class="edit_about2" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                    <tr>
                        <td>Facebook Username</td>
                        <td><p>Ajala Richard Taiwo</p></td>
                        <td><a style="float:right" href="#" class="edit_about3" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                    <tr>
                        <div>
                        <td>Instagram Username</td>
                        <td><p>arts_richard</p></td>
                        <td><a style="float:right" href="#" class="edit_about4" id="<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil"></i></a></td>
                       </div>
                    </tr>
                </tbody>
-->
        </div>
        <div class="tab-pane fade" id="tab5">
        <div class="gallery">
            <?php
            $sql = "SELECT picture FROM cover_photos WHERE user_id = {$student_details['user_id']} "
        . " UNION "
        . " SELECT picture FROM profile_pictures WHERE user_id = {$student_details['user_id']} "
        ." UNION "
        ."SELECT picture FROM pictures WHERE user_id = {$student_details['user_id']}";
            $get_pics = mysqli_query($connection, $sql);
            confirm_query($get_pics);
            while($my_pic = mysqli_fetch_assoc($get_pics)){
                $pic = "../../Users/{$student_details['first_name']}{$student_details['last_name']}/pictures/{$my_pic['picture']}";
                ?>
            <a href="<?php echo $pic ?>"><img src="<?php echo $pic ?>" height="250px" alt="" width="250px" title="Beautiful Image" style="border-radius:10%" border-radius="5px" /></a>
            <?php
            }
            ?>
			<div class="clear"></div>
			
         </div>  
        </div>
      </div>
    </div>
    </div>
                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                            </div>


                    </div>
                </div>
<div class="mikes-modal" id="myModal">
      <?php set_profile_picture_two($student_details['email']); ?>
      <div class="description">
        <div class='title-area'>
            <?php set_profile_picture(30,30,$student_details['email']); ?>
          <h5>&nbsp;&nbsp;<?php echo $_GET['f_name']?> <?php echo $_GET['l_name']; ?></h5>
        </div>
      </div>
    </div>
<script type="text/javascript" src="script/simple-lightbox.js"></script>
<script>
	$(function(){
		var $gallery = $('.gallery a').simpleLightbox();
		
	});
</script>        
 <script>

      jQuery(function() {
        $(".open-mikes-modal").click(function(e) {
          e.preventDefault();
          $("#myModal").mikesModal();
        });
      });

    </script>
                <!--END CONTENT-->
 <?php require_once('../../includes/footer.php')?>