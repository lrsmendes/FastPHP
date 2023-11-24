<?php
// Retrieve form data from request
$endereco = $_POST["endereco"] ?? "";
$categoria = $_POST["categoria"] ?? "";
$preco = $_POST["preco"] ?? "";
$nome_vendedor = $_POST["nome_vendedor"] ?? "";
$telefone_vendedor = $_POST["telefone_vendedor"] ?? "";
$email_vendedor = $_POST["email_vendedor"] ?? "";
$status = $_POST["status"] ?? "";

// Database connection parameters
$dbUrl = "mysql:host=localhost;dbname=fastimoveis;charset=utf8mb4";
$dbUser = "root";
$dbPassword = "";

try {
    // Connect to the database
    $conn = new PDO($dbUrl, $dbUser, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to insert a new record
    $sql = "INSERT INTO imoveis (endereco, categoria, preco, nome_vendedor, telefone_vendedor, email_vendedor, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $endereco);
    $stmt->bindParam(2, $categoria);
    $stmt->bindParam(3, $preco);
    $stmt->bindParam(4, $nome_vendedor);
    $stmt->bindParam(5, $telefone_vendedor);
    $stmt->bindParam(6, $email_vendedor);
    $stmt->bindParam(7, $status);

    // Execute the SQL query to insert the new record
    $stmt->execute();

    $rowsAffected = $stmt->rowCount();

    if ($rowsAffected > 0) {
        // Record was successfully added
        header("Location: painel.php");
        exit();
    } else {
        // Record insertion failed
        header("Location: your_failure_page.php");
        exit();
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    header("Location: your_error_page.php");
    exit();
} finally {
    // Close resources
    $stmt = null;
    $conn = null;
}
?>
