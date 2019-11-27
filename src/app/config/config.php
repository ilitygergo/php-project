<?php

    function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    function isGetRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
