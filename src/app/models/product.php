<?php

class Product extends \Model implements modelInterface {
    use modelTrait;

    const PRIMARY_KEY = 0;

    /**
     * @var string
     */
    static protected $table = 'products';

    /**
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
     *
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
    static public function getCategoriesAndSubcategories() {
        return Product::$categories;
    }

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
     * @param $args
     */
    public function __construct($args = NULL) {
        if (isset($args['id']) && $args['id'] != '') {
            $this->findById($args['id']);
        }

        $this->argumentValuesToProperties($args);
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
    public function isNew() {
        if ($this->created_at > date('Y-m-d 00:00:00', strtotime("-1 week"))) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * @param array $args
     *
     * @param bool $count
     *
     * @param int $limit
     *
     * @param int $offset
     *
     * @return array
     */
    public static function getAll($args = [], $count = FALSE, $limit = 0, $offset = 0) {
        if (isset($args['brand']) && $args['brand'] != '') {
            $args['brand'] =  'brand=\'' . parent::$db->escape_string($args['brand']) . '\'';
        } else {
            unset($args['brand']);
        }

        if (isset($args['category']) && $args['category'] != '') {
            $args['category'] =  'category=\'' . parent::$db->escape_string($args['category']) . '\'';
        } else {
            unset($args['category']);
        }

        if (isset($args['subcategory']) && $args['subcategory'] != '') {
            $args['subcategory'] =  'subcategory=\'' . parent::$db->escape_string($args['subcategory']) . '\'';
        } else {
            unset($args['subcategory']);
        }

        if (isset($args['target_group']) && $args['target_group'] != '') {
            $args['target_group'] =  'target_group=\'' . parent::$db->escape_string($args['target_group']) . '\'';
        } else {
            unset($args['target_group']);
        }

        if (isset($args['sale']) && $args['sale'] == '') {
            unset($args['sale']);
        }

        if (isset($args['new']) && $args['new'] != '') {
            $args['new'] =  'created_at > \'' . date('Y-m-d 00:00:00', strtotime("-1 week")) . '\' ';
        } else {
            unset($args['new']);
        }

        if (isset($args['sale']) && $args['sale']) {
            unset($args['sale']);
            $sql = 'SELECT * FROM ' . self::$table . ', availabilities WHERE products.id = availabilities.product_id AND sale!=\'0\' AND ' . implode(' AND ', $args);
        } else if (!empty($args)) {
            $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . implode(' AND ', $args);
        } else {
            $sql = 'SELECT * FROM ' . self::$table;
        }

        if ($limit != 0) {
            $sql .= ' LIMIT ' . $limit . ' ';
        }

        if ($offset != 0) {
            $sql .= ' OFFSET ' . $offset . ' ';
        }

        if ($count) {
            $sql = str_replace('SELECT * FROM', 'SELECT COUNT(*) FROM', $sql);
        }

        return parent::findAll($sql);
    }

    /**
     * @param $name
     *
     * @return array
     */
    public static function search($name) {
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE name LIKE \'%' . $name . '%\'';

        return parent::findAll($sql);
    }

    /**
     * @param int $id
     */
    public function findById($id) {
        if ($result = parent::findById($id)) {
            $properties = $this->mysqlResultToArray($result);
            $this->argumentValuesToProperties($properties);
        }
    }

    /**
     * @return bool|mixed|resource|void
     */
    public function save() {
        if (!$this->validate()) {
            return;
        }

        $data = $this->escapedPropertiesToArray();

        if ($this->isNewInstance()) {
            return parent::insert($data);
        } else {
            $data['id'] = parent::$db->escape_string($this->id);

            return parent::update($data);
        }
    }

    /**
     * @return bool
     */
    public function validate() {
        if (empty($this->name)) {
            Alert::getInstance()->add('Product name can\'t be empty');
        }

        if (empty($this->brand)) {
            Alert::getInstance()->add('Brand name can\'t be empty');
        }

        if (empty($this->cost)) {
            Alert::getInstance()->add('Cost can\'t be empty');
        }

        if (!is_numeric($this->cost)) {
            Alert::getInstance()->add('Cost has to be a number');
        }

        if (!in_array($this->category, self::getCategories())) {
            Alert::getInstance()->add('Invalid category');
        }

        if (!in_array($this->subcategory, self::getSubcategories())) {
            Alert::getInstance()->add('Invalid category');
        }

        if (!in_array($this->subcategory, array_keys($this->getCategoriesAndSubcategories(), $this->category))) {
            Alert::getInstance()->add('Category and subcategory mismatch');
        }

        if (empty($this->target_group)) {
            Alert::getInstance()->add('Target group can\'t be empty');
        }

        $product = parent::isUnique('name', $this->name);

        if ($product && $product[0] != $this->getId()) {
            Alert::getInstance()->add('Already registered product name!');
        }

        return Alert::getInstance()->isAlertEmpty();
    }
}
