<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header('location:login.php');
    if(!$_SESSION['loggedin']){
        header('location:login.php');
    }}

?>
<?php
include'db.php';
include 'functions.php';
$page = 'events';
$id = $_SESSION['id'];

$user = $db->query("SELECT * FROM usres WHERE id='$id'");
$dataRow = $user->fetch_object();
//

include 'header.php';

?>


    <div class="container">

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mt-5">
                    <div class="card-body">
                        <img src="assets/images/users/<?=$dataRow->image?>" class="rounded mx-auto d-block" width="100">
                        <h5 class="card-title text-center mt-2"><?=$dataRow->first_name.' '.$dataRow->last_name?></h5>
                        <hr>

                        <ul>
                            <li>Role : <?=get_role($dataRow->role)?></li>
                            <li>Email : <?=$dataRow->email?></li>

                        </ul>
                        <a href="editProfile.php" class="btn btn-warning">
                            Edit
                        </a>



                    </div>
                </div>
            </div>

        </div>
    </div>

<?php include 'footer.php'?>