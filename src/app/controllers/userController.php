<?php

class UserController extends \Controller {
    /**
     *
     */
    public function profileAction() {
        if (isset($_GET['id']) && $_GET['id'] == Session::getInstance()->getUserId()) {
            include CURR_VIEW_PATH . "admin/edit/users.phtml";
        } else {
            include CURR_VIEW_PATH . "index.phtml";
        }
    }

    /**
     *
     */
    public function updateAction() {
        if (isPostRequest()) {
            $user = new User($_POST['user']);
            $user->edit();
        }

        $this->redirectIfNotAdmin();

        include CURR_VIEW_PATH . "admin/listing/users.phtml";
    }

    /**
     *
     */
    public function deleteAction() {
        if (isPostRequest()) {
            $user = new User($_POST['user']);

            if ($user->getId() == Session::getInstance()->getUserId()) {
                Session::getInstance()->logout();
            }

            $user->delete(0, $user->getId());
        }

        $this->redirectIfNotAdmin();

        include CURR_VIEW_PATH . "admin/listing/users.phtml";
    }
}
