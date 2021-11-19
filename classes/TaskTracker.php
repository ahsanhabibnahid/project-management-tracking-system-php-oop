<?php

class TaskTracker {

    public $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function filter($data) {
        $id = !empty($data['project_id']) ? $data['project_id'] : 0;
        $generate = !empty($data['project_id']) ? 'true' : 'false';
        $url = 'generate=' . $generate . '&project_id=' . $id;


        header('Location: http://localhost:8080/nahid/pmts/view/tracking/index.php?' . $url);
    }

    public function index($id = 0) {
       
        $project_id = $id;
        
//        unset($data['submit']);

        $table = 'task';
        $col = '`task`.*, `projects`.`project_name` as `project_name`';
        $where = "`task`.`project_id` = " . $project_id;
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

        $taskResult = $this->db->select($table, $col, $where, $limit, $orderBy, $join);

 
   
        // projects info
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

        $projectResult = $this->db->select($table, $col, $where, $limit, $orderBy);
        
        $projectList = $projectResult;
        
        
        
        
        $taskInfo = $taskResult;
        
//        echo '<pre>';
//        print_r($taskInfo);
//        exit();

        $returnArr = [
            'project_list' => $projectList,
            'task_info' => $taskInfo,
        ];

        return $returnArr;
    }

    public function generator($data) {

//        $data =$data ;
//        echo '<pre>';
//        print_r($data);
//        exit();
        $project_id = $data['project_id'];
        unset($data['submit']);

        $table = 'task';
        $col = '`task`.*, `projects`.`project_name` as `project_name`';
        $where = "`task`.`id` = " . $project_id;
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

        echo '<pre>';
        print_r($result);
        exit;

        return $result;
    }

}
