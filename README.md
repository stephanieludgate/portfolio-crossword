# Crossword Game
For my PHP game project, I chose to create a simple crossword puzzle. I offer users a simple prompt, and they can make a guess. I also wanted to incorporate individual user accounts, so that users can login and view their personal details/scores. You might notice there are other ‘puzzles’ listed. I did this to show that I could add additional puzzles at a later date.\
<img width="757" alt="project thumbnail" src="https://user-images.githubusercontent.com/58275084/141150927-2f33d292-73ed-4a8e-a060-244e162844aa.png">

### Stats Tracked
The design of my website uses a number of SESSION variables, to track if a question has already been answered or not, and the start time. Only when all questions have been answered, a record is entered into the database for my ‘project_scores’ table. This table keeps track of the user who submitted the entry, the score (in whole seconds) and the date entered. I chose this approach so that if a user abandoned a game, I wouldn’t be left with an incomplete record.

### Project Highlights
Some of the parts I am most proud of:
1. The interactivity of my crossword puzzle. Once a question has been correctly answered, the
clue link becomes disabled, adds a check mark, and that word appears in the crossword.
2. While I figured it out in the end, I found Fat Free Framework’s documentation incredibly
unclear. I was very please to have managed to set SESSION variables that I could use both in my controller, and in my twig files (by adding a twig filter – index.php lines 15 & 16).

### Website Improvements
The major areas of my quiz that I would like to fix:
1. Crossword display & JavaScript
While it works for the purposes of this project, both the display and logic of ‘playing_board.twig’ is not ideal. I would like to incorporate Javascript here to create my crossword, and find a more efficient way to add data (currently each letter is hard-coded).
2. User functionality
I would like to give users the chance to update their information, or remove themselves from the database. As it currently stands, users can only ‘view’ their profile.

### Screenshots
Login:\
<img width="757" alt="login page" src="https://user-images.githubusercontent.com/58275084/141149273-227a6475-1162-42e7-b200-0879bd799606.png">

Crossword Puzzle:\
<img width="757" alt="crossword puzzle" src="https://user-images.githubusercontent.com/58275084/141149264-502ff873-ffa3-4540-92ba-4d3e52d3d91c.png">

Clues:\
<img width="757" alt="crossword clue" src="https://user-images.githubusercontent.com/58275084/141149271-26dc14a8-3b4b-4e2a-a5d0-6176c8770e9a.png">

Scoreboard:\
<img width="757" alt="scoreboard" src="https://user-images.githubusercontent.com/58275084/141149267-1718ce0a-cfaa-4a48-8a77-2d5def80b844.png">
