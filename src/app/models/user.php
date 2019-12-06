<?php

class User extends \Model {
    /**
     * @var string
     */
    static protected $table = 'users';

    /**
     * The first element is the primary key
     * The order is important!
     * @var []
     */
    static protected $fields = [
        'id',
        'first_name',
        'last_name',
        'email',
        'address',
        'gender',
        'birthday',
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
     * @var DateTime
     * Format: YYYY-MM-DD
     */
    private $birthday;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $hashed_password;

    /**
     * @var DateTime
     */
    private $created_at;

    /**
     * @var DateTime
     */
    private $updated_at;

    /**
     * Users initialization.
     * @param $args
     */
    public function __construct($args = NULL) {
        if (isset($args['id'])) {
            $this->findById($args['id']);
        }

        $this->first_name = $args['first_name'] ?? $this->first_name;
        $this->last_name = $args['last_name'] ?? $this->last_name;
        $this->email = $args['email'] ?? $this->email;
        $this->address = $args['address'] ?? $this->address;
        $this->gender = $args['gender'] ?? $this->gender;
        $this->birthday = $args['birthday'] ?? $this->birthday;
        $this->hashed_password = $args['hashed_password'] ?? $this->hashed_password;
    }

    /**
     * @param $args
     */
    public function init($args) {
        $this->id = $args['id'] ?? '';
        $this->first_name = $args['first_name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->address = $args['address'] ?? '';
        $this->gender = $args['gender'] ?? '';
        $this->birthday = $args['birthday'] ?? '';
        $this->hashed_password = $args['hashed_password'] ?? '';
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
     * @return String
     */
    public function getBirthday() {
        return substr($this->birthday, 0, strrpos($this->birthday, ' '));
    }

    /**
     * @param int $birthday
     */
    public function setBirthday(int $birthday) {
        $this->birthday = $birthday;
    }

    /**
     * @return int
     */
    public function getAge() {
        $birthDate = explode("-", $this->birthday);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
            ? ((date("Y") - $birthDate[0]) - 2)
            : (date("Y") - $birthDate[0]));
        return $age;
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
     * @return array
     */
    public static function getAllUser() {
        return parent::findAll('SELECT * FROM ' . self::$table);
    }

    /**
     * Creating a user to the database
     * @return void|boolean
     */
    public function create() {
        $this->validate();
        $this->validatePassword();

        if (parent::isUnique('email', $this->email)) {
            parent::$errors[] = "Already registered email!";
        }


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

        if (is_integer($result)) {
            $this->id = $result;

            return $this->login();
        }
    }

    /**
     * Saving a user to the database
     * @return void|boolean
     */
    public function edit() {
        $this->validate();

        $user = parent::isUnique('email', $this->email);

        if ($user && $user[0] != $this->getId()) {
            parent::$errors[] = "Already registered email!";
        }

        if (!empty(parent::$errors)) {
            return;
        }

        $result = parent::update(
            [
                'id' => parent::$db->escape_string($this->id),
                'first_name' => parent::$db->escape_string($this->first_name),
                'last_name' => parent::$db->escape_string($this->last_name),
                'email' => parent::$db->escape_string($this->email),
                'address' => parent::$db->escape_string($this->address),
                'gender' => parent::$db->escape_string($this->gender),
                'birthday' => parent::$db->escape_string($this->birthday)
            ]
        );

        if ($result) {
            return TRUE;
        }

        return FALSE;
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

        if (!($mysqli_result = $this->findByEmail($this->email))) {
            return 'Email or password is invalid!';
        }

        $this->init($this->mysqlResultToArray($mysqli_result));

        if (!password_verify($this->password, $this->hashed_password)) {
            return 'Email or password is invalid!';
        }

        $session = Session::getInstance();
        $session->login($this);

        return $this;
    }

    /**
     * @param int $id
     * @return bool|mysqli_result|void
     */
    public function findById($id) {
        $result = parent::findById($id);

        $this->init($this->mysqlResultToArray($result));
    }

    /**
     * Validate the instance when saving to the database
     */
    public function validate() {
        parent::$errors = [];

        if (empty($this->first_name)) {
            parent::$errors[] = 'First name can\'t be empty';
        }

        if (!preg_match("/^[áéúőóüöÁÉÚŐÓÜÖA-Za-z-]+$/", $this->first_name)) {
            parent::$errors[] = 'First name: only letters allowed';
        }

        if (empty($this->last_name)) {
            parent::$errors[] = 'Last name can\'t be empty';
        }

        if (!preg_match("/^[áéúőóüöÁÉÚŐÓÜÖA-Za-z-]+$/", $this->last_name)) {
            parent::$errors[] = 'Last name: only letters allowed';
        }

        if (empty($this->email)) {
            parent::$errors[] = 'Email can\'t be empty';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            parent::$errors[] = "Invalid email format";
        }

        return parent::$errors;
    }

    /**
     *
     */
    public function validatePassword() {
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
    }
}
