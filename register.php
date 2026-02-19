<?php
require_once 'db.php'; 

$error = [];
$uucms_id = '';
$name = '';
$team_no = '';
$phone = '';
$div = '';
$sem = '';
$event = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event    = $_POST['event'] ?? '';
    $team_no  = trim($_POST['team_no'] ?? '');
    $name     = trim($_POST['name'] ?? '');
    $uucms_id = $_POST['uucms_id'] ?? '';
    $phone    = $_POST['phone'] ?? '';
    $div      = $_POST['sdiv'] ?? '';
    $sem      = $_POST['sem'] ?? '';
}


if ($name === '') $error['name'] = "Name is required";
if ($team_no === '') $error['team_no'] = "Team no is required";
if ($phone === '') $error['phone'] = "Phone no is required";
if ($div === '') $error['sdiv'] = "Div is required";
if ($sem === '') $error['sem'] = "Sem is required";
if ($uucms_id === '') {
    $error['uucms_id'] = "UUCMS ID is required";
} elseif (!preg_match('/^[A-Z0-9]+$/', $uucms_id)) {
    $error['uucms_id'] = "UUCMS ID is invalid";
} elseif (strlen($uucms_id) !== 12) {
    $error['uucms_id'] = "UUCMS ID must be 12 characters";
}


if (empty($error)) {
    $stmt = $conn->prepare("SELECT ID FROM registrations WHERE uucms_id = ? LIMIT 1");
    $stmt->bind_param("s", $uucms_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error['uucms_id'] = "UUCMS ID already registered";
    } else {
        $stmt = $conn->prepare("INSERT INTO registrations (team_no, name, uucms_id, phone, sdiv, sem, event) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $team_no, $name, $uucms_id, $phone, $div, $sem, $event);
        if ($stmt->execute()) {
            header("Location: event-details.php?event=" . urlencode($event) . "&registered=1");
            exit;
        } else {
            $error['db'] = "Database error: " . $stmt->error;
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <section>
    <h2>Registration Form</h2>

    <!-- GIVE: success message -->
    <?php if (!empty($success)): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert">
            <?php foreach ($error as $msg): ?>
                <p><?= htmlspecialchars($msg) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <input type="text" name="team_no" value="<?= htmlspecialchars($team_no) ?>" placeholder="Team No" required><br>
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" placeholder="Name" required><br>
        <input type="text" name="uucms_id" value="<?= htmlspecialchars($uucms_id) ?>" placeholder="UUCMS ID" required><br>
        <input type="text" name="phone" value="<?= htmlspecialchars($phone) ?>" placeholder="Phone" required><br>
        <input type="text" name="sdiv" value="<?= htmlspecialchars($div) ?>" placeholder="Division" required><br>
        <input type="text" name="sem" value="<?= htmlspecialchars($sem) ?>" placeholder="Semester" required><br>

        <select name="event" required>
            <option value="">Select Event</option>
            <option value="Communication" <?= $event === 'Communication' ? 'selected' : '' ?>>Communication</option>
            <option value="Coding" <?= $event === 'Coding' ? 'selected' : '' ?>>Coding</option>
            <option value="Designing" <?= $event === 'Designing' ? 'selected' : '' ?>>Designing</option>
            <option value="Quiz" <?= $event === 'Quiz' ? 'selected' : '' ?>>Quiz</option>
            <option value="Art" <?= $event === 'Art' ? 'selected' : '' ?>>Art</option>
            <option value="Start-up" <?= $event === 'Start-up' ? 'selected' : '' ?>>Start-up</option>
            <option value="Lan-Gaming" <?= $event === 'Lan-Gaming' ? 'selected' : '' ?>>Lan-Gaming</option>
            <option value="Treasure-Hunt" <?= $event === 'Treasure-Hunt' ? 'selected' : '' ?>>Treasure-Hunt</option>
            <option value="Photography" <?= $event === 'Photography' ? 'selected' : '' ?>>Photography</option>
            <option value="Reel-Making" <?= $event === 'Reel-Making' ? 'selected' : '' ?>>Reel-Making</option>
            <option value="Cultural" <?= $event === 'Cultural' ? 'selected' : '' ?>>Cultural</option>
            <option value="TGT" <?= $event === 'TGT' ? 'selected' : '' ?>>TGT</option>
        </select><br>

        <button type="submit" name="save" class="btn">Submit</button>
    </form>
</section>

</body>

</html>