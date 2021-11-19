<?php
include_once '../header.php';
include_once '../../model/Database.php';
include_once '../../classes/Task.php';

$tasks = new Task();

if (isset($_GET['delTask'])) {
    $id = $_GET['delTask'];
    $tasks->delete($id);
}
?>

<main>
    <div class="row">
        <?php
        include_once '../navbar.php';
        ?>
        <div class="mt-5 col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <h5>Task Create</h5>
                    <a href="http://localhost:8080/nahid/pmts/view/task/create.php"  class="btn btn-success text-right">Add Task</a>
                </div>
            </div> 
            <h3 class="mt-5">Task List</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selectData = $tasks->select();
//                    $selectData = $selectData[''];
//                    echo '<pre>';
//                    print_r($selectData);
//                    exit();

                    if (!empty($selectData)) {
                        
                        foreach ($selectData as $row) {
                            ?>
                            <tr>
                                <th>
                                    <?php
                                    echo $row["id"];
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    echo $row["title"];
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    echo $row["description"];
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    echo $row["start_date"];
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    echo $row["end_date"];
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if($row["status"] == 1){
                                        echo 'active';
                                    }else {
                                        echo 'inactive';
                                    }
                                    ?>
                                </th>
                                <th>
                                    <a href="edit.php?taskid=<?php echo $row['id']; ?>">Edit</a>  || <a href="?delTask=<?php echo $row['id']; ?>">Delete</a>  
                                </th>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>



<?php include_once '../footer.php'; ?>