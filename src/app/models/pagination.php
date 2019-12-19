<?php

class Pagination {
    /**
     * @var int
     */
    public $current_page;

    /**
     * @var int
     */
    public $per_page;

    /**
     * @var int
     */
    public $total_count;

    /**
     * @param int $page
     *
     * @param int $per_page
     *
     * @param int $total_count
     */
    public function __construct($page = 1, $per_page = 10, $total_count = 0) {
        $this->current_page = (int) $page;
        $this->per_page = (int) $per_page;

        if (isset($total_count[0]['COUNT(*)'])) {
            $this->total_count = (int) $total_count[0]['COUNT(*)'];
        }
    }

    /**
     * @return float|int
     */
    public function offset() {
        return $this->per_page * ($this->current_page - 1);
    }

    /**
     * @return false|float
     */
    public function total_pages() {
        return ceil($this->total_count / $this->per_page);
    }

    /**
     * @return bool|int
     */
    public function previous_page() {
        $previous = $this->current_page - 1;
        return ($previous > 0) ? $previous : false;
    }

    /**
     * @return bool|int
     */
    public function next_page() {
        $next = $this->current_page + 1;
        return ($next <= $this->total_pages()) ? $next : false;
    }

    /**
     * @param $page
     *
     * @return string
     */
    public function pageQueryParam($page) {
        $url_parts = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        if (isset($url_parts['query'])) {
            parse_str($url_parts['query'], $params);
        } else {
            $params = [];
        }

        $params['page'] = $page;

        return http_build_query($params);
    }

    /**
     * @return string
     */
    public function previousButton() {
        $button = '';

        if ($this->previous_page()) {
            $button .= "<a href=\"" . '/selection/search?' .  $this->pageQueryParam($this->current_page - 1) . "\">";
            $button .= "<button type=\"submit\" class=\"btn btn-dark\">&larr;</button>";
            $button .= "</a>";
        }

        return $button;
    }

    /**
     * @return string
     */
    public function nextButton() {
        $button = '';

        if ($this->next_page()) {
            $button .= "<a href=\"" . '/selection/search?' .  $this->pageQueryParam($this->current_page + 1) . "\">";
            $button .= "<button type=\"submit\" class=\"btn btn-dark\">&rarr;</button>";
            $button .= "</a>";
        }

        return $button;
    }

    /**
     * @return string
     */
    public function numberButtons() {
        $buttons = '';

        for ($i = 1; $i <= $this->total_pages(); $i++) {
            if ($i == $this->current_page) {
                $buttons .= "<a href=\"" . '/selection/search?' .  $this->pageQueryParam($i) . "\">";
                $buttons .= "<button disabled type=\"submit\" class=\"btn btn-dark\">" . $i . "</button>";
                $buttons .= "</a>";
            } else {
                $buttons .= "<a href=\"" . '/selection/search?' .  $this->pageQueryParam($i) . "\">";
                $buttons .= "<button type=\"submit\" class=\"btn btn-dark\">" . $i . "</button>";
                $buttons .= "</a>";
            }
        }

        return $buttons;
    }

    /**
     * @return string
     */
    public function navigationButtons() {
        $nav = "<div class=\"col-md-12\">";
        $nav .= $this->previousButton();
        $nav .= $this->numberButtons();
        $nav .= $this->nextButton();
        $nav .= "<div>";
        return $nav;
    }
}