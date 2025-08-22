<?php
// Database configuration for Hostinger compatibility
$servername = "localhost";
$username = "u261459251_home"; // Change this to your database username
$password = "Vishraj@9884"; // Change this to your database password
$dbname = "u261459251_imegine"; // Change this to your database name

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Create tables if they don't exist
function createTables($pdo) {
    try {
        // House plan submissions table
        $sql1 = "CREATE TABLE IF NOT EXISTS house_plans (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            mobile VARCHAR(15) NOT NULL,
            email VARCHAR(100) NOT NULL,
            city VARCHAR(50) NOT NULL,
            plot_shape TEXT,
            plot_length VARCHAR(50),
            plot_width VARCHAR(50),
            plot_radius VARCHAR(50),
            margin_right VARCHAR(50),
            margin_left VARCHAR(50),
            margin_back VARCHAR(50),
            margin_front VARCHAR(50),
            road_direction TEXT,
            front_facing VARCHAR(20),
            entry_gate VARCHAR(20),
            main_door VARCHAR(20),
            gf_parking INT DEFAULT 0,
            gf_porch INT DEFAULT 0,
            gf_hall INT DEFAULT 0,
            gf_duplex_hall INT DEFAULT 0,
            gf_kitchen INT DEFAULT 0,
            gf_washing INT DEFAULT 0,
            gf_store INT DEFAULT 0,
            gf_bedroom INT DEFAULT 0,
            gf_bedroom_balcony INT DEFAULT 0,
            gf_master_bedroom INT DEFAULT 0,
            gf_master_balcony INT DEFAULT 0,
            gf_toilet INT DEFAULT 0,
            gf_bathroom INT DEFAULT 0,
            gf_puja INT DEFAULT 0,
            gf_guest INT DEFAULT 0,
            gf_theater INT DEFAULT 0,
            gf_courtyard INT DEFAULT 0,
            gf_staircase INT DEFAULT 0,
            gf_staircase_hall INT DEFAULT 0,
            ff_parking INT DEFAULT 0,
            ff_porch INT DEFAULT 0,
            ff_hall INT DEFAULT 0,
            ff_duplex_hall INT DEFAULT 0,
            ff_kitchen INT DEFAULT 0,
            ff_washing INT DEFAULT 0,
            ff_store INT DEFAULT 0,
            ff_bedroom INT DEFAULT 0,
            ff_bedroom_balcony INT DEFAULT 0,
            ff_master_bedroom INT DEFAULT 0,
            ff_master_balcony INT DEFAULT 0,
            ff_toilet INT DEFAULT 0,
            ff_bathroom INT DEFAULT 0,
            ff_puja INT DEFAULT 0,
            ff_guest INT DEFAULT 0,
            ff_theater INT DEFAULT 0,
            ff_courtyard INT DEFAULT 0,
            ff_staircase INT DEFAULT 0,
            ff_staircase_hall INT DEFAULT 0,
            sf_parking INT DEFAULT 0,
            sf_porch INT DEFAULT 0,
            sf_hall INT DEFAULT 0,
            sf_duplex_hall INT DEFAULT 0,
            sf_kitchen INT DEFAULT 0,
            sf_washing INT DEFAULT 0,
            sf_store INT DEFAULT 0,
            sf_bedroom INT DEFAULT 0,
            sf_bedroom_balcony INT DEFAULT 0,
            sf_master_bedroom INT DEFAULT 0,
            sf_master_balcony INT DEFAULT 0,
            sf_toilet INT DEFAULT 0,
            sf_bathroom INT DEFAULT 0,
            sf_puja INT DEFAULT 0,
            sf_guest INT DEFAULT 0,
            sf_theater INT DEFAULT 0,
            sf_courtyard INT DEFAULT 0,
            sf_staircase INT DEFAULT 0,
            sf_staircase_hall INT DEFAULT 0,
            total_ground INT DEFAULT 0,
            total_first INT DEFAULT 0,
            total_second INT DEFAULT 0,
            submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            status VARCHAR(20) DEFAULT 'pending'
        )";
        
        $pdo->exec($sql1);

        // Admin table
        $sql2 = "CREATE TABLE IF NOT EXISTS admins (
            id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        $pdo->exec($sql2);

        // Insert default admin if not exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM admins WHERE username = ?");
        $stmt->execute(['admin']);
        if ($stmt->fetchColumn() == 0) {
            $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
            $stmt->execute(['admin', password_hash('admin123', PASSWORD_DEFAULT)]);
        }

        // Visitor counter table
        $sql3 = "CREATE TABLE IF NOT EXISTS visitor_count (
            id INT PRIMARY KEY AUTO_INCREMENT,
            count_value INT DEFAULT 0,
            last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        $pdo->exec($sql3);

        // Initialize visitor count if not exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM visitor_count");
        $stmt->execute();
        if ($stmt->fetchColumn() == 0) {
            $pdo->exec("INSERT INTO visitor_count (count_value) VALUES (0)");
        }

    } catch(PDOException $e) {
        die("Error creating tables: " . $e->getMessage());
    }
}

// Initialize tables
createTables($pdo);
?>