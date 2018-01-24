<?php
namespace Test\Unit;

use Mapache\Carrito;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    function checkPriceSum()
    {
        $mapacheMarket = new Carrito();
        $this->barcodeGetter('apple');
        assert($mapacheMarket->getCurrentTotal() == 100);
        $this->barcodeGetter('cherry');
        assert($mapacheMarket->getCurrentTotal() == 175);
        $this->barcodeGetter('cherry');
        assert($mapacheMarket->getCurrentTotal() == 230);
        $this->barcodeGetter('apple,cherry,banana');
        assert($mapacheMarket->getCurrentTotal() == 325);
        $this->barcodeGetter('cherry,cherry');
        assert($mapacheMarket->getCurrentTotal() == 130);
        $this->barcodeGetter('cherry,cherry,banana,banana');
        assert($mapacheMarket->getCurrentTotal() == 280);
        $this->barcodeGetter('apple,manzana,apfel');
        assert($mapacheMarket->getCurrentTotal() == 300);
    }

}
