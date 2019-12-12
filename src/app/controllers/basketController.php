<?php

class BasketController extends \Controller {
    /**
     *
     */
    public function indexAction() {
        include CURR_VIEW_PATH . "user/basket.phtml";
    }

    /**
     *
     */
    public function addAction() {
        if (isPostRequest()) {
            $availability = Availability::getFilteredAvailabilityById(
                $_POST['product']['id'],
                $_POST['product']['size'],
                $_POST['product']['color'],
            );

            $order = new Order(
                [
                    'user_id' => Session::getInstance()->getUserId(),
                    'availability_id' => $availability['id'],
                    'status' => Order::getStatusStates()[0]
                ]
            );

            $order->save();

            include CURR_VIEW_PATH . "user/basket.phtml";
        } else {
            include CURR_VIEW_PATH . "pageNotFound.phtml";
        }
    }
}
