  <?php
  // create a php records of student information with 5 records and the following enteties of the student information are student_id_number, full name,  course, year, date enrollled, and school attended

  // Database connection parameters
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "lab_exam";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Initialize variables
  $student_id_number = $full_name = $course = $year = $date_enrolled = $school_attended = "";
  $errors = [];
  $success_message = "";

  // Process form submission for adding a new student
  if (isset($_POST['add_student'])) {
      $student_id_number = $_POST['student_id_number'];
      $full_name = $_POST['full_name'];
      $course = $_POST['course'];
      $year = $_POST['year'];
      $date_enrolled = $_POST['date_enrolled'];
      $school_attended = $_POST['school_attended'];
    
    
      // If no errors, insert the new student
      if (empty($errors)) {
          // Check if student ID already exists
          $check_query = "SELECT student_id_number FROM students WHERE student_id_number = '$student_id_number'";
          $check_result = $conn->query($check_query);

          if ($check_result->num_rows > 0) {
              echo"<h3>Student ID Number already exists</h3>";
          } else {
              $insert_query = "INSERT INTO students (student_id_number, full_name, course, year, date_enrolled, school_attended) 
                              VALUES ('$student_id_number', '$full_name', '$course', '$year', 
                              '$date_enrolled', '$school_attended')";
            
              if ($conn->query($insert_query) === TRUE) {
                  echo"<h3>New student record added successful.</h3>";
                  $student_id_number = $full_name = $course = $year = $date_enrolled = $school_attended = "";
              }
          }
      }
  }

  // Process delete request
  if (isset($_GET['delete'])) {
      $id = $_GET['delete'];
    
      $delete_query = "DELETE FROM students WHERE id = '$id'";
    
      if ($conn->query($delete_query) === TRUE) {
          echo"<h3>Student record deleted successfully.</h3>";
      }
  }
  // Fetch all students for display
  $sql = "SELECT * FROM students ORDER BY full_name";
  $result = $conn->query($sql);
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Student Records System</title>
      <style>
          body {
              font-family: Arial, sans-serif;
              margin: 0;
              padding: 20px;
              background-color: #f5f5f5;
          }
          .container {
              max-width: 1000px;
              margin: 0 auto;
              background-color: white;
              padding: 20px;
              border-radius: 5px;
              box-shadow: 0 0 10px rgba(0,0,0,0.1);
          }
          h1 {
              text-align: center;
              color: #4a69bd;
          }
          .form-container {
              margin-bottom: 30px;
              border: 1px solid #ddd;
              padding: 20px;
              border-radius: 5px;
          }
          .form-title {
              margin-top: 0;
              padding-bottom: 10px;
              border-bottom: 1px solid #ddd;
              color: #4a69bd;
          }
          .form-group {
              margin-bottom: 15px;
          }
          .form-group label {
              display: block;
              margin-bottom: 5px;
              font-weight: bold;
          }
          .form-control {
              width: 100%;
              padding: 8px;
              border: 1px solid #ddd;
              border-radius: 4px;
              box-sizing: border-box;
          }
          .btn {
              padding: 10px 15px;
              border: none;
              border-radius: 4px;
              cursor: pointer;
              font-size: 16px;
          }
          .btn-primary {
              background-color: #4a69bd;
              color: white;
          }
          .btn-danger {
              background-color: #e74c3c;
              color: white;
          }
          table {
              width: 100%;
              border-collapse: collapse;
              margin-top: 20px;
          }
          th, td {
              padding: 12px 15px;
              text-align: left;
              border-bottom: 1px solid #ddd;
          }
          th {
              background-color: #4a69bd;
              color: white;
          }
          tr:hover {
              background-color: #f5f5f5;
          }
          .form-row {
              display: flex;
              flex-wrap: wrap;
              margin: 0 -10px;
          }
          .form-col {
              flex: 1;
              padding: 0 10px;
              min-width: 200px;
          }
          h3{
              text-align: center;
          }
          a{
              text-decoration: none;
          }
      </style>
  </head>
  <body>
      <div class="container">
          <h1>Student Records System</h1>
        
        
        
          <!-- Add New Student Form -->
          <div class="form-container">
              <h2 class="form-title">Add New Student</h2>
              <form method="post" action="">
                  <div class="form-row">
                      <div class="form-col">
                          <div class="form-group">
                              <label for="student_id_number">Student ID Number:</label>
                              <input type="number" class="form-control" id="student_id_number" name="student_id_number" value="<?php echo $student_id_number; ?>" required>
                          </div>
                      </div>
                      <div class="form-col">
                          <div class="form-group">
                              <label for="full_name">Full Name:</label>
                              <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $full_name; ?>" required>
                          </div>
                      </div>
                  </div>
                
                  <div class="form-row">
                      <div class="form-col">
                          <div class="form-group">
                              <label for="course">Course:</label>
                              <input type="text" class="form-control" id="course" name="course" value="<?php echo $course; ?>" required>
                          </div>
                      </div>
                      <div class="form-col">
                          <div class="form-group">
                              <label for="year">Year:</label>
                              <select class="form-control" id="year" name="year" required>
                                  <option value="">Select Year</option>
                                  <?php for ($i = 1; $i <= 5; $i++): ?>
                                      <option value="<?php echo $i; ?>" <?php echo (isset($year) && $year == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                  <?php endfor; ?>
                              </select>
                          </div>
                      </div>
                  </div>
                
                  <div class="form-row">
                          <div class="form-col">
                              <div class="form-group">
                                  <label for="date_enrolled">Date Enrolled:</label>
                                  <input type="date" class="form-control" id="date_enrolled" name="date_enrolled" value="<?php echo $date_enrolled; ?>" required>
                              </div>
                          </div>
                      <div class="form-col">
                          <div class="form-group">
                              <label for="school_attended">School Attended:</label>
                              <input type="text" class="form-control" id="school_attended" name="school_attended" value="<?php echo $school_attended; ?>" required>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <button type="submit" name="add_student" class="btn btn-primary">Add Student</button>
                  </div>
              </form>
          </div>
        
          <!-- Student Records Table -->
          <h2>Student Records</h2>
              <table>
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Full Name</th>
                          <th>Course</th>
                          <th>Year</th>
                          <th>Date Enrolled</th>
                          <th>School Attended</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php 
                      // Store all rows in an array
                      $all_rows = [];
                      while($row = $result->fetch_assoc()) {
                          $all_rows[] = $row;
                      }
                    
                      // Find the indexes of rows with ID 8 and 12
                      $index8 = -1;
                      $index11 = -1;
                      foreach($all_rows as $index => $row) {
                          if($row["id"] == 13) {
                              $index8 = $index;
                          } elseif($row["id"] == 8) {
                              $index11 = $index;
                          }
                      }
                    
                      // Swap the rows if both exist
                      if($index8 != -1 && $index11 != -1) {
                          $temp = $all_rows[$index8];
                          $all_rows[$index8] = $all_rows[$index11];
                          $all_rows[$index11] = $temp;
                      }
                    
                      // Display the rows
                      foreach($all_rows as $row):
                      ?>
                          <tr>
                              <td><?php echo $row["id"]; ?></td>
                              <td><?php echo $row["student_id_number"]; ?></td>
                              <td><?php echo $row["full_name"]; ?></td>
                              <td><?php echo $row["course"]; ?></td>
                              <td><?php echo $row["year"]; ?></td>
                              <td><?php echo date("M d, Y", strtotime($row["date_enrolled"])); ?></td>
                              <td><?php echo $row["school_attended"]; ?></td>
                              <td>
                                  <a href="?delete=<?php echo $row["id"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student record?')">Delete</a>
                              </td>
                          </tr>
                      <?php endforeach; ?>
                  </tbody>
              </table>
      </div>
  </body>
  </html>
