<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartClinic+ Appointment</title>
    <link rel="stylesheet" href="css/appointment.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>

<main class="appointment-page">

    <h2>Book Appointment</h2>
    <?php if ($message !== ""): ?>
        <p style="color: red; font-weight: bold;">
            <?= htmlspecialchars($message) ?>
        </p>
    <?php endif; ?>
    <form action="appointment.php" method="POST">

        <!-- SECTION 1: DOCTOR -->
        <div class="doctor-section">

            <h3>Select Doctor</h3>

            <div class="doctor-grid">

                <?php foreach ($doctors as $doctor): ?>

                    <label class="doctor-card">

                        <input
                            type="radio"
                            name="doctor_id"
                            value="<?= (int)$doctor['id'] ?>"
                            required
                        >

                        <div class="doctor-content">

                            <div class="doctor-avatar">
                                Dr
                            </div>

                            <div class="doctor-info">

                                <h4>
                                    <?= htmlspecialchars($doctor['full_name']) ?>
                                </h4>

                                <p>
                                    <?= htmlspecialchars($doctor['specialty']) ?>
                                </p>

                                <p>
                                    <?= htmlspecialchars($doctor['qualification'] ?? '') ?>
                                </p>

                                <small>
                                    <?= (int)$doctor['experience_years'] ?>
                                    Years Experience
                                </small>

                            </div>

                        </div>

                    </label>

                <?php endforeach; ?>

            </div>

        </div>

        <div class="booking-container">

            <div class="time-section">
                <h3>Select Time</h3>

                <div class="time-grid">

                    <label>
                        <input type="radio" name="time" value="09:00" required>
                        <span>09:00 AM</span>
                    </label>

                    <label>
                        <input type="radio" name="time" value="09:15">
                        <span>09:15 AM</span>
                    </label>

                    <label>
                        <input type="radio" name="time" value="09:30">
                        <span>09:30 AM</span>
                    </label>

                    <label>
                        <input type="radio" name="time" value="09:45">
                        <span>09:45 AM</span>
                    </label>

                    <label>
                        <input type="radio" name="time" value="10:00">
                        <span>10:00 AM</span>
                    </label>

                    <label>
                        <input type="radio" name="time" value="10:15">
                        <span>10:15 AM</span>
                    </label>

                </div>
            </div>

            <div class="date-section">
                <h3>Select Date</h3>

                <label for="date">Appointment Date</label>

                <input
                    type="date"
                    id="date"
                    name="date"
                    required
                >
            </div>

        </div>

        <div class="booking-actions">
            <button type="reset" class="cancel-btn">Cancel</button>
            <button type="submit" class="next-btn">Next</button>
        </div>

    </form>

</main>
</body>
</html>
