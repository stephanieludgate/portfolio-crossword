# Crossword Game
For my PHP game project, I chose to create a simple crossword puzzle. I offer users a simple prompt, and they can make a guess. I also wanted to incorporate individual user accounts, so that users can login and view their personal details/scores. You might notice there are other ‘puzzles’ listed. I did this to show that I could add additional puzzles at a later date.

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
Login
