<?php
use PHPUnit\Framework\TestCase;
use App\Framework\Core\Model;
use App\Models\Website;

class WebsiteTest extends TestCase {
    /**
     * @coversNothing
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockInstance() {
        return $this->getMockBuilder(Website::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @inheritDoc
     */
    public function testInheritance() {
        $this->assertInstanceOf(
            Model::class,
            $this->mockInstance()
        );
    }
}
