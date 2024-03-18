<?php
$account = $_POST["account"];
$password = $_POST["password"];
$name = $_POST["name"];

$acexist = "SELECT `account` FROM `user` WHERE `account`= '$account'";
if (!($database = mysqli_connect("localhost", "your_account", "your_password")))
    die("Could not connect to database </body></html>");
if (!mysqli_select_db($database, "hw4"))
    die("Could not open hw4 database </body></html>");
if (mysqli_num_rows($result = mysqli_query($database,  $acexist))>0) {
   
    print("<p>Someone already have the account, please create another one!</p>");
    //print("$acexist");
    //die(mysqli_error() . "</body></html>");
} else {
    $query = "INSERT INTO `user` (`account`, `pw`, `customer`)
    VALUES ('$account', '$password', '$name')";
    //print("$query");
    if (!($database = mysqli_connect("localhost", "your_account", "your_password")))
        die("Could not connect to database </body></html>");
    if (!mysqli_select_db($database, "hw4"))
        die("Could not open hw4 database </body></html>");
    if (!($result = mysqli_query($database,  $query))) {
        print("<p>Could not execute query!</p>");
        die(mysqli_error() . "</body></html>");
    }
    print("<p>create success!</p><a href = hw4.html>back to log in</a>");
}

//print("$acexist");



mysqli_close($database);
