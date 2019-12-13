<?php

class Loader {
    public function library($lib){
        include getenv("LIB_PATH") . "$lib.php";
    }

    public function helper($helper){
        include getenv("HELPER_PATH") . "{$helper}_helper.php";
    }
}
