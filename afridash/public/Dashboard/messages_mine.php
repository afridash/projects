<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); ?>
<script>
function change_url(url){
   history.pushState({}, null, url);
}
</script>
<style>
    .myPeople{
        background: #fff;
    }
</style>
<?php require_once("../../includes/header.php");?>
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Messages</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Messages</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-4 myPeople"><h3>People</h3>
<?php
global $connection;
$query= "SELECT u.user_id, c.c_id, u.email, u.last_name, u.first_name FROM convo c, users u WHERE CASE WHEN c.user1 = {$_SESSION['user_id']} THEN c.user2 = u.user_id WHEN c.user2 = {$_SESSION['user_id']} THEN c.user1 = u.user_id END 
 AND ( c.user1 = {$_SESSION['user_id']} OR c.user2 = {$_SESSION['user_id']} ) ORDER BY c.c_id DESC";
 
 $get_list1 = mysqli_query($connection, $query);
 confirm_query($get_list1);
$first = 0;
 while($new_list1 = mysqli_fetch_assoc($get_list1)){ 
     $first++;
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

 
                       <ul class="nav nav-pills nav-stacked">
                            <?php if($first==1){
                                ?>
                           <li role="presentation" class="active">
                            <?php
                            }else{
                            ?>
                            <li role="presentation">
                        <?php
                            } ?>
                           
                                <a data-toggle="pill" href="#Messages" id="myChatBox" onclick="change_url('?user=<?php echo $cr_id; ?>')">
                                    <?php set_profile_picture(30,30, $new_list1['email']); ?><span class="user"><?php echo "{$new_list1['first_name']} {$new_list1['last_name']}"; ?></span><span
                                        class="time"><?php echo $time ?></span><br/>
                                    <span class="padding: 10px"><?php echo $reply ?></span></a>
                           
                                 </li>
                        </ul>   
                      <?php      
                            }
?>
                        
                        </div>
                        
                        <div class="col-lg-8"><h3>Messages</h3>
                            <div class="chat_body">
                                <div class="msg_body">
                            <?php
                             $query="SELECT R.cr_id, R.time, R.reply,R.userID 
                            FROM convoReply R WHERE R.convoID={$c_id} 
                            ORDER BY R.cr_id DESC ";
                            $cReply = mysqli_query($connection, $query);
                            confirm_query($cReply);                           
                            while($message = $crow=mysqli_fetch_assoc($cReply) ){
                                if($message['userID']==$_SESSION['user_id']){
                                    ?>
                                    <div class="msg_b">
                                        <p><?php echo $message['reply']; ?></p>
                                        <br/><?php echo $message['time']; ?>
                                    
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <div class="msg_a">
                                        <p><?php echo $message['reply']; ?></p>
                                        <br/><?php echo $message['time']; ?> 
                                    </div>
                                    <?php
                                } ?>
                                
                            <?php
                            }
                            ?>
                                    <input type="text" class="msg_input">
                                    </div>
                            </div>
                        </div>
                        
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>
                        <?php if(isset($_GET['username'])){
                                echo $_GET['username'];
                            }?>
                    </div>
 <?php require_once('../../includes/footer.php')?>