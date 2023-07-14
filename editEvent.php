<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header('location:login.php');
    if(!$_SESSION['loggedin']){
        header('location:login.php');
    }}
if ($_SESSION['role'] != 1) {
    header('location:login.php');
}

    ?>
<?php
include'db.php';
$page = 'events';
$id = $_GET['id'];

$ev = $db->query("SELECT * FROM events WHERE id='$id'");
$dataRow = $ev->fetch_object();
//
if (isset($_POST['submit']))

{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $upevent = $db->query("UPDATE events set name = '$name',start_date = '$start_date',end_date='$end_date' WHERE id='$id'");
    if ($upevent)
    {
        $_SESSION['flash']['success'] = "event updated.";
        header('location:dashboard.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = "error.";
        header('location:editEvent.php');
        exit();
    }
}
 include 'header.php';
?>


<div class="container">

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-5">
                <div class="card-body">

                    <h5 class="card-title">Edit Event</h5>
                    <hr>

                    <?php if(isset($_SESSION['flash'])):?>
                        <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                            <div class="alert alert-<?=$type?>"><?=$message;?></div>
                        <?php endforeach; ?>
                        <?php unset($_SESSION['flash']); ?>
                    <?php endif; ?>


                    <form style="width: 100%" method="post">
                        <div class="form-group">
                            <input name="id" type="hidden" value="<?=$dataRow->id?>">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?=$dataRow->name?>" required>
                        </div>
                        <div class="form-group">
                            <label for="start_date">start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?=$dataRow->start_date?>">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?=$dataRow->end_date?>">
                        </div>


                        <button type="submit" name="submit" class="btn btn-primary btn-block" >Update</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'?>