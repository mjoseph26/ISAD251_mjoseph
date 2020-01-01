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

    public function setCustomer($id)
    {
        $this->customerId = $id;
    }

    public function getCustomer()
    {
        return $this->customerId;
    }


}


?>

