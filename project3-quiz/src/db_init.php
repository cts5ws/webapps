<?php

//set user variables
$DB_USER="root";
$DB_PASSWORD="";
$DB_HOST="localhost";
$DB_DATABASE="assignment3";

//open connection
$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_DATABASE);

//insertion of categories
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Categories` (`C_id`, `C_name`) VALUES ('0', 'Math')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Categories` (`C_id`, `C_name`) VALUES ('1', 'Animal Noises')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Categories` (`C_id`, `C_name`) VALUES ('2', 'State Capitols')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Categories` (`C_id`, `C_name`) VALUES ('3', 'UVa Questions')");

//insertion of math questions
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('0', '1', 'What is 1+1?', '2', '4', '1', '2')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('0', '2', 'What is 2+2?', '2', '4', '1', '4')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('0', '3', 'What is 3*1?', '1', '5', '3', '3')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('0', '4', 'What is 6/2?', '3', '7', '2', '3')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('0', '5', 'What is 18/6?', '2', '3', '4', '3')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('0', '6', 'What is 1+4?', '5', '2', '8', '5')");

//insertion of animal noises questions
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('1', '1', 'What animal goes Moo?', 'cow', 'pig', 'human', 'cow')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('1', '2', 'What animal goes Meow?', 'bird', 'cat', 'turtle', 'cat')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('1', '3', 'What animal goes Woof', 'duck', 'fish', 'dog', 'dog')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('1', '4', 'What animal goes Neyyy?', 'horse', 'pig', 'cat', 'horse')");

//insertion of state questions
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('2', '1', 'What is the capitol of Virginia?', 'Nova', 'Richmond', 'Charlottesville', 'Richmond')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('2', '2', 'What is the capitol of Michigan?', 'Detroit', 'Troy', 'Lancing', 'Lancing')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('2', '3', 'What is the capitol of West Virginia?', 'Charleston', 'Ivy', 'Bluefield', 'Charleston')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('2', '4', 'What is the capitol of California?', 'Sacramento', 'San Francisco', 'Los Angeles', 'Sacramento')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('2', '5', 'What is the capitol of New York?', 'Queens', 'Brooklyn', 'Albany', 'Albran')");

//uva questions
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('3', '1', 'Who founded UVa?', 'George Washington', 'Thomas Jefferson', 'John Adams', 'Thomas Jefferson')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('3', '2', 'What building houses the CS Department?', 'Rice Hall', 'Thorton Hall', 'Olsson Hall', 'Rice Hall')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Questions` (`C_id`, `Q_num`, `Q_question`, `Q_choiceA`, `Q_choiceB`, `Q_choiceC`, `Q_correct_choice`) VALUES ('3', '3', 'What is the most iconic building on Grounds?', 'Chem Building', 'Scott Stadium', 'The Rotunda', 'The Rotunda')");

mysqli_close($con);
header("Refresh:0; url=quiz.html");

?>