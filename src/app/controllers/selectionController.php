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
        $group = htmlspecialchars($_GET['g']) ?? '';
        $sale = htmlspecialchars($_GET['sale']) ?? FALSE;
        $new = htmlspecialchars($_GET['new']) ?? FALSE;

        include CURR_VIEW_PATH . "selection.phtml";
    }
}
