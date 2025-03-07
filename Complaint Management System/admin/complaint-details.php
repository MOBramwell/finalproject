<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Pick-Up Details</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <script language="javascript" type="text/javascript">
        var popUpWin = 0;
        function popUpWindow(URLStr, left, top, width, height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + width + ',height=' + height + ',left=' + left + ',top=' + top + ',screenX=' + left + ',screenY=' + top);
        }
    </script>
</head>
<body>
<?php include('include/header.php'); ?>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <?php include('include/sidebar.php'); ?>
            <div class="span9">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h3>Pick-Up Details</h3>
                        </div>
                        <div class="module-body table">
                            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                                <tbody>
                                <?php
                                $st = 'closed';
                                $query = mysqli_query($bd, "SELECT tblcomplaints.*, users.fullName AS name, category.categoryName AS catname FROM tblcomplaints JOIN users ON users.id = tblcomplaints.userId JOIN category ON category.id = tblcomplaints.category WHERE tblcomplaints.complaintNumber = '" . $_GET['cid'] . "'");
                                while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><b>Pick-Up Number</b></td>
                                        <td><?php echo htmlentities($row['complaintNumber']); ?></td>
                                        <td><b>User Name</b></td>
                                        <td><?php echo htmlentities($row['name']); ?></td>
                                        <td><b>Reg Date</b></td>
                                        <td><?php echo htmlentities($row['regDate']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>User Type</b></td>
                                        <td><?php echo htmlentities($row['catname']); ?></td>
                                    </tr>
                                    <?php
                                    $ret = mysqli_query($bd, "SELECT complaintremark.remark AS remark, complaintremark.status AS sstatus, complaintremark.remarkDate AS rdate FROM complaintremark JOIN tblcomplaints ON tblcomplaints.complaintNumber = complaintremark.complaintNumber WHERE complaintremark.complaintNumber = '" . $_GET['cid'] . "'");
                                    while ($rw = mysqli_fetch_array($ret)) {
                                        ?>
                                        <tr>
                                            <td><b>Remark</b></td>
                                            <td colspan="5"><?php echo htmlentities($rw['remark']); ?> <b>Remark Date <?php echo htmlentities($rw['rdate']); ?></b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Status</b></td>
                                            <td colspan="5"><?php echo htmlentities($rw['sstatus']); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><b>Final Status</b></td>
                                        <td colspan="5"><?php echo $row['status'] == "" ? "Not Processed Yet" : htmlentities($row['status']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Action</b></td>
                                        <td>
                                            <?php if ($row['status'] != "closed") { ?>
                                                <a href="javascript:void(0);" onClick="popUpWindow('router.php?action=updatecomplaint&id=<?php echo htmlentities($row['complaintNumber']); ?>', 600, 600, 600, 600);" title="Update order">
                                                    <button type="button" class="btn btn-primary">Process Request</button>
                                                </a>
                                            <?php } ?>
                                        </td>
                                        <td colspan="4">
                                            <a href="javascript:void(0);" onClick="popUpWindow('router.php?action=userprofile&id=<?php echo htmlentities($row['userId']); ?>', 600, 600, 600, 600);" title="View User Details">
                                                <button type="button" class="btn btn-primary">View User Details</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--/.content-->
            </div><!--/.span9-->
        </div>
    </div><!--/.container-->
</div><!--/.wrapper-->

<?php include('include/footer.php'); ?>

<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('.datatable-1').dataTable();
        $('.dataTables_paginate').addClass("btn-group datatable-pagination");
        $('.dataTables_paginate > a').wrapInner('<span />');
        $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
        $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
    });
</script>
</body>
</html>
