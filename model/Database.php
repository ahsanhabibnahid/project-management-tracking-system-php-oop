<?php

class Database {

    public $host = "localhost";
    public $user = "root";
    public $pass = "";
    public $dbname = "pmts";
    public $link;
    public $error;
    public $row;

    public function __construct() {
        $this->connectDB();
    }

    // database connection
    private function connectDB() {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if (!$this->link) {
            $this->error = "Connection fail" . $this->link->connect_error;
            return false;
        }
    }

    public function select($table, $col, $where = null, $limit = [], $orderBy = [], $join = []) {

//        $innerCls = !empty() ? $this->innerJoin() : '';
        $whereCls = !empty($where) ? $this->where($where) : '';
        $orderByCls = !empty($orderBy) ? $this->orderBy($orderBy) : '';
        $limitCls = !empty($limit) ? $this->limit($limit) : '';

        $tableCls = "`" . $table . "`";

        if (!empty($join)) {
            $tableCls = '';
            $jTable = "`" . $table . "`";
            foreach ($join as $indx => $jData) {
                $tableCls = $this->join($jData, $jTable);
                $jTable = $tableCls;
            }
        }
        $sql = "SELECT " . $col . " FROM " . $tableCls . $whereCls . $orderByCls . $limitCls . ";";
//        return $sql;
        $result = $this->link->query($sql);


        return $result;
    }

    public function join($join, $table) {
        $joinTxt = " " . $table . " " . $join['type'] . " `" . $join['joining_table'] . "` ON " . $join['joining_col'] . "=" . $join['joiner_col'] . " ";


        return $joinTxt;
    }

//    public function select($table, $col, $where = null, $limit = [], $orderBy = []) {
//
//        $whereCls = !empty($where) ? $this->where($where) : '';
//        $orderByCls = !empty($orderBy) ? $this->orderBy($orderBy) : '';
//        $limitCls = !empty($limit) ? $this->limit($limit) : '';
//
//        $sql = "SELECT " . $col . " FROM `" . $table . "`" . $whereCls . $orderByCls . $limitCls . ";";
////        return $sql;
//        $result = $this->link->query($sql);
//
//        if ($result->num_rows > 0) {
//            return $result;
//        } else {
//            return false;
//        }
//    }

    protected function where($cls) {
        return " WHERE " . $cls;
    }

    protected function orderBy($cls) {
        $order = "";
        $i = 0;
        if (!empty($cls)) {
            foreach ($cls as $key => $val) {
                $cmm = sizeof($cls) - 1 != $i ? "," : "";
                $order .= "`" . $key . "` " . $val . $cmm;
                $i++;
            }
        }

        return " ORDER BY " . $order;
    }

    protected function limit($limitArr) {
        $limit = !empty($limitArr['limit']) ? $limitArr['limit'] : '';
        $offset = !empty($limitArr['offset']) ? " OFFSET " . $limitArr['offset'] : '';
        ;
        return " LIMIT " . $limit . $offset;
    }

    public function insert($table, $dataArr) {
        $key = $val = '';

        $keys = array_keys($dataArr);
        $vals = array_values($dataArr);

        if (!empty($keys)) {
            foreach ($keys as $iK => $vK) {
                $cmm = sizeof($keys) - 1 != $iK ? "," : "";
                $key .= "`" . $vK . "`" . $cmm;
            }
        }
        if (!empty($vals)) {
            foreach ($vals as $iV => $vV) {
                $cmm = sizeof($vals) - 1 != $iV ? "," : "";
                $val .= "'" . $vV . "'" . $cmm;
            }
        }

        $sql = "INSERT INTO `" . $table . "` (" . $key . ") VALUES (" . $val . ");";

        $insertRow = $this->link->query($sql);

        return $insertRow;
    }

    public function update($id, $table, $dataArr) {
        $keyVal = '';
        $i = 0;
        foreach ($dataArr as $keys => $data) {
            $cmm = sizeof($dataArr) - 1 != $i ? "," : " ";

            $keyVal .= "`" . $keys . "` = '" . $data . "'" . $cmm;
            $i++;
        }

        $sql = "UPDATE `" . $table . "` SET " . $keyVal . " WHERE ID = " . $id;

//        return $sql;

        $updateRow = $this->link->query($sql);

        return $updateRow;
    }

    public function delete($id, $table) {
        $sql = "DELETE FROM " . $table . " WHERE ID = " . $id;

        $deleteRow = $this->link->query($sql);

        return $deleteRow;
    }

}

?>