<?php

class Project {

    public $db;

    public function __construct() {
        $this->db = new Database();
    }
    
    public function delete($id) {
        $id = $id;
        $result = $this->db->delete($id, 'projects');
        
        if ($result){
            echo 'Project has been deleted Successfully';
        }
    }

    public function edit($id, $data) {
        $id = $id;
        $projectId = $data['project_name'];
        $title = $data['description'];
        $description = $data['code'];
        unset($data['submit']);


        $projecUpdate = $this->db->update($id,'projects', $data);

//         echo '<pre>';
//        print_r($projectInsert);
//        exit;

        if ($projecUpdate) {
            echo 'Project has been updated Successfully';
        }
    }

    public function show($id) {
        $table = 'projects';
        $col = '*';
        $where = "id = $id";
        $limit = [];
        $orderBy = [];

        $result = $this->db->select($table, $col, $where, $limit, $orderBy);

//        echo '<pre>';
//        print_r($result);
//        exit;

        return $result;
    }

    public function select() {
        $table = 'projects';
        $col = '*';
        $where = [];
//        $where = "status = '1'";
        $limit = [
//            'limit' => 10,
//            'offset' => 0,
        ];
        $orderBy = [
//            'code' => 'asc',
        ];

        $result = $this->db->select($table, $col, $where, $limit, $orderBy);

//        echo '<pre>';
//        print_r($result);
//        exit;

        return $result;
    }

    public function projectInsert($data) {
        $projectId = $data['project_name'];
        $title = $data['description'];
        $description = $data['code'];
        unset($data['submit']);


        $projectInsert = $this->db->insert('projects', $data);


        if ($projectInsert) {
            echo 'Project has been inserted Successfully';
        }
    }

//    public function projectInsert($data) {
//
//        $projectName = $data['project_name'];
//        $description = $data['description'];
//        $code = $data['code'];
//
//        $sql = "INSERT INTO projects (project_name, description, code) VALUES ('$projectName', '$description','$code')";
//
//        $projectInsert = $this->db->insert($sql);
//
//        if ($projectInsert) {
//            echo 'Project has been inserted Successfully';
//        }
//    }
}

?>