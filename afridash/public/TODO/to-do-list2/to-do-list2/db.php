<?php
// my database class

class Db{
	public $mysql;
	
	function __construct(){
		$this->mysql = new mysqli('afritables.db.6471559.hostedresource.com', 'afritables', 'afr!D4sh', 'afritables') or die('problem'); 
	}		
	
	function delete_by_id($id) { 
    $query = "DELETE from toDos WHERE id = $id"; 
    $result = $this->mysql->query($query) or die("sorry, there was a problem deleting."); 
      
    if($result) return 'yay!'; 
	}
	
	function update_by_id($id, $description) {
		$query = "UPDATE toDos
				 SET description = ?
				 WHERE id = ?
				 LIMIT 1";
		if($stmt = $this->mysql->prepare($query)) {
			$stmt->bind_param('si', $description, $id);
			$stmt->execute();
			return "Deleted";
			}
	}
}//end class
	