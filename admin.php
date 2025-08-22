<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

include 'db.php';

// Handle password change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $new_password = $_POST['new_password'] ?? '';
    $current_password = $_POST['current_password'] ?? '';
    $username = $_SESSION['admin_username'];
    
    if (!empty($new_password) && !empty($current_password)) {
        try {
            // Verify current password
            $stmt = $pdo->prepare("SELECT password FROM admins WHERE username = ?");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();
            
            if (!$admin || !password_verify($current_password, $admin['password'])) {
                $error_message = "Current password is incorrect";
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE admins SET password = ? WHERE username = ?");
                $stmt->execute([$hashed_password, $username]);
                $success_message = "Password updated successfully!";
            }
        } catch(PDOException $e) {
            $error_message = "Error updating password: " . $e->getMessage();
        }
    } else {
        $error_message = "Both current and new passwords are required";
    }
}

// Handle username change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_username'])) {
    $new_username = $_POST['new_username'] ?? '';
    $current_password = $_POST['username_password'] ?? '';
    $current_username = $_SESSION['admin_username'];
    
    if (!empty($new_username) && !empty($current_password)) {
        try {
            // Verify current password
            $stmt = $pdo->prepare("SELECT password FROM admins WHERE username = ?");
            $stmt->execute([$current_username]);
            $admin = $stmt->fetch();
            
            if (!$admin || !password_verify($current_password, $admin['password'])) {
                $error_message = "Current password is incorrect";
            } else {
                // Check if new username already exists
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM admins WHERE username = ? AND username != ?");
                $stmt->execute([$new_username, $current_username]);
                if ($stmt->fetchColumn() > 0) {
                    $error_message = "Username already exists";
                } else {
                    $stmt = $pdo->prepare("UPDATE admins SET username = ? WHERE username = ?");
                    $stmt->execute([$new_username, $current_username]);
                    $_SESSION['admin_username'] = $new_username;
                    $success_message = "Username updated successfully!";
                }
            }
        } catch(PDOException $e) {
            $error_message = "Error updating username: " . $e->getMessage();
        }
    } else {
        $error_message = "Both new username and current password are required";
    }
}

// Handle old password-only change (deprecated)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['old_change_password'])) {
    $new_password = $_POST['new_password'] ?? '';
    $username = $_SESSION['admin_username'];
    
    if (!empty($new_password)) {
        try {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE admins SET password = ? WHERE username = ?");
            $stmt->execute([$hashed_password, $username]);
            $success_message = "Password updated successfully!";
        } catch(PDOException $e) {
            $error_message = "Error updating password: " . $e->getMessage();
        }
    } else {
        $error_message = "New password is required";
    }
}

// Handle old username-only change (deprecated)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['old_change_username'])) {
    $new_username = $_POST['new_username'] ?? '';
    $current_username = $_SESSION['admin_username'];
    
    if (!empty($new_username)) {
        try {
            // Check if new username already exists
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM admins WHERE username = ? AND username != ?");
            $stmt->execute([$new_username, $current_username]);
            if ($stmt->fetchColumn() > 0) {
                $error_message = "Username already exists";
            } else {
                $stmt = $pdo->prepare("UPDATE admins SET username = ? WHERE username = ?");
                $stmt->execute([$new_username, $current_username]);
                $_SESSION['admin_username'] = $new_username;
                $success_message = "Username updated successfully!";
            }
        } catch(PDOException $e) {
            $error_message = "Error updating username: " . $e->getMessage();
        }
    } else {
        $error_message = "New username is required";
    }
}

// Get filter parameters
$name_filter = $_GET['name'] ?? '';
$mobile_filter = $_GET['mobile'] ?? '';
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';

// Build query with filters
$sql = "SELECT * FROM house_plans WHERE 1=1";
$params = [];

if (!empty($name_filter)) {
    $sql .= " AND name LIKE ?";
    $params[] = "%$name_filter%";
}

if (!empty($mobile_filter)) {
    $sql .= " AND mobile LIKE ?";
    $params[] = "%$mobile_filter%";
}

if (!empty($date_from)) {
    $sql .= " AND DATE(submission_date) >= ?";
    $params[] = $date_from;
}

if (!empty($date_to)) {
    $sql .= " AND DATE(submission_date) <= ?";
    $params[] = $date_to;
}

