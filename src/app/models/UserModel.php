<?php

class UserModel extends \Model {
    /**
     * @var string
     */
    static protected $table = 'users';

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
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $hashed_password;

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
     * @param string $password
     */
    public function setPassword(string $password) {
        $this->password = $password;
    }

    /**
     *
     */
    public function setHashedPassword() {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
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
     * @return array
     */
    public static function getColumns() {
        return [
            'id',
            'first_name',
            'last_name',
            'email',
            'address',
            'gender',
            'age',
            'password',
            'hashed_password'
        ];
    }

    /**
     * Users constructor.
     * @param $args
     */
    public function __construct($args) {
        $this->setFirstName($args['first_name'] ?? '');
        $this->setLastName($args['last_name'] ?? '');
        $this->setEmail($args['email'] ?? '');
        $this->setAddress($args['address'] ?? '');
        $this->setGender($args['gender'] ?? '');
        $this->setAge($args['age'] ?? 0);
        $this->setPassword($args['password'] ?? '');
    }

    /**
     * @return string
     */
    public function fullName() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    /**
     * Creating a user to the database
     * @return void
     */
    public function create() {
        $this->validate();

        if (!empty(parent::$errors)) {
            return;
        }

        $this->setHashedPassword();

        parent::insert(
            [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'hashed_password' => $this->hashed_password
            ]
        );
    }

    /**
     * Validate the instance
     */
    public function validate() {
        parent::$errors = [];

        if (empty($this->first_name)) {
            parent::$errors[] = 'First name can\'t be empty';
        }

        if (!preg_match("/^[áéúőóüöA-Za-z0-9_-]+$/", $this->first_name)) {
            parent::$errors[] = 'First name: only letters allowed';
        }

        if (empty($this->last_name)) {
            parent::$errors[] = 'Last name can\'t be empty';
        }

        if (!preg_match("/^[áéúőóüöA-Za-z0-9_-]+$/", $this->last_name)) {
            parent::$errors[] = 'Last name: only letters allowed';
        }

        if (empty($this->email)) {
            parent::$errors[] = 'Email can\'t be empty';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            parent::$errors[] = "Invalid email format";
        }

        if (empty($this->password)) {
            parent::$errors[] = 'Password can\'t be empty';
        }

        if (strlen($this->password) <= 8) {
            parent::$errors[] = "Your Password Must Contain At Least 8 Characters!";
        }
        elseif(!preg_match("#[0-9]+#", $this->password)) {
            parent::$errors[] = "Your Password Must Contain At Least 1 Number!";
        }
        elseif(!preg_match("#[A-Z]+#", $this->password)) {
            parent::$errors[] = "Your Password Must Contain At Least 1 Capital Letter!";
        }
        elseif(!preg_match("#[a-z]+#", $this->password)) {
            parent::$errors[] = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }

        return parent::$errors;
    }

    /**
     * Returns the database columns except the id
     * @return array
     */
    public function attributes() {
        $attributes = [];

        foreach (self::getColumns() as $column) {
            if ($column == 'id') continue;

            $attributes[$column] = $this->$column;
        }

        return $attributes;
    }

    /**
     * Sanitize the attribute values
     * @return array
     */
    public function sanitizeAttributes() {
        $sanitized = [];

        foreach ($this->attributes() as $key => $value) {
            $sanitized[$key] = mysqli_escape_string(parent::$db, $value);
        }

        return $sanitized;
    }
}
