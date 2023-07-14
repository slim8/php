<?php
session_start();
include 'db.php';
include 'functions.php';
$page = 'participants';
if(!isset($_SESSION['loggedin'])){
    header('location:login.php');
    if(!$_SESSION['loggedin']){
        header('location:login.php');
    }}

//list events
$events = $db->query("select * from participants order by id DESC");

//delete
if (isset($_GET['id'])){
    if ($_SESSION['role'] != 1) {
        header('location:login.php');
    }
    $id = $_GET['id'];
    $del = $db->query("DELETE FROM events WHERE id='$id'");
    if ($del){
        $_SESSION['flash']['success'] = "event deleted.";
        header('location:dashboard.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = "Error";
        header('location:dashboard.php');
        exit();
    }
}


?>
<?php include 'header.php'?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

            <a href="index.php" type="button" class="btn btn-sm btn-outline-secondary">
                <span data-feather="plus"></span>
                Add participant
            </a>
        </div>
    </div>


    <h2>Events</h2>
    <?php if(isset($_SESSION['flash'])):?>
        <?php foreach ($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?=$type?>"><?=$message;?></div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
    <div>
        <table class="table table-striped table-sm" id="events" width="100%" >
            <thead>
            <tr>

                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Event</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php while($row = $events->fetch_object()) {
                ?>

                <tr  role="button" onclick="location.href = 'showPart.php?id=<?=$row->id?>'">
                    <td><?=$row->first_name?></td>
                    <td><?=$row->last_name?></td>
                    <td><?=$row->email?></td>
                    <td><?=$row->position?></td>
                    <td><?=get_name($row->id)?></td>
                    <td class="text-center">
                        <?php if($_SESSION['role']==1){ ?>
                            <a href="editPart.php?id=<?=$row->id?>"><i class="far fa-edit mr-2 text-info"></i></a>
                            <a href="?id=<?=$row->id?>" onclick="return confirm('Are you sure you want to delete this item?');"> <i class="far fa-trash-alt text-danger mr-2"></i></a>
                        <?php }?>
                        <a href="showPart.php?id=<?=$row->id?>"><i class="far fa-list-alt text-success"></i></a>
                    </td>
                </tr>
            <?php } ?>







            </tbody>
        </table>
    </div>
</main>

<?php include 'footer.php'?>
