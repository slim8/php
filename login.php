<?php
session_start();
if(isset($_SESSION['loggedin'])){
    if($_SESSION['loggedin']){
    header('location:dashboard.php');
}}

include'db.php';
//login
if (isset($_POST['submit']))

{
    $password = $_POST['password'];
    $pass = md5($password);
    $email = $_POST['email'];
    if ((! $password)||(! $email))
    {   //echo $pass;
        $_SESSION['flash']['danger'] = "input field should not be empty.";
        header('location:login.php');
        exit();
    }
    else{
       // echo "select * from users where email = '$email' and password = '$pass'";
        $sql = $db->query("select * from usres where email = '$email' and password = '$pass'");
        $row_cnt = $sql->num_rows;
        if ($row_cnt==1){
            $user = $sql->fetch_object();
            $_SESSION['id'] = $user->id;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $user->role;
            $_SESSION['username'] = $user->first_name.' '.$user->last_name;
            $_SESSION['loggedin'] = true;

            header('location:dashboard.php');

        }else{
            $_SESSION['flash']['danger'] = "email/password is incorrect..";
            header('location:login.php');
            exit();
        }
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>

<div class="container">

    <div class="row col-md-4 offset-md-4">
        <div class="card mt-5">
            <div class="card-body">

                <h5 class="card-title">Login</h5>
                <hr>

                <?php if(isset($_SESSION['flash'])):?>
                    <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                        <div class="alert alert-<?=$type?>"><?=$message;?></div>
                    <?php endforeach; ?>
                    <?php unset($_SESSION['flash']); ?>
                <?php endif; ?>


                <form style="width: 100%" method="post">
                    <div class="form-group">

                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-block" >Submit</button>
                </form>
            </div>
        </div>

</div>
</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
-->
</body>
</html>