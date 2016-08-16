<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");  ?>
<?php confirm_if_user_logged_in(); ?>
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
            <a href="#" class="comment_button" id="<?php echo $msgID; ?>">Comment</a>
        </div>
        <div class='likeUsers' id="likes<?php echo $msgID; ?>" >
            <span id="you<?php echo $msgID; ?>"><a href="#">You, </a>and <?php echo $num_likes ?> others like this.</span>
        </div>
<?php
    }elseif(!empty($confirm_like) && $num_likes == 0 ){
        ?>
            <div>
            <a class="comment_like" id="like<?php echo $msgID; ?>" title="Unlike" rel="Unlike">Unlike</a>
            <a href="#" class="comment_button" id="<?php echo $msgID; ?>">Comment</a>
        </div>
        <div class='likeUsers' id="youlike<?php echo $msgID; ?>" >
            <span id="you<?php echo $msgID; ?>"><a href="#">You</a> like this.</span>
        </div>            
<?php
    }elseif(empty($confirm_like) && $num_likes > 0){
        ?>
        <div>
            <a class="comment_like" id="like<?php echo $msgID; ?>" title="like" rel="like">Like</a>
            <a href="#" class="comment_button" id="<?php echo $msgID; ?>">Comment</a>
        </div>
        <div class='likeUsers' id="likes<?php echo $msgID; ?>" >
            <span id="you<?php echo $msgID; ?>"><a href="#"><?php echo $num_likes ?></a> likes.</span>
        </div>                    
<?php
    }elseif(empty($confirm_like) && $num_likes == 0){
        ?>
        <div>
            <a class="comment_like" id="like<?php echo $msgID; ?>" title="like" rel="like">Like</a>
            <a href="#" class="comment_button" id="<?php echo $msgID; ?>">Comment</a>
        </div>
        <div class='likeUsers' id="youlike<?php echo $msgID; ?>" >
            
        </div>  
<?php
    }
?>
<ol id="load_comments"><?php get_comments($updates['update_id']); ?> </ol><div id="flash"></div>
<div class='comment_panel' id="slidepanel<?php echo $msgID; ?>">
<form action="" method="post">
<textarea rows="3" placeholder="Write a comment" class="form-control" id="comment_content<?php echo $msgID; ?>" name="comment_content"></textarea><br />
<input type="hidden" id="pID" name="pID" value="<?php echo $msgID; ?>">
<input type="submit" value=" Comment " id="submit_comment"  class="btn btn-default"/>
</form>
</div>
<script>getPosts(<?php echo $msgID; ?>)</script>
</div>
 </div>
       <?php }
            ?>