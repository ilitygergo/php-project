<?php

class SelectionController extends \Controller {
    public function searchAction() {
        if (!isGetRequest()) {
            include getenv("CURR_VIEW_PATH") . "product/selection.phtml";
        }

        $pagination = $this->setPagination();

        $id = '';
        $products = $this->getAllProducts(FALSE, $pagination->per_page, $pagination->offset());

        include getenv("CURR_VIEW_PATH") . "product/selection.phtml";
    }

    /**
     * @return Pagination
     */
    public function setPagination() {
        $current_page = $_GET['page'] ?? 1;
        $per_page = 8;
        $total_count = $this->getAllProducts(TRUE, 0, 0);

        return new Pagination($current_page, $per_page, $total_count);
    }

    public function getAllProducts($count, $per_page, $offset) {
        return Product::getAll(
            [
                'brand' => htmlspecialchars($_GET['b']) ?? '',
                'category' => htmlspecialchars($_GET['c']) ?? '',
                'subcategory' => htmlspecialchars($_GET['s']) ?? '',
                'target_group' => htmlspecialchars($_GET['g']) ?? '',
                'sale' => htmlspecialchars($_GET['sale']) ?? '',
                'new' => htmlspecialchars($_GET['new']) ?? ''
            ],
            $count,
            $per_page,
            $offset
        );
    }
}
