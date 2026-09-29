<?php
session_start();
require_once 'includes/db.php';

$sql = "
    SELECT 
        appointments.id,
        users.full_name AS patient_name,
        doctors.full_name AS doctor_name,
        appointments.appointment_date,
        appointments.appointment_time
    FROM appointments
    JOIN users ON appointments.user_id = users.id
    JOIN doctors ON appointments.doctor_id = doctors.id
    ORDER BY appointments.appointment_date ASC,
             appointments.appointment_time ASC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartClinic</title>
    <link rel="stylesheet" href="css/home.css">
</head>

<body>

    <?php include 'includes/sidebar.php'; ?>

    <main class="dashboard">

        <div class="dashboard-header">
            <div>
                <h1>Admin Dashboard</h1>
                <p>Manage and monitor clinic appointments.</p>
            </div>
        </div>

        <section class="dashboard-card">

            <h2>Appointment List</h2>

            <div class="table-container">

                <table>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if (count($appointments) > 0): ?>

                        <?php foreach ($appointments as $appointment): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($appointment['id']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($appointment['patient_name']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($appointment['doctor_name']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($appointment['appointment_date']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($appointment['appointment_time']) ?>
                                </td>

                                <td>
                                    <span class="status-confirmed">
                                        Confirmed
                                    </span>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="6">
                                No appointments found.
                            </td>
                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </section>

    </main>

</body>
</html>
