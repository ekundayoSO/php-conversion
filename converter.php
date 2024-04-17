<?php

class Converter
{
    public $celsiusToFahrenheit;
    public $celsiusToKelvin;
    public $kilometersToMeters;
    public $kilometersToKnots;
    public $kilogramToGrams;
    public $gramsToKilograms;

    function __construct()
    {
        $this->celsiusToFahrenheit;
        $this->celsiusToKelvin;
        $this->kilometersToMeters;
        $this->kilometersToKnots;
        $this->kilogramToGrams;
        $this->gramsToKilograms;
    }
    function convertCelToFah($degreeInCel)
    {
        $this->celsiusToFahrenheit = number_format(($degreeInCel * 9 / 5) + 32, 2);
        return $this->celsiusToFahrenheit;
    }
    function convertCelToKel($degreeInCel)
    {
        $this->celsiusToKelvin = number_format(($degreeInCel + 273.15), 2);
        return $this->celsiusToKelvin;
    }
    function convertKmToM($kilometers)
    {
        $this->kilometersToMeters = number_format($kilometers * (1000 / 3600), 2);
        return $this->kilometersToMeters;
    }
    function convertKmToK($kilometers)
    {
        $this->kilometersToKnots = number_format($kilometers * 0.539957, 2);
        return $this->kilometersToKnots;
    }
    function convertKgToGrams($kilograms)
    {
        $this->kilogramToGrams = number_format($kilograms / 1000, 2);
        return $this->kilogramToGrams;
    }
    function convertGramsToKg($grams)
    {
        $this->gramsToKilograms = number_format($grams * 1000, 2);
        return $this->gramsToKilograms;
    }
}

$conversionObj = new Converter();

$temperature°C = $speed = $mass = '';

# Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # Retrieve inputs from the form
    $temperature = isset($_POST['temperature']) ? (float)$_POST['temperature'] : 0;
    $speed = isset($_POST['speed']) ? (float)$_POST['speed'] : 0;
    $mass = isset($_POST['mass']) ? (float)$_POST['mass'] : 0;

    $tempFahrenheit°F = $conversionObj->convertCelToFah($temperature);
    $tempKelvin = $conversionObj->convertCelToKel($temperature);
    $speedMps = $conversionObj->convertKmToM($speed);
    $speedKnots = $conversionObj->convertKmToK($speed);
    $massGrams = $conversionObj->convertKgToGrams($mass);
    $massKg = $conversionObj->convertGramsToKg($mass);

    echo "<h2>Temperature Conversions</h2>";
    echo "Celsius to Fahrenheit: $temperature°C  = $tempFahrenheit°F F<br>";
    echo "Celsius to Kelvin: $temperature°C = $tempKelvin K<br><br>";

    echo "<h2>Speed Conversions</h2>";
    echo "Kilometers per hour to Meters per second: $speed km/h = $speedMps m/s<br>";
    echo "Kilometers per hour to Knots: $speed km/h = $speedKnots knots<br><br>";

    echo "<h2>Mass Conversions</h2>";
    echo "Kilograms to Grams: $mass kg = $massGrams g<br>";
    echo "Grams to Kilograms: $massGrams g = $massKg kg<br>";

    # Empty input fields after each post.
    if (!empty($_POST['temperature']) && !empty($_POST['speed']) && !empty($_POST['mass'])) {
        $temperature = '';
        $speed = '';
        $mass = '';
    }
}

?>

<!DOCTYPE html>
<html>
<style>
    form {
        max-width: 800px;
    }

    div {
        border: 2px solid orange;
        border-radius: 5px;
        margin: 20px;
        padding-left: 10px;
    }

    div:hover {
        border: 2px solid red;
        transition: 1s ease-out;
    }

    input[type='submit'] {
        background-color: orange;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 4px;
        padding: 10px;
        margin-left: 20px;

    }

    input[type='submit']:hover {
        background-color: green;
        transition: 0.5s ease-out;
    }
</style>

<head>
    <title>Measurement Converter</title>
</head>

<body>
    <h1>Measurement Converter</h1>
    <form method="post" action="converter.php">
        <div>
            <h2>Temperature</h2>
            Celsius: <input type="text" name="temperature" value="<?= $temperature ?>"><br><br>
        </div>
        <div>
            <h2>Speed</h2>
            Kilometers per hour: <input type="text" name="speed" value="<?= $speed ?>"><br><br>
        </div>
        <div>
            <h2>Mass</h2>
            Kilograms: <input type="text" name="mass" value="<?= $mass ?>"><br><br>
        </div>
        <input type="submit" value="Convert">
    </form>
</body>

</html>