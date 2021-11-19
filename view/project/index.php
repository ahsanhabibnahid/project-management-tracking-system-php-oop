<?php
include_once '../header.php';
include_once '../../model/Database.php';
include_once '../../classes/Project.php';


$projects = new Project();

if (isset($_GET['delProject'])) {
    $id = $_GET['delProject'];
    $projects->delete($id);
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
                    <h5>Project Create</h5>
                    <a href="http://localhost:8080/nahid/pmts/view/project/create.php"  class="btn btn-success text-right">Add Project</a>
                </div>
            </div> 
            <h3 class="mt-5">Project List</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Project Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Code</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selectData = $projects->select();

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
                                    echo $row["project_name"];
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    echo $row["description"];
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    echo $row["code"];
                                    ?>
                                </th>
                                <th>
                                <td>
                                    <a href="edit.php?projectid=<?php echo $row['id']; ?>">Edit</a> || <a href="?delProject=<?php echo $row['id']; ?>">Delete</a>  
                                </td>
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