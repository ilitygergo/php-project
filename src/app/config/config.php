<?php
    function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    function isGetRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    function redirect_to($location) {
        header("Location: " . $location);
        exit;
    }

    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
