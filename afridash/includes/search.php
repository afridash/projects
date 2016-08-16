<?php
require_once('../../db.php');
if($_POST)
{

$q=$_POST['searchword'];

$sql_res=mysqli_query("SELECT * FROM users WHERE (first_name like '%$q%' or last_name like '%$q%') OR (CONCAT(first_name,' ',last_name) like '%$q%') ORDER BY user_id LIMIT 5");
while($row=mysqli_fetch_assoc($sql_res))
{
$fname=$row['first_name'];
$lname=$row['last_name'];
$re_fname='<b>'.$q.'</b>';
$re_lname='<b>'.$q.'</b>';
$final_fname = str_replace($q, $re_fname, $fname);
$final_lname = str_replace($q, $re_lname, $lname);
?>
<div class="display_box" align="left">
<?php echo $final_fname; ?>&nbsp;<?php echo $final_lname; ?><br/>
</div>
<?php
}

}
else
{
}
?>
