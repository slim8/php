<?php
session_start();


    include'db.php';
    $sql = $db->query("select * from events order by name");
    //insert event
    if (isset($_POST['submit']))

    {

        $gender = htmlspecialchars($_POST['gender']);
        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $email = htmlspecialchars($_POST['email']);
        $company = htmlspecialchars($_POST['company']);
        $position = htmlspecialchars($_POST['position']);
        $street = htmlspecialchars($_POST['street']);
        $street_number = htmlspecialchars($_POST['street_number']);
        $zip_code = htmlspecialchars($_POST['zip_code']);
        $state = htmlspecialchars($_POST['state']);
        $country = htmlspecialchars($_POST['country']);
        $reason = htmlspecialchars($_POST['reason']);
        $birth_date = ($_POST['birth_date']);


            $participant = $db->query("insert into participants set gender = '$gender',first_name = '$first_name',
                    last_name = '$last_name',
                    birth_date = '$birth_date',
                    email = '$email',
                    company = '$company', 
                    position = '$position',
                    street = '$street',
                    street_number = '$street_number',
                    zip_code = '$zip_code',
                    state = '$state',
                    country = '$country',
                    reason = '$reason'
                    ");
            if ($participant)
            {
                $_SESSION['flash']['success'] = "Done !";
                header('location:index.php');
                exit();
            }
            else {
                $_SESSION['flash']['danger'] = "Error !";
                header('location:index.php');
                exit();
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
    <img src="assets/images/bg.jpg" class="img-fluid" width="100%">
    <h3>Application form</h3>
    <hr>
    <?php if(isset($_SESSION['flash'])):?>
        <?php foreach ($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?=$type?>"><?=$message;?></div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
    <div class="row col-md-6 offset-md-3">
    <form style="width: 100%" method="post">

        <div class="form-group">
            <label for="gender">Gender</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                <label class="form-check-label" for="female">Female</label>
            </div>
        </div>
        <div class="form-group">
            <label for="first">First name</label>
            <input type="text" class="form-control" name="first_name" id="first" >
        </div>
        <div class="form-group">
            <label for="last">Last name</label>
            <input type="text" class="form-control" name="last_name" id="last" >
        </div>
        <div class="form-group">
            <label for="birth">Birth Date</label>
            <input type="date" class="form-control" name="birth_date" id="birth" >
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" >
        </div>
        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" class="form-control" name="company" id="company" >
        </div>
        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" class="form-control" name="position" id="position" >
        </div>
        <div class="form-group">
            <label for="street">Street</label>
            <input type="text" class="form-control" name="street" id="street" >
        </div>
        <div class="form-group">
            <label for="street_number">Street number</label>
            <input type="number" class="form-control" name="street_number" id="street_number" >
        </div>
        <div class="form-group">
            <label for="zip">Zip code</label>
            <input type="text" class="form-control" name="zip_code" id="zip" >
        </div>
        <div class="form-group">
            <label for="state">State</label>
            <input type="text" class="form-control" name="state" id="state" >
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" name="country" id="country" >
        </div>
        <div class="form-group">
            <label for="event">Event</label>
            <select id="event" class="form-control">
                <?php while($row = $sql->fetch_object()) { ?>
                <option value="<?=$row->id?>"><?=$row->name?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="reason">Reason of participation</label>
            <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Apply</button>

    </form>
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