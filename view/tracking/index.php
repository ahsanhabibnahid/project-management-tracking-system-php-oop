<?php
include_once '../header.php';
include_once '../../model/Database.php';
include_once '../../classes/Project.php';
include_once '../../classes/TaskTracker.php';

$tracker = new TaskTracker();

$id = !empty($_GET['project_id']) ? $_GET['project_id'] : 0;
$gen = !empty($_GET['generate']) ? $_GET['generate'] : 'false';

$dataArr = $tracker->index($id);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $generate = $tracker->filter($_POST);
}
?>

<main>
    <div class="row">
        <?php
        include_once '../navbar.php';
        ?>
        <div class="mt-5 col-md-9">

            <h4>
                Task Tracking
            </h4>

            <div class="row justify-content-md-center my-5">
                <form action="" method="POST" class="d-flex col-5">
                    <select class="form-select" name="project_id">
                        <option disabled selected>select project..</option>
                        <?php
                        if (!empty($dataArr['project_list'])) {
                            foreach ($dataArr['project_list'] as $row) {
                                ?>
                        <option <?php echo $row['id'] == $id ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['project_name']; ?></option>
                                <?php
                            }
                        }
                        ?>

                    </select>
                    <input type="submit" name="submit" Value="Generate" />
                </form>
            </div>

            <?php
            if ($gen == 'true') {
                ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Project Name</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($dataArr['task_info'])) {
                            foreach ($dataArr['task_info'] as $row) {
                                ?>
                                <tr>
                                    <th>
                                        <?php echo $row['project_name']; ?>
                                    </th>
                                    <th>
                                        <?php echo $row['title']; ?>
                                    </th>
                                    <th>
                                        <?php echo $row['description']; ?>
                                    </th>
                                    <th>
                                        <?php echo $row['start_date']; ?>
                                    </th>
                                    <th>
                                        <?php echo $row['end_date']; ?>
                                    </th>
                                    <th>
                                        <?php
                                        if ($row["status"] == 1) {
                                            echo 'active';
                                        } else {
                                            echo 'inactive';
                                        }
                                        ?>
                                    </th>
                                </tr>

                                <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
                <?php
            }
            ?>


        </div>


    </div>
</main>



<?php include_once '../footer.php'; ?>