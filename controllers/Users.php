<?php
    class Users extends Controller {
        private $model;
        
        public function __construct(){
            parent::__construct(); // call this to execute Controller construct method
            $this->model = new User($this->db);
        }
        
        function homepage(){
            echo $this->f3->get('twig')->render('user/login.twig');
        }
        
        public function login(){
            // FIELD validation
            if($this->isFieldEmpty($this->f3->get('POST.email')) || $this->isFieldEmpty($this->f3->get('POST.password'))){
                $messages = "Both fields are required";
                //echo $messages;
                // if failed, reload this page w/ error message
                echo $this->f3->get('twig')->render("user/login.twig", array("user"=>$this->f3->get('POST'), "messages"=>$messages ));
            } else {
                // both fields were filed in, check is user exists
                $user = $this->model->getByEmail( $_POST['email'] );
                if(!isset($user)){
                    $messages = "No such user";
                    echo $this->f3->get('twig')->render("user/login.twig", array("user"=>$this->f3->get('POST'), "messages"=>$messages ));
                } else{
                    // user exists, check password
                    if( !password_verify( $_POST['password'], $user['password']) ){
                        $messages = "Incorrect password";
                        echo $this->f3->get('twig')->render("user/login.twig", array("user"=>$this->f3->get('POST'), "messages"=>$messages ));
                    } else{
                        // SUCCESSFUL login
                        // set SESSION variables
                        $this->f3->set('SESSION.username',$user['username']);
                        $this->f3->set('SESSION.userid',$user['id']);
                        $this->f3->set('SESSION.loggedIn', true);
                        $this->f3->reroute('/puzzles');
                        die();
                    }  
                }
            }
            
            
            
        }
        
        public function viewAll(){
            $users = $this->model->fetchAll();
            //echo $this->f3->get('twig')->render('tasks/list.twig', compact('tasks'));

            echo $this->f3->get('twig')->render('user/list_user.twig', compact('users'));

        }
        
        public function add(){
            if($this->isLoggedIn()){
                // user is logged in, allow them to view their a/c details
                $user = $this->model->getById( $this->f3->get('SESSION.userid') );
                echo $this->f3->get('twig')->render('user/view_user.twig', array("user"=>$user));
            } else {
                echo $this->f3->get('twig')->render('user/add_user.twig');
            }
        }
        
        public function create(){
            // EMAIL validation
            if($this->isFieldEmpty($this->f3->get('POST.email'))){
                $messages_email = "Email is required";
            } else if ( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)){
                $messages_email = "Must be a valid email";
            } else if ( $this->model->emailExists($_POST['email'])){
                $messages_email = "Email already exists";
            }
            
            // PASSWORD validation
            if($this->isFieldEmpty($this->f3->get('POST.password_1'))){
                $messages_password = "Password is required";
            } else if( strlen($_POST['password_1'])<5){
                $messages_password = "Password must be at least 5 characters";
            } else if ($_POST['password_1'] != $_POST['password_2']){
                $messages_password = "Passwords do not match";
            }
            // USERNAME validation
            if($this->isFieldEmpty($this->f3->get('POST.username'))){
                $messages_username = "Username is required";
            } else if( strlen($_POST['username'])<3){
                $messages_username = "Username must be at least 3 characters";
            } else if ( $this->model->usernameExists($_POST['username'])){
                $messages_username = "Username already exists";
            }
            
            if($this->isFieldEmpty($messages_email) && $this->isFieldEmpty($messages_password) && $this->isFieldEmpty($messages_username)){
                // passes my validation
                
                // encrypt the new password
				$password = password_hash( $this->f3->get('POST.password_1'), PASSWORD_BCRYPT );
                $this->f3->set('POST.password', $password); 
                
                $this->model->add();
                
                // if done correctly, reroute to login page
                $this->f3->reroute('/');
                die();
            }
            // if failed, reload this page w/ error message
            echo $this->f3->get('twig')->render("user/add_user.twig", array("user"=>$this->f3->get('POST'), "messages_email"=>$messages_email, "messages_password"=>$messages_password, "messages_username"=>$messages_username));
            die();
        }
        
        public function logout(){
            // clear SESSION variables
            $this->f3->clear('SESSION');

            // reroute to login page
            $this->f3->reroute('/');
            die();
        }
        
        public function printUsers(){
            // Create an instance of the class:
            $mpdf = new \Mpdf\Mpdf();

            // PAGE HEADING
            $mpdf->WriteHTML('<h2>Steph&apos;s Final PHP Project</h2>');
            $mpdf->WriteHTML('<p>Here is a list of my users:<p>');
            // USER TABLE
            $table_start = "<table><thead><tr><th>ID</th><th>EMAIL</th><th>USERNAME</th><th>DATE JOINED</th></tr></thead><tbody style='text-align:center'>";
            $mpdf->WriteHTML($table_start);
            
            $users = $this->model->fetchAll();
            foreach($users as $u){
                $user_row = "<tr><td>".$u['id']."</td><td>".$u['email']."</td><td>".$u['username']."</td><td>".$u['member_since']."</td></tr>";
                $mpdf->WriteHTML($user_row);
            }
            $table_end = "</tbody></table>";
            $mpdf->WriteHTML($table_end);


            // Output a PDF file directly to the browser
            $mpdf->Output();
        }
        
    }
?>