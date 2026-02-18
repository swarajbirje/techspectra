<?php
if (!isset($_GET['event'])) {
  die("No Event Selected");
}

$event = $_GET['event'];

// All event data stored in an associative array
$events = [
  "Communication" => [
    "description" => "Test Your Vocabulary.",
    "team" => "2 Members",
    "rounds" => "2",
    "duration" => "2 Hours",
    "venue" => "Classroom 1",
    "rules" => ["No internet access", "English Mandatory"],
    "faculty_incharge" => ["name" => "Dr. Neeta Kulkarni", "phone" => "9876543210"],
    "team_heads" => [
      ["name" => "Alice Sharma", "phone" => "9876543211"],
      ["name" => "Rohit Patil", "phone" => "9123456780"]
    ]
  ],
  "Coding" => [
    "description" => "Development challenge.",
    "team" => "2 Members",
    "duration" => "24 Hours",
    "venue" => "Lab 3",
    "rules" => ["Bring your own laptops", "Plagiarism not allowed"],
    "faculty_incharge" => ["name" => "Prof. Sanjay Rao", "phone" => "9988776655"],
    "team_heads" => [
      ["name" => "Swayam Keserkar", "phone" => "9871234567"],
      ["name" => "Aditya Sungar", "phone" => "9871122334"]
    ]
  ],
  "Designing" => [
    "description" => "Explore New Images to the World.",
    "team" => "2 Members",
    "duration" => "24 Hours",
    "venue" => "Lab 2",
    "rules" => ["Bring your own laptops", "Plagiarism not allowed"],
    "faculty_incharge" => ["name" => "Dr. Neha Kulkarni", "phone" => "9876543222"],
    "team_heads" => [
      ["name" => "Neha Kulkarni", "phone" => "9876543211"]
    ]
  ],
  "Quiz" => [
    "description" => "Decode your Knowledge.",
    "team" => "2 Members",
    "duration" => "4 Hours",
    "venue" => "Classroom 2",
    "rules" => ["No cheating", "Follow instructions"],
    "faculty_incharge" => ["name" => "Prof. Manish Desai", "phone" => "9123456781"],
    "team_heads" => [
      ["name" => "Riya Sharma", "phone" => "9876543234"]
    ]
  ],
  "Art" => [
    "description" => "Explore your Magical Hands.",
    "team" => "2 Members",
    "duration" => "4 Hours",
    "venue" => "Classroom 6",
    "rules" => ["Bring your own materials"],
    "faculty_incharge" => ["name" => "Dr. Pooja Rane", "phone" => "9876543225"],
    "team_heads" => [
      ["name" => "Pooja Rane", "phone" => "9876543222"]
    ]
  ],
  "Start-Up" => [
    "description" => "Time to build up something.",
    "team" => "2 Members",
    "duration" => "4 Hours",
    "venue" => "Ranade Seminar Hall",
    "rules" => ["Bring your own laptops", "Plagiarism not allowed"],
    "faculty_incharge" => ["name" => "Prof. Jeevan Bodas", "phone" => "9988776644"],
    "team_heads" => [
      ["name" => "Gulmohar Chougule", "phone" => "8618304315"]
    ]
  ],
  "Cultural" => [
    "description" => "Make the World Move.",
    "team" => "8-10 Members",
    "duration" => "3 Hours",
    "venue" => "K.M.Giri Hall",
    "rules" => ["Costume should be decent", "Bring your own music/props"],
    "faculty_incharge" => ["name" => "Prof. Sakshi Patil", "phone" => "9871122333"],
    "team_heads" => [
      ["name" => "Sakshi Patil", "phone" => "9871122334"],
      ["name" => "Aditya Verma", "phone" => "9871122335"]
    ]
  ],
  "Lan-Gaming" => [
    "description" => "Fastest Moves of Your Hand.",
    "team" => "2 Members",
    "duration" => "4 Hours",
    "venue" => "Lab 1",
    "rules" => ["Bring your own laptops", "No cheating"],
    "faculty_incharge" => ["name" => "Prof. Karan Singh", "phone" => "9988123456"],
    "team_heads" => [
      ["name" => "Karan Singh", "phone" => "9988123457"]
    ]
  ],
  "Photography" => [
    "description" => "Photography is the story I fail to put in words.",
    "team" => "2 Members",
    "duration" => "4 Hours",
    "venue" => "Open Space",
    "rules" => ["Bring your own camera/laptop"],
    "faculty_incharge" => ["name" => "Prof. Anjali Rao", "phone" => "9876543232"],
    "team_heads" => [
      ["name" => "Anjali Rao", "phone" => "9876543233"]
    ]
  ],
  "Reel-Making" => [
    "description" => "Strategic planning, creative shooting & editing.",
    "team" => "2 Members",
    "duration" => "4 Hours",
    "venue" => "Place will be informed",
    "rules" => ["Bring your own laptops", "Plagiarism not allowed"],
    "faculty_incharge" => ["name" => "Prof. Riya Kapoor", "phone" => "9876654322"],
    "team_heads" => [
      ["name" => "Riya Kapoor", "phone" => "9876654321"]
    ]
  ],
  "Treasure-Hunt" => [
    "description" => "Series of clues, riddles, directions.",
    "team" => "10 Members",
    "duration" => "2 Hours",
    "venue" => "The Campus",
    "rules" => ["Follow the hints carefully"],
    "faculty_incharge" => ["name" => "Prof. Vikram Joshi", "phone" => "9875544331"],
    "team_heads" => [
      ["name" => "Vikram Joshi", "phone" => "9875544332"]
    ]
  ],
  "TGT" => [
    "description" => "Finding Something New In You.",
    "team" => "2 Members",
    "duration" => "4 Hours",
    "venue" => "Classroom 5",
    "rules" => ["Bring your own laptops", "Plagiarism not allowed"],
    "faculty_incharge" => ["name" => "Prof. Tanvi Deshmukh", "phone" => "9876677888"],
    "team_heads" => [
      ["name" => "Tanvi Deshmukh", "phone" => "9876677889"]
    ]
  ]
];

