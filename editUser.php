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
$page = 'users';
$id = $_GET['id'];

$ev = $db->query("SELECT * FROM usres WHERE id='$id'");
$dataRow = $ev->fetch_object();
//
if (isset($_POST['submit']))

{
    $id = $_POST['id'];
    $first_name =  $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = $_POST['role'];
    $email = $_POST['email'];

    if ($_POST['password']==''){
        $password = $dataRow->password;
    }else{
        $password = md5($_POST['password']);
        $confirm = md5($_POST['confirm']);
        if ($password != $confirm){
            $_SESSION['flash']['danger'] = "Password error.";
            header('location:editUser.php?id='.$dataRow->id);
            exit();
        }
    }





    $upevent = $db->query("   UPDATE usres 
                                    set first_name = '$first_name',
                                        last_name = '$last_name',
                                        role = '$role',
                                        email = '$email',
                                        password = '$password'
                                    WHERE id='$id'
    ");

    if ($upevent)
    {
        $_SESSION['flash']['success'] = "user updated.";
        header('location:users.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = "error.";
        header('location:editUser.php?id='.$dataRow->id);
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

                        <h5 class="card-title">Edit User</h5>
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
                                <label for="name">First name</label>
                                <input type="text" class="form-control" id="name" name="first_name" value="<?=$dataRow->first_name?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last name</label>
                                <input type="text" class="form-control" id="lname" name="last_name" value="<?=$dataRow->last_name?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?=$dataRow->email?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"  >
                                <small id="passwordHelpInline" class="text-muted">
                                    Please leave empty if not change
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="confirm">Password Confirmation</label>
                                <input type="password" class="form-control" id="confirm" name="confirm"  >
                                <small id="passwordHelpInline" class="text-muted">
                                    Please leave empty if not change
                                </small>
                            </div>
                            <div class="form-group">
                                <select name="role" class="form-control mb-5">
                                    <option value="1" <?php if($dataRow->role == '1'){echo 'selected';}?>>Admin</option>
                                    <option value="0" <?php if($dataRow->role == '0'){echo 'selected';}?> >User</option>
                                </select>
                            </div>


                            <button type="submit" name="submit" class="btn btn-primary btn-block" >Update User</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php include 'footer.php'?>