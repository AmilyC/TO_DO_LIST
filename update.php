<?php
/*print("<p><input id='id' type='text' placeholder='修改後的id'></p>");
print("<p><input id='thing' type='text' placeholder='修改後要做的事'></p>
        <p><input id='time' type='date' value='time' placeholder='修改後的時間'></p>");*/
$time = $_POST["time"];
$thing = $_POST["thing"];
$id = $_POST["id"];
$account = $_COOKIE["account"];
$oldid = $_POST["oldid"];
$password = $_COOKIE["password"];
if ($id != $oldid) {
    $query = "UPDATE `list` SET `id`=$id,`thing`='$thing',`time`='$time' WHERE `account`= '$account'  AND `id`=$oldid ";
    print("$query");
} else {
    $query = "UPDATE `list` SET `id`=$oldid,`thing`='$thing',`time`='$time' WHERE `account`= '$account'  AND `id`=$oldid ";
    print("$query");
}

if (!($database = mysqli_connect("localhost", "your_account", "your_password")))
    die("Could not connect to database </body></html>");
if (!mysqli_select_db($database, "hw4"))
    die("Could not open hw4 database </body></html>");
if (!($result = mysqli_query($database,  $query))) {
    print("<p>Could not execute query! or you don't type your  update todolist,please try again!</p>");
    die(mysqli_error() . "</body></html>");
}
/*if ($query) {
    //print("<p>update success!</p>");
    print("<table>");
    $i = 0;
    $query = "SELECT `account`,`pw` FROM `user` WHERE `account`
      LIKE '" . $account . "'" . "AND `pw`  LIKE '" . $password . "' IS NULL";
    while ($row = mysqli_fetch_row($result = mysqli_query($database, $query))) {

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
