<?php
trait ModelTrait {
    /**
     * @param $args
     */
    public function init($args = NULL) {
        foreach (array_values(self::$fields) as $field) {
            if ($args["$field"] == NULL) {
                continue;
            }

            $this->$field = $args["$field"];
        }
    }

    /**
     * @return []
     */
    public function escapedPropertiesToArray() {
        $array = [];

        foreach (array_values(self::$fields) as $field) {
            if ($field == 'id' || $field == 'created_at' || $field == 'updated_at') {
                continue;
            }

            $array["$field"] = parent::$db->escape_string($this->$field);
        }

        return $array;
    }
}
