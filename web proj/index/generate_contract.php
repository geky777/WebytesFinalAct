<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output buffering to prevent "headers already sent" issues
ob_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $client_name = $_POST['client_name'];
    $service_description = $_POST['service_description'];
    $purchased_date = $_POST['Purchased_Date']; // Corrected variable name
    $address = $_POST['Address']; // Corrected variable name
    $total_amount = $_POST['total_amount'];

    // Format the data for exporting to Notepad
    $notepad_content = "Client Name: $client_name\r\n";
    $notepad_content .= "Service Description: $service_description\r\n";
    $notepad_content .= "Purchased Date: $purchased_date\r\n"; // Corrected variable name
    $notepad_content .= "Address: $address\r\n"; // Corrected variable name
    $notepad_content .= "Total Amount: $total_amount\r\n";

    // Set the file path where the Notepad file will be created
    $file_path = "C:/Users/Richard Bilan/Desktop/project web/database/contract_data.txt"; // Corrected file path

    // Write the data to the text file
    if (file_put_contents($file_path, $notepad_content)) {
        // Display a "Thank you" message
        echo "Thank you, $client_name, for your purchase! Your contract data has been exported to a Notepad file.";
    } else {
        echo "Error: Unable to write to file.";
    }
} else {<?php
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Start output buffering to prevent "headers already sent" issues
    ob_start();
    
    // Check if running from CLI
    if (php_sapi_name() == 'cli') {
        // Simulate POST data
        $_SERVER["REQUEST_METHOD"] = 'POST';
        $_POST['client_name'] = 'Test Client';
        $_POST['service_description'] = 'Test Service';
        $_POST['Purchased_Date'] = '2024-05-24';
        $_POST['Address'] = '123 Test Street';
        $_POST['total_amount'] = '1000';
    }
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize form data
        $client_name = htmlspecialchars($_POST['client_name'], ENT_QUOTES, 'UTF-8');
        $service_description = htmlspecialchars($_POST['service_description'], ENT_QUOTES, 'UTF-8');
        $purchased_date = htmlspecialchars($_POST['Purchased_Date'], ENT_QUOTES, 'UTF-8');
        $address = htmlspecialchars($_POST['Address'], ENT_QUOTES, 'UTF-8');
        $total_amount = htmlspecialchars($_POST['total_amount'], ENT_QUOTES, 'UTF-8');
    
        // Format the data for exporting to Notepad
        $notepad_content = "Client Name: $client_name\r\n";
        $notepad_content .= "Service Description: $service_description\r\n";
        $notepad_content .= "Purchased Date: $purchased_date\r\n";
        $notepad_content .= "Address: $address\r\n";
        $notepad_content .= "Total Amount: $total_amount\r\n";
    
        // Set the file path where the Notepad file will be created
        $file_path = "C:/Users/Richard Bilan/Desktop/project web/database/contract_data.txt";
    
        // Ensure the directory exists
        if (!is_dir(dirname($file_path))) {
            echo "Error: Directory does not exist.";
        } else {
            // Write the data to the text file
            if (file_put_contents($file_path, $notepad_content)) {
                // Display a "Thank you" message
                echo "Thank you, $client_name, for your purchase! Your contract data has been exported to a Notepad file.";
            } else {
                echo "Error: Unable to write to file.";
            }
        }
    } else {
        // If the form is not submitted, redirect to the form page
        header("Location: contract_form.html");
        exit;
    }
    
    // Flush the output buffer
    ob_end_flush();
    
    // If the form is not submitted, redirect to the form page
    header("Location: contract_form.html");
    exit;
}

// Flush the output buffer
ob_end_flush();
?>
