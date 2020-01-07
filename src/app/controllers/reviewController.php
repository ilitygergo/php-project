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
        if (!isset($_POST['id']) && !isset($_POST['content'])) {
            redirect_to('/index');
        }

        $review = new Review($_POST);
        $review->setContent($_POST['content']);
        $review->save();
        $product_id = $review->getProductId();

        redirect_to('/product/show?id=' . $product_id);
    }

    public function deleteAction() {
        if (!isset($_POST['id'])) {
            redirect_to('/index');
        }

        $review = new Review($_POST);
        $product_id = $review->getProductId();
        $review->delete();

        redirect_to('/product/show?id=' . $product_id);
    }
}