$sql .= " ORDER BY submission_date DESC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $submissions = $stmt->fetchAll();
} catch(PDOException $e) {
    $error_message = "Error fetching data: " . $e->getMessage();
    $submissions = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Imagine Your Home</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="admin-body">
    <div class="admin-container">
        <header class="admin-header">
            <h1><i class="fas fa-cogs"></i> Admin Panel - Imagine Your Home</h1>
            <div class="admin-actions">
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</span>
                <a href="export.php" class="export-btn"><i class="fas fa-download"></i> Export Excel</a>
                <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </header>

        <?php if (isset($success_message)): ?>
            <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <!-- Settings Section -->
        <div class="settings-section">
            <h3><i class="fas fa-user-cog"></i> Account Settings</h3>
            <div class="settings-grid">
                <div class="setting-item">
                    <h4>Change Username</h4>
                    <form method="POST" class="inline-form">
                        <input type="text" name="new_username" placeholder="New Username" required>
                        <input type="password" name="username_password" placeholder="Current Password" required>
                        <button type="submit" name="change_username" class="btn-small">
                            <i class="fas fa-user-edit"></i> Update
                        </button>
                    </form>
                </div>
                
                <div class="setting-item">
                    <h4>Change Password</h4>
                    <form method="POST" class="inline-form">
                        <input type="password" name="current_password" placeholder="Current Password" required>
                        <input type="password" name="new_password" placeholder="New Password" required>
                        <button type="submit" name="change_password" class="btn-small">
                            <i class="fas fa-key"></i> Update
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="filters-section">
            <h3><i class="fas fa-filter"></i> Filter Submissions</h3>
            <form method="GET" class="filter-form">
                <div class="filter-grid">
                    <div class="filter-item">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name_filter); ?>">
                    </div>
                    
                    <div class="filter-item">
                        <label for="mobile">Mobile</label>
                        <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile_filter); ?>">
                    </div>
                    
                    <div class="filter-item">
                        <label for="date_from">From Date</label>
                        <input type="date" id="date_from" name="date_from" value="<?php echo htmlspecialchars($date_from); ?>">
                    </div>
                    
                    <div class="filter-item">
                        <label for="date_to">To Date</label>
                        <input type="date" id="date_to" name="date_to" value="<?php echo htmlspecialchars($date_to); ?>">
                    </div>
                    
                    <div class="filter-actions">
                        <button type="submit" class="filter-btn">
                            <i class="fas fa-search"></i> Apply Filters
                        </button>
                        <a href="admin.php" class="clear-btn">
                            <i class="fas fa-times"></i> Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="data-section">
            <h3><i class="fas fa-table"></i> House Plan Submissions (<?php echo count($submissions); ?> records)</h3>
            
            <?php if (empty($submissions)): ?>
                <div class="no-data">
                    <i class="fas fa-inbox"></i>
                    <p>No submissions found with the current filters.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Plot Shape</th>
                                <th>Dimensions</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($submissions as $submission): ?>
                            <tr>
                                <td><?php echo $submission['id']; ?></td>
                                <td><?php echo date('Y-m-d H:i', strtotime($submission['submission_date'])); ?></td>
                                <td><?php echo htmlspecialchars($submission['name']); ?></td>
                                <td><?php echo htmlspecialchars($submission['mobile']); ?></td>
                                <td><?php echo htmlspecialchars($submission['email']); ?></td>
                                <td><?php echo htmlspecialchars($submission['city']); ?></td>
                                <td><?php echo htmlspecialchars($submission['plot_shape']); ?></td>
                                <td><?php echo htmlspecialchars($submission['plot_length'] . ' x ' . $submission['plot_width']); ?></td>
                                <td>
                                    <span class="status-<?php echo $submission['status']; ?>">
                                        <?php echo ucfirst($submission['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="view-btn" onclick="viewDetails(<?php echo $submission['id']; ?>)">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                        <?php if ($submission['status'] !== 'approved'): ?>
                                        <button class="approve-btn" onclick="updateStatus(<?php echo $submission['id']; ?>, 'approved')">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                        <?php endif; ?>
                                        <?php if ($submission['status'] !== 'rejected'): ?>
                                        <button class="reject-btn" onclick="updateStatus(<?php echo $submission['id']; ?>, 'rejected')">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal for viewing details -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Submission Details</h2>
            <div id="modalContent"></div>
        </div>
    </div>

    <script src="admin.js"></script>
</body>
</html>