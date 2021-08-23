<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>changePassword</title>
    <link rel="stylesheet" href="..\assets\bootstrap3\css\bootstrap.min.css">
	<link rel="stylesheet" href="..\assets\css\style.css">
</head>
<body>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h4>Change Password</h4>
                <h4 >User : <?php echo $_SESSION["username"] ?> </h4>
                
            </div>
            <div class="panel-body ">
                <form action="/" id="changePassForm" >             
                    <div class="form-group">
                        <label for="currentPassword">Current password:</label>
                        <input type="password" class="form-control" name="currentPassword" id="currentPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New password:</label>
                        <input type="password" class="form-control" name="newPassword" id="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm new password:</label>
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required>
                    </div>
                    <button type="submit" id="btn-changepass" class="btn btn-default">Change password</button>

                </form>
            </div>
            <a  href="logout.php" id="btn-logout" style="float:right" class="btn btn-default">Log out</a>

        </div>
    </div> 
    <script src="..\assets\js\jquery-3.2.1.js"></script>

    <script src="..\assets\bootstrap3\js\bootstrap.js"></script> 
    <script src="..\assets\plugins\jquery-validation-1.19.3\dist\jquery.validate.min.js"></script>
    <script src="..\assets\js\changepass.js?1500"></script>
</body>
</html>