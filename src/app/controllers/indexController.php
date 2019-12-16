<?php

class IndexController extends \Controller {
    public function indexAction() {
        include  getenv("CURR_VIEW_PATH") . "index.phtml";
    }

    public function not_foundAction() {
        include  getenv("CURR_VIEW_PATH") . "pageNotFound.phtml";
    }

    public function loginAction() {
        if (isPostRequest() && isset($_POST['user'])) {
            $user = new User($_POST['user']);
            $user->setPassword($_POST['user']['password']);
            $user->login();
        }

        include  getenv("CURR_VIEW_PATH") . "index.phtml";
    }

    public function logoutAction() {
        if (isPostRequest()) {
            $session = Session::getInstance();
            $session->logout();
        }

        include  getenv("CURR_VIEW_PATH") . "index.phtml";
    }

    public function searchAction() {
        if (isPostRequest() && ($value = $_POST['searchInput']) != '') {
            $products = Product::search($value);

            include getenv("CURR_VIEW_PATH") . "product/selection.phtml";
        } else {
            include  getenv("CURR_VIEW_PATH") . "index.phtml";
        }
    }
}
