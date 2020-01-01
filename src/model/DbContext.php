<?php
include_once 'customer.php';
include_once 'product.php';
include_once 'MakeOrder.php';


class DBContext
{
    private $db_server = 'Proj-mysql.uopnet.plymouth.ac.uk';
    private $dbUser = 'ISAD251_MJoseph';
    private $dbPassword = 'ISAD251_22216083';
    private $dbDatabase = 'ISAD251_MJoseph';
    private $dataSourceName;
    private $connection;

    public function __construct(PDO $connection = null)
    {
        $this->connection = $connection;
        try {
            if ($this->connection === null) {
                $this->dataSourceName = 'mysql:dbname=' . $this->dbDatabase . ';host=' . $this->db_server;
                $this->connection = new PDO($this->dataSourceName, $this->dbUser, $this->dbPassword);
                $this->connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
            }
        } catch (PDOException $err) {
            echo 'Connection failed: ', $err->getMessage();
        }
    }

    public function Customers()
    {
        $sql = "SELECT * FROM `customer`";

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $customers = [];

        if ($resultSet) {
            foreach ($resultSet as $row) {
                $client = new customer($row['TableNo']);
                $client->setCustomer($row['CustomerId']);
                $customers[] = $client;
            }
        }

        return $customers;
    }

    public function Products()
    {
        $sql = "SELECT * FROM `product`";

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $products = [];

        if ($resultSet) {
            foreach ($resultSet as $row) {
                $product = new product($row['ProductName'], $row['ProductDesc'], $row['ProductPrice'], $row['ProductStock']);
                $product->setID($row['ProductId']);
                $products[] = $product;
            }
        }

        return $products;

    }

    public function Orders()
    {
        $sql = "SELECT * FROM `order`";

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $orders = [];

        if ($resultSet) {
            foreach ($resultSet as $row) {
                $order = new makeOrder($row['CustomerId']);
                $order->setID($row['OrderId']);
                $order->setTime($row['OrderTime']);
                $orders[] = $order;
            }
        }

        return $orders;

    }

    public function addCustomer($client)
    {
        //CREATE PROCEDURE `AddCustomer`(IN `AtableNo` INT) NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER BEGIN INSERT INTO `customer` (TableNo) VALUES('AtableNo'); END
        $sql = "CALL AddCustomer(:Table)";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':Table', $client->Table(), PDO::PARAM_INT);
        $result = $statement->execute();
        return $result;
    }

    public function createOrder($order)
    {

        $sql = "CALL addOrder(:CustomerNo)";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':CustomerNo', $order->getCustomer(), PDO::PARAM_INT);
        $return = $statement->execute();
        return $return;

    }

    public function currentUser()
    {
        $sql = "SELECT `CustomerId` FROM `customer` ORDER BY `CustomerId` DESC LIMIT 1";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $resultset = $statement->fetch(PDO::FETCH_ASSOC);
        $currentCustomerId = $resultset['CustomerId'];
        return $currentCustomerId;
    }

    public function currentOrder()
    {
        $sql = "SELECT `OrderId` FROM `order` ORDER BY `OrderId` DESC LIMIT 1";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $resultset = $statement->fetch(PDO::FETCH_ASSOC);
        $currentOrderId = $resultset['OrderId'];
        return $currentOrderId;
    }

    public function orderProduct($ordId, $prodId)
    {

        $sql = "CALL ProductToBuy(:OrderNo, :ProductNo)";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':OrderNo', $ordId, PDO::PARAM_INT);
        $statement->bindParam(':ProductNo', $prodId, PDO::PARAM_INT);
        $result = $statement->execute();
        return $result;
    }


    public function selectCId($orderId)
    {
        $sql = "SELECT `CustomerId` FROM `order` WHERE `OrderId`=:OrderNo";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':OrderNo', $orderId, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function viewOrder($orderId)
    {
        $sql = "SELECT `product`.`ProductId`,`ProductName`,`ProductDesc`,`ProductPrice` FROM `order-product`,`product` WHERE `order-product`.`OrderId`=:OrderNo AND `order-product`.`ProductId` = `product`.`ProductId`";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':OrderNo', $orderId, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteOrder($orderId,$product)
    {
        $sql = "DELETE FROM `order-product` WHERE `OrderId`=:OrderNo AND `ProductId`=:ProductNo";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':OrderNo',$orderId);
        $statement->bindValue(':ProductNo',$product);
        $statement->execute();
    }

    public function deleteProduct($productId)
    {
        $sql = "DELETE FROM `product` WHERE `ProductId`=:ProductNo";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':ProductNo',$productId);
        $statement->execute();
    }

    public function addProduct($pId,$pDesc,$pCost)
    {
        $sql = "CALL AddProduct(:ProductNo,:Description,:Cost)";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':ProductNo', $pId, PDO::PARAM_STR);
        $statement->bindParam(':Description', $pDesc, PDO::PARAM_STR);
        $statement->bindParam(':Cost', $pCost);
        $exec = $statement->execute();
        return $exec;

    }

    public function setTime($orderId)
    {
        //UPDATE `order` SET OrderTime=NOW() WHERE `order`.`OrderId` = AorderNumber;
        $sql = "CALL SetTime(:OrderNo)";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':OrderNo',$orderId,PDO::PARAM_INT);
        $statement->execute();
    }

    public function runView()
    {
        $sql = "SELECT * FROM `[CustomerOrders]`";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $values = $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $values;
    }

    public function updateProduct($id,$name,$description,$price)
    {
        $sql = "UPDATE `product` SET `ProductName`=:ProdName,`ProductDesc`=:ProdDesc,`ProductPrice`=:ProdPrice WHERE `ProductId`=:ProdId";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':ProdName', $name, PDO::PARAM_STR);
        $statement->bindParam(':ProdDesc', $description, PDO::PARAM_STR);
        $statement->bindParam(':ProdPrice', $price);
        $statement->bindParam(':ProdId', $id,PDO::PARAM_INT);
        $updated = $statement->execute();

        if($updated)
        {
            header('Location:admin.php');
        }


    }
}

?>

