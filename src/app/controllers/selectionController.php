<?php

class SelectionController extends \Controller {
    public function indexAction() {
        include getenv("CURR_VIEW_PATH") . "product/selection.phtml";
    }

    public function searchAction() {
        if (!isGetRequest()) {
            include getenv("CURR_VIEW_PATH") . "product/selection.phtml";
        }

        $products = Product::getAll(
            [
                'brand' => htmlspecialchars($_GET['b']) ?? '',
                'category' => htmlspecialchars($_GET['c']) ?? '',
                'subcategory' => htmlspecialchars($_GET['s']) ?? '',
                'target_group' => htmlspecialchars($_GET['g']) ?? '',
                'sale' => htmlspecialchars($_GET['sale']) ?? '',
                'new' => htmlspecialchars($_GET['new']) ?? ''
            ]
        );

        include getenv("CURR_VIEW_PATH") . "product/selection.phtml";
    }
}
