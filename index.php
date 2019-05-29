<?php
    session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Engine</title>
	<link rel="stylesheet" type="text/css" href="Styles/index.css">
</head>

<body>
    <div class="container">
        <h3>Sign in</h3>
            <form method="post">
                Username: <input class="in" type="text" name="username"/><br>
                Password: <input class="in" type="password" name="password"/><br>
                <input type="submit" value="Sign in">
            </form>

            <button id="signup">Sign Up</button>
            <button id="forgot">Forgot Password?</button>
    </div>

    <div>
    <?php
        $errmsg = "";
        $username = "0";
        $password = "0";
        $send = false;
        $login = false;

        if($_POST){
            $dbh = new PDO('mysql:host=softwarestudio.2y.idv.tw;dbname=s105030010', 's105030010', 'zxc123654');
            $username = $_POST["username"];
            $password = $_POST["password"];
            $select = $dbh->prepare("select * from final_user where username=?");
            $select->execute([$username]);
            $get = $select->fetch();

            if($get){
                if($password===$get["password"] && $username!=="0" && $password!=="0"){
                    $login = true;
                    $_SESSION["id"] = $get["id"];
                    $_SESSION["logged"] = $login;
                    $password = "0";
                    $username = "0";
                    echo 'success';
                    $URL="/finalproj/main.php";
                    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                }else{
                    $errmsg = "Wrong Password!";
                    echo $errmsg;
                }
            }else{
                $errmsg = "User doesn't exist!";
                echo $errmsg;
            }
        }
    ?>
    <div>

    <script type="text/javascript" src="Scripts/index.js"></script>
</body>
</html>
