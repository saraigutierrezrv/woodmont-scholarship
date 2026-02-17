<?php

// 1. We connect to MySQL (but not the specific database yet)
$host = '127.0.0.1';
$user = 'root';
$pass = ''; // Leave this empty if you don't use a password (standard for XAMPP/Laragon)

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. We delete the corrupted database
    echo "💥 Dropping database woodmont_scholarship...\n";
    $pdo->exec("DROP DATABASE IF EXISTS woodmont_scholarship");

    // 3. We create a fresh, clean one
    echo "✨ Creating fresh database...\n";
    $pdo->exec("CREATE DATABASE woodmont_scholarship");

    echo "✅ SUCCESS! The database is clean. You can delete this file now.\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Tip: If access is denied, your root user might have a password. Check your .env file.\n";
}