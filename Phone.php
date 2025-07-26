<?php

$host = 'localhost'; 
$dbname = 'phonebook'; 
$username = 'root'; 
$password = 'Yoake@2005'; 

try {
   
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];

       
        $stmt = $pdo->prepare("INSERT INTO contacts (name, phone, email) VALUES (?, ?, ?)");
        $stmt->execute([$name, $phone, $email]);

        echo "Contact added successfully!";
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Fetch all contacts
        $stmt = $pdo->query("SELECT * FROM contacts");
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($contacts);
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

