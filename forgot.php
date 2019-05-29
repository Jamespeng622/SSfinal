<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<title>Forgot</title>
	<link rel="stylesheet" type="text/css" href="Styles/forgot.css">
</head>


<body>
    <div class="container" id="login">
        <h3>Forgot Password</h3>
        <p>Please enter username and the email your signed up with, and your new password:</p>
            <form method="post">
                Username: <input class="in" type="text" name="username"/><br>
                Email: <input class="in" type="text" name="email"/><br>
                New Password: <input class="in" type="password" name="password"/><br>
                Confirm Password: <input class="in" type="password" name="confirm"/><br>

                <input type="submit" value="Overwrite"/>
            </form>

        <button id="back">Back</button>
    </div>

    <div>
    <?php
        $dbh = new PDO('mysql:host=softwarestudio.2y.idv.tw;dbname=s105030010', 's105030010', 'zxc123654');
        $username = "";
        $password = "";
        $confirm = "";
        $same = true;
        $email = "";
        $check = true;

        if($_POST){
            $check = true;
            $username = $_POST["username"];
            if($username == ""){
                $check = false;
            }

            $email = $_POST["email"];
            if($email == ""){
                $check = false;
            }

            $password = $_POST["password"];
            if($password == ""){
                $check = false;
            }

            $confirm = $_POST["confirm"];
            if($password == $confirm){
                $same = true;
            }else $same = false;
        }

        if($_POST && $check == true && $same == true){
            $username = $_POST["username"];
            $select = $dbh->prepare("select * from final_user where username=?");
            $select->execute([$username]);
            $get = $select->fetch();

            if($get){
                if($email == $get["email"]){
                    $update = "update final_user set password=? where id=?";
                    $stmt = $dbh->prepare($update);
                    $stmt->execute(array($password, $get["id"]));
                    $errmsg = "Reset!";
                    echo $errmsg;
                }else{
                    $errmsg = "Wrong Email!";
                    echo $errmsg;
                }
            }else{
                $errmsg = "User doesn't exist!";
                echo $errmsg;
            }
        }
    ?>
    </div>

    <script type="text/javascript" src="Scripts/forgot.js"></script>

</body>
</html>
