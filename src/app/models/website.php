<?php
namespace App\Models;

use App\Framework\Core\Model;
use App\Models\ModelTrait;

class Website extends Model {
    use ModelTrait;
    /**
     * @var Website
     */
    private static $instance = null;

    /**
     * @var string
     */
    static protected $table = 'website';

    /**
     * The first element is the primary key
     * The order is important!
     *
     * @var []
     */
    static protected $fields = [
        'id',
        'internal',
        'currency',
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
    private $internal;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    public function __construct() {
        $mysqli_result = $this->findFirst('SELECT * FROM ' . self::$table);

        $website = [];

        foreach ($mysqli_result as $key => $value) {
            $website[self::$fields[$key]] = $value;
        }

        $this->argumentValuesToProperties($website);
    }

    /**
     * @return Website
     */
    public static function getInstance() {
        if (self::$instance == null)  {
            self::$instance = new Website();
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
    public function getInternal() {
        return $this->internal;
    }

    /**
     * @param string $internal
     */
    public function setInternal(string $internal) {
        $this->internal = $internal;
    }

    /**
     * @return string
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency) {
        $this->currency = $currency;
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
}
