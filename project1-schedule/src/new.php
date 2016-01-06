<?php
  //start session for session and cookie variables
  session_start();

  //get name and namefile and count variable
  $name = $_POST["name"];
  $namefile = fopen("users.txt", "a");
  $count = $_SESSION['count'];
  //initialize string to an empty string
  $str = "";

  //adds numbers to str to be appended based on what the user checked
  for ($i = 0; $i < $count; $i++){
    if(isset($_POST[$i])){
      $str .= $i."|";
    }
  }

  //remove the last '|' from the string
  $str = trim($str, "|");
  //fully concatenating the to be appended string
  $str = $name . "^" . $str . "\n";
  //removes spaces from cookie name and sets the cookie
  $temp_name = str_replace(' ','',$name);
  setcookie($temp_name, str_replace(' ', '^', $name));

  //writes to the users.txt file with a new entry
  if (flock($namefile, LOCK_EX)) {
    fwrite($namefile, $str);
  } else  {
    echo "error";
  }
  flock($namefile, LOCK_UN);
  fclose($namefile);

  //redirects back to the table
  header("Refresh:0; url=table.php");
?>
