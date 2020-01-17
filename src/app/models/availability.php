<?php
namespace App\Models;

use App\Framework\Core\Model;
use App\Models\ModelInterface;
use App\Models\ModelTrait;

class Availability extends Model implements modelInterface {
    use ModelTrait;

    const PRIMARY_KEY = 0;
    const FOREIGN_KEY_PRODUCT = 1;

    /**
     * @var string
     */
    static protected $table = 'availabilities';

    /**
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
        } else {
            $this->argumentValuesToProperties($args);
        }
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
    public static function getAllById($product_id) {
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
    public static function getFilteredById($product_id, $size, $color) {
        return parent::findAll("SELECT * FROM " . self::$table .
            " WHERE product_id='" . $product_id . "'" .
            " AND size='" . $size . "'" .
            " AND color='" . $color . "';")[0];
    }

    /**
     * @return boolean
     */
    public function save() {
        return parent::insert($this->escapedPropertiesToArray());
    }

    /**
     * @return bool|mixed
     */
    public function deleteAllByProductId($product_id) {
        return parent::delete(self::FOREIGN_KEY_PRODUCT, $product_id);
    }
}
