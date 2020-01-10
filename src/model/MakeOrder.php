<?php

class makeOrder
{
    private $id;
    private $time;
    private $customerId;


    public function __construct($customerNumber)
    {
        $this->customerId = $customerNumber;
    }

    //the total price can be calculated by using product->price for each of the elements in the array of makeOrder items

    public function setID($oID)
    {
        $this->id = $oID;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setTime($Otime)
    {
        $this->time = $Otime;
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
