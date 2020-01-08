<?php
include_once 'header.php';
include_once '../src/model/DbContext.php';
include_once '../src/model/customer.php';
include_once '../src/model/product.php';
include_once '../src/model/MakeOrder.php';

if(!isset($db)){
    $db = new DBContext();
}

if(isset($_POST['add_new_item']))
{
    $name = $_POST['product-name'];
    $description = $_POST['product-description'];
    $cost = $_POST['product-price'];
    $add = $db->addProduct($name,$description,$cost);
}

if(isset($_GET['delete']))
{
    $delId = $_GET['delete'];
    $db->deleteProduct($delId);
}



$showView = $db->runView();
$productList = $db->Products();

?>

<!DOCTYPE html>
<head></head>
<body>
<div class="card col-md-10 mx-auto" style="margin-top:30px; margin-bottom: 30px;">
    <div class="card-header bg-primary text-white">
        Add Menu Item
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="productName">Product Name:</label>
                <input type="text" class="form-control" name="product-name" id="order" placeholder="Product Name" required>
            </div>
            <div class="form-group">
                <label for="productDescription">Product Description:</label>
                <input type="text" class="form-control" name="product-description" id="order" placeholder="Description" required>
            </div>
            <div class="form-group">
                <label for="productPrice">Product Price:</label>
                <input type="number" step="0.01" min="0" class="form-control inputValidation" name="product-price" id="order" placeholder="Price(£)" required>
            </div>

            <button type="submit" class="btn btn-primary" name="add_new_item">Add</button>
        </form>
    </div>
</div>

<table class="table col-sm-10 mx-auto">
    <thead class="thead-light">
    <tr>
        <th scope="col">Order Number</th>
        <th scope="col">Table Number</th>
        <th scope="col">Product</th>
        <th scope="col">Price(£)</th>
        <th scopre="col">Order Time</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($showView as $viewItem): ?>
        <tr>
            <td><?php echo $viewItem['OrderId'] ?></td>
            <td><?php echo $viewItem['TableNo'] ?></td>
            <td><?php echo $viewItem['ProductName'] ?></td>
            <td><?php echo $viewItem['ProductPrice'] ?></td>
            <td><?php echo $viewItem['OrderTime'] ?></td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>


<div class="card col-md-10 mx-auto" style="margin-top:30px; margin-bottom: 30px;">

    <div class="card-header bg-primary text-white">
        View Items For Sale
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table class="table col-sm-10 mx-auto">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price(£)</th>
                    <th scopre="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($productList as $product): ?>
                    <tr>
                        <td><?php echo $product->getName() ?></td>
                        <td><?php echo $product->getDescription() ?></td>
                        <td><?php echo $product->getPrice() ?></td>
                        <td><a class='btn btn-sm btn-primary' href="edit.php?id=<?php echo $product->getID() ?>">Edit</a> &nbsp;
                            <a class='btn btn-sm btn-danger' href="admin.php?delete=<?php echo $product->getID() ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
            <button type="submit" class="btn btn-primary" name="submit_view_request">View</button>
        </form>
    </div>
</div>


</body>

</html>

