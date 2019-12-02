<?php

class ImageController extends \Controller {

    /**
     *
     */
    public function indexAction() {
        if (isset($_GET['id'])) {
            header("Content-Type:image/jpg");

            $image = PUBLIC_PATH . 'images/' . $_GET['id'];

            if (is_file($image) ||  is_file($image = PUBLIC_PATH . 'images/not_found.jpg')) readfile($image);
        }
    }
}
