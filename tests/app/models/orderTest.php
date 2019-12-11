<?php
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase {
    /**
     * @coversNothing
     * @return Order
     */
    public function createInstance() {
        return new Order();
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
