<?php ob_start()?>
<?php
require_once("../../includes/session.php");
require_once("../../includes/db.php");
require_once("../../includes/validation.php");
require_once("../../includes/functions.php");
if($_POST)
{
    global $connection;
$q=$_POST['searchword'];
$query = "SELECT * FROM users WHERE (first_name like '%$q%' or last_name like '%$q%') OR (CONCAT(first_name,' ',last_name) like '%$q%') ORDER BY user_id LIMIT 5";
$sql_res=mysqli_query($connection, $query);
confirm_query($sql_res);
while($row=mysqli_fetch_assoc($sql_res))
{
$fname=$row['first_name'];
$lname=$row['last_name'];
$userID = $row['user_id'];
//$re_fname='<b>'.$q.'</b>';
//$re_lname='<b>'.$q.'</b>';
//$final_fname = str_replace($q, $re_fname, $fname);
//$final_lname = str_replace($q, $re_lname, $lname);
?>
<?php
    echo "<a href='profile.php?f_name={$fname}&l_name={$lname}&id={$userID}'><div class='display_box' align='left'>{$fname} {$lname} </div></a>";
?>
<?php
}

}
else
{
}
?>
<?php ob_end_flush()?>