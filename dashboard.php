<?php
    session_start();
    error_reporting(0);
    include('sess_config/session_data.php');
    include('includes/error_reporting.php');
    include('Classes/dbFunctions.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>William Assessment | Shopping List</title>

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
                                <li class="breadcrumb-item active" aria-current="page">View Shopping Items</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <span class="badge bg-info">Shopping Items</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="infoTable">
                            <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Item Code</th>
                                <th>Item Quantity</th>
                                <th>Item Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $dataObj = new dbFunctions();
                                $data_set = $dataObj->getItems();
                                if (is_array($data_set[0])) {
                                    foreach ($data_set as $data) {
                                        $id = $data['recordId'];
                                        $item_name = $data['itemName'];
                                        $item_code = $data['itemCode'];
                                        $item_quantity = $data['itemQuantity'];
                                        $item_description = $data['itemDescription'];
                                        ?>
                                        <tr>
                                            <td><?php echo $item_name; ?></td>
                                            <td><?php echo $item_code; ?></td>
                                            <td><?php echo $item_quantity; ?></td>
                                            <td><?php echo $item_description; ?></td>
                                            <td>
                                                <a href="#" class="badge bg-warning edit_item"
                                                   i_name="<?php echo $item_name; ?>"
                                                   i_code="<?php echo $item_code; ?>"
                                                   i_qty="<?php echo $item_quantity; ?>"
                                                   i_descr="<?php echo $item_description; ?>"
                                                   uid="<?php echo $id; ?>">
                                                    EDIT
                                                </a>
                                                <a href="#" class="badge bg-danger remove_item"
                                                   i_name="<?php echo $item_name; ?>"
                                                   uid="<?php echo $id; ?>">
                                                    DELETE
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    };
                                };
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p><?php echo date('Y')?> &copy;</p>
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

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="js/operations.js"></script>
<script>
    // Simple Datatable
    let infoTable = document.querySelector('#infoTable');
    let dataTable = new simpleDatatables.DataTable(infoTable);

</script>
<script src="assets/js/main.js"></script>
</body>
</html>