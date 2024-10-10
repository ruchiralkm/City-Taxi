<?php
// Include database connection
include 'dbConnection.php';

// Get the driverID from the URL
$driverID = isset($_GET['driverID']) ? intval($_GET['driverID']) : 0;

// Initialize $driver as null
$driver = null;

if ($driverID > 0) {
    // SQL query to get driver details by driverID
    $sql = "SELECT * FROM driver WHERE driverID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $driverID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $driver = $result->fetch_assoc();
    }

    $sqlComments = "SELECT * FROM driverFeedback WHERE driverID = ?";
    if ($stmt = $conn->prepare($sqlComments)) {
        $stmt->bind_param("i", $driverID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $comments[] = $row['comment'];
            }
        }
    }

    $sqlRatings = "SELECT * FROM driverratings WHERE driverID = ?";
    if ($stmt = $conn->prepare($sqlRatings)) {
        $stmt->bind_param("i", $driverID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $ratings = $result->fetch_assoc();
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Details</title>
    <style>
        /* POPPINS FONT */
        /* POPPINS FONT */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

body {
    font-family: "Poppins", sans-serif;
    background-color: #f0f2f5;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    background-color: #ffffff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 90%;
    max-width: 1000px;
    margin: 2rem auto;
}

.driver-details {
    display: flex;
    flex-direction: row;
    padding: 3rem;
}

.profile-picture {
    flex: 0 0 30%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-right: 2rem;
}

.profile-picture img {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    object-fit: cover;
    margin-bottom: 1rem;
}

.driver-name {
    font-size: 1.8rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
    text-align: center;
}

.rating-badge {
    background-color: #ffd700;
    color: #333;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 1.2rem;
    margin-top: 1rem;
}

.details {
    flex: 1;
}

h1 {
    color: #3498db;
    margin-top: 0;
    margin-bottom: 2rem;
    font-size: 2.5rem;
    font-weight: 700;
}

.info-item {
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
}

.info-label {
    font-size: 1.1rem;
    font-weight: 600;
    color: #555;
    width: 150px;
    flex-shrink: 0;
}

.info-value {
    font-size: 1.1rem;
    color: #333;
    font-weight: 500;
}

.comments-section {
    border-radius: 10px;
    margin-left: 30px;
    padding: 30px;
    height: auto;
    background-color: #f9f9f9;
    border-top: 1px solid #e0e0e0;
}

.comments-section h2 {
    color: #3498db;
    margin-bottom: 1.5rem;
    font-size: 2rem;
    font-weight: 600;
}

.comment {
    padding: 1.5rem;
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    font-size: 1rem;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.comment:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.container {
    animation: fadeIn 0.5s ease-out;
}

/* Responsive design */
@media (max-width: 768px) {
    .driver-details {
        flex-direction: column;
    }
    .profile-picture {
        padding-right: 0;
        padding-bottom: 2rem;
    }
    .info-item {
        flex-direction: column;
        align-items: flex-start;
    }
    .info-label {
        margin-bottom: 0.5rem;
    }
}
    </style>
</head>
<body>
    <div class="container">
        <?php if ($driver): ?>
            <div class="driver-details">
                <div class="profile-picture">
                    <img src="<?php echo htmlspecialchars('../../Drivers/backend/' . $driver['profilePicture']); ?>" alt="Driver Profile Picture">
                    <center>
                        <span class="info-value" style="font-weight:600; font-size:24px;"><?php echo htmlspecialchars($driver['firstName']); ?></span>
                        <span class="info-value" style="font-weight:600; font-size:24px;"><?php echo htmlspecialchars($driver['lastName']); ?></span><br><br>
                        <img style="width: 80px; height:80px;" src="https://img.icons8.com/?size=100&id=YUnLyRLAKDTW&format=png&color=000000" alt="">
                        <?php if ($ratings): ?>
                        <div class="ratings-section">
                            <h2>Driver Ratings</h2>
                            <div class="info-item">
                                <span class="info-label">Average Rating:</span>
                                <span class="info-value"><?php echo htmlspecialchars($ratings['rating_avg']); ?></span>
                            </div>
                            <div style="margin-top: -40px; margin-left:15px;" class="info-item">
                                <span class="info-value"><?php echo '<p><strong></strong><span style="color: yellow; font-size: 40px;">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>'; ?></span>
                            </div>
                        </div>
                            <?php else: ?>
                            <p>Driver not found or no driver selected.</p>
                        <?php endif; ?>
                    </center>
                </div>
                <div class="details">
                    <h1>Driver Details</h1>
                    <div class="info-item">
                        <span class="info-label">Name:</span>
                        <span class="info-value"><?php echo htmlspecialchars($driver['firstName']); ?></span>
                        <span>&nbsp;</span> <!-- Add space here -->
                        <span class="info-value"><?php echo htmlspecialchars($driver['lastName']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Mobile:</span>
                        <span class="info-value"><?php echo htmlspecialchars($driver['mobile']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Employment:</span>
                        <span class="info-value"><?php echo htmlspecialchars($driver['employment']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Vehicle:</span>
                        <span class="info-value"><?php echo htmlspecialchars($driver['vehicle']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Vehicle Reg No:</span>
                        <span class="info-value"><?php echo htmlspecialchars($driver['regNo']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Brand:</span>
                        <span class="info-value"><?php echo htmlspecialchars($driver['vehicleBrand']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Model:</span>
                        <span class="info-value"><?php echo htmlspecialchars($driver['vehicleModel']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Color:</span>
                        <span class="info-value"><?php echo htmlspecialchars($driver['vColor']); ?></span>
                    </div>
                </div>
            
            <!-- Comments Section -->
            <div class="comments-section">
                <h2>Driver Comments</h2>
                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment"><?php echo htmlspecialchars($comment); ?></div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No comments available for this driver.</p>
                <?php endif; ?>
            </div>

        <?php else: ?>
            <p>Driver not found or no driver selected.</p>
        <?php endif; ?>
    </div>
</body>
</html>