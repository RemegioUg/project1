<?php
session_start();
include("connection.php");
include("functions.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    if(!empty($user_name) && !empty($password))
    {
        //read from db
        $query = "select * from admin where user_name = '$user_name' limit 1 "; 
        
        $result =  mysqli_query($con, $query);
        if($result)
        {
            if($result && mysqli_num_rows($result)>0) 
            {
                $user_data = mysqli_fetch_assoc($result);
             if($user_data['password'] === $password)
             {
                $_SESSION['user_id'] = $user_data['user_id'];
                 header("location: Admin.php");
                  die; 
             }
            } 
        }
        echo "wrong user name or password";
    }
    else
    {
        echo "please enter valid information";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="./Resources/code-base2.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <title>Login</title>
    <style>
        .body {
            height: 100%;
        }
        
        .login {
            width: 40%;
            margin: 10% auto;
            background-color: rgb(53, 52, 52);
        }
        
        .header {
            color: white;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            font-size: 2rem;
            font-weight: bold;
            display: grid;
            grid-template-columns: repeat(1, 1fr);
        }
        
        form div {
            width: 60%;
            margin: auto;
            padding: .5rem;
            display: grid;
            grid-template-columns: repeat(1, 1fr);
        }
        
        input {
            margin-left: 2rem;
            padding: .5rem .5rem .5rem 5rem;
            color: white;
            outline: none;
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: 1px solid white;
            background-color: rgb(53, 52, 52);
            display: grid;
            grid-template-columns: repeat(1, 1fr);
        }
        
        span button {
            margin-top: 1rem;
            margin-bottom: 1rem;
            margin-left: 40%;
            justify-content: center;
            align-items: center;
            padding: .5rem;
            width: 100px;
            display: grid;
            grid-template-columns: repeat(1, 1fr);
        }
        
        @media only screen and (max-width: 1000px) {
            .body {
                width: 100%;
                grid-template-columns: repeat(1, 1fr);
            }
            .login {
                grid-template-columns: repeat(1, 1fr);
            }
            .header {
                width: 100%;
                grid-template-columns: repeat(1, 1fr);
            }
            form div {
                width: 100%;
                margin: auto;
                grid-template-columns: repeat(1, 1fr);
            }
            input {
                width: 100px;
                grid-template-columns: repeat(1, 1fr);
                left: 0;
                margin-left: .5rem;
                margin-left: 2rem;
                padding: 0rem 0rem 0rem .8rem;
                border-bottom: 1px solid white;
                background-color: rgb(53, 52, 52);
                display: grid;
                grid-template-columns: repeat(1, 1fr);
            }
            span button {
                margin-top: 1rem;
                margin-bottom: 1rem;
                margin-left: 2rem;
                justify-content: center;
                align-items: center;
                padding: .5rem;
                width: 100px;
                display: grid;
                grid-template-columns: repeat(1, 1fr);
            }
        }
    </style>
</head>

<body>
    <div class="body">
        <div class="login">
            <div class="header">
                <span>Food Ordering System</span>

            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div><input type="text" placeholder="user-name" required name="user_name"></div>
                <div><input type="password" placeholder="password" required name="password"></div>

                <span> <button class="btn btn-primary text-white">Login </button></sp>
            </form>
        </div>
    </div>
</body>

</html>