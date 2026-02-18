<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once 'db.php';

$search = $_GET['search'] ?? '';
$search = trim($search);

if ($search !== '') {
    //prepared statement
    $stmt = $conn->prepare("SELECT id, team_no, name, uucms_id, phone, sdiv, sem, event 
                            FROM registrations 
                            WHERE team_no LIKE ? 
                               OR name LIKE ? 
                               OR uucms_id LIKE ? 
                               OR phone LIKE ? 
                               OR event LIKE ?
                            ORDER BY event ASC, team_no ASC");
    $like = "%$search%";
    $stmt->bind_param("sssss", $like, $like, $like, $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} if ($search === '' || isset($_GET['reset'])) {
    //registrations
    $sql = "SELECT id, team_no, name, uucms_id, phone, sdiv, sem, event 
            FROM registrations 
            ORDER BY event ASC, team_no ASC";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin - Registrations</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .container{
      display: flex;
      flex-direction: row;
      justify-content: space-evenly;
      align-items: center;
      max-width: 100%;
      background: linear-gradient(135deg, #020617, #0b1120);
      border: 1px solid  #38bdf8;;
      border-radius: 5px;
    }
    form{
      float :right;
      display: flex;
      flex-direction: row;
      text-align: center;
      margin-bottom: 20px;
    }
    input[type="text"] , select{
      padding: 8px;
      width: 300px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button{
       background: linear-gradient(to right, #38bdf8, #0ea5e9);
       color: white;
        padding: 5px;
        width: 80px;
        height: 40px;
        margin:10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;

}
    table {
      border-collapse: collapse;
      width: 100%;
    }
    .container h2{
      font-family: Arial, sans-serif;
      color: #38bdf8;
      margin: 20px;
      text-align: center;
      margin-bottom: 20px;
    }
    a{
      color: white;
      text-decoration: none;
      
    }
    .container a{
      padding: 5px 10px;
      border-radius: 4px;
    }
   
    th, td {
      border: 1px solid  #38bdf8;
      color: #38bdf8;
      padding: 8px;
      text-align: left;
    }
    th {
      background: #f4f4f4;
    }
  </style>
</head>
<body>
<div class="container">
    
  <h2>Registered Participants</h2>
  <form method="get" action="admin.php">
    <input type="text" name="search" placeholder="Search by Team No, Name, UUCMS ID..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    <select name="search" value="<?= htmlspecialchars($registration['event']) ?>">
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
    </select>
    <button type="submit">Search</button>
    <button>reset<a href="admin.php?reset=1" style="margin-left: 10px;"></a></button>

  </form>
  <button><a href="logout.php">Logout</a></p></button>
</div>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Team No</th>
        <th>Name</th>
        <th>UUCMS ID</th>
        <th>Phone</th>
        <th>Div</th>
        <th>Sem</th>
        <th>Event</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['team_no']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['uucms_id']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td><?php echo htmlspecialchars($row['sdiv']); ?></td>
            <td><?php echo htmlspecialchars($row['sem']); ?></td>
            <td><?php echo htmlspecialchars($row['event']); ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
              <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="9">No registrations found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>