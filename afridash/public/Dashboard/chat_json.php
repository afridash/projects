<?php
include('db.php');
include('session.php');
if($_GET['q'])
{
$user=$_GET['c_id'];
global $connection;
$sql = mysqli_query($connection,"SELECT R.cr_id, R.time, R.reply,R.userID 
                            FROM convoReply R WHERE R.convoID= {$user} 
                            ORDER BY R.cr_id ASC");
$row=mysqli_fetch_assoc($sql);
$userx=$row['userID'];
$id=$row['cr_id'];
$msg=$row['reply'];
$time =$row['time'];
if($userx!=$user)
{

echo '{"posts": [';
echo '
    {
	"id":"'.$id.'",
	"user":"'.$userx.'",
	"reply":"'.$msg.'",
    "time":"'.$time.'"
	},';	


echo ']}';
} } ?>