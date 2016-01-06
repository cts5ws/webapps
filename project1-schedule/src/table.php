<?php
  //starts session
  session_start();

  //initial html markups outputted
  echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN'>
  <html>
  <head><center>Select Your Meeting Times</center></head>
  <body>
  <table border='1'>
    <tr>
      <th>User</th>
      <th>Action</th>";

  $array = [];
  for ($i=0; $i<2000; $i++){
    $array[$i] = 0;
  }
  //schedule file is openssl_private_decrypt
  $file = fopen('schedule.txt', 'r');
  $count = 0;

  //while loop adds dates across the top of the doodle poll
  while(($line = fgets($file)) !== false){
    //reads dates
    $line_split = explode('^', $line);
    //reads times
    $times = explode('|', $line_split[1]);
    $day = date('l', strtotime($line_split[0]));
    //echos first row of the table
    foreach($times as $value){
      echo "<th> $day \n $line_split[0]  \n  $value  </th>";
      $count++;
    }
  }
  //closes schedule.txt file for reading
  fclose($file);
  //uses SESSION to make the count variable available to other scripts
  $_SESSION['count'] = $count;

  echo "</tr>";

  //opens users.txt file for reading
  $file = fopen("users.txt", "c+");
  //reads through the users.txt file
  while(($line = fgets($file)) !== false){
    $temp = 0;
    echo "<tr>";
    $line_split = explode("^", $line);
    $dates = explode("|", $line_split[1]);
    $name = $line_split[0];

    //checks if edit variable is sets and a cookie exists for the name currently being read
    if(isset($_POST['edit']) && $_POST['edit'] == $name && isset($_COOKIE[str_replace(' ','',$name)])){
      $_SESSION['name'] = $name;
      echo "<tr>
              <td>$name</td>
              <td>
                <form action='edit.php' method='POST'><input type='submit' value='Submit'/>
              </td>";


      //adds checkboxes to the screen
      for ($i = 0; $i < $count; $i++){
        //adds checkbox if it was previously checked
        if ($i == $dates[$temp] ){
          echo "<td><center><input type='checkbox' name=$i checked></center></td>";
          $temp++;
          if ($temp >= count($dates)){
            $temp = count($dates) - 1;
          }
        }
        //otherwise adds plain checkbox
        else{
          echo "<td><center><input type='checkbox' name=$i></center></td>";
        }
      }
      echo "</form>";

    }
    //if no cookie exists prints row like Normal
    else{
      echo "<td>$name</td>";
      //if cookie exists add the edit button
      if(isset($_COOKIE[str_replace(' ','',$name)])){
        echo "<td>
                <form action ='table.php' method='post'>
                  <button name='edit' value='$name'>Edit</button>
                </form>
              </td>";
      }
      //if no cookie exists add a blank cell under the action column for the given namme
      else{
      echo "<td></td>";
      }

      //prints checkmarks in the cells that the user put has entered as free times
      for ($i = 0; $i < $count; $i++){
        if ($i == $dates[$temp] ){
          echo "<td> <p><center> &#10004 </center></p> </td>";

          $array[$i]++;

          $temp++;
          if ($temp >= count($dates)){
            $temp = count($dates) - 1;
          }
        } else {
          echo "<td></td>";
        }
      }
      echo "</tr>";
    }
  }
  //closes users.txt file from being read
  fclose($file);

  //checks to see if the new button has been pressed in this session
  if (isset($_POST['new'])){
    //if so adds a textfield, submit button, and checkboxes
    echo "<tr>
            <td>
              <form action='new.php' method='POST'>
                <input type='text' name='name' style='width: 100px;'>
            </td>
            <td>
              <input type='submit' value='Submit'/>
            </td>";
    //checkboxes being added
    for ($i = 0; $i < $count; $i++){
      echo "<td><center><input type='checkbox' name=$i></center></td>";
    }
    echo "</form>";
  }
  //if new button hasn't been pressed...
  else{
    //echos mostly empty cells with a new button
    echo "<tr><td></td>";
    echo "<td>
            <form action ='table.php' method='post'>
              <button name='new' value='true'>New</button>
            </form>
          </td>";
    for ($i = 0; $i < $count; $i++){
      echo "<td></td>";
    }
  }
  echo "</tr>";

  echo "<tr><td>Total</td><td></td>";
  for ($i = 0; $i < $count; $i++){
    echo "<td><center> $array[$i] </center></td>";
  }

  echo "</table>
      </body>
    </html>";
?>
