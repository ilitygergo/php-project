<?php

class StyleController extends \Controller {
    public function indexAction() {
        if (isset($_GET['file'])) {
            header("Content-Type:text/css");

            $file = getenv("PUBLIC_PATH") . 'css/' . htmlspecialchars($_GET['file']) . '.css';
            if (is_file($file)) readfile($file);
        }
    }
}
