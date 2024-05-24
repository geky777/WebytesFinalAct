<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Status</title>
</head>

<body>
    <header>
        <h1><b>Submission Status</b></h1>
    </header>

    <main>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "donationdb";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

           
            $stmt = $conn->prepare("INSERT INTO donations (firstname, lastname, email, contact, amount) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $firstname, $lastname, $email, $contact, $amount);

            
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $amount = $_POST['amount'];

            if ($stmt->execute()) {
                echo '<p style="color: green;">Data entered in the form is now saved.</p>';
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            echo '<p style="color: red;">Invalid request method.</p>';
        }
        ?>
        <a href="form.html">Back to Form</a>
    </main>

    <footer>
        <hr>
        <p>&copy; 2024 Advocacy for Animals. All rights reserved.</p>
    </footer>
</body>

</html>
