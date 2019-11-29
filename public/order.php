<?php
    include_once 'header.php';
    include_once '../src/model/DbContext.php';
    include_once '../src/model/customer.php';
    include_once '../src/model/product.php';

    if(!isset($db))
    {
        $db = new DbContext();
    }
    if(isset($_POST['submit_order']))
    {

    }
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
        <form>
            <div class="form-group">
                <label for="tableNo">Table Number</label>
                <select id="table" class="form-control">
                    <option>--Select Table--</option>
                    <?php
                    $optionString = "";
                    $tables = $db->tableSelector();

                    if ($tables) {
                        foreach ($tables as $table)
                        {
                            $optionString.= "<option>".$table['TableNo']."</option>";
                        }
                    }
                    echo $optionString;


                    ?>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group col-md-10">
                    <label for="choiceTea">Select Tea</label>
                    <select id="choiceTea" class="form-control">
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
                <div class="form-group col-md-2">
                    <label for="inputAmount">Quantity</label>
                    <select id="inputAmount" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
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
