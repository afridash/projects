<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php 
if (isset($_GET['logout']))
{
    logged_out($_SESSION["user_id"]);
    $_SESSION = array();
    if ($_COOKIE[session_name()])
    {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
    redirect_to('../index.php');
}
?>
<?php
    $query = "SELECT first_name, last_name, email FROM users WHERE user_id = {$_GET['id']}";
    $get_f = mysqli_query($connection, $query);
    confirm_query($get_f);
    $f_details = mysqli_fetch_assoc($get_f);

    $query = "UPDATE convoReply SET status = 1 WHERE convoID = {$_GET['user']} AND status = 0 AND userID <> {$_SESSION['user_id']}";
    $seen_messages = mysqli_query($connection, $query);
    confirm_query($seen_messages);
?>
<?php require_once("../../includes/header.php");?>
<script>
var auto_refresh = setInterval(
function ()
{
$('#load_messages').load('get_messages.php?q=<?php echo $_GET['user'];?>&id=<?php echo $_GET['id']; ?>').fadeIn("slow");
}, 2000);
    

$(document).ready(function()
  {
   
  $('.postMessage').click(function()
  {
  var boxval = $("#MessageContent").val();
	var c_id = '<?php echo $_GET['user'];?>';
    var user = '<?php echo $_SESSION['user_id']; ?>'
	var dataString = 'c_id='+ c_id + '&msg=' + boxval + '&userID='+user;
  	if(boxval.length > 0)
	{
	if(boxval.length<200)
	{
$.ajax({
		type: "POST",
  url: "chatajax.php",
   data: dataString,
  cache: false,
  success: function(html){
  $("ol#load_messages").append(html);
   $('#MessageContent').val('');
   $('#MessageContent').focus();
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
ol#load_messages
{
list-style:none;
}
    #submitButton{
        visibility: hidden;
    }
</style>
<div id="page-wrapper" onload="prettyPrint()">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div class="content container-fluid bootstrap snippets">
      <div class="row row-broken">
        <div class="col-sm-3 col-md-4 col-xs-12">
          <div class="col-inside-lg decor-default chat" style="overflow: hidden; height:700px; outline: none;" tabindex="5000">
            <div class="chat-users">
              <h6>Online</h6>
                
                <?php
global $connection;
$query= "SELECT u.user_id, c.c_id, u.email,  u.last_name, u.logged_in, u.first_name FROM convo c, users u WHERE CASE WHEN c.user1 = {$_SESSION['user_id']} THEN c.user2 = u.user_id WHEN c.user2 = {$_SESSION['user_id']} THEN c.user1 = u.user_id END 
 AND ( c.user1 = {$_SESSION['user_id']} OR c.user2 = {$_SESSION['user_id']} ) ORDER BY c.c_id DESC";
 
 $get_list1 = mysqli_query($connection, $query);
 confirm_query($get_list1);
$first = 0;
 while($new_list1 = mysqli_fetch_assoc($get_list1)){
     
if($new_list1['logged_in'] == '1'){
    $status = 'online';
    $stat1 = 'online';
}else{
    $status = 'off';
    $stat1 = 'offline';
}
$c_id=$new_list1['c_id'];
$user_id=$new_list1['user_id'];
$email=$new_list1['email'];
     
$query="SELECT R.cr_id, R.time, R.reply 
                            FROM convoReply R WHERE R.convoID={$c_id} 
                            ORDER BY R.cr_id DESC LIMIT 1";
$cReply = mysqli_query($connection, $query);
  confirm_query($cReply);                           
$crow=mysqli_fetch_assoc($cReply);
$cr_id=$crow['cr_id'];
$reply=$crow['reply'];
$time=$crow['time'];

//HTML Output. 
?>
                    <a href="?id=<?php echo $user_id?>&user=<?php echo $c_id?>"><div class="user">
                    <div class="avatar">
                    <?php set_profile_picture(30,30,$new_list1['email']);?>
                    <div class="status <?php echo $status; ?>"></div>
                    </div>
                    <div class="name"><?php echo "{$new_list1['first_name']} {$new_list1['last_name']}"; ?></div>
                    <div class="mood"><?php echo $reply ?></div>
                        </div></a>
 
                           
                      <?php      
                            }
?>
                
            </div>
          </div>
        </div>
        <div class="col-sm-9 col-md-8 col-xs-12 chat" style="height:700px; outline: none;" tabindex="5001">
          <div class="col-inside-lg decor-default">
            <div class="chat-body">
              <h6><?php echo "{$f_details['first_name']} {$f_details['last_name']}"; ?></h6>
                 <ol id="load_messages">
                <?php
                             $query="SELECT R.cr_id, R.time, R.reply,R.userID 
                            FROM convoReply R WHERE R.convoID={$_GET['user']} 
                            ORDER BY R.cr_id ASC ";
                            $cReply = mysqli_query($connection, $query);
                            confirm_query($cReply);                           
                            while($message = $crow=mysqli_fetch_assoc($cReply) ){
                                if($message['userID']==$_SESSION['user_id']){
                                    ?>
                                        <li id="<?php echo $message['cr_id']; ?>"><div class="answer right">
                                        <div class="avatar">
                                        <?php set_profile_picture(30,30,$_SESSION['email']); ?>
                                           
                                        </div>
                                        <div class="name"><?php echo $_SESSION['name']; ?></div>
                                        <div class="text">
                                        <?php echo $message['reply']; ?>
                                        </div>
                                        <div class="time"><?php
                                    $date = new MyDateTime($message['time'], new DateTimeZone('PST'));
                                    echo time_stamp($date->getTimestamp());
                                    ?></div>
                                            </div></li>
                                    <?php
                                }else{
                                    ?>
                                        <li id="<?php echo $message['cr_id']; ?>"><div class="answer left">
                                        <div class="avatar">
                                            <?php set_profile_picture(30,30,$f_details['email']); ?>
                                            
                                        </div>
                                        <div class="name"><?php echo "{$f_details['first_name']} {$f_details['last_name']}"; ?></div>
                                        <div class="text"><?php echo $message['reply']; ?>
                                        </div>
                                            <div class="time"><?php  $date = new MyDateTime($message['time'], new DateTimeZone('PST'));
                                    echo time_stamp($date->getTimestamp()); ?></div>
                                        </div></li>
                                    <?php
                                } ?>
                                
                            <?php
                            }
                            ?>
                    </ol>
                <div id="flash"></div>
                <form action="" method="post">
              <div class="answer-add">
                <input id="MessageContent" name="msg" placeholder="Write a message" autofocus autocomplete="on">
                <span class="answer-btn answer-btn-1"></span>
             <span class="answer-btn answer-btn-2"><input type="submit"  name="submit" id="submitButton" class="postMessage"></span>
              </div>
                </form>
                </div>
                
          </div>
        </div>
      </div>
    </div>
<div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>
</div>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#MessageContent").emojioneArea(
      {
        container: ".answer-add",
        hideSource: false,
        useSprite: false,
        template: "<filters/><tabs/><editor/>";
      });
    });
  </script>
 <?php require_once('../../includes/footer.php')?>