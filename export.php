<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

include 'db.php';

// Set headers for Excel download
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="house_plans_' . date('Y-m-d') . '.xls"');
header('Cache-Control: max-age=0');

try {
    $stmt = $pdo->prepare("SELECT * FROM house_plans ORDER BY submission_date DESC");
    $stmt->execute();
    $submissions = $stmt->fetchAll();
} catch(PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}

// Output Excel content
echo '<table border="1">';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Submission Date</th>';
echo '<th>Name</th>';
echo '<th>Mobile</th>';
echo '<th>Email</th>';
echo '<th>City</th>';
echo '<th>Plot Shape</th>';
echo '<th>Plot Length</th>';
echo '<th>Plot Width</th>';
echo '<th>Plot Radius</th>';
echo '<th>Margin Right</th>';
echo '<th>Margin Left</th>';
echo '<th>Margin Back</th>';
echo '<th>Margin Front</th>';
echo '<th>Road Direction</th>';
echo '<th>Front Facing</th>';
echo '<th>Entry Gate</th>';
echo '<th>Main Door</th>';
echo '<th>Status</th>';
echo '</tr>';

foreach ($submissions as $row) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['submission_date'] . '</td>';
    echo '<td>' . htmlspecialchars($row['name']) . '</td>';
    echo '<td>' . htmlspecialchars($row['mobile']) . '</td>';
    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
    echo '<td>' . htmlspecialchars($row['city']) . '</td>';
    echo '<td>' . htmlspecialchars($row['plot_shape']) . '</td>';
    echo '<td>' . htmlspecialchars($row['plot_length']) . '</td>';
    echo '<td>' . htmlspecialchars($row['plot_width']) . '</td>';
    echo '<td>' . htmlspecialchars($row['plot_radius']) . '</td>';
    echo '<td>' . htmlspecialchars($row['margin_right']) . '</td>';
    echo '<td>' . htmlspecialchars($row['margin_left']) . '</td>';
    echo '<td>' . htmlspecialchars($row['margin_back']) . '</td>';
    echo '<td>' . htmlspecialchars($row['margin_front']) . '</td>';
    echo '<td>' . htmlspecialchars($row['road_direction']) . '</td>';
    echo '<td>' . htmlspecialchars($row['front_facing']) . '</td>';
    echo '<td>' . htmlspecialchars($row['entry_gate']) . '</td>';
    echo '<td>' . htmlspecialchars($row['main_door']) . '</td>';
    echo '<td>' . htmlspecialchars($row['status']) . '</td>';
    echo '</tr>';
}

echo '</table>';
?>