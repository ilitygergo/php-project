<?php

class IndexController extends \Controller {

    /**
     * Handles images in the query string and displays the index page otherwise
     */
    public function indexAction() {
        if (isset($_GET['image'])) {
            header("Content-Type:image/jpg");

            $image = PUBLIC_PATH . 'images/' . $_GET['image'];

            if (is_file($image) ||  is_file($image = PUBLIC_PATH . 'images/not_found.jpg')) readfile($image);
        } else {
            include  CURR_VIEW_PATH . "index.phtml";
        }
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
}
