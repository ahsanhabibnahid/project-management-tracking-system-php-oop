<?php
include_once '../header.php';
include_once '../../model/Database.php';
include_once '../../classes/Task.php';
include_once '../../classes/Project.php';

$id = $_GET['taskid'];

$projects = new Project();
$task = new Task();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskUpdate = $task->edit($id, $_POST);
}
?>


<div class="row ">
    <?php
    include_once '../navbar.php';
    ?>
    <div class="col-6 mt-5">
        <?php
//        echo 'hello';
        $taskData = $task->show($id);
        $data = $taskData->fetch_assoc();
        
        
        
        if (!empty($data)) {
            
                ?>
                <form method="POST" action="">

                    <div class="mb-3">
                        <label for="projectId" class="form-label">Project</label>
                <select name="project_id" class="form-select">
                    <?php
                    $selectData = $projects->select();

                    if ($selectData->num_rows > 0) {
                        while ($row = $selectData->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo $data['project_id'] == $row['id'] ? 'selected' : '';?>> <?php echo $row['project_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Title</label>
                        <input name="title" value="<?php echo $data['title']; ?>"  type="text" class="form-control" id="description">
                    </div>
                    <div class="mb-3">
                        <label for="projectCode" class="form-label">Description</label>
                        <input name="description" value="<?php echo $data['description']; ?>"  type="text" class="form-control" id="projectCode">
                    </div>
                    <div class="mb-3">
                        <label for="projectCode" class="form-label">Start Date</label>
                        <input name="start_date" value="<?php echo $data['start_date']; ?>"  type="date" class="form-control" id="projectCode">
                    </div>
                    <div class="mb-3">
                        <label for="projectCode" class="form-label">End Date</label>
                        <input name="end_date" value="<?php echo $data['end_date']; ?>"  type="date" class="form-control" id="projectCode">
                    </div>
                    <div class="mb-3">
                        <label for="projectCode" class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" <?php echo !empty($data['status']) && $data['status'] == 1 ? 'selected' : '';?>>active</option>
                            <option value="2" <?php echo !empty($data['status']) && $data['status'] == 2 ? 'selected' : '';?>>inactive</option>
                        </select>

                    </div>
                    <input type="submit" name="submit" Value="Save" />
                </form>
                <?php
        }
        ?>
    </div>
</div>


<?php include_once '../footer.php'; ?>