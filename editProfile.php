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
$page = 'users';
$id = $_SESSION['id'];

$ev = $db->query("SELECT * FROM usres WHERE id='$id'");
$dataRow = $ev->fetch_object();
//
if (isset($_POST['submit']))

{
    $id = $_POST['id'];
    $first_name =  $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $email = $_POST['email'];

    if ($_POST['password']==''){
        $password = $dataRow->password;
    }else{
        $password = md5($_POST['password']);
        $confirm = md5($_POST['confirm']);
        if ($password != $confirm){
            $_SESSION['flash']['danger'] = "Password error.";
            header('location:editProfile.php');
            exit();
        }
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
            $image = $dataRow->image;

        }
    }else{
        $image = $dataRow->image;
    }




    $upprofile = $db->query("   UPDATE usres 
                                    set first_name = '$first_name',
                                        last_name = '$last_name',
                                        email = '$email',
                                        password = '$password',
                                        image = '$image'
                                    WHERE id='$id'
    ");

    if ($upprofile)
    {
        $_SESSION['flash']['success'] = "user updated.";
        header('location:profile.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = "error.";
        header('location:editProfile.php');
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

                        <h5 class="card-title">Edit Profile</h5>
                        <hr>

                        <?php if(isset($_SESSION['flash'])):?>
                            <?php foreach ($_SESSION['flash'] as $type => $message): ?>
                                <div class="alert alert-<?=$type?>"><?=$message;?></div>
                            <?php endforeach; ?>
                            <?php unset($_SESSION['flash']); ?>
                        <?php endif; ?>


                        <form style="width: 100%" method="post" enctype="multipart/form-data">
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


                            <div class="input-group mb-3">

                                <div class="row">

                                    <div class="col-4">
                                        <img src="assets/images/users/<?=$dataRow->image?>" class="rounded mx-auto d-block" width="100">
                                    </div>
                                    <div class="col-8">
                                        <input type="file"  name="image" id="inputGroupFile01">
                                    </div>
                                </div>
                            </div>


                            <button type="submit" name="submit" class="btn btn-primary btn-block" >Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php include 'footer.php'?>