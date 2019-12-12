<?php

class Loader {
    /**
     * Loading classes in the framework directory
     */
    public function library($lib){
        include getenv("LIB_PATH") . "$lib.php";
    }

    /**
     * Loading helpers in the framework directory
     */
    public function helper($helper){
        include getenv("HELPER_PATH") . "{$helper}_helper.php";
    }
}
