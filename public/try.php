<?php
include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");

// Query to fetch all classes for the combo box
$class_query = "SELECT class_id, class_name FROM class";
$class_result = mysqli_query($database_connection, $class_query);

// Initialize empty search parameters
$name = $age = $class_id = $student_id = '';
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- starts here -->
        <div class="">
            <h6 class="text-muted">Student Search</h6>

            <div class="mb-4">
                <form id="searchForm">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-3">
                            <label for="name" class="form-label">Select Class</label>
                            <select class="form-select " id="classSelect" name="class_id">
                                <option value="">Select a class</option>
                                <?php while ($class_row = mysqli_fetch_assoc($class_result)) { ?>
                                    <option value="<?php echo $class_row['class_id']; ?>">
                                        <?php echo $class_row['class_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- search by name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter student name" value="<?php echo htmlspecialchars($name); ?>">
                        </div>
                        <!-- search by language -->
                        <div class="col-md-6 mb-3">
                            <label for="language" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter language" value="<?php echo htmlspecialchars($student_id); ?>">
                        </div>
                        <!-- search by language -->
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="text" class="form-control" id="age" name="age" placeholder="Enter Age" value="<?php echo htmlspecialchars($age); ?>">
                        </div>

                        <div class="mb-3 ">
                            <button type="submit" id="searchForm" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="studentTableWrapper" style="display:none;">
                <h5 class="card-header mb-4">Student Table</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="studentTable">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Class</th>
                                <th>Email / Phone</th>
                                <th>Language </th>
                                <th>Date Of Birth</th>
                                <th>Age</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="studentTableBody">
                            <!-- Data from AJAX will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Handle form submission
    $('#searchForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting via the traditional method

        // Get the form data
        var class_id = $('#classSelect').val();
        var name = $('#name').val();
        var student_id = $('#student_id').val();
        var age = $('#age').val();

        // Perform the AJAX request
        $.ajax({
            url: 'try_fetch_students.php',
            method: 'POST',
            data: {
                class_id: class_id,
                name: name,
                student_id: student_id,
                age: age
            },
            success: function(response) {
                // Show the table and populate it with data
                $('#studentTableWrapper').show();
                $('#studentTableBody').html(response);
            }
        });
    });
</script>

<?php
mysqli_close($database_connection);
include(SHARED_PATH . "/footer.php");
?>