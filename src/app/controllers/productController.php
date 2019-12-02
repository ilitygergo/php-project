<?php

class ProductController extends \Controller {
    /**
     *
     */
    public function updateAction() {
        if (isPostRequest()) {
            $product = ProductModel::getInstance();
            $product->init($_POST['product']);
            $product->edit();
        }

        $this->redirectIfNotAdmin();

        include CURR_VIEW_PATH . "admin/listing/products.phtml";
    }

    /**
     *
     */
    public function deleteAction() {
        if (isPostRequest()) {
            $product = ProductModel::getInstance();
            $product->init($_POST['product']);
            $product->delete($product->getId());
        }

        $this->redirectIfNotAdmin();

        include CURR_VIEW_PATH . "admin/listing/products.phtml";
    }
}
