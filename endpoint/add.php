<?php 
include("../conn/conn.php");

// Set the Content-Type to application/json to return JSON responses
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required POST variables are set
    if (isset($_POST['full_name'], $_POST['email_address'], $_POST['phone_number'], $_POST['birthday'], $_POST['address'], $_POST['company_name'], $_POST['job_title'], $_POST['jobDescription'])) {
        
        // Get the form data
        $fullName = $_POST['full_name'];
        $emailAddress = $_POST['email_address'];
        $phoneNumber = $_POST['phone_number'];
        $birthday = $_POST['birthday'];
        $address = $_POST['address'];
        $companyName = $_POST['company_name'];
        $jobTitle = $_POST['job_title'];
        $jobDescription = $_POST['jobDescription'];

        try {
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO tbl_register (full_name, email_address, phone_number, birthday, address, company_name, job_title, job_description) 
                VALUES (:full_name, :email_address, :phone_number, :birthday, :address, :company_name, :job_title, :job_description)");

            // Bind parameters
            $stmt->bindParam(":full_name", $fullName, PDO::PARAM_STR);
            $stmt->bindParam(":email_address", $emailAddress, PDO::PARAM_STR);
            $stmt->bindParam(":phone_number", $phoneNumber, PDO::PARAM_STR);
            $stmt->bindParam(":birthday", $birthday, PDO::PARAM_STR);
            $stmt->bindParam(":address", $address, PDO::PARAM_STR);
            $stmt->bindParam(":company_name", $companyName, PDO::PARAM_STR);
            $stmt->bindParam(":job_title", $jobTitle, PDO::PARAM_STR);
            $stmt->bindParam(":job_description", $jobDescription, PDO::PARAM_STR);

            // Execute the statement
            $stmt->execute();

            // Return a JSON response indicating success
            echo json_encode(['success' => true, 'message' => 'Lead added successfully.']);

        } catch (PDOException $e) {
            // Return a JSON response with the error message
            echo json_encode(['success' => false, 'message' => 'Error adding lead: ' . $e->getMessage()]);
        }

    } else {
        // Return a JSON response indicating that not all fields were filled
        echo json_encode(['success' => false, 'message' => 'Please fill in all fields!']);
    }
} else {
    // Return a JSON response if the request method is not POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
