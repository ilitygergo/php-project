<?php
use PHPUnit\Framework\TestCase;

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
