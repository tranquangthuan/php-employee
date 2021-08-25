<?php
class Paginator {
	private $conn;
	private $limit;
	private $page;
	private $query;
	private $total;
	public function __construct($conn, $query) {
		// For suggestion
		// $this->conn = new PDO ( "", "", "" );
		$this->conn = $conn;
		$this->query = $query;
		$result = $this->conn->query ( $query );
		$this->total = $result->rowCount ();
	}
	public function getData($limit = 10, $page = 1) {
		$this->limit = $limit;
		$this->page = $page;
		if ($this->limit == "all") {
			$query = $this->query;
		} else {
			$query = $this->query . " LIMIT " . (($this->page - 1) * $this->limit) . ", " . $this->limit;
		}
		$rs = $this->conn->query ( $query );
		while ( $row = $rs->fetch ( PDO::FETCH_ASSOC ) ) {
			$results [] = $row;
		}

		$result = new stdClass ();
		$result->page = $this->page;
		$result->limit = $this->limit;
		$result->total = $this->total;
		$result->data = $results;

		return $result;
	}
	public function createLinks($link, $listClass) {
		if ($this->limit == "all") {
			return "";
		}

		$last = ceil ( $this->total / $this->limit );
		$start = (($this->page - $link) > 0) ? $this->page - $link : 1;
		$end = (($this->page + $link) < $last) ? $this->page + $link : $last;

		$html = '<ul class="' . $listClass . '">';
		$class = ($this->page == 1) ? "disabled" : "";

		$html .= '<li class="' . $class . '"><a href="?limit=' . $this->limit . '&page=' . (($this->page - 1) > 0 ? ($this->page - 1) : 1) . '">&laquo;</a></li>';

		if ($start > 1) {
			$html .= '<li><a href="?limit=' . $this->limit . '&page=1">1</a></li>';
			$html .= '<li class="disabled"><span>...</span></li>';
		}

		for($i = $start; $i <= $end; $i ++) {
			$class = ($this->page == $i) ? "active" : "";
			$html .= '<li class="' . $class . '"><a href="?limit=' . $this->limit . '&page=' . $i . '">' . $i . '</a></li>';
		}

		if ($end < $last) {
			$html .= '<li class="disabled"><span>...</span></li>';
			$html .= '<li><a href="?limit=' . $this->limit . '&page=' . $last . '">' . $last . '</a></li>';
		}

		$class = ($this->page == $last) ? "disabled" : "";
		$html .= '<li class="' . $class . '"><a href="?limit=' . $this->limit . '&page=' . (($this->page + 1 > $last) ? $last : $this->page + 1) . '">&raquo;</a></li>';

		$html .= '</ul>';

		return $html;
	}
}

?>