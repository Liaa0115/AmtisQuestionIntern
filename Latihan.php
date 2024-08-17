<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <center>
        <h1>Calculation Electricity</h1>
    </center>
    <main>
        <div class="calcBox">
            <div class="calc1">
            <h1>Calculate</h1>
                <form method="POST" action="">
                    <p>
                        <label for="volt">Voltage</label>
                        <input type="number" id="volt" name="voltage" step="any" placeholder="Voltage (V)" required>
                    </p>
                    <p>  
                        <label for="current">Current</label>
                        <input type="number" id="current" name="current" step="any" placeholder="Ampere (A)" required>
                    </p>
                    <p>
                        <label for="rate">Current Rate</label>
                        <input type="number" id="rate" name="rate" step="any" placeholder="sen/kWh" required>
                    </p>
                    <button type="submit" class="btn btn-primary">Calculate</button>
                </form>
            </div>

            <div class="calc2">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $voltage = $_POST['voltage'];
                    $current = $_POST['current'];
                    $rate = $_POST['rate'];
                
                    $power = $voltage * $current; // Power in Watts
                    $power_kW = $power / 1000; // Power in kW
                    $cost = $rate / 100 ; // Cost per hour
                
                    echo "<h1>Results</h1>";
                    echo "<p>Power: " . number_format($power_kW, 5) . " kW</p>";
                    echo "<p>Rate: " . number_format($cost, 3) . " RM</p>";
                }else{
                    echo "<h1>Results</h1>";
                    echo "<p>Power: 0 kW</p>";
                    echo "<p>Rate: 0 RM</p>";
                }
                ?>
            </div>
        </div>
                    
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<div class='table'>";
            echo "<h1>Energy and Cost per Hour</h1>";
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>Hour</th><th>Energy (kWh)</th><th>Total Cost (RM)</th></tr></thead>";
            echo "<tbody>";

            for ($hour = 1; $hour <= 24; $hour++) {
                $energy = $power_kW * $hour; // Energy in kWh
                $total = $energy * ($rate / 100); // Total cost in RM
                echo "<tr><td>$hour</td><td>" . number_format($energy, 5) . "</td><td>" . number_format($total, 2) . "</td></tr>";
            }

            echo "</tbody></table>";
            echo "</div>";
        }
        ?>
        
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>