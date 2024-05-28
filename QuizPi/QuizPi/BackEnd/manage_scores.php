<?php
session_start();
include_once("../Layout/Header.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

include('../dbConnection.php');

$scores = $conn->query("SELECT Scores.*, Users.username FROM Scores JOIN Users ON Scores.user_id = Users.id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $score_id = $_POST['score_id'];

    if (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM Scores WHERE id = ?");
        $stmt->bind_param("i", $score_id);

        if ($stmt->execute()) {
            echo "Score deleted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['update'])) {
        $new_score = $_POST['new_score'];
        $stmt = $conn->prepare("UPDATE Scores SET score = ? WHERE id = ?");
        $stmt->bind_param("ii", $new_score, $score_id);

        if ($stmt->execute()) {
            echo "Score updated successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Scores</title>
</head>
<body>
    <h2>Manage Scores</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Score</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($score = $scores->fetch_assoc()): ?>
        <tr>
            <td><?php echo $score['username']; ?></td>
            <td><?php echo $score['score']; ?></td>
            <td><?php echo $score['created_at']; ?></td>
            <td>
                <form method="post" action="" style="display:inline;">
                    <input type="hidden" name="score_id" value="<?php echo $score['id']; ?>">
                    <input type="number" name="new_score" value="<?php echo $score['score']; ?>" required>
                    <input type="submit" name="update" value="Update">
                </form>
                <form method="post" action="" style="display:inline;">
                    <input type="hidden" name="score_id" value="<?php echo $score['id']; ?>">
                    <input type="submit" name="delete" value="Delete">
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php include_once("../Layout/Footer.php"); ?>
