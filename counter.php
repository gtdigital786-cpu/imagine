<?php
include 'db.php';

function updateVisitorCount() {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE visitor_count SET count_value = count_value + 1, last_updated = NOW()");
        $stmt->execute();
        return true;
    } catch(PDOException $e) {
        return false;
    }
}

function getVisitorCount() {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT count_value FROM visitor_count LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result ? $result['count_value'] : 0;
    } catch(PDOException $e) {
        return 0;
    }
}

// Update visitor count if this is a new session
session_start();
if (!isset($_SESSION['visited'])) {
    $_SESSION['visited'] = true;
    updateVisitorCount();
}
?>