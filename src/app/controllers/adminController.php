<?php

class AdminController extends \Controller {

    /**
     *
     */
    public function usersAction() {
        $this->redirectIfNotAdmin();

        if (isset($_GET['id'])) {
            include CURR_VIEW_PATH . "admin/edit/users.phtml";
        } else {
            include CURR_VIEW_PATH . "admin/listing/users.phtml";
        }
    }

    /**
     *
     */
    public function ordersAction() {
        $this->redirectIfNotAdmin();

        include CURR_VIEW_PATH . "admin/listing/orders.phtml";
    }

    /**
     *
     */
    public function productsAction() {
        $this->redirectIfNotAdmin();

        if (isset($_GET['id'])) {
            include CURR_VIEW_PATH . "admin/edit/products.phtml";
        } else {
            include CURR_VIEW_PATH . "admin/listing/products.phtml";
        }
    }
}
