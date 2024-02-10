<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            margin: 15px 0;
            font-size: 14px;
            color: #555;
            max-width: 100%; /* Ensure the text doesn't exceed the container width */
            word-wrap: break-word; /* Allow the text to wrap to the next line if needed */
        }

        a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #4caf50;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Add styles for the QR code image */
        img {
            max-width: 100%;  /* Ensure the image doesn't exceed its container */
            height: auto;     /* Maintain the aspect ratio of the image */
            border-radius: 8px; /* Optional: Add border-radius to the image */
            margin-top: 15px; /* Optional: Add margin to separate image and text */
        }
    </style>
</head>
<body>
    <form method="post" method="GET" action="qr_gen.php" autocomplete = "off">
        <label>Text :</label>
        <input type="text" name="text-qr" id="text-qr" required>
        <button type="submit" name="submit">Generate</button>
        
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    function generateUniqueName($existingNames) {
        // Use a timestamp or a hash function to create a unique identifier
        $uniqueIdentifier = md5(uniqid(rand(), true));

        // Combine with a prefix or other information if needed
        $uniqueName = 'file_' . $uniqueIdentifier;

        // Check if the generated name already exists
        while (in_array($uniqueName, $existingNames)) {
            // Regenerate until a truly unique name is found
            $uniqueIdentifier = md5(uniqid(rand(), true));
            $uniqueName = 'file_' . $uniqueIdentifier;
        }

        return $uniqueName;
    }


    if (isset($_POST['submit']) || isset($_GET['text-qr'])) {
        $tempoFolder = '../tempo';
        $existingNames = glob($tempoFolder . '*');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $textqr = isset($_POST['text-qr']) ? $_POST['text-qr'] : '';
        } 
        elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $textqr = isset($_GET['text-qr']) ? $_GET['text-qr'] : '';
        }
        $textqr = escapeshellarg($textqr);
        $fileqr = generateUniqueName($existingNames);
        $fileqr = escapeshellarg($fileqr);
    
        $command = "C:/Users/ashri/AppData/Local/Programs/Python/Python311/python.exe qr_gen.py $textqr $fileqr 2>&1";
        $output = shell_exec($command);

        if ($output) {
            $fileqr = str_replace('"','',$fileqr);
            $imagePath = "../../tempo/".$fileqr.".png";
            echo "<img src='$imagePath' alt='Generated QR Code'>";
            echo "<p>Code Generated for the below text<br>
                    {$textqr}</p>";
            echo "<a href = '$imagePath' download><u>Download</u></a>";
            echo "<style>#text-qr, label, button { display: none; }</style>";
        } 
        else {
            echo "Error: $output";
        }
    } 

?>


    </form>
</body>
</html>
