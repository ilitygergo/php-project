<?php

class ReviewController extends \Controller {
    public function indexAction() {
        if (isPostRequest()) {
            $review = new Review($_POST['review']);
            $review->save();
        }

        redirect_to('/product/show?id=' . $_POST['review']['product_id']);
    }
}
