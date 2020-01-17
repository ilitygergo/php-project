<?php
namespace App\Controllers;

use App\Framework\Core\Controller;

class AdminController extends Controller {
    public function usersAction() {
        $this->redirectIfNotAdmin();

        if (isset($_GET['id'])) {
            include getenv("CURR_VIEW_PATH") . "admin/edit/users.phtml";
        } else {
            include getenv("CURR_VIEW_PATH") . "admin/listing/users.phtml";
        }
    }

    public function productsAction() {
        $this->redirectIfNotAdmin();

        if (isset($_GET['id'])) {
            include getenv("CURR_VIEW_PATH") . "admin/edit/products.phtml";
        } else {
            include getenv("CURR_VIEW_PATH") . "admin/listing/products.phtml";
        }
    }
}
