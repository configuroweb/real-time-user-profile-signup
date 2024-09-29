<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Registration with Export to Excel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            align-items: center;
            height: 100vh;
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }

        img {
            width: 100px;
            margin-bottom: 12px;
        }

        .landing-page,
        .registration-container,
        .confirmation-page {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 50px;
            border-radius: 10px;
            width: 800px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

        h1 {
            font-size: 35px;
            text-align: center;
            font-weight: 500;
        }

        p {
            text-align: center;
            font-size: 15px;
        }

        h2 {
            font-size: 22px;
        }

        button {
            color: #fff !important;
            padding: 5px 25px !important;
        }

        label {
            font-size: .875rem !important;
            color: #343a40 !important;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2">
        <div class="container-fluid">
            <a class="navbar-brand h1 mt-2" href="#">Registration</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button type="button" class="btn btn-dark ms-auto" onclick="window.location.href='admin.php';">Admin</button>
        </div>
    </nav>

    <div class="main">
        <div class="registration-container">
            <h1 class="text-center mb-3">Registration Form</h1>
            <form id="registrationForm">
                <div class="mb-2">
                    <label for="fullName" class="form-label">Full Name:</label>
                    <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Lorem Ipsum">
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <label for="emailAdd" class="form-label">Email Address:</label>
                        <input type="email" class="form-control" id="emailAdd" name="email_address" placeholder="name@example.com">
                    </div>
                    <div class="col-4">
                        <label for="phoneNumber" class="form-label">Phone Number:</label>
                        <input type="number" class="form-control" id="phoneNumber" name="phone_number" placeholder="09123456789">
                    </div>
                    <div class="col-4">
                        <label for="birthday" class="form-label">Birthday:</label>
                        <input type="date" class="form-control" id="birthday" name="birthday">
                    </div>
                </div>
                <div class="mb-2">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Bogotá Colombia">
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <label for="companyName" class="form-label">Company Name:</label>
                        <input type="text" class="form-control" id="companyName" name="company_name" placeholder="Google Inc.">
                    </div>
                    <div class="col-6">
                        <label for="jobTitle" class="form-label">Job Title:</label>
                        <input type="text" class="form-control" id="jobTitle" name="job_title" placeholder="Programmer">
                    </div>
                </div>
                <div class="mb-2">
                    <label for="jobDescription" class="form-label">Job Description:</label>
                    <input type="text" class="form-control" id="jobDescription" name="jobDescription" placeholder="Creating website.">
                </div>
                <button type="button" class="btn btn-dark" id="submitBtn">Submit form</button>
            </form>
        </div>

        <div class="confirmation-page" style="display: none;">
            <img src="./check.png" alt="Success">
            <h1>Registration Successful!</h1>
            <p>Thank you for registering with us. Your personal information has been securely saved.</p>
            <button class="btn btn-dark float-right" onclick="window.location.href='index.php';">← Back to Home</button>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('submitBtn').onclick = () => {
            const form = document.getElementById('registrationForm');
            const formData = new FormData(form);

            fetch('./endpoint/add.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        document.querySelector('.confirmation-page').style.display = '';
                        document.querySelector('.registration-container').style.display = 'none';
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        };
    </script>
</body>

</html>