<?php
session_start();

//db variables
$DB_USER="root";
$DB_PASSWORD="";
$DB_HOST="localhost";
$DB_DATABASE="assignment3";
$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_DATABASE);

//calculate category id
$date = getdate()["yday"];
$num_cat = mysqli_num_rows(mysqli_query($con, "SELECT * FROM Categories"));
$c_id = $date % $num_cat;


//starting new session with number and userid, adding user to db
if(!isset($_SESSION["num"])){
    if(isset($_COOKIE["user_cookie"])){
        echo "invalid_user";
        exit;
    }
    setcookie("user_cookie",0,strtotime('today 23:59'), '/');
    $_SESSION["num"] = 1;
    $_SESSION["u_id"] = $u_id = mysqli_num_rows(mysqli_query($con, "SELECT * FROM Results"));
    $u_id = $_SESSION["u_id"];
    mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Results` (`U_id`, `C_id`, `correct`, `total`) VALUES ('$u_id', '$c_id', '0', '0')");
} else {
    $_SESSION["num"] += 1;
}

//grabs session variables
$u_id = $_SESSION["u_id"];
$q_num = $_SESSION["num"];
$prev_q_num = $q_num - 1;
$prev_answer_num = $_POST["answer"];

//comparing user choice with choices from database
$result = mysqli_query($con, "SELECT * FROM Questions WHERE `C_id`='$c_id' AND `Q_num`='$prev_q_num'");
$row = mysqli_fetch_assoc($result);
$choice = "";
if($prev_answer_num == 0){
    $choice = $row['Q_choiceA'];
} else if ($prev_answer_num == 1){
    $choice = $row['Q_choiceB'];
} else {
    $choice = $row['Q_choiceC'];
}

//get total correct and attempted in the db for the user
$result = mysqli_query($con, "SELECT * FROM Results WHERE `C_id`='$c_id' AND `U_id`='$u_id'");
$row1 = mysqli_fetch_assoc($result);
$current_correct = $row1["correct"];
$current_attempted = $row1["total"];

//make appropriate updates
if($choice == $row['Q_correct_choice'] && $q_num != 1){
    $current_correct += 1;
    $current_attempted +=1;
    mysqli_query($con, "UPDATE Results SET `correct`='$current_correct', `total`='$current_attempted' WHERE `U_id`='$u_id'");
}
else if ($q_num != 1){
    $current_attempted += 1;
    mysqli_query($con, "UPDATE Results SET `correct`='$current_correct', `total`='$current_attempted' WHERE `U_id`='$u_id'");
}

//grabs info for next question to send back to the database
$row = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Questions WHERE `C_id` = '$c_id' AND `Q_num` = '$q_num'"));
$total_questions = mysqli_num_rows(mysqli_query($con, "SELECT * FROM Questions WHERE `C_id` = '$c_id'"));
$row["total_num_questions"] = $total_questions;
$row["prev_answer_num"] = $prev_answer_num;

//if quiz is done gets proper information to send back for rendering
if(($total_questions+1) == $q_num) {
    $result = mysqli_query($con, "SELECT * FROM Results WHERE `C_id`='$c_id' AND `U_id`='$u_id'");
    $row1 = mysqli_fetch_assoc($result);

    $user_correct = $row1["correct"];
    $user_attempted = $row1["total"];

    mysqli_query($con, "INSERT INTO `" . $DB_DATABASE . "`.`Averages` (`C_id`, `correct`, `total`) VALUES ('$c_id', '$user_correct', '$user_attempted')");

    $result = mysqli_query($con, "SELECT * FROM Averages WHERE `C_id`='$c_id'");
    $total_correct=0;
    $total_attempted=0;

    while ($row1 = mysqli_fetch_assoc($result)) {
        $total_correct += $row1["correct"];
        $total_attempted += $row1["total"];
    }

    //declares array to be sent through JSON
    $result_array = array(
        "user_correct" => $user_correct,
        "user_attempted" => $user_attempted,
        "total_correct" => $total_correct,
        "total_attempted" => $total_attempted,
        "quiz_finished" => "true",
    );

    $JSONStringResults = json_encode($result_array);
    echo $JSONStringResults;
    session_destroy();
}
else{
    //if quiz isn't over sends question info
    $JSONStringQuestion = json_encode($row);
    echo $JSONStringQuestion;
}

mysqli_close($con);
?>