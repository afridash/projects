<?php ob_start(); ?>
<?php
require_once("../../../includes/session.php");
require_once("../../../includes/functions.php");
require_once("../../../includes/validation.php");
if(isset($_POST)) { 
    global $connection;
    $query = "INSERT INTO toDos(user_id,title, description, date) VALUES ({$_SESSION['user_id']}, '{$_POST['title']}', '{$_POST['description']}', '{$_POST['date']}')"; 
     $store_todo = mysqli_query($connection, $query);
      confirm_query($store_todo);
    $sql = "SELECT * FROM toDos WHERE user_id = {$_SESSION['user_id']} ORDER BY id DESC LIMIT 1 "; 
    $results =mysqli_query($connection, $sql);
    confirm_query($results);
    $toDo = mysqli_fetch_assoc($results);
}
?>
<div class="panel panel-info" id="<?php echo "{$toDo['id']}"?>">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo "{$toDo['id']}"?>"> <?php echo "{$toDo['title']} *****  {$toDo['date']} "?></a>
        </h4>
    </div>
    <div id="collapse<?php echo "{$toDo['id']}"?>" class="panel-collapse collapse">
        <div class="panel-body">
    <p class="medium"> <?php echo "{$toDo['description']} " ?></p>
    <input type="hidden" name="id" id="id" value="<?php echo "{$toDo['id']}" ?>" />
    <div class="options">
<a class=" btn btn-danger btn-sm deleteEntryAnchor" data-id="<?php echo "{$toDo['id']}"?>" href="delete.php?id=<?php echo "{$toDo['id']}"?>">Del</a> 
<a class=" btn btn-primary btn-sm editEntry" href="#">Edit</a>
<a class="btn btn-success btn-sm saveEntry" href="#">Save</a>
 </div>
        </div>
      </div>
    </div>
<?php ob_end_flush(); ?>