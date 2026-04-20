<?php

$servername ="localhost";
$username ="root";
$password =" Password";
$database ="contactdb";


try {
    $conn = new PDO("mysql:host=$servername;database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $message = $_POST['message'] ?? null;

        if ($name && $email && $phone && $message) {
            $stmt = $conn->prepare("INSERT INTO contact (name, email, phone, messages) VALUES (:name, :email, :phone, :message)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':message', $message);

            if(empty($name)||empty($email)||empty($phone)||empty($message)){
                echo "Please fill in all fields.";
                exit;
            }
            if ($stmt->execute()) {
                // Redirect after success
                header("Location: contact.php?success=1");
                exit();

            }
        }
    }
   
}
    catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

// Alert for success
if (isset($_GET['success'])) {
    echo '<script>alert("Message sent successfully!");</script>';
}

?>
