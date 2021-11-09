<?php

class User extends DB\SQL\Mapper{
    
    public function __construct(DB\SQL $db){
        parent::__construct($db, 'project_users');
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
    
    public function getById($id){
		$this->load( array( "id=?", $id ) );
		$query =  $this->query;
		return $query[0];
	}
    
    public function getByEmail($email){
		$this->load( array( "email=?", $email ) );
		$query =  $this->query;
		return $query[0];
	}
    
    /**
    * Create a new task with data from our POST superglobal
    * @return void
    */
    public function add(){
        $this->copyFrom("POST");
        $this->save();
    }
    
    public function emailExists($email){
        $this->load( array( "email=?", $email ) );
        $query =  $this->query;
        if(isset($query[0])){
            // email EXISTS
            return true;
        } else {
            // email does not exist
            return false;
        }
    }
    
    public function usernameExists($username){
        $this->load( array( "username=?", $username ) );
        $query =  $this->query;
        if(isset($query[0])){
            // username EXISTS
            return true;
        } else {
            // email does not exist
            return false;
        }
    }
}

?>