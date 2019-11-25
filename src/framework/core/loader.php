<?php

class Loader {
    /**
     * Loading classes in the framework directory
     */
    public function library($lib){
        include LIB_PATH . "$lib.php";
    }

    /**
     * Loading helpers in the framework directory
     */
    public function helper($helper){
        include HELPER_PATH . "{$helper}_helper.php";
    }
}
