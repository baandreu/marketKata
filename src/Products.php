<?php
/**
 * Created by PhpStorm.
 * User: viscaweb
 * Date: 24/1/18
 * Time: 11:40
 */

namespace Mapache;

class Products
{
    private $products;
    private $total_products;
    private $total;

    public function __construct()
    {
        $this->total = 0;
        $this->total_products = 0;
    }

    public function addProduct($code)
    {
        if (!isset($this->products[$code])) $this->products[$code] = 0;
        $this->products[$code] += 1;
        $this->total_products += 1;
        $this->setTotal($code);
    }

    public function getProducts()
    {
        return $this->products();
    }

    public function getTotal()
    {
        return $this->total;
    }

    private function setTotal($product)
    {
        $price = $this->getPrice($product);
        if (!$price) return false;
        $this->total += $price - $this->getDiscount($product);
        return true;
    }

    private function getPrice($product)
    {
        switch ($product) {
            case "banana":
                return 150;
                break;
            case "manzana":
            case "apple":
            case "apfel":
                return 100;
                break;
            case "cherry":
                return 75;
                break;
            default:
                return false;
        }
    }

    private function getDiscount($product)
    {
        $discount = 0;
        switch ($product) {
            case "apfel":
                if (isset($this->products[$product]) && ($this->products[$product] % 2 == 0)) {
                    $discount += 150;
                }
                break;
            case "apple":
                if (isset($this->products[$product]) && ($this->products[$product] % 4 == 0)) {
                    $discount += 100;
                }
                break;
            case "manzana":
                if (isset($this->products[$product]) && ($this->products[$product] % 3 == 0)) {
                    $discount += 100;
                }
                break;
            case "banana":
                if (isset($this->products[$product]) && ($this->products[$product] % 2 == 0)) {
                    $discount += $this->getPrice($product);
                }
                break;
            case "cherry":
                if (isset($this->products[$product]) && ($this->products[$product] % 2 == 0)) {
                    $discount += 20;
                }
            default:
                break;
        }

        if(($this->total_products % 5) == 0) $discount += 200;
        return $discount;
    }

}