<?php
use PHPUnit\Framework\TestCase;

class AvailabilityTest extends TestCase {
    /**
     * @coversNothing
     * @return Availability
     */
    public function createInstance() {
        return new Availability();
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

    /**
     * @inheritDoc
     * @covers Availability::init
     */
    public function testInit() {
        $user = $this->createInstance();
        $args = [
            'id' => 5,
            'product_id' => 134,
            'size' => 'XXL',
            'color' => 'black',
            'amount' => 12,
            'sale' => 0
        ];

        $user->init($args);

        $this->assertSame($user->getId(), $args['id']);
        $this->assertSame($user->getProductId(), $args['product_id']);
        $this->assertSame($user->getSize(), $args['size']);
        $this->assertSame($user->getColor(), $args['color']);
        $this->assertSame($user->getAmount(), $args['amount']);
        $this->assertSame($user->getSale(), $args['sale']);
    }
}
