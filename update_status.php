<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

include 'db.php';

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

$id = $input['id'] ?? 0;
$status = $input['status'] ?? '';

if (!$id || !in_array($status, ['pending', 'approved', 'rejected'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE house_plans SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
    
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No record found or no changes made']);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>