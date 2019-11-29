<?php
class product
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $stock;

    public function __construct($prod_id,$prod_name,$desc,$prod_price,$amtStock)
    {
        $this->id = $prod_id;
        $this->name = $prod_name;
        $this->description = $desc;
        $this->price = $prod_price;
        $this->stock = $amtStock;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getStock()
    {
        return $this->stock;
    }



}