<h1 style="font-style: italic;"> My To-Do List </h1>
         <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#toDo" aria-controls="home" role="tab" data-toggle="tab">To Do</a></li>
    <li role="presentation"><a href="#addNew" aria-controls="profile" role="tab" data-toggle="tab">Add New</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="toDo">
<div class="panel-group" id="accordion">
     <div id="todoListItems"></div>
    		<?php
                    global $connection;
					$sql = "SELECT * FROM toDos WHERE user_id = {$_SESSION['user_id']} LIMIT 0, 30 "; 
					$results =mysqli_query($connection, $sql);
					confirm_query($results);
                    $num_todo = mysqli_num_rows($results);
                if($num_todo > 0){
                    while($toDo = mysqli_fetch_assoc($results)){ ?>
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
              <?php
                                                               }
            }else{
                    echo "<p class='zerowarning'>There are zero items. Add one now!</p>";
                }
                
				?> 

        </div>
    </div>

    <div role="tabpanel" class="tab-pane fade" id="addNew">
				<form class="form-vertical" action="" method="post"> 
					<div class="form-group"> 
						<label for="title" > Title</label> 
						<input class="form-control" type="text" name="title" id="title" class="input"/> 
					</div>
					<div class="form-group"> 
						<label for="date"> Date</label> 
						<input class="form-control" type="date" name="date" id="date" class="input"/> 
					</div> 
  
					<div class="form-group"> 
						<label for="description" > Description</label> 
						<textarea class="form-control" name="description" id="description" rows="4" cols="35"></textarea> 
					</div>   
      
					<div class="form-group"> 
						<input class=" btn btn-primary addEntry" name="addEntry" id="addEntry" value="Save To-Do" /> 
					</div> 
				</form> 

    </div>
  </div>