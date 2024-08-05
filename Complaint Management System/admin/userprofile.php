<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('include/config.php');
if(strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="style.css" rel="stylesheet" type="text/css">
<link href="anuj.css" rel="stylesheet" type="text/css">
<style>
    body {
        background-color: #f5f5f5;
        font-family: 'Open Sans', sans-serif;
    }
    .container {
        margin-top: 50px;
    }
    .card {
        animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function f2() {
    window.close();
}
function f3() {
    window.print();
}
</script>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>User Profile</h3>
        </div>
        <div class="card-body">
            <form name="updateticket" id="updateticket" method="post">
                <?php 
                $ret1 = mysqli_query($bd, "SELECT * FROM users WHERE id='" . $_GET['uid'] . "'");
                while($row = mysqli_fetch_array($ret1)) {
                ?>
                <div class="form-group">
                    <label for="fullName"><b>Full Name</b></label>
                    <input type="text" class="form-control" id="fullName" value="<?php echo $row['fullName']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="regDate"><b>Reg Date</b></label>
                    <input type="text" class="form-control" id="regDate" value="<?php echo htmlentities($row['regDate']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="userEmail"><b>User Email</b></label>
                    <input type="text" class="form-control" id="userEmail" value="<?php echo htmlentities($row['userEmail']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="contactNo"><b>User Contact no</b></label>
                    <input type="text" class="form-control" id="contactNo" value="<?php echo htmlentities($row['contactNo']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="updationDate"><b>Last Updation</b></label>
                    <input type="text" class="form-control" id="updationDate" value="<?php echo htmlentities($row['updationDate']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="status"><b>Status</b></label>
                    <input type="text" class="form-control" id="status" value="<?php echo $row['status'] == 1 ? "Active" : "Block"; ?>" readonly>
                </div>
                <button type="button" class="btn btn-secondary" onclick="f2()">Close this window</button>
                <?php } ?>
            </form>
        </div>
    </div>
</div>

</body>
</html>
<?php } ?>
