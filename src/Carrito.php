<?php

namespace Mapache;
require_once 'Products.php';

class Carrito
{
    private $products;

    public function __construct()
    {
        $this->products = new Products;
    }

    public function barcodeGetter($code = false)
    {
        echo("\n\nInsert product: ");
        if (!$code) $code = fgetss(STDIN);
        $this->addToCart($this->getCleanCode($code));
        self::barcodeGetter();
    }

    public function getCurrentTotal()
    {
        return $this->products->getTotal();
    }

    private function addToCart($code)
    {
        foreach ($code as $c => $v) {
            $this->products->addProduct($v);
        }
        print_r($this->products->getTotal());
    }

    private function getCleanCode($code)
    {
        $codeArray = explode(',', str_replace("\n", "", $code));
        foreach ($codeArray as &$codeValue) {
            $codeValue = trim($codeValue);
        }
        return $codeArray;
    }

}