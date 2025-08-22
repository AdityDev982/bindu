<?php
$servername = "bindu.mysql.database.azure.com";
$username   = "binduadmin";
$password   = "Admin@123"; // <-- change this to your actual password
$dbname     = "bindu";

// Path to Azure CA certificate
// Download from: https://dl.cacerts.digicert.com/DigiCertGlobalRootG2.crt.pem
$sslcert = __DIR__ . "/DigiCertGlobalRootCA.crt.pem";

// Initialize connection
$conn = mysqli_init();

// Configure SSL
mysqli_ssl_set($conn, NULL, NULL, $sslcert, NULL, NULL);

// Connect with SSL
if (!mysqli_real_connect($conn, $servername, $username, $password, $dbname, 3306, NULL, MYSQLI_CLIENT_SSL)) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "✅ Connected successfully with SSL!";
?>
