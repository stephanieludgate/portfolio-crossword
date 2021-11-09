<?php
    class Controller {
        // parent controller
        protected $f3;
        protected $db;
        public $twig_data;
        
        public function __construct(){
            $c_f3 = Base::instance();
            $c_db = new DB\SQL($c_f3->get('dbHost'),$c_f3->get('dbUser'),$c_f3->get('dbPass'));
            
            $this->f3 = $c_f3;
            $this->db = $c_db;
            
            $this->twig_data = array("messages"=>$_SESSION['messages']);
            unset($_SESSION['messages']);
        }
        
        public function isFieldEmpty($field){
            return (!isset($field) || trim($field)=="");
        }
        
        public function isLoggedIn(){
            if($this->f3->get('SESSION.loggedIn') !== null && $this->f3->get('SESSION.loggedIn') === true){
                return true;
            } else {
                return false;
            }  
        }
        
        public function crosswordComplete(){
            if( $this->f3->get('SESSION.clue1') === true && $this->f3->get('SESSION.clue2') === true && $this->f3->get('SESSION.clue3') === true && $this->f3->get('SESSION.clue4') === true && $this->f3->get('SESSION.clue5') === true && $this->f3->get('SESSION.clue6') === true && $this->f3->get('SESSION.clue7') === true && $this->f3->get('SESSION.clue8') === true){
                return true;
            } else {
                return false;
            }
        }
        
        public function clearProgress(){
            // clear all 8 crossword clues
            $this->f3->clear('SESSION.clue1');
            $this->f3->clear('SESSION.clue2');
            $this->f3->clear('SESSION.clue3');
            $this->f3->clear('SESSION.clue4');
            $this->f3->clear('SESSION.clue5');
            $this->f3->clear('SESSION.clue6');
            $this->f3->clear('SESSION.clue7');
            $this->f3->clear('SESSION.clue8');
            // clear timer
            $this->f3->clear('SESSION.startTime');
        }
        
        
    }
?>