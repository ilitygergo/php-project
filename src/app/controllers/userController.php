<?php

class UserController extends \Controller {
    /**
     *
     */
    public function updateAction() {
        if (isPostRequest()) {
            $user = UserModel::getInstance();
            $user->init($_POST['user']);
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
            $user = UserModel::getInstance();
            $user->init($_POST['user']);
            $user->delete($user->getId());
        }

        $this->redirectIfNotAdmin();

        include CURR_VIEW_PATH . "admin/listing/users.phtml";
    }
}
