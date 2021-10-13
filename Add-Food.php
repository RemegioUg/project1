<?php
session_start();
$_SESSION;
include("connection.php");
include("functions.php");
$user_data = check_login($con);

if(isset($_POST["add_food"])){
    
    $food = mysqli_real_escape_string($con, $_POST['food']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $image = mysqli_real_escape_string($con, $_POST['image']);
   
   
        $sql = "SELECT * FROM food_category WHERE food = '$food'";
        $result = mysqli_query($con, $sql);
        $user = mysqli_fetch_assoc($result);
        
     
            $sqlr = "INSERT INTO food_category (food, description, price, image)
                    VALUES('$food', '$description', '$price', '$image')";
            $results = mysqli_query($con, $sqlr);

            if (!$results) {
                echo "food not inserted Failed!!!";
            }else {
                echo "food inserted successively.";
            }
        }
   
    


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="./Resources/code-base2.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>Food|Oredering|System</title>
    <link rel="stylesheet" href="./bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <script src="./bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href='./font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css'> </head>
<link rel="stylesheet" href="./style.css">
<style>
     :root {
        --main-color: #622baa;
        --color-dark: #1D2231;
        --text-grey: #8390A2;
    }
    
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        list-style: none;
        text-decoration: none;
        font-family: 'poppins', sana-serif;
    }
    
    .sidebar {
        width: 345px;
        position: fixed;
        left: 0;
        top: 0;
        height: 100%;
        background-color: rgb(34, 33, 33);
        z-index: 100;
        transition: width 300ms;
    }
    
    .sidebar-brand {
        height: 90px;
        padding: 1rem 0rem 0rem 1rem;
        color: white;
    }
    
    .sidebar-menu {
        margin-top: 1rem;
    }
    
    .sidebar-menu li {
        width: 100%;
        margin-bottom: 1.9rem;
        padding-left: 2rem;
    }
    
    .sidebar-menu a {
        padding-left: 1rem;
        display: block;
        color: white;
        font-size: 1.2rem;
    }
    
    .active {
        padding: 1rem;
    }
    
    .sidebar-menu a.active {
        background-color: white;
        padding-top: 1rem;
        color: var(--main-color);
        border-radius: 30px 0px 0px 30px;
    }
    
    .sidebar-menu a i {
        font-size: 1.5rem;
        padding-right: 1.5rem;
    }
    
    .sidebar-menu a i:first-child {
        font-size: 1.5rem;
        padding-top: .5rem;
        padding-bottom: .5rem;
        color: white;
        border-radius: 30px 0px 0px 30px;
    }
    
    .sidebar-menu a i:first-child {
        font-size: 1.5rem;
        padding-right: 1rem;
    }
    
    #nav-toggle:checked+.sidebar {
        width: 100px;
    }
    
    #nav-toggle:checked+.sidebar {
        width: 100px;
    }
    
    #nav-toggle:checked+.sidebar .sidebar-brand,
    #nav-toggle:checked+.sidebar li a {
        padding-left: 1rem;
        text-align: left;
    }
    
    #nav-toggle:checked+.sidebar li a {
        padding-left: 0rem;
    }
    
    #nav-toggle:checked+.sidebar .sidebar-brand h2 i:last-child,
    #nav-toggle:checked+.sidebar li a i:last-child {
        display: none;
    }
    
    #nav-toggle:checked~.main-content {
        margin-left: 100px;
    }
    
    #nav-toggle:checked~.main-content header {
        width: calc(100%-100px);
        left: 100px;
    }
    
    .main-content {
        transition: marin-left 300ms;
        margin-left: 345px;
    }
    
    header {
        display: flex;
        justify-content: space-between;
        padding: 1.3rem 1.5rem;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        position: fixed;
        left: 345px;
        width: calc(100% - 345px);
        top: 0;
        z-index: 100;
        transition: left 300ms;
    }
    
    header h2 {
        color: #222;
    }
    
    header label i {
        font-size: 1.7rem;
        padding-right: 1rem;
    }
    
    .search-wrapper {
        border: 1px solid #ccc;
        border-radius: 30px;
        height: 50px;
        display: flex;
        align-items: center;
        overflow-x: hidden;
    }
    
    .search-wrapper i {
        display: inline-block;
        padding: 0rem 1rem;
        font-size: 1.5rem;
        color: #757575;
    }
    
    .search-wrapper input {
        height: 100%;
        padding: .5rem;
        border: none;
        outline: none;
        font-size: 1.5rem;
    }
    
    .user-wrapper {
        display: flex;
        align-items: center;
    }
    /* .user-wrapper img {
        border-radius: 100%;
        margin-right: 1rem;
    } */
    
    .user-wrapper small {
        display: inline-block;
        color: var(--text-grey);
        margin-left: .5rem;
        font-size: 1.5rem;
        font-weight: bold;
    }
    
    main {
        margin-top: 85px;
        padding: 2rem 1.5rem;
        background-color: #f1f5f9;
        min-height: calc(100vh - 90px);
    }
    
    .cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 2rem;
        margin-bottom: 1rem;
    }
    
    .card-single {
        display: flex;
        justify-content: space-between;
        background-color: #fff;
        padding: 2rem;
        border-radius: 2px;
    }
    
    .card-single div:last-child i {
        font-size: 3rem;
        color: var(--main-color);
    }
    
    .card-single div:first-child span {
        color: var(--text-grey);
        font-size: 1.3rem;
        font-weight: regular;
    }
    
    @media only screen and (max-width:1200px) {
        .sidebar {
            width: 100px;
        }
        .sidebar .sidebar-brand,
        .sidebar li {
            padding-left: 1rem;
            text-align: center;
        }
        .sidebar li a {
            padding-left: 0rem;
        }
        .sidebar .sidebar-brand h2 i:last-child,
        .sidebar li a i:last-child {
            display: none;
        }
        .main-content {
            margin-left: 100px;
        }
        .main-content header {
            width: calc(100%-100px);
            left: 100px;
        }
        .sidebar:hover {
            width: 345px;
            z-index: 200;
        }
        .sidebar:hover .sidebar-brand,
        .sidebar:hover li {
            padding-left: 1rem;
            text-align: left;
        }
        .sidebar:hover li a {
            padding-left: 0rem;
        }
        .sidebar:hover .sidebar-brand h2 i:last-child,
        .sidebar:hover li a i:last-child {
            display: inline;
        }
    }
    
    @media only screen and (max-width: 768px) {
        .cards {
            grid-template-columns: repeat(2, 1fr);
        }
        .recent-grid {
            width: 100%;
            grid-template-columns: 100%;
        }
        .search-wrapper {
            display: none;
        }
        .sidebar {
            left: -100% !important
        }
        header h2 {
            display: flex;
            align-items: center;
        }
        header h2 label {
            background: var(--main-color);
            display: inline-block;
            padding-right: 0rem;
            margin-right: 1rem;
            height: 40px;
            width: 40px;
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center !important;
        }
        header h2 i {
            text-align: center;
            padding-right: 0rem;
        }
        header h2 {
            font-size: 1.1rem;
        }
        .main-content {
            width: 100%;
            margin-left: 0rem;
        }
        header {
            width: 100% !important;
            left: 0 !important;
        }
        #nav-toggle:checked+.sidebar {
            left: 0 !important;
            z-index: 100;
            width: 345px;
        }
        #nav-toggle:checked+.sidebar .sidebar-brand,
        #nav-toggle:checked+.sidebar li {
            padding-left: 2rem;
            text-align: left;
        }
        #nav-toggle:checked+.sidebar li a {
            padding-left: 1rem;
        }
        #nav-toggle:checked+.sidebar .sidebar-brand h2 i:last-child,
        #nav-toggle:checked+.sidebar li a i:last-child {
            display: inline;
        }
        #nav-toggle:checked+.main-content {
            margin-left: 0rem !important;
        }
    }
    
    @media only screen and (max-width: 560px) {
        .cards {
            grid-template-columns: 100%;
        }
        .recent-grid {
            grid-template-columns: 100%;
        }
    }
    
    .recent-grid {
        margin-top: 3.5rem;
        display: grid;
        grid-gap: 2rem;
        grid-template-columns: repeat(1, ifr);
    }
    
    .card {
        background-color: white;
        border-radius: 5px;
    }
    
    .card-header {
        padding: 1rem;
    }
    
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .card-header button {
        background-color: var(--main-color);
        border-radius: 10px;
        color: white;
        font-size: .8rem;
        padding: .5rem 1rem;
        border: 1px solid var(--main-color);
    }
    
    .card-header button a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        font-size: .8rem;
    }
    
    table {
        border-collapse: collapse;
    }
    
    thead tr {
        border-top: 1px solid #f0f0f0;
        border-bottom: 2px solid #f0f0f0;
    }
    
    td {
        padding: .5rem 1rem;
        font-size: .9rem;
        color: #222;
    }
    
    tr td:last-child {
        display: flex;
        align-items: center;
    }
    
    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }
    
    thead tr td {
        color: #622baa;
        font-weight: bolder;
        font-size: large;
    }
    
    .bo {
        display: flex;
        padding: 1rem;
    }
    
    .bo h {
        font-weight: bolder;
    }
    
    .bo a {
        float: left;
    }
