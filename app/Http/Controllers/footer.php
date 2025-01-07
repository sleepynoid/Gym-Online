<footer class="text-center">
    <p>&copy; 2023 Premium Gym. All rights reserved.</p>
</footer>
- **personal-trainer.php (Personal Trainer Section)**

php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Trainer - Premium Gym</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php include('includes/header.php'); ?>

    <div class="container">
        <h2>Our Personal Trainers</h2>
        <div class="row">
            <div class="col-md-4">
                <h4>Trainer 1</h4>
                <p>Specializes in strength training and nutrition.</p>
            </div>
            <div class="col-md-4">
                <h4>Trainer 2</h4>
                <p>Expert in cardio and weight loss programs.</p>
            </div>
            <div class="col-md-4">
                <h4>Trainer 3</h4>
                <p>Focuses on flexibility and rehabilitation.</p>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>