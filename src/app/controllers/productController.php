<?php

class ProductController extends \Controller {
    /**
     *
     */
    public function updateAction() {
        if (isPostRequest()) {
            if ($_FILES['image']['name'] != '') {
                $_POST['product']['image'] = $this->uploadImage();
            }

            $product = new ProductModel($_POST['product']);
            $product->save();
        }

        $this->redirectIfNotAdmin();

        include CURR_VIEW_PATH . "admin/listing/products.phtml";
    }

    /**
     *
     */
    public function deleteAction() {
        if (isPostRequest()) {
            $product = new ProductModel($_POST['product']);
            $product->delete($product->getId());
        }

        $this->redirectIfNotAdmin();

        include CURR_VIEW_PATH . "admin/listing/products.phtml";
    }

    /**
     *
     */
    public function uploadImage() {
        $fileExtensions = ['jpeg','jpg','png'];

        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileTmpName  = $_FILES['image']['tmp_name'];
        $fileExtension = strtolower(end(explode('.',$fileName)));
        $name = generateRandomString();

        $uploadPath = PUBLIC_PATH . 'uploads/products/' . basename($name) . '.' . $fileExtension;

        if (! in_array($fileExtension,$fileExtensions)) {
            \Model::$errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 2000000) {
            \Model::$errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (!empty(\Model::$errors)) {
            return FALSE;
        }

        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
            return basename($name) . '.' . $fileExtension;
        } else {
            return FALSE;
        }
    }
}
