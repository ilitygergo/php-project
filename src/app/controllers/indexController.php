<?php

class IndexController extends \Controller {
    /**
     * Handles images in the query string and displays the index page otherwise
     */
    public function indexAction() {
        include  getenv("CURR_VIEW_PATH") . "index.phtml";
    }

    /**
     * Logs in the user
     */
    public function loginAction() {
        if (isPostRequest() && isset($_POST['user'])) {
            $user = new User($_POST['user']);
            $user->setPassword($_POST['user']['password']);
            $user->login();
        }

        include  getenv("CURR_VIEW_PATH") . "index.phtml";
    }

    /**
     * Logs the user out
     */
    public function logoutAction() {
        if (isPostRequest()) {
            $session = Session::getInstance();
            $session->logout();
        }

        include  getenv("CURR_VIEW_PATH") . "index.phtml";
    }

    /**
     * Search for products
     */
    public function searchAction() {
        if (isPostRequest() && ($value = $_POST['searchInput']) != '') {
            $products = Product::searchProduct($value);

            include getenv("CURR_VIEW_PATH") . "product/selection.phtml";
        } else {
            include  getenv("CURR_VIEW_PATH") . "index.phtml";
        }
    }
}
