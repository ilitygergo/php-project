<?php

class SelectionController extends \Controller {
    /**
     *
     */
    public function indexAction() {
        include CURR_VIEW_PATH . "selection.phtml";
    }

    /**
     *
     */
    public function searchAction() {
        if (!isGetRequest()) {
            include CURR_VIEW_PATH . "selection.phtml";
        }

        $brand = htmlspecialchars($_GET['b']) ?? '';
        $category = htmlspecialchars($_GET['c']) ?? '';
        $subcategory = htmlspecialchars($_GET['s']) ?? '';
        $target_group = htmlspecialchars($_GET['g']) ?? '';
        $sale = htmlspecialchars($_GET['sale']) ?? FALSE;
        $new = htmlspecialchars($_GET['new']) ?? FALSE;

        $products = Product::getAllProducts(
            [
                'brand' => $brand,
                'category' => $category,
                'subcategory' => $subcategory,
                'target_group' => $target_group,
                'sale' => $sale,
                'new' => $new
            ]
        );

        include CURR_VIEW_PATH . "selection.phtml";
    }
}
