<?php

class Order extends \Model {
    /**
     * @var string
     */
    static protected $table = 'orders';

    /**
     * The first element is the primary key
     * The order is important!
     *
     * @var []
     */
    static protected $fields = [
        'id',
        'user_id',
        'availability_id',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * The order is important!
     *
     * @var []
     */
    static public $statusStates = [
        'basket',
        'ordered',
        'arrived',
        'sent_back',
        'fulfilled'
    ];

    /**
     * @return array
     */
    static public function getStatusStates() {
        return Order::$statusStates;
    }

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
    private $availability_id;

    /**
     * @var string
     */
    private $status;

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

        $this->user_id = $args['user_id'] ?? $this->user_id;
        $this->availability_id = $args['availability_id'] ?? $this->availability_id;
        $this->status = $args['status'] ?? $this->status;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
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
    public function getAvailabilityId() {
        return $this->availability_id;
    }

    /**
     * @param int $availability_id
     */
    public function setAvailabilityId(int $availability_id) {
        $this->availability_id = $availability_id;
    }

    /**
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status) {
        $this->status = $status;
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
     * @return bool
     */
    public function findById($id) {
        $result = parent::findById($id);

        if ($result) {
            $properties = $this->mysqlResultToArray($result);

            $this->id = $properties['id'] ?? '';
            $this->user_id = $properties['user_id'] ?? '';
            $this->availability_id = $properties['availability_id'] ?? '';
            $this->status = $properties['status'] ?? '';
            $this->created_at = $properties['created_at'] ?? '';
            $this->updated_at = $properties['updated_at'] ?? '';
        }

        return $result;
    }

    /**
     * @param $user_id
     *
     * @param $status
     *
     * @return array
     */
    public static function getAllOrdersByUserId($user_id, $status) {
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE user_id=\'' . $user_id . '\' AND status=\'' . $status . '\';';

        return parent::findAll($sql);
    }

    /**
     * @return boolean
     */
    public function save() {
        $this->validate();

        return parent::insert(
            [
                'user_id' => parent::$db->escape_string($this->user_id),
                'availability_id' => parent::$db->escape_string($this->availability_id),
                'status' => parent::$db->escape_string($this->status)
            ]
        );
    }

    public function validate() {
        return;
    }
}
