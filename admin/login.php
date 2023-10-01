<?php
    session_start();
    //cek cookie
    if (isset($_COOKIE['login'])){
        if($_COOKIE['login'] == 'true'){
            $_SESSION['login'] = true;
        }
    }
    // if(isset($_SESSION['login'])){
    //     header("Location:index.php");
    //     exit;
    // }
    require "function.php";
    if(isset($_POST['login'])){
        $user = $_POST['user'];
        $pass = $_POST['p1'];
        $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$user'");
        //cek username
        if(mysqli_num_rows($result) === 1){
            //cek password
            $row = mysqli_fetch_assoc($result);
            if($pass == $row['password_2']){
                //set session
                $_SESSION['login'] = true;
                //cek remember me
                if(isset($_POST['remember'])){
                    setcookie('login', 'true', time()+60);
                }
                header('location: index.php?id='.$row['idadmin']);
                exit;
            }
        }$error = true;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            user-select: none;
        }
        .content {
            border-radius: 10px;
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 999;
            text-align: center;
            padding: 60px 32px;
            width: 370px;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid #fff;
            backdrop-filter: blur(3px);
            box-shadow: 0 0 6px 0 rgba(29, 29, 29, 0.21);
        }
        .content header {
            color: #222;
            font-size: 33px;
            font-weight: 600;
            margin: 0 0 35px 0;
            font-family: "Montserrat", sans-serif;
        }
        .field {
            position: relative;
            height: 45px;
            width: 100%;
            display: flex;
            background: rgba(255, 255, 255, 0.95);
        }
        .field span {
            color: #222;
            width: 40px;
            line-height: 45px;
        }
        .field input {
            height: 100%;
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: #222;
            font-size: 16px;
            font-family: "Poppins", sans-serif;
        }
        .field button {
            background: #682efc;
            border: 1px solid #7741fd;
            color: white;
            width: 100%;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            font-family: "Montserrat", sans-serif;
        }
        .field button:hover {
            background: #4a0de4f5;
        }
        .space {
            margin-top: 16px;
        }
        .show {
            position: absolute;
            right: 13px;
            font-size: 13px;
            font-weight: 700;
            color: #222;
            display: none;
            cursor: pointer;
            font-family: "Montserrat", sans-serif;
        }
        .pass-key:valid ~ .show {
            display: block;
        }
        .pass {
            text-align: left;
            margin: 10px 0;
            text-decoration: none;
            font-family: "Poppins", sans-serif;
        }
        .pass:hover label{
            text-decoration: underline;
        }
        .field input[type="submit"] {
            background: #682efc;
            border: 1px solid #7741fd;
            color: white;
            width: 100%;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            font-family: "Montserrat", sans-serif;
        }
        .field input[type="submit"]:hover {
            background: #4a0de4f5;
        }
    </style>
    <title>Login Admin | Adeabbasy.project</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Adeabbasy.project</a>
        </div>
    </nav>
    <div style='background: url("../assets/bglogin.jpg"); height: 100vh; background-size: cover; background-position: center;'>
        <div class="content">
            <header>Login Admin</header>
            <?php if(isset($error)) : ?>
                <p style="color: red; font-style: italic;">Username atau Password salah</p>
            <?php endif; ?>
            <form action="" method="post">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input name="user" type="text" placeholder="Username" required>
                </div>
                <div class="field space">
                    <span class="fa fa-lock" style='color: #222; width: 40px; line-height: 45px;'></span>
                    <input name="p1" type="password" class="pass-key" placeholder="Password" required>
                    <span class="show">SHOW</span>
                </div>
                <div class="pass">
                    <p style='margin-top: 16px;'>
                        <input type="checkbox" name="remember" id="remember"><label for="remember" style='margin-left: 16px;'>Remember Me</label>
                    </p>
                </div>
                <div class="field">
                    <input name="login" type="submit" value="Login">
                </div>
            </form>
            <a href="../index.php"><div class="field" style='margin-top: 16px;'>
                <button>Kembali</button>
            </div></a>
        </div>
    </div>

    <script src="script.js">
        const pass_field = document.querySelector(".pass-key");
        const showBtn = document.querySelector(".show");
        showBtn.addEventListener("click", function () {
            if (pass_field.type === "password") {
                pass_field.type = "text";
                showBtn.textContent = "HIDE";
                showBtn.style.color = "#3498db"
            } else {
                pass_field.type = "password";
                showBtn.textContent = "SHOW";
                showBtn.style.color = "#222"
            }
        })
    </script>
</body>
</html>