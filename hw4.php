<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Search Results</title>
    <style type="text/css">
        body {
            font-family: sans-serif;
            background-color: lightyellow;
        }

        table {
            background-color: lightblue;
            border-collapse: collapse;
            border: 1px solid gray;
        }

        td {
            padding: 5px;
        }

        tr:nth-child(odd) {
            background-color: white;
        }
    </style>
</head>

<body>
    <?php
    $account = $_POST["account"];
    $password = $_POST["password"];
    $query =  "SELECT `account`, `pw` FROM `user` WHERE `account` = '" . $account . "' AND `pw` = '" . $password . "'";
    define("FIVE_DAYS", 60 * 60 * 24 * 5); // define constant
    setcookie("account", $_POST["account"], time() + FIVE_DAYS);
    setcookie("password", $_POST["password"], time() + FIVE_DAYS);
    //print("<p>$query</p>");
    if (!($database = mysqli_connect("localhost", "your_account", "your_password")))
        die("Could not connect to database </body></html>");
    if (!mysqli_select_db($database, "hw4"))
        die("Could not open products database </body></html>");
    if (!($result = mysqli_query($database,  $query))) {
        print("<p>Could not execute query!");
        die(mysqli_error() . "</body></html>");
    }
    //print("<p>$query</p>");
    if (mysqli_num_rows($result) <= 0) {
        print("<p>login failed, or you may haven't creat your account!</p>");
        print("<a href='creat.html'>創建帳號</a>");
    } else {

        print("<p>login success!</p>");
        print("<p>below is your to do list:</p>");

        $query2 = "SELECT * FROM `list` WHERE `account`  LIKE '" . $account . "'";
        if (!($result = mysqli_query($database,  $query2))) {
            print("<p>Could not execute query!</P>");
            die(mysqli_error() . "</body></html>");
        }
        print("<table><tr><td>id</td><td>帳號</td><td>事情</td><td>日期</td><td></td></tr>");
        $i = 0;
        $count = 1;
        //抓id
        $queryid = "SELECT * FROM `list` WHERE `account`='$account' ORDER BY `id` ASC";
        //print("$queryid");
        if (!($resultid = mysqli_query($database,  $queryid))) {
            print("<p>Could not execute query!</P>");
            //print("<button class='todo-insert'>新增</button>");
            die(mysqli_error() . "</body></html>");
        }
        //$mysqli= new mysqli("loacalhost","tzu jung","amily0911","hw4");
        //$resultid = $queryid;



        while ($row = mysqli_fetch_assoc($resultid)) {
            printf("<tr class='todo-item' data-id='%s' data-time='%s' >", $row['id'], $row['time']);
            //printf("%s \n", $id["id"]);
            $i = 0;
            foreach ($row as $value) {
                //data-id=0,1,2
                $i++;

                print("<td class='todo-time'> $value</td>");

                if ($i == 2) {
                    setcookie("thing", $value, time() + FIVE_DAYS);
                }
            }
            print("<td><button class='todo-edit'>編輯</button>
            <button class='todo-delete'>刪除</button></div></td>");
            print("</tr>");
        }
        print("</table>");
        print("<button class='todo-insert'>新增</button>");
        mysqli_close($database);
    }

    ?>
</body>

</html>