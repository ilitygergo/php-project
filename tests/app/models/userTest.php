<?php
use PHPUnit\Framework\TestCase;
use App\Framework\Core\Model;
use App\Models\User;

class UserTest extends TestCase {
    /**
     * @coversNothing
     * @return User
     */
    public function createInstance() {
        return new User();
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
     * @covers User::init
     */
    public function testInit() {
        $user = $this->createInstance();
        $args = [
            'id' => '500',
            'first_name' => 'Ágota',
            'last_name' => 'Nagy',
            'email' => 'nagyagota@example.com',
            'address' => 'Szeged Űrhajós utca',
            'gender' => 'Female',
            'birthday' => '2019-06-12'
        ];

        $user->argumentValuesToProperties($args);

        $this->assertSame($user->getId(), $args['id']);
        $this->assertSame($user->getFirstName(), $args['first_name']);
        $this->assertSame($user->getLastName(), $args['last_name']);
        $this->assertSame($user->getEmail(), $args['email']);
        $this->assertSame($user->getAddress(), $args['address']);
        $this->assertSame($user->getGender(), $args['gender']);
        $this->assertSame($user->getBirthday(), $args['birthday']);
    }
}
