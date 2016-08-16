<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");  ?>
<?php
global $connection;
$query= "SELECT u.user_id, c.c_id, u.email, u.last_name, u.first_name FROM convo c, users u WHERE CASE WHEN c.user1 = {$_SESSION['user_id']} THEN c.user2 = u.user_id WHEN c.user2 = {$_SESSION['user_id']} THEN c.user1 = u.user_id END 
 AND ( c.user1 = {$_SESSION['user_id']} OR c.user2 = {$_SESSION['user_id']} ) ORDER BY c.c_id DESC LIMIT 20";
 
 $get_list1 = mysqli_query($connection, $query);
 confirm_query($get_list1);
$first = 0;
 while($new_list1 = mysqli_fetch_assoc($get_list1)){ 
$c_id=$new_list1['c_id'];
$user_id=$new_list1['user_id'];
$email=$new_list1['email'];
     
$query="SELECT R.cr_id, R.time, R.reply, R.userID 
                            FROM convoReply R WHERE R.convoID={$c_id} 
                            ORDER BY R.cr_id DESC LIMIT 1";
$cReply = mysqli_query($connection, $query);
  confirm_query($cReply);                           
$crow=mysqli_fetch_assoc($cReply);
$cr_id=$crow['cr_id'];
$reply=$crow['reply'];
$time=$crow['time'];
$ur_id = $crow['userID'];

//HTML Output. 
?>
                            <a  href="messages.php?id=<?php echo $user_id; ?>&user=<?php echo $c_id; ?>" ><div class="display_pan">
                                    <?php set_profile_picture(30,30, $new_list1['email']); ?><span class="user"><?php echo "{$new_list1['first_name']} {$new_list1['last_name']}"; ?></span><span
                                        class="time"><?php $date = new MyDateTime($time, new DateTimeZone('PST')); echo time_stamp($date->getTimestamp());?></span><br/><?php if ($ur_id != $_SESSION['user_id']){ ?>
                                                <span class="reply"><?php echo $reply ?></span>
                                           <?php
                                        }else{ ?>
                                 <span class="my_reply"><?php echo $reply ?></span>
<?php    
} ?>
                                   
                           
                                 </div></a> 
                      <?php      
                            }
?>
           
<?php ob_end_flush()?>