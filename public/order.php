<?php
    include_once 'header.php';
    include_once '../src/model/DbContext.php';
    include_once '../src/model/customer.php';
    include_once '../src/model/product.php';
    include_once '../src/model/MakeOrder.php';
    session_start();



    if(!isset($db))
    {
        $db = new DbContext();
    }
    if(isset($_POST['submit_order']))
    {
        $customer = new customer($_POST['table']);
        $done = $db->addCustomer($customer);

        $id = $db->currentUser();
        $order = new makeOrder($id);
        $success = $db->createOrder($order);


        $oId = $db->currentOrder();
        $item = $_POST['tea'];//item holds the value of the selected tea
        $query = $db->orderProduct($oId,$item);
        $db->setTime($oId);
    }
    if(isset($_POST['submit_view_request']))
    {
        $orderEntry = $_POST['order-input'];
        $orderInfo = $db->viewOrder($orderEntry);
        $_SESSION['orderNumber'] = $orderEntry;
    }
    if(isset($_POST['submit_addOrder']))
    {
        $productSelected = $_POST['productSelect'];
        $orderID = $_POST['orderNo'];
        $value = $db->selectCId($orderID);
        $completeAdd = $db->orderProduct($orderID,$productSelected);
        $db->setTime($orderID);
    }
    if(isset($_GET['del']))
    {
        $pid = $_GET['del'];

        $hello = $_SESSION['orderNumber'];//I USE SESSION VARIABLES TO BE ABLE TO ACCESS THE VALUE SUBMITTED THROUGH THE VIEW BUTTON LATER ON.
        echo $hello;
        echo $pid;
        $db->deleteOrder($hello,$pid);////I NEED TO FIND A WAY OF ACCESSING THE VALUE ENTERED INTO THE TEXT BOX
        if(isset($_SESSION['orderNumber']))
        {
            unset($_SESSION['orderNumber']);
        }
    }
?>


<!DOCTYPE html>
<head>
<title>Order page, here is where customers can add, view and remove orders</title>
</head>
<body>

<div class="col-md-10 mx-auto" style="margin-top: 20px">
    Welcome to the Order Page, here you can make an order, add products to your order,view the order you have placed and delete products from your order.<br>
    After placing an order the order information will be displayed, the OrderId, refers to the order you have placed and can be used to modify your order if needed.
</div>

<div class="card col-md-10 mx-auto" style="margin-top:30px; margin-bottom: 30px;">
    <div class="card-header bg-primary text-white">
        Make your Order
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="tableNo">Table Number</label>
                <select id="table" class="form-control" name="table">
                    <option>--Select Table--</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>

                </select>
            </div>


            <div class="form-group">
                <label for="choiceTea">Select Tea</label>
                <select id="choiceTea" class="form-control" name="tea">
                    <option selected>Choose...</option>
                    <?php
                    $listString = "";
                    $products = $db->Products();

                    if($products)
                    {
                        foreach($products as $product)
                        {
                            $listString.= "<option value=".$product->getID().">".$product->getName()."</option>";
                        }
                    }
                    echo $listString;
                    ?>
                </select>
            </div>



            <button type="submit" class="btn btn-primary" name="submit_order">Place Order</button>
        </form>
    </div>

</div>

<div class="card col-md-10 mx-auto" style="margin-top:30px; margin-bottom: 30px;">

    <div class="card-header bg-primary text-white">
        View Your Order
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="orderNo">Order Number:</label>
                <input type="number" class="form-control" name="order-input" id="order" placeholder="Order No" value="<?php echo $orderEntry; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit_view_request">View</button>

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
                <?php
                if(is_array($orderInfo)) { foreach($orderInfo as $element): ?>
                    <tr>
                        <td><?php echo $element['ProductName'] ?></td>
                        <td><?php echo $element['ProductDesc'] ?></td>
                        <td><?php echo $element['ProductPrice'] ?></td>
                        <td><a class='btn btn-sm btn-danger' href="order.php?del=<?php echo $element['ProductId']; ?>">Delete</a></td>
                    </tr>
                <?php endforeach; }?>

                </tbody>
            </table>
        </form>
    </div>
</div>





<div class="card col-md-10 mx-auto" style="margin-top:30px; margin-bottom: 30px;">

    <div class="card-header bg-primary text-white">
        Add To Your Order
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="orderNo">Order Number:</label>
                <input type="number" class="form-control" name="orderNo" placeholder="Order No">
            </div>

            <div class="form-group">
                <label for="tableNo">Select Tea</label>
                <select id="table" class="form-control" name="productSelect">
                    <option selected>Choose...</option>
                    <?php
                    $listString = "";
                    $products = $db->Products();

                    if($products)
                    {
                        foreach($products as $product)
                        {
                            $listString.= "<option value=".$product->getID().">".$product->getName()."</option>";
                        }
                    }
                    echo $listString;
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit_addOrder">Place Order</button>
        </form>
    </div>
</div>


<!--
<?php
if (is_array($orderInfo) || is_object($orderInfo))
{
    foreach($orderInfo as $element)
    {
        $resultString = "<div class='row mx-auto col-sm-10'>".
            "<div class='bg-success text-white'>"."Product: ".$element['ProductName'] .". Description: ".$element['ProductDesc'].". Price: ".$element['ProductPrice']."."."</div>"."</div>";
        echo $resultString;
    }
}

?>
-->

<?php


$resultString = "<div class='row mx-auto col-sm-10'>".
    "<div class='bg-success text-white'>"."Your Order has been placed"." .The Order Id is ".$oId."</div>"."</div>";
if ($success > 0) {
    echo $resultString;
};
?>
</body>
</html>

<?php
    include_once 'footer.php';
    ?>
