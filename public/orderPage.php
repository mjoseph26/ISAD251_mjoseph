<?php
    include_once 'header.php';
    include_once '../src/model/DbContext.php';
    include_once '../src/model/customer.php';
    include_once '../src/model/product.php';

    if(!isset($db))
    {
        $db = new DbContext();
    }
    //if(isset($_POST['submit_order']))
    //{
        //insert the data to add customer
        //$customer = new customer($_POST['table']);
        //$done = $db->addCustomer($customer);

        //get the customer Id to into the orders table
        //$curCustomer = currentCustomer();

        //$datetime = date("d-m-Y h:i a");;
        //$order = new order($datetime,$curCustomer);
        //$success = $db->createOrder($order);

        //$orderRequest = new order($_POST[''])

    //}
?>

<!DOCTYPE html>
<head>

</head>
<body>

<div class="card col-md-10 mx-auto" style="margin-top:30px; margin-bottom: 30px;">
    <div class="card-header bg-primary text-white">
        Make your Order
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-row">

                <div class="form-group">
                    <label for="tableNo">Table Number</label>
                    <select id="table" class="form-control" name="table">
                        <option>--Select Table--</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>

                <div class="form-group col-md-10">
                    <label for="choiceTea">Select Tea</label>
                    <select id="choiceTea" class="form-control" name="product">
                        <option>--Select Tea--</option>
                        <?php
                        $listString = "";
                        $teas = $db->teaSelector();

                        if($teas)
                        {
                            foreach($teas as $tea)
                            {
                                $listString.= "<option>".$tea['ProductName']."</option>";
                            }
                        }
                        echo $listString;
                        ?>

                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="inputAmount">Quantity</label>
                    <select id="inputAmount" class="form-control" name="quantity">
                        <option>--Select Quantity--</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>

            </div>

            <button type="submit" class="btn btn-primary" name="submit_order">Place Order</button>
        </form>
    </div>
</div>

</body>
</html>

<?php
    include_once 'footer.php';
    ?>
