<?php
include_once 'header.php';
include_once '../model/Database.php';
include_once '../classes/Project.php';

$projects = new Project();
?>



<main>
    <div class="row">
        <?php 
        include_once 'navbar.php';
        ?>
        <div class="mt-5 col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <h5>Project Create</h5>
                    <a href="http://localhost:8080/nahid/pmts/view/project/create.php"  class="btn btn-success text-right">Add Project</a>
                </div>
                <div class="col-md-6">
                    <h5>Task Create</h5>
                    <a href="http://localhost:8080/nahid/pmts/view/task/create.php"  class="btn btn-success text-right">Add Project</a>
                </div>
            </div> 
        </div>
    </div>
</main>



<?php include_once 'footer.php'; ?>