</style>

<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2>Food Ordering System</h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="Admin.php" class="active nav-link"><i class="fa fa-igloo"></i> <i>Dashboard</i> </a>
                </li>
                <li>
                    <a href="Admin.php" class="nav-link"><i class="fa fa-book fa-lg"></i> <i>Customers</i> </a>
                </li>
                <li>
                    <a href="Orders.php" class="nav-link"><i class="fa fa-users fa-lg"></i> <i>Orders</i> </a>
                </li>
                <li>
                    <a href="Food.php" class="nav-link"><i class="fa fa-drivers-license-o fa-lg"></i> <i>Foods</i> </a>
                </li>

                <li>
                    <a href="logout.php" class="nav-link"><i style="color: red;" class="fa fa-power-off fa-lg"></i><i>Log Out</i> </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle"><i class="fa fa-bars"></i></label> Dashboard
            </h2>
            <div class="search-wrapper">
                <i class="fa fa-search"></i>
                <input type="search" placeholder="search here">
            </div>
            <div class="user-wrapper">
                <!-- <img src="Resources/code-base2.png" width="30px" height="40px" alt=""> -->
                <h4></h4>
                <small>Admin</small>
            </div>
        </header>
        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1> <?php
                                    $usql = "SELECT * FROM users";
                                    $uresult= mysqli_query($con, $usql);
                                    echo mysqli_num_rows($uresult);    
                                ?></h1></h1>
                        <span>Customers </span>
                    </div>
                    <div>
                        <i class="fa fa-users"></i>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>10</h1>
                        <span>Orders </span>
                    </div>
                    <div>
                        <i class="fa fa-book"></i>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php
                                    $usql = "SELECT * FROM food_category";
                                    $uresult= mysqli_query($con, $usql);
                                    echo mysqli_num_rows($uresult);    
                                ?></h1>
                        <span>Foods </span>
                    </div>
                    <div>
                        <i class="fa fa-coffee"></i>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>0</h1>
                        <span>pending Orders </span>
                    </div>
                    <div>
                        <i class="fa fa-id-card"></i>
                    </div>
                </div>
            </div>
            <div class="recent-grid">
                <div class="manage-books">
                    <div class="card">
                    <div class="card-header">

                    <a href="Food.php" class="nav-link">Back</a>
                    </div>
                        <div class="card-body">
                            <div class="login">

                                <form method="post" action="">

                                    <div class="inp ">
                                        <input type="text" class=" form-group " placeholder="Food Name" required name="food">
                                        <textarea class="form-group " placeholder="Food Description" id=" " rows="3 " name="description"></textarea>
                                        <input type="text" class=" form-group " placeholder="Price" name="price" required>
                                        <input type="file" class=" form-group " placeholder="Price" name="image" id="image" required accept="png|mpg">
                                    </div>

                                    <span> <button class="btn btn-primary text-white "  id="add_food" name="add_food">Add </button></sp>
                                </form>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
<script>
$(document).ready(function(){
    $('#add_food').click(function(){
        var image_name =$('#image').val();
        if(image_name ==''){
alert("please select image");
return false;
        }
        else{
            var extention = $('#image').val().split(.).pop().toLoowerCase();
            if(jQuery. inArray(extention, ['gif', 'png', 'jpg', 'jpeg' ]) == -1){
                alert('Invalid image file');
                $('#image').val('');
                return false;
            }
        }
    }
});
</script>