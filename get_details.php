<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

include 'db.php';

$id = $_GET['id'] ?? 0;

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM house_plans WHERE id = ?");
    $stmt->execute([$id]);
    $submission = $stmt->fetch();
    
    if ($submission) {
        echo json_encode([
            'success' => true, 
            'submission' => $submission
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Submission not found']);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>