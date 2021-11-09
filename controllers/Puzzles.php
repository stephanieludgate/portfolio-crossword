<?php
    class Puzzles extends Controller {
        private $model;
        
        public function __construct(){
            parent::__construct(); // call this to execute Controller construct method
            $this->model = new Puzzle($this->db);
        }
        
        public function list(){ 
            $puzzles = $this->model->fetchAll();
            echo $this->f3->get('twig')->render('puzzle/list_puzzles.twig', array( "puzzles"=>$puzzles ));
        }
    }
?>
