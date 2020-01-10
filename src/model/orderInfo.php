<?php
class order
{
    private $id;
    private $time;
    private $customerId;


    public function __construct($orderTime,$customerNumber)
    {
        $this->time->$orderTime;
        $this->customerId = $customerNumber;
    }

    //the total price can be calculated by using product->price for each of the elements in the array of order items

    public function getID()
    {
        return $this->id;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getCustomer()
    {
        return $this->customerId;
    }




}

?>
