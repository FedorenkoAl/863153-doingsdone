<?php
require_once ('mysql_helper.php');

class Database {
    private $link;
    private $last_error = null;
    private $last_result;

    public function __construct($host, $login, $password, $db) {
        $this->link = mysqli_connect($host, $login, $password, $db);
        mysqli_set_charset($this->link, "utf8");

        if (!$this->link) {
            $this->last_error = mysqli_connect_error();
        }
    }
    public function executeQuery($sql, $data = []) {
        $this->last_error = null;
        $stmt = db_get_prepare_stmt($this->link, $sql, $data);

        if (mysqli_stmt_execute($stmt) && $r = mysqli_stmt_get_result($stmt)) {
            $this->last_result = $r;
            $res = true;
        }
        else {
            $this->last_error = mysqli_error($this->link);
            $res = false;
        }

        return $res;
    }

    public function executeInsert($sql, $data = []) {
        $this->last_error = null;
        $stmt = db_get_prepare_stmt($this->link, $sql, $data);
        $res = mysqli_stmt_execute($stmt);
        if (!$res) {
            $this->last_error = mysqli_error($this->link);
            $res = false;
        }

        return $res;

    }

    public function getLastError() {
        return $this->last_error;
    }
    public function getResultAsArray() {
        return mysqli_fetch_all($this->last_result, MYSQLI_ASSOC);
    }

}
