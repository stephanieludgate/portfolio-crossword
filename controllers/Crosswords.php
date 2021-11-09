<?php
    class Crosswords extends Controller {
        private $model;
        
        public function __construct(){
            parent::__construct(); // call this to execute Controller construct method
            $this->model = new Crossword($this->db);
        }
        
        public function list(){                
            $clues = $this->model->fetchAll();
            if($this->crosswordComplete()){
                // YAY all clues were answered correctly!  
                // Log this as a score & unset SESSION.clue# variables
                // keep users loggedin
                $this->f3->reroute('puzzles/crossword/success');
                die();
            } else {
                // check if timer has already started, and if we have an active user
                if($this->f3->get('SESSION.startTime') === null && $this->isLoggedIn()){
                    // start time does not yet exist
                    $timeNow = time();
                    $this->f3->set('SESSION.startTime', $timeNow);
                }
                echo $this->f3->get('twig')->render('crossword/list_clues.twig', array( "clues"=>$clues ));
            }   
        }
        
        public function clues($f, $params){
            // Make sure user is logged in!
            if($this->isLoggedIn()){
                // user is logged in, allow them to view clue
                $clue = $this->model->getById( $params['id'] );
                echo $this->f3->get('twig')->render('crossword/clue_view.twig', array( "clue"=>$clue ));
                die();
            }
            // User is not logged in, redirect them
            $this->f3->reroute('puzzles/crossword');
            die();
        }
        
        public function makeGuess($f, $params){
            $clue = $this->model->getById( $params['id'] );
            if($this->isFieldEmpty($this->f3->get('POST.answer'))){
                $messages = "No guess submitted";
                //echo $messages;
                // if failed, reload this page w/ error message
            } else if(strlen($clue['answer']) !== strlen(trim($this->f3->get('POST.answer')))){
                $messages = "Incorrect length";
            } else if($clue['answer'] !== trim(strtolower($this->f3->get('POST.answer')))){
                $messages = "Wrong answer";
            } else {
                // answer is CORRECT
                // set SESSION variables
                $variableName = 'SESSION.clue'.$clue['id'];
                $this->f3->set($variableName, true);
                $this->f3->reroute('puzzles/crossword');
                die();
            }
            echo $this->f3->get('twig')->render("crossword/clue_view.twig", array("clue"=>$clue, "messages"=>$messages ));
        }
    }
?>
