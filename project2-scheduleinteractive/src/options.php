<?php
session_start();

if(!isset($_SESSION["valid_login"])){
    header("Refresh:0; url=login.php");
}
?>


<div style="text-align: center;">
    <h1>
        <p>
            Scheduling Options
        </p>
    </h1>
</div>

<div style="text-align: center;">
    <p>
        click here to make a new schedule
    </p>
</div>

<div style="text-align: center;">
    <form action="new_schedule.php">
        <input type="submit" value="NEW SCHEDULE">
    </form>
</div>

<div style="text-align: center;">
    <p>
        click here to finalize a schedule
    </p>
</div>

<div style="text-align: center;">
    <form action="finalize_schedule.php">
        <input type="submit" value="FINALIZE">
    </form>
</div>

<div style="text-align: center;">
    <p>
        click here to log out
    </p>
</div>

<div style="text-align: center;">
    <form action="log_out.php">
        <input type="submit" value="LOGOUT">
    </form>
</div>
