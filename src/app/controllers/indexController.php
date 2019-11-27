<?php

class IndexController extends \Controller {

    /**
     * Handles images in the query string and displays the index page otherwise
     */
    public function indexAction(){
        if (isset($_GET['image'])) {
            header("Content-Type:image/jpg");

            $image = PUBLIC_PATH . 'images/' . $_GET['image'];

            if (is_file($image) ||  is_file($image = PUBLIC_PATH . 'images/not_found.jpg')) readfile($image);
        } else {
            include  CURR_VIEW_PATH . "index.phtml";
        }
    }
}
