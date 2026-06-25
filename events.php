<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Events</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: #f6f7f2;
            font-family: Arial;
        }

        /* HEADER */
        .header{
            background: #556b2f;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 22px;
            font-weight: bold;
        }

        .title{
            text-align: center;
            margin: 30px 0;
            font-weight: bold;
            color: #556b2f;
        }

        /* EVENT CARD */
        .event-card{
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            background: white;
            padding: 20px;
            transition: 0.3s;
            border-top: 5px solid #556b2f;
        }

        .event-card:hover{
            transform: translateY(-6px);
        }

        .event-card h5{
            color: #556b2f;
            font-weight: bold;
        }

        .btn-join{
            width: 100%;
            background: #556b2f;
            border: none;
        }

        .btn-join:hover{
            background: #6b8e23;
        }

        /* FOOTER */
        .footer{
            background: #556b2f;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 40px;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    Event Management System
</div>

<h2 class="title">Upcoming Events</h2>

<div class="container">
    <div class="row">

        <?php
        $res = $conn->query("SELECT * FROM event");
        while($r = $res->fetch_assoc()){
        ?>

        <div class="col-md-4 mb-4">

            <div class="event-card">

                <h5><?= $r['event_name']; ?></h5>

                <p><strong>📅 Date:</strong> <?= $r['event_date']; ?></p>
                <p><strong>📍 Location:</strong> <?= $r['location']; ?></p>

                <p class="text-muted">
                    <?= $r['description']; ?>
                </p>

                <a href="event_register.php?event_id=<?= $r['event_id']; ?>" 
                   class="btn btn-primary btn-join">
                    Join Event
                </a>

            </div>

        </div>

        <?php } ?>

    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    © 2026 Event System | All Rights Reserved
</div>

</body>
</html>