<?php

class Review extends \Model implements modelInterface{
    use modelTrait;
    const PRIMARY_KEY = 0;

    /**
     * @var string
     */
    static protected $table = 'reviews';

    /**
     * @var []
     */
    static protected $fields = [
        'id',
        'user_id',
        'product_id',
        'content',
        'stars',
        'created_at',
        'updated_at',
    ];

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @var int
     */
    private $product_id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var int
     */
    private $stars;

    /**
     * @var DateTime
     */
    private $created_at;

    /**
     * @var DateTime
     */
    private $updated_at;

    /**
     * @param $args
     */
    public function __construct($args = NULL) {
        if (isset($args['id'])) {
            $this->findById($args['id']);
        }

        $this->init($args);
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id) {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id) {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getProductId() {
        return $this->product_id;
    }

    /**
     * @param int $product_id
     */
    public function setProductId(int $product_id) {
        $this->product_id = $product_id;
    }

    /**
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content) {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getStars() {
        return $this->stars;
    }

    /**
     * @param string $stars
     */
    public function setStars(string $stars) {
        $this->stars = $stars;
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
     * @param int $id
     *
     * @return bool|mysqli_result|void
     */
    public function findById($id) {
        $result = parent::findById($id);

        $this->init($this->mysqlResultToArray($result));
    }

    /**
     * @param $product_id
     *
     * @return array
     */
    public static function getAllByProductId($product_id) {
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE product_id=\'' . $product_id . '\';';

        return parent::findAll($sql);
    }

    /**
     * @return mixed|string|void
     */
    public function save() {
        if (!$this->validate()) {
            return;
        }

        $data = $this->escapedPropertiesToArray();

        if (isset($this->id)) {
            $data['id'] = parent::$db->escape_string($this->id);

            return parent::update($data);
        } else {
            return parent::insert($data);
        }
    }

    /**
     * @return bool
     */
    public function validate() {
        Alert::getInstance()->removeAlerts();

        if (empty($this->user_id)) {
            Alert::getInstance()->add('You have to log in!');
        }

        if (empty($this->product_id)) {
            Alert::getInstance()->add('Product id can\'t be empty');
        }

        if (empty($this->content)) {
            Alert::getInstance()->add('Content name can\'t be empty');
        }

        if (empty($this->stars)) {
            Alert::getInstance()->add('Stars field can\'t be empty');
        }

        if (!preg_match("/\d{1,5}/", $this->stars)) {
            Alert::getInstance()->add('Stars can only be a number from 1 to 5');
        }

        return Alert::getInstance()->isAlertEmpty();
    }
}
