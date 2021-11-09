<?php

class Crossword extends DB\SQL\Mapper{
    
    public function __construct(DB\SQL $db){
        parent::__construct($db, 'project_crossword');
    }
    
    /**
	 * Fetch all the records in our table
	 * "SELECT * FROM todo_tasks"
	 * @return void
	 *
	 * @return results
	 */
    public function fetchAll(){
        $this->load( array( 'order' => 'start_pos desc'));
        return $this->query;
    }
    
    public function getById($id){
		$this->load( array( "id=?", $id ) );
		$query =  $this->query;
		return $query[0];
	}

}
?>