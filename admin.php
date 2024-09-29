<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 91vh;
        }

        .containers {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 22px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            height: 90%;
            position: absolute;
            width: 100%;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            border-bottom: 1px solid;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .header-container > h4 {
            font-weight: 500;
        }

        .list-container {
            position: relative;
        }

        .action-button {
            display: flex;
            justify-content: center;
        }
        
        .action-button > button {
            width: 25px;
            height: 25px;
            font-size: 17px;
            display: flex !important;
            justify-content: center;
            align-items: center;
            margin: 0px 2px;
        }

        .dataTables_wrapper .dataTables_info {
            position: absolute !important;
            bottom: 20px !important;
        }

        table {
            font-size: 14px;
            text-align: center;
        }
        td {
            width: 200px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2">
        <div class="container-fluid">
            <a class="navbar-brand h1 mt-2" href="#">Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button type="button" class="btn btn-dark ms-auto" onclick="window.location.href='index.php';">Register</button>
        </div>
    </nav>

    <div class="main">
        <div class="containers">
            <div class="header-container">
                <h4>List of Registrants</h4>
            </div>

            <div class="list-container">
                <table class="table table-hover table-sm" id="listTable">
                    <thead >
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Address</th>
                            <th scope="col">Birthday</th>
                            <th scope="col">Company</th>
                            <th scope="col">Job Title</th>
                            <th scope="col">Job Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include('./conn/conn.php');

                            $stmt = $conn->prepare("SELECT * FROM tbl_register");
                            $stmt->execute();

                            $result = $stmt->fetchAll();

                            foreach ($result as $row) {
                                $id = $row['tbl_register_id'];
                                $name = $row['full_name'];
                                $phoneNumber = $row['phone_number'];
                                $emailAdd = $row['email_address'];
                                $address = $row['address'];
                                $birthday = $row['birthday'];
                                $companyName = $row['company_name'];
                                $jobTitle = $row['job_title'];
                                $jobDescription = $row['job_description'];
                                ?>

                                <tr>
                                    <th><?= $id ?></th>
                                    <td id="name-<?= $id ?>"><?= $name ?></td>
                                    <td id="emailAdd-<?= $id ?>"><?= $emailAdd ?></td>
                                    <td id="phoneNumber-<?= $id ?>"><?= $phoneNumber ?></td>
                                    <td id="address-<?= $id ?>"><?= $address ?></td>
                                    <td id="birthday-<?= $id ?>"><?= $birthday ?></td>
                                    <td id="companyName-<?= $id ?>"><?= $companyName ?></td>
                                    <td id="jobTitle-<?= $id ?>"><?= $jobTitle ?></td>
                                    <td id="jobDescription-<?= $id ?>"><?= $jobDescription ?></td>
                                    <td>
                                        <div class="action-button">
                                            <button class="btn btn-danger" onclick="deleteList(<?= $id ?>)">X</button>
                                        </div>
                                    </td>
                                </tr>

                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Data Table -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#listTable').DataTable();
        });
        
        function deleteList(id) {
            if (confirm("Do you want to delete this list?")) {
                window.location = "./endpoint/delete.php?list=" + id;
            }
        }
    </script>
</body>
</html>
