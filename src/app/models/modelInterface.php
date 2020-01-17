<?php
namespace App\Models;

interface ModelInterface {
    public function findById($id);

    public function save();
}
