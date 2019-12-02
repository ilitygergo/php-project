<?php

class IndexController extends \Controller {
    /**
     * Handles images in the query string and displays the index page otherwise
     */
    public function indexAction() {
        include  CURR_VIEW_PATH . "index.phtml";
    }

    /**
     * Logs in the user
     */
    public function loginAction() {
        if (isPostRequest() && isset($_POST['user'])) {
            $user = UserModel::getInstance();
            $user->init($_POST['user']);
            $user->setPassword($_POST['user']['password']);
            $user->login();
        }

        include  CURR_VIEW_PATH . "index.phtml";
    }

    /**
     * Logs the user out
     */
    public function logoutAction() {
        if (isPostRequest()) {
            $session = Session::getInstance();
            $session->logout();
        }

        include  CURR_VIEW_PATH . "index.phtml";
    }

    /**
     * Search for products
     */
    public function searchAction() {
        include  CURR_VIEW_PATH . "index.phtml";
    }
}
