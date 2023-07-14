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

//
if (isset($_POST['submit']))

{

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirm = md5($_POST['confirm']);
    if ($password != $confirm){
        $_SESSION['flash']['danger'] = "Password error.";
        header('location:addUser.php');
        exit();
    }


    $name = $_FILES['image']['name'];
    list($txt, $ext) = explode(".", $name);
    $image_name = time().".".$ext;
    $tmp = $_FILES['image']['tmp_name'];
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    $fileType = pathinfo('assets/images/users/'.$image_name,PATHINFO_EXTENSION);

    if(in_array($fileType, $allowTypes)){
        if(move_uploaded_file($tmp, 'assets/images/users/'.$image_name)){
            $image = $image_name;
        }else{
            $image = 'no-image.jpg';

        }
    }else{
        $_SESSION['flash']['danger'] = "File Type error.";
        header('location:addUser.php');
        exit();
    }





    $adduser = $db->query("   INSERT INTO usres 
                                    set first_name = '$first_name',
                                        last_name = '$last_name',
                                        role = '$role',
                                        email = '$email',
                                        password = '$password',
                                        image = '$image'");

    if ($adduser)
    {
        $_SESSION['flash']['success'] = "user added.";
        header('location:users.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = "error.";
        header('location:addUser.php');
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

                        <h5 class="card-title">Add User</h5>
                        <hr>

                        <?php if(isset($_SESSION['flash'])):?>
                            <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                                <div class="alert alert-<?=$type?>"><?=$message;?></div>
                            <?php endforeach; ?>
                            <?php unset($_SESSION['flash']); ?>
                        <?php endif; ?>


                        <form style="width: 100%" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">First name</label>
                                <input type="text" class="form-control" id="name" name="first_name"  required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last name</label>
                                <input type="text" class="form-control" id="lname" name="last_name"  required>
                            </div>
                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="email" class="form-control" id="email" name="email"  required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required >

                            </div>
                            <div class="form-group">
                                <label for="confirm">Password Confirmation</label>
                                <input type="password" class="form-control" id="confirm" name="confirm" required >

                            </div>
                            <div class="form-group">
                                <select name="role" class="form-control mb-5">
                                    <option value="1" >Admin</option>
                                    <option value="0" >User</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>


                            <button type="submit" name="submit" class="btn btn-primary btn-block" >Add User</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php include 'footer.php'?>