<?php

class UserModel extends \Model {
    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var int
     */
    private $age;

    /**
     * @var int
     */
    private $internal;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @return string
     */
    public function getFirstName() {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name) {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName() {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name) {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email) {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address) {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender) {
        $this->gender = $gender;
    }

    /**
     * @return int
     */
    public function getAge() {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age) {
        $this->age = $age;
    }

    /**
     * @return int
     */
    public function getInternal() {
        return $this->internal;
    }

    /**
     * @param int $internal
     */
    public function setInternal(int $internal) {
        $this->internal = $internal;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->created_at;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updated_at;
    }

    /**
     * Users constructor.
     * @param $args
     */
    public function __construct($args) {
        $this->setFirstName($args['first_name']);
        $this->setLastName($args['last_name']);
        $this->setEmail($args['email']);
        $this->setAddress($args['address']);
        $this->setGender($args['gender']);
        $this->setAge($args['age']);
        $this->setInternal($args['internal']);
    }
}
