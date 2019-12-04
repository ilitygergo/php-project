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

            $product = new Product($_POST['product']);
            $product->save();

            $availability = new Availability();
            $availability->deleteAllByProductId($_POST['product']['id']);

            for ($index = 0; $index <= $_POST['availability']; $index++) {
                if(!$_POST['availability' . $index]) {
                    continue;
                }

                $availability->init($_POST['availability' . $index]);
                $availability->save();
            }
        }

        $this->redirectIfNotAdmin();

        include CURR_VIEW_PATH . "admin/listing/products.phtml";
    }

    /**
     *
     */
    public function deleteAction() {
        if (isPostRequest()) {
            $availability = new Availability();
            $availability->deleteAllByProductId($_POST['product']['id']);

            $product = new Product($_POST['product']);
            $product->delete(0, $product->getId());
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
