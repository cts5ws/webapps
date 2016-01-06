
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Anagrams</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="http://code.jquery.com/jquery-1.11.3.js"></script>
    <script>

        //intialize variables
        var guesses = [];
        var wordCount = 0;
        var wordCountLocal;
        var realAnagram;
        var realWord;
        $(document).ready();

        //fetches new word from server using ajax
        function newWord() {
            wordCountLocal = 1;
            guesses=[];
            realAnagram = null;
            realWord = null;
            $.ajax({url: "fetchword.php",
                success: function(data) {
                    var info = JSON.parse(data);
                    word = info.word;

                    //makes sure we haven't had the word before
                    if ($.inArray(word, guesses) == -1) {
                        guesses.push(word);
                        wordCount += 1;

                        //adds another row in the table
                        $("#wordContainer").append("<div id=\"word"+wordCount+"\" class=\"trow\"><div class=\"word tcell\"></div><div class=\"guess tcell\"></div></div>");
                        var myDiv="#word"+wordCount+" .word";
                        $(myDiv).text(word);
                        var myDiv="#word"+wordCount+" .guess";
                    }
                }
            });

        }

        //inserts guess into table
        function insertGuess() {

            //fetches value from textfield
            var guessWord = $("#inp").val().toLowerCase();
            $("#inp").val("");

            //checks to make sure it hasn't been guessed yet
            if ($.inArray(guessWord, guesses) == -1) {
                isAWord(guessWord,
                    isAnagram(guessWord, $("#word"+wordCount+" .word").text(),
                        function(){

                            //makes sure only run once
                            $(document).one("ajaxStop", function(){
                                //checks that the word is in the dictionary and a legit anagram
                                if(realAnagram == true && realWord == true){
                                    if ($.inArray(guessWord, guesses) == -1){
                                        guesses.push(guessWord);
                                        var myDiv = "#word" + wordCount + " .guess";
                                        $(myDiv).append(wordCountLocal + "." + guessWord + "<br>");
                                        wordCountLocal++;
                                    }
                                }
                            });

                        }
                    )
                );
            } else {
                alert("You have already entered this word.");
            }
        }

        //checks to see if the guessed word is an anagram
        function isAnagram(guess, word, callback){
            var guessArr = guess.split('');
            var wordArr = word.split('');

            for(var i = 0; i < guessArr.length; i++){
                if($.inArray(guessArr[i], wordArr) == -1){
                    alert("You entered an illegitimate letter");
                    realAnagram = false;
                    break;
                }
            }
            if(realAnagram != false){
                realAnagram = true;
                callback();
            }
        }

        //uses AJAX to check with the database to see if the guessed word is in the dictionary
        function isAWord(guess, callback){
            $.ajax({url: "checkword.php", data: {word:guess},
                success: function(data){
                    var info = JSON.parse(data);
                    if(info.isWord == "false"){
                        alert("Your guess was not found in the dictionary.");
                        realWord = false;
                    }
                    else {
                        realWord = true;
                    }
                }, onAjaxSuccess: function(){
                    if(realWord){
                        callback();
                    }
                }});
        }

    </script>
</head>
<body>
        <span style="font-family: verdana; "><div class="div"><div class="div1"><h2>Test Your Anagram Skills</h2></div>
                <div id="wordContainer" class="tcontainer">
                    <div class="tcell"><b>Words</b></div>
                    <div class="tcell"><b>Anagrams</b></div>
                    <div id="word1" class="trow"></div>
                </div><br>
                <button class="btn" onclick="newWord()">Try Another Word</button><br><br>
                <input class="defaultTextBox advancedSearchTextBox" type="text" id="inp"><br><br>
                <input class="btn" type="button" onclick="insertGuess()" value="Check Your Guess"></div></span>

</body>
</html>
