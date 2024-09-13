<?php
include("../private/initialize.php");

$class_id = $_POST['class_id'] ?? '';
$name = $_POST['name'] ?? '';
$student_id = $_POST['student_id'] ?? '';
$age = $_POST['age'] ?? '';

// Build the query
$query_command = "SELECT student_id, surname, othername, firstname, images, class.class_name,language, email, phonenumber, dateofbirth, age 
                  FROM student 
                  JOIN class ON student.class_id = class.class_id
                  WHERE 1=1";

// Add filters based on the inputs
if (!empty($class_id)) {
    $query_command .= " AND class.class_id = '" . mysqli_real_escape_string($database_connection, $class_id) . "'";
}
if (!empty($name)) {
    $query_command .= " AND (firstname LIKE '%" . mysqli_real_escape_string($database_connection, $name) . "%' OR surname LIKE '%" . mysqli_real_escape_string($database_connection, $name) . "%' OR othername LIKE '%" . mysqli_real_escape_string($database_connection, $name) . "%')";
}
if (!empty($student_id)) {
    $query_command .= " AND student_id LIKE '%" . mysqli_real_escape_string($database_connection, $student_id) . "%'";
}
if (!empty($age)) {
    $query_command .= " AND age LIKE '%" . mysqli_real_escape_string($database_connection, $age) . "%'";
}

// Execute the query
$result = mysqli_query($database_connection, $query_command);

// Check if any results were found
if (mysqli_num_rows($result) > 0) {
    while ($fetch_result = mysqli_fetch_assoc($result)) {
?>
        <tr>";
            <td>
                <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper">
                        <div class="avatar me-2"><img src="../images/student_pictures/<?php echo $fetch_result['images']; ?>" alt="Avatar" class="rounded-circle"></div>
                    </div>
                    <div class="d-flex flex-column ">
                        <span class="emp_name text-truncate "><?php echo $fetch_result['surname'] . ' ' . $fetch_result['othername'] ?></span>
                        <span class="emp_post text-truncate "><?php echo $fetch_result['student_id'] ?></span>
                    </div>
                </div>
            </td>

            <td>
                <div class="flex-row align-items-center ms-auto ">
                    <span class="fw-medium"> <?php echo $fetch_result['class_name'] ?></span>
                </div>
            </td>
            <td>
                <div class="d-flex flex-column  ">
                    <span class="fw-medium">
                        <?php echo $fetch_result['email'] ?>
                    </span>
                    <span class="fw-medium">
                        <?php echo $fetch_result['phonenumber'] ?>
                    </span>
                </div>
            </td>
            <td>
                <div class="flex-row align-items-center ms-auto ">
                    <span class="fw-medium">
                        <?php echo $fetch_result['language'] ?>
                    </span>
                </div>
            </td>
            <td>
                <div class="flex-row align-items-center ms-auto">
                    <span class="fw-medium">
                        <?php echo $fetch_result['dateofbirth'] ?>
                    </span>
                </div>
            </td>

            <td>
                <div class="flex-row align-items-center ms-auto">
                    <span class="fw-medium">
                        <?php echo $fetch_result['age'] ?>
                    </span>
                </div>
            </td>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo url_for('edit_student.php?student_id=' . $fetch_result['student_id']); ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        <a class="dropdown-item" href="<?php echo url_for('delete_student.php?student_id=' . $fetch_result['student_id']); ?>"><i class="bx bx-edit-alt me-1"></i> Delete</a>
                        </form>
                    </div>
                </div>
            </td>
            <!-- echo "<td>{$fetch_result['class_name']}</td>";
            echo "<td>{$fetch_result['email']} / {$fetch_result['phonenumber']}</td>";
            echo "<td>{$fetch_result['student_id']}</td>";
            echo "<td>{$fetch_result['dateofbirth']}</td>";
            echo "<td>{$fetch_result['age']}</td>"; -->


        </tr>";
<?php
    }
} else {
    echo "<tr><td colspan='7'>No results found</td></tr>";
}

mysqli_close($database_connection);
?>