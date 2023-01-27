<?php
    session_start();
    error_reporting(0);
    //Add
    include('sess_config/session_data.php');
    include('includes/error_reporting.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>William Assessment | Add Items</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="assets/css/googlefonts.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">

    <!-- Favicons -->
    <link href="images/favicon/favicon.png" rel="shortcut icon">=
</head>

<body>
<div id="app">
    <div id="sidebar" class="active">
        <?php
        include('includes/nav.php');
        ?>
    </div>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Assessment</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Items</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <span class="badge bg-info">Add Item</span>
                    </div>
                    <div class="card-body">
                        <form name="add_item_form" method="post" id="add_item_form">
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" id="item_name" name="item_name" placeholder="Item Name" class="form-control">
                            </div>

                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" id="item_code" name="item_code" placeholder="Item Code" class="form-control">
                            </div>

                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" id="item_quantity" name="item_quantity" placeholder="Item Quantity" class="form-control">
                            </div>

                            <div class="form-group position-relative has-icon-left mb-4">
                                <textarea type="text" id="item_description" name="item_description" placeholder="Item Description" class="form-control"></textarea>
                            </div>
                            <button type="button" class="btn btn-info ml-1 add_item_btn">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Submit</span>
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p><?php echo date('Y')?> &copy</p>
                </div>
            </div>
        </footer>
    </div>
</div>
<div class="modal fade text-left infoModal" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title white" id="myModalLabel130">
                    Info Modal
                </h5>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="assets/js/jquery-3.5.1.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/main.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/operations.js"></script>

</body>

</html>