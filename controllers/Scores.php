<?php
    class Scores extends Controller {
        private $model;
        
        public function __construct(){
            parent::__construct(); // call this to execute Controller construct method
            $this->model = new Score($this->db);
        }
        
        public function list(){
            $scores = $this->db->exec('SELECT u.username AS username, s.score AS score FROM project_scores s JOIN project_users u ON s.user_id=u.id ORDER BY s.score ASC LIMIT 5');
            echo $this->f3->get('twig')->render('scores/scoreboard.twig', array( "scores"=>$scores ));
        }
        
        public function enterScore(){    
            //establish some DUMMY variables
            $user = $this->f3->get('SESSION.userid');
            $this->f3->set('POST.user_id', $user); 
            
            $endTime = time();
            $score = ($endTime - $this->f3->get('SESSION.startTime'));
            $this->f3->set('POST.score', $score); 
            
            // add this score to DB
            $this->model->add();
            
            // unset SESSION variables - excluding logged in
            $this->clearProgress();
                
            // if done correctly, reroute to puzzles MAYBE change to scoreboard once established
            $this->f3->reroute('scoreboard');
            die();
        }
    }
?>
