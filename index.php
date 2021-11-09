<?php

// composer autoload
require "vendor/autoload.php";

// F3 setup
$f3 = Base::instance();
$f3->config('inc/setup.ini');

// TWIG setup
$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader);
$f3->set("twig", $twig);
// TWIG filter (so I can use F3 session variables)
$filter = new \Twig\TwigFilter('f3','F3::get');
$twig->addFilter($filter);

// USERS - login
$f3->route('GET /', 'Users->homepage');
$f3->route('POST /', 'Users->login');
$f3->route('GET /logout', 'Users->logout'); 

// USERS - add
$f3->route('GET /user', 'Users->add');
$f3->route('POST /user', 'Users->create');

// USERS - backend view all
$f3->route('GET /spymaster', 'Users->viewAll');
// USERS - print all
$f3->route('GET /print', 'Users->printUsers');


// PUZZLES
$f3->route('GET /puzzles', 'Puzzles->list');
$f3->route('GET /puzzles/*', 'Puzzles->list'); // undefined puzzles

// CROSSWORDS
$f3->route('GET /puzzles/crossword', 'Crosswords->list');
$f3->route('GET /puzzles/crossword/@id', 'Crosswords->clues');
$f3->route('POST /puzzles/crossword/@id', 'Crosswords->makeGuess');

// SCORES
$f3->route('GET /puzzles/crossword/success', 'Scores->enterScore');
$f3->route('GET /scoreboard', 'Scores->list');

// ERROR HANDLING
$f3->set('ONERROR', function($f3){
    if ($f3->get('ERROR.code') == "404"){
        echo $f3->get('twig')->render('errors/404.twig');
    } else {
        echo $f3->get('ERROR.code')." - ".$f3->get('ERROR.status')."<br>".$f3->get('ERROR.text');
    }
});

// execute my f3
$f3->run();

?>