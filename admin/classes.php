<?php include("../config.php"); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class | Admin</title>
    <link rel="stylesheet" href="../assets/css/base-styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container-fluid p-4">
        <?php
        if ($_SESSION["user_category"] == "admin") {
            $query = $_GET["query"];

            if ($query == "add") {
                echo "
                    <div class='card account custom-shadow mt-5 p-3'>
                        <h3 class='text-center'>Add Class</h3>
                        <hr>
                        <form class='card-body' method='POST' action='manage-class.php'>
                            <div class='form-group'>
                                <label>Standard:</label>
                                <input type='text' class='form-control' name='standard' required>
                            </div>

                            <div class='form-group'>
                                <label>Description:</label>
                                <textarea type='text' class='form-control' name='descr' cols='6' rows='2' required></textarea>
                            </div>

                            <div class='form-group'>
                                <label>Add Subjects:</label> <br>
                ";

                include("../info/subjects.php");
                foreach ($subjects as $key => $value) {
                    $subject_id = $value["subject_id"];
                    $code = $value["code"];
                    echo "
                        <label class='checkbox-inline pr-2'><input type='checkbox' name='subject_ids[]' value=$subject_id>$code</label>
                    ";
                }

                echo "
                            </div>
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='add_class' class='btn btn-outline-primary w-50'>ADD</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($query == "manage") {
                echo "
                    <h2>Teacher List</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero adipisci mollitia illum atque sequi distinctio optio minus natus nulla vel?</p>    
                    <input class='form-control w-25 mt-4 mb-4' id='searchInput' type='text' placeholder='Filter by any attribute'> 

                    <table class='table table-hover'>
                        <thead>
                            <tr>
                                <th>Standard</th>
                                <th>Description</th>
                                <th>Subject Codes</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='dataTable'>
                ";

                include("../info/classes.php");
                foreach ($classes as $key => $class_details) {
                    $subject_ids = json_decode($class_details["subject_ids"]);

                    include("../info/codes-subjectIDs.php");
                    $codes = json_encode($codes);

                    echo "
                        <tr>
                            <td>{$class_details['standard']}</td>
                            <td>{$class_details['description']}</td>
                            <td>$codes</td>
                    ";


                    if ($class_details['active'] == 1) {
                        echo "<td>Active</td>";
                    } else {
                        echo "<td>Inactive</td>";
                    }

                    echo "
                            <td>
                                <a href='./classes.php?query=delete&class_id={$class_details['class_id']}' class='text-danger pr-2'>Delete</a>
                                <a href='./classes.php?query=update&class_id={$class_details['class_id']}' class='text-primary'>Update</a>
                            </td>
                        </tr>
                    ";
                }

                echo "
                        </tbody>
                    </table>
                ";
            }

            if ($query == "update") {
                $class_id = $_GET["class_id"];
                $class_query = "SELECT * FROM classes WHERE class_id = class_id";
                $response = mysqli_query($conn, $class_query);
                $class_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                echo "
                    <div class='card account custom-shadow mt-5 p-3'>
                        <h3 class='text-center'>Update Class</h3>
                        <hr>
                        <form class='card-body' method='POST' action='manage-class.php?class_id=$class_id'>
                            <div class='form-group'>
                                <label>Standard:</label>
                                <input type='text' class='form-control' name='standard' value='{$class_details['standard']}' required>
                            </div>

                            <div class='form-group'>
                                <label>Description:</label>
                                <textarea type='text' class='form-control' name='descr' cols='6' rows='2' required>{$class_details['description']}</textarea>
                            </div>

                            <div class='form-group'>
                                <label>Add Subjects:</label> <br>
                ";

                include("../info/subjects.php");
                foreach ($subjects as $key => $value) {
                    $subject_id = $value["subject_id"];
                    $code = $value["code"];

                    if(in_array($subject_id, json_decode($class_details["subject_ids"]))){
                        echo "<label class='checkbox-inline pr-2'><input type='checkbox' name='subject_ids[]' checked value=$subject_id>$code</label>";
                    }else{
                        echo "<label class='checkbox-inline pr-2'><input type='checkbox' name='subject_ids[]' value=$subject_id>$code</label>";
                    }
                }

                echo "
                            </div>
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='update_class' class='btn btn-outline-primary w-50'>Update Class</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($query == "delete") {
                $class_id = $_GET["class_id"];
                $class_query = "DELETE FROM classes WHERE class_id = $class_id";
                mysqli_query($conn, $class_query) or die(mysqli_errno($conn));
                header('Location: ./classes.php?query=manage');
            }
        } else {
            include("../page-not-found.php");
        }
        ?>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#dataTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

</html>