<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php require_once("../../includes/header.php");?>
                <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                           My Calender </div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Laboratories</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="page-content">
                    <div class="tab-general">
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>
<!-- define the calendar element -->
                        <div class="col-lg-8" id="my-calendar"></div>
                        <div class="col-md-4">
		<h1 style="font-style: italic;"> My To-Do List </h1>
		<ul id="tabs">
			<li id="todo_tab" class="selected"><a href="#">To-Do</a></li>
		</ul>
		
		<div id="main">
			<div id="todo">
				<?php
                    global $connection;
					$sql = "SELECT * FROM toDos WHERE user_id = {$_SESSION['user_id']} LIMIT 0, 30 "; 
					$results =mysqli_query($connection, $sql);
					confirm_query($results);
                    $num_todo = mysqli_num_rows($results);
                if($num_todo > 0){
                    while($toDo = mysqli_fetch_assoc($results)){ ?>
                    <div class="item">
                   <h4> <?php echo "{$toDo['title']} *****  {$toDo['date']} "?></h4>
                    <p> <?php echo "{$toDo['description']} " ?></p>
                    <input type="hidden" name="id" id="id" value="<?php echo "{$toDo['id']}" ?>" />
                        <div class="options">
                    <a class="deleteEntryAnchor" href="delete.php?id=<?php echo "{$toDo['id']}"?>">Del</a> 
                    <a class="editEntry" href="#">Edit</a>
					<a class="saveEntry" href="#">Save</a>
                     </div>
					</div>
              <?php
                                                               }
            }else{
                    echo "<p>There are zero items. Add one now!</p>";
                }
                
				?> 
				
			
			</div><!-- end Todo -->
			
			<div id="addNewEntry">
				<h2 style="font-style: italic;"> Add New To-Do </h2>
				<form action="addItem.php" method="post"> 
					<p> 
						<label for="title"> Title</label> 
						<input type="text" name="title" id="title" class="input"/> 
					</p>
					<p> 
						<label for="date"> Date</label> 
						<input type="date" name="date" id="date" class="input"/> 
					</p> 
  
					<p> 
						<label for="description"> Description</label> 
						<textarea name="description" id="description" rows="10" cols="35"></textarea> 
					</p>   
      
					<p> 
						<input type="submit" name="addEntry" id="addEntry" value="Save To-Do" /> 
					</p> 
				</form> 
			
			</div><!-- End addNewEntry -->
			
		</div><!-- End main -->
	</div><!-- End Container -->

                    </div>

<!-- JS ======================================================= --> 
<script type="application/javascript">
    $(document).ready(function () {
        $("#my-calendar").zabuto_calendar({
            ajax: {
          url: "show_data.php",
          modal: true
      },
      cell_border: true,
      today: true,
      show_days: true,
      weekstartson: 0,
      nav_icon: {
        prev: '<i class="fa fa-chevron-circle-left fa-lg"></i>',
        next: '<i class="fa fa-chevron-circle-right fa-lg"></i>'
      }
        });
    });
</script>
<script type="text/javascript" src="script/todo.js"></script>
 <?php require_once('../../includes/footer.php')?>