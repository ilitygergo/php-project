<?php

class ImageController extends \Controller {
    public function indexAction() {
        if (isset($_GET['id'])) {
            $this->showImage($image = getenv("PUBLIC_PATH") . 'images/' . htmlspecialchars($_GET['id']));
        } else if (isset($_GET['product'])) {
            $this->showImage($image = getenv("PUBLIC_PATH") . 'uploads/products/' . htmlspecialchars($_GET['product']));
        } else if (isset($_GET['user'])) {
            $this->showImage($image = getenv("PUBLIC_PATH") . 'uploads/users/' . htmlspecialchars($_GET['user']));
        }
    }

    /**
     * @param $image
     */
    public function showImage($image) {
        header("Content-Type:image/jpg");

        if (is_file($image) ||  is_file($image = getenv("PUBLIC_PATH") . 'images/not_found.jpg')) readfile($image);
    }
}
