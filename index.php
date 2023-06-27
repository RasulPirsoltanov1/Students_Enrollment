<?php
$connection = mysqli_connect("localhost", "root", "resulresul");
$databse = mysqli_select_db($connection, "student_enrollment") or trigger_error(mysqli_error($conn));
if ($_POST["name"] && $_POST["surname"] && $_POST["no"] && $_POST["class"]) {
    $name = mysqli_real_escape_string($connection, $_POST["name"]); // Sanitize the input
    $surname = mysqli_real_escape_string($connection, $_POST["surname"]);
    $no = mysqli_real_escape_string($connection, $_POST["no"]);
    $class = mysqli_real_escape_string($connection, $_POST["class"]);

    $query = "INSERT INTO students (Name, Surname, No, Class) VALUES ('$name', '$surname', '$no', '$class')";
    mysqli_query($connection, $query);
    
}
if(is_numeric($_GET["student_id"])){
    echo "girdo";
    $student_id=mysqli_real_escape_string($connection,$_GET["student_id"]);
    mysqli_query($connection,"DELETE FROM students WHERE Id='$student_id'");
    header("Location: http://localhost/student_enrollment");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First PHP application</title>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>

<body>
    <h1 class="text-center text-primary">Students Enrollment Page</h1>
    <hr>
    <div class="container ">
        <div class="row d-flex justify-content-center">
            <div class="col-6 " style="border: 5px,solid,green; padding: 15px; background-color: greenyellow;">
                <form action="" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>SurName</label>
                        <input type="text" name="surname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No</label>
                        <input type="text" name="no" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Class</label>
                        <select name="class" class="form-control">
                            <option disabled selected>please select a class</option>
                            <option value="9">9 class</option>
                            <option value="10">10 class</option>
                            <option value="11">11 class</option>
                            <option value="12">12 class</option>
                        </select>
                    </div>
                    <div class="form-group">

                        <input type="submit" value="submit" style="margin-top: 20px;" class="form-control btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <h4 class="text-center text-primary">Students List</h4>
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">No</th>
                            <th scope="col">Class</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlCommand = mysqli_query($connection, "SELECT * FROM students ORDER BY Id ASC");
                        while ($studentList = mysqli_fetch_array($sqlCommand)) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $studentList["Id"]; ?></th>
                                <td><?php echo $studentList["Name"]; ?></td>
                                <td><?php echo $studentList["Surname"]; ?></td>
                                <td><?php echo $studentList["No"]; ?></td>
                                <td><?php echo $studentList["Class"]; ?></td>
                                <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $studentList["Id"]; ?>">Delete</button></td>
                            </tr>
                            <!-- Modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop<?php echo $studentList["Id"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Warning</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                         are you sure to delete <?php echo $studentList["Name"]; ?> ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-danger" onclick="location.href='?student_id=<?php echo $studentList['Id'];?>'">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html>