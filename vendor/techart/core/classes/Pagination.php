<?php


namespace techart;


class Pagination
{

	public int $count_pages = 1;
    public int $current_page = 1;
    public string $uri = '';
    public int $mid_size = 2;
    public int $all_pages = 3;

    public function __construct(
        public int $page = 1,
        public int $per_page = 1,
        public int $total = 1
    )
    {
        $this->count_pages = $this->getCountPages();
        $this->current_page = $this->getCurrentPage();
        $this->uri = $this->getParams();
        $this->mid_size = $this->getMidSize();
    }

    private function getCountPages(): int
    {
        return ceil($this->total / $this->per_page) ?: 1;
    }

    private function getCurrentPage(): int
    {
        if ($this->page < 1) {
            $this->page = 1;
        }
        if ($this->page > $this->count_pages) {
            $this->page = $this->count_pages;
        }
        return $this->page;
    }

    public function getStart(): int
    {
        return ($this->current_page - 1) * $this->per_page;
    }

    private function getParams(): string
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0];
        if (isset($url[1]) && $url[1] != '') {
            $uri .= '?';
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!str_contains($param, 'page=')) {
                    $uri .= "{$param}&";
                }
            }
        }
        return $uri;
    }

    public function renderHtml(): string
    {
        $start_page = '';
        $end_page = '';
        $pages_left = '';
        $pages_right = '';
    
        if ($this->current_page > $this->mid_size + 1) {
            $start_page = "<li class='pagination__item pagination__item--next'><a class='pagination__link' href='" . $this->getLink(1) . "'>
            <svg width='18' height='16' viewBox='0 0 18 16' fill='none' xmlns='http://www.w3.org/2000/svg' transform='scale(-1, 1)'>
            <path d='M1.5 7C0.947715 7 0.5 7.44772 0.5 8C0.5 8.55228 0.947715 9 1.5 9L1.5 7ZM16.966 8.70711C17.3565 8.31658 17.3565 7.68342 16.966 7.29289L10.602 0.928931C10.2115 0.538407 9.57834 0.538407 9.18781 0.928932C8.79729 1.31946 8.79729 1.95262 9.18781 2.34315L14.8447 8L9.18781 13.6569C8.79729 14.0474 8.79729 14.6805 9.18781 15.0711C9.57834 15.4616 10.2115 15.4616 10.602 15.0711L16.966 8.70711ZM1.5 9L16.2589 9L16.2589 7L1.5 7L1.5 9Z'fill='white' />
            </svg>
            </a>
            </li>";
        }
    
        if ($this->current_page < ($this->count_pages - $this->mid_size)) {
            $end_page = "<li class='pagination__item pagination__item--next'><a class='pagination__link' href='" . $this->getLink($this->count_pages) . "'>
            <svg width='18' height='16' viewBox='0 0 18 16' fill='none' xmlns='http://www.w3.org/2000/svg'>
            <path d='M1.5 7C0.947715 7 0.5 7.44772 0.5 8C0.5 8.55228 0.947715 9 1.5 9L1.5 7ZM16.966 8.70711C17.3565 8.31658 17.3565 7.68342 16.966 7.29289L10.602 0.928931C10.2115 0.538407 9.57834 0.538407 9.18781 0.928932C8.79729 1.31946 8.79729 1.95262 9.18781 2.34315L14.8447 8L9.18781 13.6569C8.79729 14.0474 8.79729 14.6805 9.18781 15.0711C9.57834 15.4616 10.2115 15.4616 10.602 15.0711L16.966 8.70711ZM1.5 9L16.2589 9L16.2589 7L1.5 7L1.5 9Z'fill='white' />
            </svg>
            </a>
            </li>";
        }
    
        for ($i = $this->mid_size; $i > 0; $i--) {
            if ($this->current_page - $i > 0) {
                $pages_left .= "<li class='pagination__item'><a class='pagination__link' href='" . $this->getLink($this->current_page - $i) . "'>" . ($this->current_page - $i) . "</a></li>";
            }
        }
    
        for ($i = 1; $i <= $this->mid_size; $i++) {
            if ($this->current_page + $i <= $this->count_pages) {
                $pages_right .= "<li class='pagination__item'><a class='pagination__link' href='" . $this->getLink($this->current_page + $i) . "'>" . ($this->current_page + $i) . "</a></li>";
            }
        }
    
        return '<div class="pagination"><ul class="pagination__list">' . $start_page . $pages_left . '<li class="pagination__item pagination__item--active"><a class="pagination__link pagination__link--active">' . $this->current_page . '</a></li>' . $pages_right  . $end_page . '</ul></div>';
    }
    

    private function getLink($page): string
    {
        if ($page == 1) {
            return rtrim($this->uri, '?&');
        }

        if (str_contains($this->uri, '&') || str_contains($this->uri, '?')) {
            return "{$this->uri}page={$page}";
        } else {
            return "{$this->uri}?page={$page}";
        }
    }

    private function getMidSize(): int
    {
        return $this->count_pages <= $this->all_pages ? $this->count_pages : $this->mid_size;
    }

    public function __toString(): string
    {
        return $this->renderHtml();
    }

}