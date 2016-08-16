<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/db.php");
require_once("../../includes/validation.php");
require_once("../../includes/functions.php");
?>
 <?php	
$last_post = $_POST['ID'];
global $connection;
        $query = "SELECT U.user_id, U.email, U.first_name, U.last_name, D.user_update, D.type,D.created, D.update_id FROM users U, updates D, padi F WHERE D.user_id = U.user_id AND CASE WHEN F.padi_1 = {$_SESSION['user_id']} THEN F.padi_2 = D.user_id WHEN F.padi_2 = {$_SESSION['user_id']} THEN F.padi_1 = D.user_id END AND F.status > '0' AND D.update_id < {$last_post} ORDER BY D.update_id DESC LIMIT 40";
$last_post = 0;
        $get_updates = mysqli_query($connection, $query);
        confirm_query($get_updates);
        while($updates = mysqli_fetch_assoc($get_updates)){ 
        $msgID = $updates['update_id']?>
                               <div class="panel">
                    <div class="panel-heading">
                        <div class="caption"><?php set_profile_picture(35,35, $updates['email']); echo "&nbsp&nbsp";
                            echo "<a href='profile.php?f_name={$updates['first_name']}&l_name={$updates['last_name']}'>{$updates['first_name']} {$updates['last_name']}</a> made a {$updates['type']} update "; ?></div>
                         </div>
                    <div id="<?php echo $msgID; ?>" class="panel-body post_box">
                        <?php echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{$updates['user_update']}";?>
                        <p style="float:right; align:right; color:blue;"><?php echo $msgID; ?></p>
                    </div>
                    </div>
       <?php }
		
?>
