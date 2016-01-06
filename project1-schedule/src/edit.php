<?php
  //start session for session and cookie variables
  session_start();

  //get name and namefile and count variable
  $name = $_SESSION["name"];
  $count = $_SESSION['count'];

  $namefile = fopen("users.txt", "r+");
  //save lines to array $lines
  $lines = file("users.txt", FILE_IGNORE_NEW_LINES);
  //truncate file because it will need to be overwritten
  ftruncate($namefile, 0);
  //close file
  fclose($namefile);

  //initialize string to an empty string
  $str = "";
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

  $name_length = strlen($name);
  $namefile = fopen("users.txt", "w");

  if (flock($namefile, LOCK_EX)){
    for ($i = 0; $i < count($lines); $i++) {
      $explode = explode("^", $lines[$i]);
      if(strcmp(trim($explode[0]), trim($name)) == 0){
        fwrite($namefile, $str);
      }
      else{
          fwrite($namefile, $lines[$i] . "\n");
      }
    }
  }
  else  {
    echo "error";
  }
  flock($namefile, LOCK_UN);  
  fclose($namefile);

  //redirects back to the table
  header("Refresh:0; url=table.php");
?>
