<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings | MacMade</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url("https://cdn.pixabay.com/photo/2022/04/29/09/19/yarn-7162973_1280.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
        }
        #content {
            padding: 100px 0;
        }
        #settings-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container-fluid" id="content">
        <div class="row mt-4">
            <div class="col-lg-6 col-md-8 animate__animated animate__fadeInDown" id="settings-container">
                <h4>Change Password</h4>
                <form action="settings_script.php" method="POST">
                    <div class="form-group">
                        <input type="password" class="form-control" name="old-password" placeholder="Old Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="New Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password1" placeholder="Re-type New Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary animate__animated animate__bounce">Change</button>
                    <?php if(isset($_GET['error'])) echo $_GET['error']; ?>
                </form>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
</body>
</html>
