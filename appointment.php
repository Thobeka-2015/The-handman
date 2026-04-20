<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "maxdb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get form data
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $service = $_POST['date'] ?? null;
        $dateTime = $_POST['time'] ?? null;
        $notes = $_POST['service'] ?? '';

        // Validate required fields
        if ($name && $email && $phone && $service && $dateTime) {
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO appointment (name, email, phone, date, time, service) VALUES (:name, :email, :phone, :date, :time, :service)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':service', $date);
            $stmt->bindParam(':dateTime', $time);
            $stmt->bindParam(':notes', $service);

            if ($stmt->execute()) {
                // Redirect with success message
                header("Location: appointment.php?success=1&name=" . urlencode($name) . "&date" . urlencode($date) . "&time" . urlencode($time)."&service=" . urlencode($service));
                exit();
            }
        } else {
            echo '<script>alert("Please fill in all required fields.");</script>';
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>