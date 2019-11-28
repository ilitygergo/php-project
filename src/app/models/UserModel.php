<?php

class UserModel extends \Model {
    /**
     * @var UserModel
     */
    private static $instance = null;

    /**
     * @var string
     */
    static protected $table = 'users';

    /**
     * The first element is the primary key
     * The order is important!
     * @var array
     */
    static protected $fields = [
        'id',
        'first_name',
        'last_name',
        'email',
        'address',
        'gender',
        'age',
        'hashed_password',
        'created_at',
        'updated_at',
    ];

    /**
     * @var int
     */
    private $id;

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
     * Users constructor.
     * @param $args
     */
    public function init($args) {
        $this->id = $args['id'] ?? '';
        $this->setFirstName($args['first_name'] ?? '');
        $this->setLastName($args['last_name'] ?? '');
        $this->setEmail($args['email'] ?? '');
        $this->setAddress($args['address'] ?? '');
        $this->setGender($args['gender'] ?? '');
        $this->setAge($args['age'] ?? 0);
        $this->hashed_password = $args['hashed_password'] ?? '';
    }

    /**
     * @return UserModel
     */
    public static function getInstance() {
        if (self::$instance == null)  {
            self::$instance = new UserModel();
        }

        return self::$instance;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

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
     * @return DateTime
     */
    public function getCreatedAt() {
        return $this->created_at;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt() {
        return $this->updated_at;
    }

    /**
     * @return string
     */
    public function fullName() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    /**
     * Creating a user to the database
     * @return void|boolean
     */
    public function create() {
        $this->validate();

        if (!empty(parent::$errors)) {
            return;
        }

        $this->setHashedPassword();

        $result = parent::insert(
            [
                'first_name' => parent::$db->escape_string($this->first_name),
                'last_name' => parent::$db->escape_string($this->last_name),
                'email' => parent::$db->escape_string($this->email),
                'hashed_password' => parent::$db->escape_string($this->hashed_password)
            ]
        );

//        if (is_integer($result)) {
//            $this->id = $result;
//
//            return $this->login();
//        }
    }

    /**
     * Logs the user in
     * @return bool|string
     */
    public function login() {
        if (!isset($this->email)) {
            return 'Email or password is invalid!';
        }

        if (!isset($this->password)) {
            return 'Email or password is invalid!';
        }

        if (!($mysql_result = $this->findByEmail($this->email))) {
            return 'Email or password is invalid!';
        }

        $user = [];

        foreach ($mysql_result as $key => $value) {
            $user[self::$fields[$key]] = $value;
        }

        $this->init($user);

        if (!password_verify($this->password, $this->hashed_password)) {
            return 'Email or password is invalid!';
        }

        $session = Session::getInstance();
        $session->login($this);

        return $this;
    }

    /**
     * Validate the instance
     */
    public function validate() {
        parent::$errors = [];

        if (empty($this->first_name)) {
            parent::$errors[] = 'First name can\'t be empty';
        }

        if (!preg_match("/^[áéúőóüöA-Za-z-]+$/", $this->first_name)) {
            parent::$errors[] = 'First name: only letters allowed';
        }

        if (empty($this->last_name)) {
            parent::$errors[] = 'Last name can\'t be empty';
        }

        if (!preg_match("/^[áéúőóüöA-Za-z-]+$/", $this->last_name)) {
            parent::$errors[] = 'Last name: only letters allowed';
        }

        if (empty($this->email)) {
            parent::$errors[] = 'Email can\'t be empty';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            parent::$errors[] = "Invalid email format";
        }

        if (parent::isUnique('email', $this->email)) {
            parent::$errors[] = "Already registered email!";
        }

        if (empty($this->password)) {
            parent::$errors[] = 'Password can\'t be empty';
        }

        if (strlen($this->password) < 8) {
            parent::$errors[] = "Your Password Must Contain At Least 8 Characters!";
        }

        if(!preg_match("#[0-9]+#", $this->password)) {
            parent::$errors[] = "Your Password Must Contain At Least 1 Number!";
        }

        if(!preg_match("#[A-Z]+#", $this->password)) {
            parent::$errors[] = "Your Password Must Contain At Least 1 Capital Letter!";
        }

        if(!preg_match("#[a-z]+#", $this->password)) {
            parent::$errors[] = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }

        return parent::$errors;
    }
}
