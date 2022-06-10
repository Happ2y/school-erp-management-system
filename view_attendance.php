<!-- Interface for analyzing attendance (accessible only to students) -->
<?php include("./apis/config.php"); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance | Student</title>
    <!-- Add core styles here -->
    <link rel="stylesheet" href="./assets/css/base-styles.css">
    <!-- Latest compiled and minified CSS & JS or JQuery -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container-fluid">
        <!-- Page accessible only to students -->
        <?php
        if ($_SESSION["user_category"] == "student") {
            include("./includes/header.php");

            $user_id = $_SESSION["user_id"];
            $find_student = "SELECT * FROM students WHERE `student_id` = '$user_id' AND `active` = '1'";
            $response = mysqli_query($conn, $find_student) or die(mysqli_error($conn));
            $student = mysqli_fetch_array($response, MYSQLI_ASSOC);
            $class_id = $student["class_id"];

            // get standard using class id
            include("./apis/get-standard-using-classID.php");

            echo '
                <section class="content text-center align-items-center">
                    <div class="d-flex justify-content-around flex-column flex-md-row">
            ';

            // get subject ids using class id
            include("./apis/get-subjectIDs-using-classID.php");

            // get subject codes using subject ids
            include("./apis/get-codes-using-subjectIDs.php");

            for ($i = 0; $i < sizeof($subject_ids); $i++) {
                $subject_id = $subject_ids[$i];
                $code = $codes[$i];

                $find_student_subject_attendance = "SELECT * FROM attendance WHERE `student_id` = '$user_id' AND `class_id` = '$class_id' AND `subject_id` = '$subject_id'";
                $response = mysqli_query($conn, $find_student_subject_attendance) or die(mysqli_error($conn));

                if (mysqli_num_rows($response) == 1) {
                    echo "
                        <div class='w-100 p-2'>
                            <div class='small-box bg-info text-white p-3'>
                                <div class='inner'>
                    ";

                    $attendance_details = mysqli_fetch_array($response, MYSQLI_ASSOC);
                    $present = $attendance_details["present"];
                    $total = $attendance_details["total"];
                    $percentage = ($present / $total) * 100;

                    echo "<p> Total classes held :  $total </p>";
                    echo "<p> Total classes you attended : $present </p>";
                    echo "<p> % attendance :  $percentage</p>";

                    echo "
                                    <h4> $standard < <b>$code</b> > </h4>
                                </div>
                                <a href='#!' class='btn text-white'>More info</a>
                            </div>
                        </div>
                    ";
                }
            }

            echo '
                </section>
            ';
        } else {
            include("page-not-found.php");
        }
        ?>
    </div>
</body>

</html>