// Check if event exists
if (!isset($events[$event])) {
  die("Invalid Event");
}

$e = $events[$event];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Event Details | TechSpectra</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      height: 100vh;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #020617, #0b1120);
      color: #e5e7eb;
      padding: 20px;
    }

    img{
        width: 100%;
        height: 40%;

    }
    section.card {
      background: rgba(2,6,23,0.85);
      padding: 30px;
      border-radius: 15px;
      max-width: 900px;
      margin: auto;
      box-shadow: 0px 5px 15px rgba(0,0,0,0.3);
    }
    h2 {
      color: #38bdf8;
      margin-bottom: 15px;
    }
    ul {
      margin-left: 20px;
      margin-bottom: 15px;
    }
    .btn-theme {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 25px;
      border-radius: 25px;
      background: linear-gradient(90deg, #38bdf8, #0ea5e9);
      color: #fff;
      font-weight: bold;
      text-decoration: none;
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .btn-theme:hover {
      transform: translateY(-3px);
      box-shadow: 0px 5px 15px rgba(0,0,0,0.3);
    }
  </style>
</head>
<body>

<section class="card">
  
  <h2><?php echo $event; ?></h2>

  <?php if(!empty($e['faculty_incharge'])): ?>
  <p><b>Faculty In-charge:</b> <?php echo $e['faculty_incharge']['name'] . " - " . $e['faculty_incharge']['phone']; ?></p>
  <?php endif; ?>

  <?php if(!empty($e['team_heads'])): ?>
  <p><b>Event Heads (Students):</b></p>
  <ul>
    <?php foreach($e['team_heads'] as $head): ?>
      <li><?php echo $head['name'] . " - " . $head['phone']; ?></li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>

  <p><b>Description:</b> <?php echo $e['description']; ?></p>
  <p><b>Team Size:</b> <?php echo $e['team']; ?></p>
  <?php if(isset($e['rounds'])) { ?><p><b>Rounds:</b> <?php echo $e['rounds']; ?></p><?php } ?>
  <p><b>Duration:</b> <?php echo $e['duration']; ?></p>
  <p><b>Venue:</b> <?php echo $e['venue']; ?></p>

  <?php if(!empty($e['rules'])): ?>
  <p><b>Rules:</b></p>
  <ul>
    <?php foreach($e['rules'] as $rule) echo "<li>$rule</li>"; ?>
  </ul>
  <?php endif; ?>

  <a href="register.php?event=<?php echo $event; ?>" class="btn-theme">Register Now</a>
</section>

</body>
</html>
