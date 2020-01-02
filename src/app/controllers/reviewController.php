<?php

class ReviewController extends \Controller {
    public function indexAction() {
        if (isPostRequest()) {
            $review = new Review($_POST['review']);
            $review->save();
        }

        redirect_to('/product/show?id=' . $_POST['review']['product_id']);
    }

    public function updateAction() {
        if (isset($_GET['id'])) {
        }

        redirect_to('/product/show?id=' . $_GET['id']);
    }

    public function deleteAction() {
        if (isset($_GET['id'])) {
            $review = new Review($_GET);

            $product_id = $review->getProductId();

            $review->delete(Review::PRIMARY_KEY, $review->getId());
        }

        redirect_to('/product/show?id=' . $product_id);
    }
}
