<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        #result {
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form id="myForm">
        <label for="myField">Enter a value:</label>
        <input type="text" id="myField" required>
        <button type="button" onclick="submitForm()">Submit</button>
    </form>
    
    <div id="result"></div>

    <script>
        function submitForm() {
            var fieldValue = document.getElementById('myField').value;

            // You can add your conditions for successful and unsuccessful submissions here
            if (fieldValue.trim() !== "") {
                // Success
                document.getElementById('result').innerHTML = "Value: 1";
                document.getElementById('result').style.color = "green";
            } else {
                // Failure
                document.getElementById('result').innerHTML = "Value: 0";
                document.getElementById('result').style.color = "red";
            }
        }
    </script>
</body>
</html>
