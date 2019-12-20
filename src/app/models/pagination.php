<?php

class Pagination extends \Model {
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
        return ($previous > 0) ? $previous : FALSE;
    }

    /**
     * @return bool|int
     */
    public function next_page() {
        $next = $this->current_page + 1;
        return ($next <= $this->total_pages()) ? $next : FALSE;
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
        $button = "<li class=\"page-item " . ($this->previous_page() == FALSE ? "disabled" : "") . "\" >";
        $button .= "<a class=\"page-link\" href=\"" . getURL()['path'] . "?" .  $this->pageQueryParam($this->current_page - 1) . "\">Previous</a>";
        $button .= "</li>";

        return $button;
    }

    /**
     * @return string
     */
    public function nextButton() {
        $button = "<li class=\"page-item " . ($this->next_page() == FALSE ? "disabled" : "") . "\" >";
        $button .= "<a class=\"page-link\" href=\"" . getURL()['path'] . "?" .  $this->pageQueryParam($this->current_page + 1) . "\">Next</a>";
        $button .= "</li>";

        return $button;
    }

    /**
     * @return string
     */
    public function numberButtons() {
        $buttons = '';

        for ($i = 1; $i <= $this->total_pages(); $i++) {
            if ($i == $this->current_page) {
                $buttons .= "<li class=\"page-item active\">";
                $buttons .= "<span class=\"page-link\">" . $i;
                $buttons .= "<span class=\"sr-only\">(current)</span>";
                $buttons .= "</span>";
                $buttons .= "</li>";
            } else {
                $buttons .= "<li class=\"page-item\">";
                $buttons .= "<a class=\"page-link\" href=\"" . getURL()['path'] . "?" .  $this->pageQueryParam($i) . "\">" . $i . "</a>";
                $buttons .= "</li>";
            }
        }

        return $buttons;
    }

    /**
     * @return string|void
     */
    public function navigationButtons() {
        if (!$this->total_count) {
            return;
        }

        $nav = "<nav  aria-label=\"\">";
        $nav .= "<ul class=\"pagination pagination-sm\">";
        $nav .= $this->previousButton();
        $nav .= $this->numberButtons();
        $nav .= $this->nextButton();
        $nav .= "</ul>";
        $nav .= "</nav>";
        return $nav;
    }
}
