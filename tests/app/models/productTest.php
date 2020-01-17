<?php
use PHPUnit\Framework\TestCase;
use App\Framework\Core\Model;
use App\Models\Product;

class ProductTest extends TestCase {
    /**
     * @coversNothing
     * @return Product
     */
    public function createInstance() {
        return new Product();
    }

    /**
     * @inheritDoc
     */
    public function testInheritance() {
        $this->assertInstanceOf(
            Model::class,
            $this->createInstance()
        );
    }
}
