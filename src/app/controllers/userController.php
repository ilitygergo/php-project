<?php

class UserController extends \Controller {
    public function profileAction() {
        if (isset($_GET['id']) && $_GET['id'] == Session::getInstance()->getUserId()) {
            include getenv("CURR_VIEW_PATH") . "admin/edit/users.phtml";
        } else {
            include getenv("CURR_VIEW_PATH") . "index.phtml";
        }
    }

    public function updateAction() {
        if (isPostRequest()) {
            $user = new User($_POST['user']);
            $user->edit();

            $message = Session::getInstance()->getUserId() . " " . $user->getId() . " " . date("Y-m-d H-i-s") . "\n";

            file_put_contents(
                getenv("LOGS_PATH") . "userUpdate",
                $message,
                FILE_APPEND
            );
        }

        $this->redirectIfNotAdmin();

        include getenv("CURR_VIEW_PATH") . "admin/listing/users.phtml";
    }

    public function deleteAction() {
        if (isPostRequest()) {
            $user = new User($_POST['user']);

            if ($user->getId() == Session::getInstance()->getUserId()) {
                Session::getInstance()->logout();
            }

            $user->delete(0, $user->getId());
        }

        $this->redirectIfNotAdmin();

        include getenv("CURR_VIEW_PATH") . "admin/listing/users.phtml";
    }
}
