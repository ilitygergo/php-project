<?php
namespace App\Controllers;

use App\Framework\Core\Controller;
use App\Models\Product;
use App\Models\Availability;
use App\Framework\Core\Alert;

class ProductController extends Controller {
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

                $availability->argumentValuesToProperties($_POST['availability' . $index]);
                $availability->save();
            }
        }

        $this->redirectIfNotAdmin();
        redirect_to('/admin/products?id=' . $_POST['product']['id']);
    }

    public function deleteAction() {
        if (isPostRequest()) {
            $availability = new Availability();
            $availability->deleteAllByProductId($_POST['product']['id']);

            $product = new Product($_POST['product']);

            if (!$product->getImage() == '' && file_exists($filename = getenv("PUBLIC_PATH") . 'uploads/products/' . $product->getImage())) {
                unlink($filename);
            }

            $product->delete();
        }

        $this->redirectIfNotAdmin();
        include getenv("CURR_VIEW_PATH") . "admin/listing/products.phtml";
    }

    public function uploadImage() {
        $fileExtensions = ['jpeg','jpg','png'];

        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileTmpName  = $_FILES['image']['tmp_name'];
        $fileExtension = strtolower(end(explode('.',$fileName)));
        $name = generateRandomString();

        $uploadPath = getenv("PUBLIC_PATH") . 'uploads/products/' . basename($name) . '.' . $fileExtension;

        if (! in_array($fileExtension,$fileExtensions)) {
            Alert::getInstance()->add('This file extension is not allowed. Please upload a JPEG or PNG file');
        }

        if ($fileSize > 2000000) {
            Alert::getInstance()->add("This file is more than 2MB. Sorry, it has to be less than or equal to 2MB");
        }

        if (!Alert::getInstance()->isAlertEmpty()) {
            return FALSE;
        }

        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
            return basename($name) . '.' . $fileExtension;
        } else {
            return FALSE;
        }
    }

    public function showAction() {
        if (isGetRequest() && ($id = $_GET['id'])) {
            $product = new Product(['id' => $id]);

            include getenv("CURR_VIEW_PATH") . "product/product.phtml";
        } else {
            include getenv("CURR_VIEW_PATH") . "index.phtml";
        }
    }
}
