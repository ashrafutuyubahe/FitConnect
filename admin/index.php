<?php  session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="app sidebar-mini rtl bg-gray-100">
    <!-- Navbar-->
    <?php include 'include/header.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <a href="#"><i class="fa fa-home fa-lg"></i></a>
            </ul>
        </div>
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $widgets = [
                    ["title" => "Listed Categories", "link" => "add-category.php", "sql" => "SELECT count(id) as total FROM tblcategory"],
                    ["title" => "Listed Package Type", "link" => "add-package.php", "sql" => "SELECT count(id) as total FROM tblcategory"],
                    ["title" => "Listed Packages", "link" => "manage-post.php", "sql" => "SELECT count(id) as total FROM tbladdpackage"],
                    ["title" => "Total Bookings", "link" => "booking-history.php", "sql" => "SELECT count(id) as total FROM tblbooking"],
                    ["title" => "New Bookings", "link" => "new-bookings.php", "sql" => "SELECT count(id) as total FROM tblbooking WHERE paymentType IS NULL OR paymentType=''"],
                    ["title" => "Partial Payment Bookings", "link" => "partial-payment-bookings.php", "sql" => "SELECT count(id) as total FROM tblbooking WHERE paymentType='Partial Payment'"],
                    ["title" => "Full Payment Bookings", "link" => "full-payment-bookings.php", "sql" => "SELECT count(id) as total FROM tblbooking WHERE paymentType='Full Payment'"]
                ];

                foreach ($widgets as $widget) {
                    $sql = $widget['sql'];
                    $link = $widget['link'];

                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_OBJ);
                ?>
                    <a href="<?php echo $link; ?>" class="hover:no-underline">
                        <div class="p-6 bg-white rounded-lg shadow-md hover:bg-gray-100 transition duration-300">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-lg font-semibold"><?php echo $widget['title']; ?></h4>
                                <span class="text-gray-600"><?php echo $result->total; ?></span>
                            </div>
                            <div class="text-sm text-gray-500"><?php echo $widget['description']; ?></div>
                        </div>
                    </a>
                <?php } ?>
                </div>

        </a>
    <?php } ?>
            </div>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
    </script>

</body>

</html>
