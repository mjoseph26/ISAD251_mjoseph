<?php
class customer
{
    private $customerId;
    private $table;

    public function __construct($tableNo)
    {
        $this->table = $tableNo;
    }

    public function Table()
    {
        return $this->table;
    }

    public function getCustomer()
    {
        return $this->customerId;
    }


}


?>

