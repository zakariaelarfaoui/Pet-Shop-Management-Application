<?php
session_start();
include '../includes/db-inc.php';
if (isset($_POST['add'])) {
    $c_id = $_POST['c_id'];
    $b_id = $_POST['b_id'];
    $p_id = $_POST['p_id'];
    $date = $_POST['date'];
    $qauntity = $_POST['quantity'];

    $sql = "INSERT INTO sales_details_birds (customer_id, birds_id, Product_id, date, quantity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $c_id,
        $b_id,
        $p_id,
        $date,
        $qauntity,
    ]);
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $c_id = $_POST['c_id'];
    $b_id = $_POST['b_id'];
    $p_id = $_POST['p_id'];
    $date = $_POST['date'];
    $qauntity = $_POST['quantity'];

    $sql = "UPDATE sales_details_birds SET customer_id = ?, birds_id = ?, Product_id = ? , date = ?, quantity = ? WHERE sd_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $c_id,
        $b_id,
        $p_id,
        $date,
        $qauntity,
        $id,
    ]);
}
if (isset($_POST['Delete'])) {

    $animal_id = $_POST['t1'];

    $sql = "DELETE FROM sales_details_birds WHERE sd_id = $animal_id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/main.css">
    <title>salesdetail birds</title>
</head>

<body>
    <!-- strat navbar -->
    <nav class="products product-nav">
        <div class="z-logo">
            <img src="../assets/nav_logo.png" alt="Logo">
            <h2>Sales Details Birds</h2>
        </div>
        <a href="../logout.php">logout</a>
    </nav>
    <!-- end navbar -->
    <!-- <a>Add New Details</a> -->
    <button class="add sale-btn" id="add">Add New Details</button>
    <button class="add sale-btn" id="update">Update Details</button>
    <!-- ADD Nex Sales Details -->
    <section class="modal-container" id="add-modal">
        <div class="modal">
            <h3 class="m-title">Sales Details</h3>
            <hr>
            <form action="" method="POST">
                <label>Customer_id :</label><br>
                <input type="number" name="c_id" required><br>
                <label>Birds_id :</label><br>
                <input type="number" name="b_id" required><br>
                <label>Product_id :</label><br>
                <input type="number" name="p_id" required><br>
                <label>Date :</label><br>
                <input type="date" name="date"><br>
                <label>Qauntity :</label><br>
                <input type="number" name="quantity" required><br>
                <input type="submit" name="add" value="Add" class="add sale-btn"></input>
                <button id="close" class="add sale-btn">Cancel</button>
            </form>
        </div>
    </section>
    <!-- Update  Sales Details -->
    <section class="modal-container" id="update-modal">
        <div class="modal">
            <h3 class="m-title">Sales Details</h3>
            <hr>
            <form action="" method="POST">
                <label>Sales_id :</label><br>
                <input type="number" name="id" required><br>
                <label>Customer_id :</label><br>
                <input type="number" name="c_id" required><br>
                <label>Birds_id :</label><br>
                <input type="number" name="b_id" required><br>
                <label>Product_id :</label><br>
                <input type="number" name="p_id" required><br>
                <label>Date :</label><br>
                <input type="date" name="date" required><br>
                <label>Qauntity :</label><br>
                <input type="number" name="quantity" required><br>
                <input type="submit" name="update" value="Update" class="add sale-btn"></input>
                <button id="close" class="add sale-btn">Cancel</button>
            </form>
        </div>
    </section>

    <!-- start table -->
    <table class="z-table">
        <thead>
            <th class="z-th sale-th">sd_id</th>
            <th class="z-th sale-th">Customer_id</th>
            <th class="z-th sale-th">Birds_id</th>
            <th class="z-th sale-th">Product_id</th>
            <th class="z-th sale-th">Date</th>
            <th class="z-th sale-th">Quantity of Pruduts</th>
        </thead>
        <?php
        $sql = "SELECT * FROM sales_details_birds";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $details = $stmt->fetchAll(2);
        foreach ($details as $row) { ?>
            <tr>
                <td class="z-td"><?php echo $row['sd_id'] ?></td>
                <td class="z-td"><?php echo $row['customer_id'] ?></td>
                <td class="z-td"><?php echo $row['birds_id'] ?></td>
                <td class="z-td"><?php echo $row['Product_id'] ?></td>
                <td class="z-td"><?php echo $row['date'] ?></td>
                <td class="z-td"><?php echo $row['quantity'] ?></td>
            </tr>

        <?php } ?>


    </table>
    <!-- end table -->
    <div class="search">
        <form action="" method="POST">
            <input type="text" name="t1" placeholder="Enter the id to delete" required class="delete-i">
            <input type="submit" name="Delete" value="Delete" class="add sale-btn">
        </form>
    </div>

    <footer class="footer">
        <h4>WeDev &copy; 2021</h4>
    </footer>
</body>
<script src="../JS/script.js"></script>

</html>