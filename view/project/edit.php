<?php
include_once '../header.php';
include_once '../../model/Database.php';
include_once '../../classes/Project.php';

$id = $_GET['projectid'];

$project = new Project();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projectUpdate = $project->edit($id, $_POST);
}


?>


<div class="row ">
    <?php
    include_once '../navbar.php';
    ?>
    <div class="col-6 mt-5">
        <?php
        $selectData = $project->show($id);
        if (!empty($selectData)) {
            foreach ($selectData as $data) {
                ?>
                <form method="POST" action="">

                    <div class="mb-3">
                        <label for="projectName" class="form-label">Project Name</label>
                        <input name="project_name" value="<?php echo $data['project_name']; ?>" type="text" class="form-control" id="projectName">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input name="description" value="<?php echo $data['description']; ?>"  type="text" class="form-control" id="description">
                    </div>
                    <div class="mb-3">
                        <label for="projectCode" class="form-label">Project Code</label>
                        <input name="code" value="<?php echo $data['code']; ?>"  type="text" class="form-control" id="projectCode">
                    </div>

                    <input type="submit" name="submit" Value="Save" />
                </form>
                <?php
            }
        }
        ?>
    </div>
</div>


<?php include_once '../footer.php'; ?>