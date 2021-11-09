<?php

class Score extends DB\SQL\Mapper{
//    $scoreboard;
    
    public function __construct(DB\SQL $db){
        parent::__construct($db, 'project_scores');
//        parent::__construct($db, 'view_scoreboard');
//        $this->scoreboard = new DB\SQL\Mapper($db, 'view_scoreboard');
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
    
    public function fetchScores(){
        $this->scoreboard->load();
        return $this->scoreboard;
    }
    
    /**
    * Create a new task with data from our POST superglobal
    * @return void
    */
    public function add(){
        $this->copyFrom("POST");
        $this->save();
    }
}
?>