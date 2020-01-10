<?php
include_once 'header.php';
include_once '../src/model/DbContext.php';
include_once '../src/model/customer.php';
include_once '../src/model/product.php';
include_once '../src/model/MakeOrder.php';

if(!isset($db)){
    $db = new DBContext();
}
if(isset($_GET['id']))
{
    $editId = $_GET['id'];

}
if(isset($_POST['edit_item']))
{
    $inputId = $_POST['id'];
    $inputName = $_POST['product-name'];
    $inputDesc = $_POST['product-description'];
    $inputCost = $_POST['product-price'];
    $db->updateProduct($inputId,$inputName,$inputDesc,$inputCost);
}

$product = $db->Products();
$length = count($product);
$i = 0;

while($i < $length)
{
    if($product[$i]->getID() == $editId)
    {
        $productid = $product[$i]->getID();
        $name = $product[$i]->getName();
        $desc = $product[$i]->getDescription();
        $cost = $product[$i]->getPrice();
        break;
    }
    else
    {
        $i++;
    }
}


?>

<!DOCTYPE html>
<head>Edit Page - where the product information is edited</head>
<body>
<div class="card col-md-10 mx-auto" style="margin-top:30px; margin-bottom: 30px;">
    <div class="card-header bg-primary text-white">
        Edit Menu Item
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo $productid?>">
            <div class="form-group">
                <label for="productName">Product Name:</label>
                <input type="text" class="form-control" name="product-name" id="order" placeholder="Product Name" value="<?php echo $name?>">
            </div>
            <div class="form-group">
                <label for="productDescription">Product Description:</label>
                <input type="text" class="form-control" name="product-description" id="order" placeholder="Description" value="<?php echo $desc?>">
            </div>
            <div class="form-group">
                <label for="productPrice">Product Price:</label>
                <input type="text" class="form-control" name="product-price" id="order" placeholder="Price(£)" value="<?php echo $cost?>">
            </div>

            <button type="submit" class="btn btn-primary" name="edit_item">Edit</button>
        </form>
    </div>
</div>
</body>
</html>
