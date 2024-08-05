<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('include/config.php');
if(strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if(isset($_POST['update'])) {
        $complaintnumber = $_GET['cid'];
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        $query = mysqli_query($bd, "INSERT INTO complaintremark (complaintNumber, status, remark) VALUES ('$complaintnumber', '$status', '$remark')");
        $sql = mysqli_query($bd, "UPDATE tblcomplaints SET status='$status' WHERE complaintNumber='$complaintnumber'");

        echo "<script>alert('Complaint details updated successfully');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Complaint</title>
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
            <h3>Update Complaint</h3>
        </div>
        <div class="card-body">
            <form name="updatecomplaint" id="updatecomplaint" method="post">
                <div class="form-group">
                    <label for="complaintNumber"><b>Complaint Number</b></label>
                    <input type="text" class="form-control" id="complaintNumber" value="<?php echo htmlentities($_GET['cid']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="status"><b>Status</b></label>
                    <select name="status" id="status" class="form-control" required="required">
                        <option value="">Select Status</option>
                        <option value="in process">In Process</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="remark"><b>Remark</b></label>
                    <textarea name="remark" id="remark" class="form-control" cols="50" rows="10" required="required"></textarea>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" onclick="f2()">Close this window</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
<?php } ?>
