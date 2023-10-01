<?php
    session_start();
    //cek cookie
    if (isset($_COOKIE['loginc'])){
        if($_COOKIE['loginc'] == 'true'){
            $_SESSION['loginc'] = true;
        }
    }
    // if(isset($_SESSION['login'])){
    //     header("Location:index.php");
    //     exit;
    // }
    require ("admin/function.php");
    if(isset($_POST['loginc'])){
        $user = $_POST['email'];
        $pass = $_POST['pass'];
        $result = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$user'");
        //cek username
        if(mysqli_num_rows($result) === 1){
            //cek password
            $row = mysqli_fetch_assoc($result);
            if($pass == $row['pass']){
                //set session
                $_SESSION['loginc'] = true;
                //cek remember me
                if(isset($_POST['remember'])){
                    setcookie('loginc', 'true', time()+60);
                }
                header('location:indexlog.php?idc='.$row['idcustomer']);
                exit;
            }
        }else {
            echo "<script>
                    alert('Gagal Login')
                </script>";
            $error = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI';
            text-decoration: none;
        }
        body {
            width: 100vw;
            height: 100vh;
            display: grid;
            place-items: center;
            background-image: url('assets/bglogin2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .form-container {
        color: white;
        width: 380px;
        background-color: rgba(255, 255, 255, 0.237);
        display: flex;
        margin: 5px;
        flex-direction: column;
        gap: 20px;
        padding: 30px 20px 150px 20px;
        text-align: center;
        border-radius: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 998;
        transform: translate(-50%, -50%);
        border: 1px solid #fff;
        box-shadow: 0 0 6px 0 rgba(29, 29, 29, 0.21);
        }
        .kembali {
            position: absolute;
            z-index: 999;
            top: 67%;
            margin-left: 10px;
        }
        input {
            padding: 8px 10px;
            border-radius: 10px;
            border: none;
            outline: none;
        }
        input[type='checkbox'] {
            accent-color: rgb(5, 211, 183);
            width: 15px;
            height: 15px;
        }
        .remember {
            display: flex;
            justify-content: center;
            gap: 6px;
            align-items: center;
        }
        .remember:hover {
            text-decoration: underline;
        }
        input[type='submit'] {
            padding: 8px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            background-color: rgb(5, 211, 183);
            color: rgba(0, 0, 0, 0.699);
            cursor: pointer;
            font-size: 15px;
        }
        input[type='submit']:hover {
            background-color: rgb(8, 204, 178);
        }
        input[type='submit']:active {
            background-color: rgb(45, 241, 215);
        }
        .kembali button {
            padding: 8px;
            border-radius: 8px;
            width: 338px;
            border: none;
            font-weight: 500;
            background-color: rgb(5, 211, 183);
            color: rgba(0, 0, 0, 0.699);
            cursor: pointer;
            font-size: 15px;
        }
        .kembali button:hover {
            background-color: rgb(8, 204, 178);
        }
        .kembali button:active {
            background-color: rgb(45, 241, 215);
        }
        .login {
            position: absolute;
            display: flex;
            justify-content: center;
            gap: 6px;
            align-items: center;
            z-index: 998;
            color: white;
            top: 73%;
        }
        .login2 {
            position: absolute;
            display: flex;
            justify-content: center;
            gap: 6px;
            align-items: center;
            z-index: 998;
            color: white;
            top: 76%;
        }
        .login2 a {
            color: white;
        }
        .login2 a:hover {
            text-decoration: underline;
        }
        .login a {
            color: white;
        }
        .login a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Login | Adeabbasy.project</title>
</head>
<body>
    <form action="" method="post" class="form-container">
        <h2>LOGIN</h2>
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Email" required>
        <label for="pass">Password</label>
        <input type="password" id="pass" name="pass" placeholder="Password" required>
        <div class="remember">
            <input type="checkbox" name="remember" id="remember"><label for="remember">remember me</label>
        </div>
        <input name="loginc" type="submit" value="Login">
    </form>
    <a href="index.php" class="kembali"><div>
        <button>Kembali</button>
    </div></a>
    <div class="login">Belum punya akun? <a href="register.php">Register</a></div>
    <div class="login2">lupa password? <a href="https://wa.me/6282227774402" target=”_blank”>Hubungi admin</a></div>
</body>
</html>