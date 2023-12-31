<?php

define('TITLE', "Edit Profile");
include '../assets/layouts/navbar.php';
check_verified();

//XSS filter for session variables
function xss_filter($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<div class="container">
    <div class="">
        <div class="col-lg-7">
            <form class="form-auth" action="includes/profile-edit.inc.php" method="post" enctype="multipart/form-data" autocomplete="off">

                <?php insert_csrf_token(); ?>
                <div class="text-center">
                    <small class="text-success font-weight-bold">
                        <?php
                            if (isset($_SESSION['STATUS']['editstatus']))
                                echo $_SESSION['STATUS']['editstatus'];

                        ?>
                    </small>
                </div>

                <h6 class="h3 mt-3 mb-3 font-weight-normal text-muted text-center">Edit Your Profile</h6>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control mt-2 mb-2" placeholder="Username" value="<?php echo xss_filter($_SESSION['username']); ?>" autocomplete="off" readonly>
                    <sub class="text-danger">
                        <?php
                            if (isset($_SESSION['ERRORS']['usernameerror']))
                                echo $_SESSION['ERRORS']['usernameerror'];

                        ?>
                    </sub>
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" class="form-control mt-2 mb-2" placeholder="Email address" value="<?php echo xss_filter($_SESSION['email']); ?>">
                    <sub class="text-danger">
                        <?php
                            if (isset($_SESSION['ERRORS']['emailerror']))
                                echo $_SESSION['ERRORS']['emailerror'];

                        ?>
                    </sub>
                </div>

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control mt-2 mb-2" placeholder="First Name" value="<?php echo xss_filter($_SESSION['first_name']); ?>">
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control mt-2 mb-2" placeholder="Last Name" value="<?php echo xss_filter($_SESSION['last_name']); ?>">
                </div>

                <div class="form-group">
                    <label for="last_name">Permission Level</label>
                    <input type="text" id="level" name="level" class="form-control mt-2 mb-2" placeholder="level" value="<?php  
                        if(xss_filter($_SESSION['level'])==0)
                        echo "Super Admin";
                        else if(xss_filter($_SESSION['level'])==1)
                        echo "HOD/Admin/Teacher";
                        else if(xss_filter($_SESSION['level'])==2)
                        echo "Student";
                    
                    ?>" readonly>
                </div>

                <div class="form-group mb-5">
                    <label>Gender</label>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="male" name="gender" class="custom-control-input mt-2 mb-2" value="m" <?php if ($_SESSION['gender'] == 'm') echo 'checked' ?>>
                        <label class="custom-control-label" for="male">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="female" name="gender" class="custom-control-input" value="f" <?php if ($_SESSION['gender'] == 'f') echo 'checked' ?>>
                        <label class="custom-control-label" for="female">Female</label>
                    </div>
                </div>
                <hr>
                <span class="h5 font-weight-normal text-muted mb-4">Social Media Section</span>
                <div class="form-group mt-2">
                    <input type="text" id="facebook" name="facebook" class="form-control" placeholder="Facebook Link" 
                    value="<?php if(isset($_SESSION['facebook'])){echo "https://www.facebook.com/";echo xss_filter($_SESSION['facebook']);}?>">
                </div>
                <div class="form-group mt-2">
                    <input type="text" id="instagram" name="instagram" class="form-control mb-5" placeholder="Instagram Link" 
                    value="<?php if(isset($_SESSION['instagram'])){echo "https://instagram.com/";echo xss_filter($_SESSION['instagram']);}?>">
                </div>
                <hr>
                    <span class="h5 font-weight-normal text-muted mb-4">Password Edit</span>
                    <sub class="text-danger mb-4">
                        <?php
                            if (isset($_SESSION['ERRORS']['passworderror']))
                                echo $_SESSION['ERRORS']['passworderror'];

                        ?>
                    </sub>
                    <br><br>

                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Current Password" autocomplete="new-password">
                    </div>

                    <div class=" form-group">
                        <input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="New Password" autocomplete="new-password">
                    </div>

                    <div class=" form-group mb-5">
                        <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password" autocomplete="new-password">
                    </div>

                    <button class="btn btn-lg btn-primary btn-block mb-5" type="submit" name='update-profile'>Confirm Changes</button>
                
            </form>

        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>



<?php

include '../assets/layouts/footer.php';

?>

<script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);

            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#avatar").change(function() {
        console.log("here");
        readURL(this);
    });
</script>
