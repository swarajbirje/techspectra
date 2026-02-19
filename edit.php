<?php
require_once 'db.php';

$id = intval($_GET['id'] ?? 0);

// Fetch record
$stmt = $conn->prepare("SELECT * FROM registrations WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$registration = $result->fetch_assoc();
$stmt->close();

if (!$registration) {
    die("Record not found.");
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $team_no  = trim($_POST['team_no']);
    $name     = trim($_POST['name']);
    $uucms_id = trim($_POST['uucms_id']);
    $phone    = trim($_POST['phone']);
    $div      = trim($_POST['sdiv']);
    $sem      = trim($_POST['sem']);
    $event    = trim($_POST['event']);

    $stmt = $conn->prepare("UPDATE registrations 
        SET team_no=?, name=?, uucms_id=?, phone=?, sdiv=?, sem=?, event=? 
        WHERE id=?");
    $stmt->bind_param("sssssssi", $team_no, $name, $uucms_id, $phone, $div, $sem, $event, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: admin.php?updated=1");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Registration</title>
  <style>
    body{
      background: linear-gradient(135deg, #020617, #0b1120);
      
    }
    section{
      font-family: Arial, sans-serif;
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      border: 1px solid  #38bdf8;;
      border-radius: 5px;
    }
    section:hover{
      box-shadow: 0 0 15px #38bdf8;
      border-color: #38bdf8;
    }
    h2{
      text-align: center;
      color: #38bdf8;
}
  h2:hover{
      color: #0ea5e9;}
    input , select{
      width: 100%;
      padding: 8px;
      margin: 5px 0;
      box-sizing: border-box;
      border-radius: 4px;
      border-color: #062d3d;
      background-color:rgba(255,255,255,0.1);
    }
    input:hover , select:hover{
      
      border-color: #38bdf8;
    }
    button {
      background: linear-gradient(to right, #38bdf8, #0ea5e9);
      color: white;
      padding: 10px 20px;
      margin: 10px 0px 0px 40%;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover{
      background: linear-gradient(to right, #0ea5e9, #38bdf8);
      transform: translateY(-3px);
      box-shadow: 0 0 20px #38bdf8;
    }
    

  </style>
</head>
<body>
  <section>
  <h2><label for="name">Edit Registration</label></h2>
  <form method="post">
    <input type="text" name="team_no" id = "name" value="<?= htmlspecialchars($registration['team_no']) ?>" required><br>
    <input type="text" name="name" value="<?= htmlspecialchars($registration['name']) ?>" required><br>
    <input type="text" name="uucms_id" value="<?= htmlspecialchars($registration['uucms_id']) ?>" required><br>
    <input type="text" name="phone" value="<?= htmlspecialchars($registration['phone']) ?>" required><br>
    <input type="text" name="sdiv" value="<?= htmlspecialchars($registration['sdiv']) ?>" required><br>
    <input type="text" name="sem" value="<?= htmlspecialchars($registration['sem']) ?>" required><br>
    <select name="event" value="<?= htmlspecialchars($registration['event']) ?>"required>
      <option value="">Select Event</option>
      <option>Communication</option>
      <option>Coding</option>
	  <option>Designing</option>
	  <option>Quiz</option>
	  <option>Art</option>
	  <option>Start-up</option>
	  <option>Lan-Gaming</option>
	  <option>Treasure-Hunt</option>
	  <option>Photography</option>
	  <option>Reel-Making</option>
	  <option>Cultural</option>
	   <option>TGT</option>
    </select><br>
    <button type="submit">Update</button>
  </form>
  </section>
</body>
</html>