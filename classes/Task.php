<?php

class Task {

    public $db;

    public function __construct() {
        $this->db = new Database();
    }
    
    
    public function select() {
        $table = 'task';
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
    
    public function taskInsert($data) {
        $projectId = $data['project_id'];
        $title = $data['title'];
        $description = $data['description'];
        $startDate = $data['start_date'];
        $endDate = $data['end_date'];
        unset($data['submit']);


        $projectInsert = $this->db->insert('task', $data);

        if ($projectInsert) {
            echo 'Task has been inserted Successfully';
        }
    }
    
    
    public function show($id) {
        $table = 'task';
        $col = '`task`.*, `projects`.`project_name` as `project_name`';
        $where = "`task`.`id` = " . $id;
        $limit = [];
        $orderBy = [];

        $join = [
            '0' => [
                'type' => 'INNER JOIN',
                'joining_table' => 'projects',
                'joiner_col' => '`task`.`project_id`',
                'joining_col' => '`projects`.`id`',
            ],
        ];

        $result = $this->db->select($table, $col, $where, $limit, $orderBy, $join);

//        echo '<pre>';
//        print_r($result);
//        exit;

        return $result;
    }
    

    public function edit($id, $data) {
        $id = $id;
        $project_id = $data['project_id'];
        $title = $data['title'];
        $description = $data['description'];
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $status = $data['status'];
       
        unset($data['submit']);


        $taskUpdate = $this->db->update($id, 'task', $data);

//         echo '<pre>';
//        print_r($projectInsert);
//        exit;

        if ($taskUpdate) {
            echo 'Task has been updated Successfully';
        }
    }
    
    
    public function delete($id) {
        $id = $id;
        $result = $this->db->delete($id, 'task');

        if ($result) {
            echo 'Task has been deleted Successfully';
        }
    }

     

}
