<?php
include_once '../header.php';
include_once '../../model/Database.php';
include_once '../../classes/Task.php';
include_once '../../classes/Project.php';

$db = new Database();
$projects = new Project();
$task = new Task();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskInsert = $task->taskInsert($_POST);
}
?>


<div class="row">
    <?php
    include_once '../navbar.php';
    ?>
    <div class="col-6 mt-5">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="projectId" class="form-label">Project</label>
                <select name="project_id" class="form-select">
                    <?php
                    $selectData = $projects->select();

                    if ($selectData->num_rows > 0) {
                        while ($row = $selectData->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['project_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input name="description" type="text" class="form-control" id="description">
            </div>
            <div class="mb-3">
                <label for="start" class="form-label">Start</label>
                <input name="start_date" type="date" class="form-control" id="start">
            </div>
            <div class="mb-3">
                <label for="end" class="form-label">End</label>
                <input name="end_date" type="date" class="form-control" id="end">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Project</label>
                <select name="status" class="form-select">
                    <option value="1"> Active </option>
                    <option value="2"> Inactive </option>
                </select>
            </div>
            <input type="submit" name="submit" Value="Save" />
        </form>
    </div>
</div>


<?php include_once '../footer.php'; ?>