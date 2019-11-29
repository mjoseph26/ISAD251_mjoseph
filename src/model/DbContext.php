<?php
include_once 'customer.php';
include_once 'product.php';

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
        }catch (PDOException $err)
        {
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

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $client = new customer($row['CustomerId'],$row['TableNo']);
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

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $product = new product($row['ProductId'],$row['ProductName'],$row['ProductDesc'],$row['ProductPrice'],$row['ProductStock']);
                $products[] = $product;
            }
        }

        return $products;

    }

    public function tableSelector()
    {
        $sql = "SELECT DISTINCT `TableNo` FROM `customer`";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }






}

?>

