<?php

class Product extends \Model {
    /**
     * @var string
     */
    static protected $table = 'products';

    /**
     * The first element is the primary key
     * The order is important!
     * @var []
     */
    static protected $fields = [
        'id',
        'name',
        'brand',
        'cost',
        'category',
        'subcategory',
        'image',
        'target_group',
        'created_at',
        'updated_at',
    ];

    /**
     * subcategory => category
     * @var []
     */
    static public $categories = [
        'Sneakers' => 'Footwear',
        'Boots' => 'Footwear',
        'Casual' => 'Footwear',
        'Sandals' => 'Footwear',
        'Sweatshirts' => 'Clothes',
        'Shirts' => 'Clothes',
        'Sweaters' => 'Clothes',
        'Backpacks' => 'Accessories',
        'Hats' => 'Accessories',
        'Jewelry' => 'Accessories',
        'Socks' => 'Accessories',
    ];

    /**
     * @var []
     */
    static public $targetGroupSelection = [
        'Male',
        'Female',
        'Unisex',
        'Kids'
    ];

    /**
     * @return array
     */
    static public function getCategories() {
        return array_unique(array_values(Product::$categories));
    }

    /**
     * @return array
     */
    static public function getSubcategories() {
        return array_keys(Product::$categories);
    }

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var int
     */
    private $cost;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $subcategory;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $target_group;

    /**
     * @var DateTime
     */
    private $created_at;

    /**
     * @var DateTime
     */
    private $updated_at;

    /**
     * Product initialization.
     * @param $args
     */
    public function __construct($args = NULL) {
        if ($id = $args['id']) {
            $this->findById($id);
        }

        $this->name = $args['name'] ?? parent::$db->escape_string($this->name);
        $this->brand = $args['brand'] ?? parent::$db->escape_string($this->brand);
        $this->cost = $args['cost'] ?? parent::$db->escape_string($this->cost);
        $this->category = $args['category'] ?? parent::$db->escape_string($this->category);
        $this->subcategory = $args['subcategory'] ?? parent::$db->escape_string($this->subcategory);
        $this->image = $args['image'] ?? parent::$db->escape_string($this->image);
        $this->target_group = $args['target_group'] ?? parent::$db->escape_string($this->target_group);
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
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBrand() {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand) {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getCost() {
        return $this->cost;
    }

    /**
     * @param string $cost
     */
    public function setCost(string $cost) {
        $this->brand = $cost;
    }

    /**
     * @return string
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category) {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getSubcategory() {
        return $this->subcategory;
    }

    /**
     * @param string $subcategory
     */
    public function setSubcategory(string $subcategory) {
        $this->subcategory = $subcategory;
    }

    /**
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image) {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getTargetGroup() {
        return $this->target_group;
    }

    /**
     * @param string $target_group
     */
    public function setTargetGroup(string $target_group) {
        $this->target_group = $target_group;
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
     * @return bool
     */
    public function newProduct() {
        if ($this->created_at < strtotime("-1 week")) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * @param $args
     * @return array
     */
    public static function getAllProducts($args = []) {
        if ($args['brand'] != '') {
            $args['brand'] =  'brand=\'' . parent::$db->escape_string($args['brand']) . '\'';
        } else {
            unset($args['brand']);
        }

        if ($args['category'] != '') {
            $args['category'] =  'category=\'' . parent::$db->escape_string($args['category']) . '\'';
        } else {
            unset($args['category']);
        }

        if ($args['subcategory'] != '') {
            $args['subcategory'] =  'subcategory=\'' . parent::$db->escape_string($args['subcategory']) . '\'';
        } else {
            unset($args['subcategory']);
        }

        if ($args['target_group'] != '') {
            $args['target_group'] =  'target_group=\'' . parent::$db->escape_string($args['target_group']) . '\'';
        } else {
            unset($args['target_group']);
        }

        if ($args['sale'] != FALSE) {
            $args['sale'] =  'sale!=\'0\'';
        } else {
            unset($args['sale']);
        }

        if ($args['new'] != FALSE) {
            $args['new'] =  'created_at=\'' . parent::$db->escape_string($args['new']) . '\' ';
        } else {
            unset($args['new']);
        }

        if (!empty($args)) {
            return parent::findAll('SELECT * FROM ' . self::$table . ' WHERE ' . implode(' AND ', $args));
        } else {
            return parent::findAll('SELECT * FROM ' . self::$table);
        }
    }

    /**
     * @param int $id
     * @return bool|void
     */
    public function findById($id) {
        $result = parent::findById($id);
        $properties = $this->mysqlResultToArray($result);

        $this->id = $properties['id'] ?? '';
        $this->name = $properties['name'] ?? '';
        $this->brand = $properties['brand'] ?? '';
        $this->cost = $properties['cost'] ?? '';
        $this->category = $properties['category'] ?? '';
        $this->subcategory = $properties['subcategory'] ?? '';
        $this->image = $properties['image'] ?? '';
        $this->target_group = $properties['target_group'] ?? '';
        $this->created_at = $properties['created_at'] ?? '';
        $this->updated_at = $properties['updated_at'] ?? '';
    }

    /**
     * Saving a product to the database
     * @return void|boolean
     */
    public function save() {
        $this->validate();

        $product = parent::isUnique('name', $this->name);

        if ($product && $product[0] != $this->getId()) {
            parent::$errors[] = "Already registered product name!";
        }

        if (!empty(parent::$errors)) {
            return;
        }

        if ($this->getId() != '') {
            $result = parent::update(
                [
                    'id' => parent::$db->escape_string($this->id),
                    'name' => parent::$db->escape_string($this->name),
                    'brand' => parent::$db->escape_string($this->brand),
                    'cost' => parent::$db->escape_string($this->cost),
                    'category' => parent::$db->escape_string($this->category),
                    'subcategory' => parent::$db->escape_string($this->subcategory),
                    'image' => parent::$db->escape_string($this->image),
                    'target_group' => parent::$db->escape_string($this->target_group),
                ]
            );
        } else {
            $result = parent::insert(
                [
                    'name' => parent::$db->escape_string($this->name),
                    'brand' => parent::$db->escape_string($this->brand),
                    'cost' => parent::$db->escape_string($this->cost),
                    'category' => parent::$db->escape_string($this->category),
                    'subcategory' => parent::$db->escape_string($this->subcategory),
                    'image' => parent::$db->escape_string($this->image),
                    'target_group' => parent::$db->escape_string($this->target_group),
                ]
            );
        }

        return $result;
    }

    /**
     * Validate the instance when saving to the database
     */
    public function validate() {
        parent::$errors = [];

        if (empty($this->name)) {
            parent::$errors[] = 'Product name can\'t be empty';
        }

        if (empty($this->brand)) {
            parent::$errors[] = 'Brand name can\'t be empty';
        }

        if (empty($this->cost)) {
            parent::$errors[] = 'Cost can\'t be empty';
        }

        if (!is_numeric($this->cost)) {
            parent::$errors[] = 'Cost has to be a number';
        }

        if (!in_array($this->category, self::getCategories())) {
            parent::$errors[] = 'Invalid category';
        }

        if (!in_array($this->subcategory, self::getSubcategories())) {
            parent::$errors[] = 'Invalid category';
        }

        if (empty($this->target_group)) {
            parent::$errors[] = 'Target group can\'t be empty';
        }

        return parent::$errors;
    }
}
