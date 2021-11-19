<?php
include_once '../header.php';
include_once '../../model/Database.php';
include_once '../../classes/Project.php';


$project = new Project();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projectInsert = $project->projectInsert($_POST);
}
?>


<div class="row ">
    <?php
    include_once '../navbar.php';
    ?>
    <div class="col-6 mt-5">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="projectName" class="form-label">Project Name</label>
                <input name="project_name" type="text" class="form-control" id="projectName">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input name="description" type="text" class="form-control" id="description">
            </div>
            <div class="mb-3">
                <label for="projectCode" class="form-label">Project Code</label>
                <input name="code" type="text" class="form-control" id="projectCode">
            </div>

            <input type="submit" name="submit" Value="Save" />
        </form>
    </div>
</div>


<?php include_once '../footer.php'; ?>