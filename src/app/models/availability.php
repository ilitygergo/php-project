<?php

class Availability extends \Model {
    /**
     * @var string
     */
    static protected $table = 'availabilities';

    /**
     * The first element is the primary key
     * The order is important!
     *
     * @var []
     */
    static protected $fields = [
        'id',
        'product_id',
        'size',
        'color',
        'amount',
        'sale',
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
    private $product_id;

    /**
     * @var string
     */
    private $size;

    /**
     * @var string
     */
    private $color;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var float
     */
    private $sale;

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

        $this->size = $args['size'] ?? $this->size;
        $this->color = $args['color'] ?? $this->color;
        $this->amount = $args['amount'] ?? $this->amount;
        $this->sale = $args['sale'] ?? $this->sale;
    }

    /**
     * @param $args
     */
    public function init($args = NULL) {
        $this->id = $args['id'] ?? $this->id;
        $this->product_id = $args['product_id'] ?? $this->product_id;
        $this->size = $args['size'] ?? $this->size;
        $this->color = $args['color'] ?? $this->color;
        $this->amount = $args['amount'] ?? $this->amount;
        $this->sale = $args['sale'] ?? $this->sale;
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
    public function getProductId() {
        return $this->product_id;
    }

    /**
     * @return string
     */
    public function getSize() {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize(string $size) {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color) {
        $this->color = $color;
    }

    /**
     * @return int
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount) {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getSale() {
        return $this->sale;
    }

    /**
     * @param float $sale
     */
    public function setSale(float $sale) {
        $this->sale = $sale;
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
     * @param $product_id
     *
     * @return array
     */
    public static function getAllAvailabilityById($product_id) {
        return parent::findAll("SELECT * FROM " . self::$table .
            " WHERE product_id='" . $product_id . "';");
    }

    /**
     * @param $product_id
     *
     * @param $size
     *
     * @param $color
     *
     * @return array
     */
    public static function getFilteredAvailabilityById($product_id, $size, $color) {
        return parent::findAll("SELECT * FROM " . self::$table .
            " WHERE product_id='" . $product_id . "'" .
            " AND size='" . $size . "'" .
            " AND color='" . $color . "';")[0];
    }

    /**
     * @return void|boolean
     */
    public function save() {
        return parent::insert(
            [
                'product_id' => parent::$db->escape_string($this->product_id),
                'size' => parent::$db->escape_string($this->size),
                'color' => parent::$db->escape_string($this->color),
                'amount' => parent::$db->escape_string($this->amount),
                'sale' => parent::$db->escape_string($this->sale)
            ]
        );
    }

    /**
     * @return bool|mixed
     */
    public function deleteAllByProductId($product_id) {
        return parent::delete(1, $product_id);
    }
}
