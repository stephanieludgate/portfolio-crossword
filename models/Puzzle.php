<?php

class Puzzle extends DB\SQL\Mapper{
    
    public function __construct(DB\SQL $db){
        parent::__construct($db, 'project_puzzles');
    }
    
    /**
	 * Fetch all the records in our table
	 * "SELECT * FROM todo_tasks"
	 * @return void
	 *
	 * @return results
	 */
    public function fetchAll(){
        $this->load();
        return $this->query;
    }
}
?>