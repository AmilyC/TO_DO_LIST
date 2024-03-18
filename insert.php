<?php
$time = $_POST["time"];
$thing = $_POST["thing"];
$id = $_POST["id"];
$account = $_COOKIE["account"];
$password = $_COOKIE["password"];
$query = "INSERT INTO `list`(`id`, `thing`, `time`, `account`) VALUES ('$id','$thing','$time','$account')";
if (!($database = mysqli_connect("localhost", "your_account", "your_password")))
    die("Could not connect to database </body></html>");
if (!mysqli_select_db($database, "hw4"))
    die("Could not open hw4 database </body></html>");
if (!($result = mysqli_query($database,  $query))) {
    print("<p>Could not execute query!</p>");
    die(mysqli_error() . "</body></html>");
}
/*if ($query) {
    //print("<p>insert success!<p>");
    print("<table>");
    $i = 0;
    $query = "SELECT `account`,`pw` FROM `user` WHERE `account`
      LIKE '" . $account . "'" . "AND `pw`  LIKE '" . $password . "' IS NULL";
    while ($row = mysqli_fetch_row(mysqli_query($database,  $query))) {

        print("<tr>");
        foreach ($row as $value) {
            //data-id=0,1,2
            print("<td><div class='todo-item' data-id='42'> $value  ");
            $i++;
            if ($i == 1) {
                setcookie("id", $value, time() + FIVE_DAYS);
            }
            if ($i == 2) {
                setcookie("thing", $value, time() + FIVE_DAYS);
            }
            if ($i == 3) {
                setcookie("time", $value, time() + FIVE_DAYS);
            }
        }
        print("<button class='todo-edit'>編輯</button>
            <button class='todo-delete'>刪除</button></div></td>");
        print("</tr>");
    }
    print("</table>");
    print("<button class='todo-insert'>新增</button>");
}*/

mysqli_close($database);
