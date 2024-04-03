<?php
// Define logging function
function logMessage($message, $type = 'info') {
    // Log file path
    $logFile = 'logs/log.txt';

    // Current timestamp
    $timestamp = date('Y-m-d H:i:s');

    // Format the log message
    $logMessage = "[$timestamp][$type] $message" . PHP_EOL;

    // Append the log message to the log file
    file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
}

// Your function
if ($action == "update_add_to_cart") {
    try {
        // Get data from AJAX request and sanitize
        $qut = test_input($_POST['qut']);
        $total_price = test_input($_POST['total_price']);
        $product_id = test_input($_POST['product_id']);

        // Use prepared statement to prevent SQL injection
        $sql = "UPDATE add_to_cart SET cart_qty=?, total_price=? WHERE product_id=?";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $qut, $total_price, $product_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => true]);
            $_SESSION['msg'] = "Update Add To Cart successfully";
            logMessage("Update Add To Cart successfully");
        } else {
            echo json_encode(['status' => false]);
            $_SESSION['msg_error'] = "Failed to Update Add To Cart";
            logMessage("Failed to Update Add To Cart", 'error');
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        echo 'Caught exception: ',  $e->getLine(), "\n";
        logMessage("Exception caught: " . $e->getMessage(), 'error');
        logMessage("Line: " . $e->getLine(), 'error');
    }
}
?>
