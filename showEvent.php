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
$page = 'events';
$id = $_GET['id'];

$ev = $db->query("SELECT * FROM events WHERE id='$id'");
$dataRow = $ev->fetch_object();
//

include 'header.php';

?>


    <div class="container">

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mt-5">
                    <div class="card-body">

                        <h5 class="card-title"><?=$dataRow->name?></h5>
                        <hr>

                        <ul>
                            <li>Start Date: <?=$dataRow->start_date?></li>
                            <li>End Date: <?=$dataRow->end_date?></li>

                        </ul>
                        <a href="editEvent.php?id=<?=$dataRow->id?>" class="btn btn-warning">
                            Edit
                        </a>



                    </div>
                </div>
            </div>

        </div>
    </div>

<?php include 'footer.php'?>