<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<title>Forum</title>
	<link rel="stylesheet" type="text/css" href="Styles/signup.css">
</head>

<body>
    <div class="container">
        <h3>Sign Up</h3>
            <form method="post">
                Username: <input class="in" type="text" name="username"/><br>
                Password: <input class="in" type="password" name="password"/><br>
                Confirm password: <input class="in" type="password" name="confirm"/><br>
                Email: <input class="in" type="text" name="email"/><br>

                <input type="submit" value="Sign Up"/>
            </form>
        <button id="back">Back</button>
    </div>

    <div>
    <?php
        $dbh = new PDO('mysql:host=softwarestudio.2y.idv.tw;dbname=s105030010', 's105030010', 'zxc123654');
        $username = "0";
        $password = "0";
        $confirm = "";
        $same = true;
        $email = "";
        $check = true;

        if($_POST){
            $check = true;
            $username = $_POST["username"];
            if($username === "" || $username === " "){
                $check = false;
            }

            $password = $_POST["password"];
            if($password === "" || $password === " "){
                $check = false;
            }

            $confirm = $_POST["confirm"];
            if($password === $confirm){
                $same = true;
            }else $same = false;

            $email = $_POST["email"];
            if($email === "" || $email === " "){
                $check = false;
            }
        }

        if($check === true && $same === true && $username !== ""&&
        $password !== "" && $confirm !== "" && $email !== ""){
            $new = "insert into final_user (username, password, email) values (?, ?, ?)";

            $dbh->prepare($new)->execute(array($username, $password, $email));
            $_POST = array();
            echo 'success';
        }else{
            if($check == false){
                $errmsg = "Invalid information!";
                echo $errmsg;
            }else if($same == false){
                $errmsg = "Check password again!";
                echo $errmsg;
            }
        }
     ?>
    </div>

    <script type="text/javascript" src="Scripts/signup.js"></script>
</body>
</html>
