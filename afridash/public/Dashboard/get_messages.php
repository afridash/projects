<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");  ?>
<?php confirm_if_user_logged_in(); ?>
<?php 
global $connection;
if(isset($_GET['q'])){
    $query = "SELECT first_name, last_name, email FROM users WHERE user_id = {$_GET['id']}";
    $get_f = mysqli_query($connection, $query);
    confirm_query($get_f);
    $f_details = mysqli_fetch_assoc($get_f);
                             $query="SELECT R.cr_id, R.time, R.reply,R.userID 
                            FROM convoReply R WHERE R.convoID={$_GET['q']} 
                            ORDER BY R.cr_id ASC ";
                            $cReply = mysqli_query($connection, $query);
                            confirm_query($cReply);                           
                            while($message = $crow=mysqli_fetch_assoc($cReply) ){
                                if($message['userID']==$_SESSION['user_id']){
                                    ?>
                                        <li id="<?php echo $message['cr_id']; ?>"><div class="answer right">
                                        <div class="avatar">
                                        <?php set_profile_picture(30,30,$_SESSION['email']); ?>
                                        <div class="status <?php echo $stat1 ?>"></div>
                                        </div>
                                        <div class="name"><?php echo $_SESSION['name']; ?></div>
                                        <div class="text">
                                        <?php echo $message['reply']; ?>
                                        </div>
                                        <div class="time"><?php  $date = new MyDateTime($message['time'], new DateTimeZone('PST'));
                                    echo time_stamp($date->getTimestamp()); ?></div>
                                            </div></li>
                                    <?php
                                }else{
                                    ?>
                                        <li id="<?php echo $message['cr_id']; ?>"><div class="answer left">
                                        <div class="avatar">
                                            <?php set_profile_picture(30,30,$f_details['email']); ?>
                                            <div class="status <?php echo $stat1 ?>"></div>
                                        </div>
                                        <div class="name"><?php echo "{$f_details['first_name']} {$f_details['last_name']}"; ?></div>
                                        <div class="text"><?php echo $message['reply']; ?>
                                        </div>
                                            <div class="time"><?php 
                                    $date = new MyDateTime($message['time'], new DateTimeZone('PST'));
                                    echo time_stamp($date->getTimestamp()); ?></div>
                                        </div></li>
                                    <?php
                                } ?>
                                
                            <?php
                            }
}           
 ?>
<?php ob_end_flush()?>