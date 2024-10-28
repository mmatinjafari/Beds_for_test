<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فرم با نوع‌های مختلف ارسال</title>
</head>
<body>
    <h2>فرم با سه فیلد و سه نوع محتوا</h2>
    
    <!-- فرم برای ارسال به صورت x-www-form-urlencoded -->
    <form method="post" enctype="application/x-www-form-urlencoded">
        <label for="field1">فیلد اول (URL Encoded):</label>
        <input type="text" name="field1" id="field1">
        <button type="submit" name="submit_urlencoded">ارسال به صورت URL Encoded</button>
    </form>
    <br>

    <!-- فرم برای ارسال به صورت multipart/form-data -->
    <form method="post" enctype="multipart/form-data">
        <label for="field2">فیلد دوم (Multipart):</label>
        <input type="text" name="field2" id="field2">
        <button type="submit" name="submit_multipart">ارسال به صورت Multipart</button>
    </form>
    <br>

    <!-- فرم برای ارسال به صورت JSON -->
    <form method="post">
        <label for="field3">فیلد سوم (JSON):</label>
        <input type="text" name="field3" id="field3">
        <button type="button" onclick="sendJson()">ارسال به صورت JSON</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['submit_urlencoded']) && !empty($_POST['field1'])) {
            echo "<p>سلام " . htmlspecialchars($_POST['field1']) . " - ارسال شده به صورت URL Encoded</p>";
        }

        if (isset($_POST['submit_multipart']) && !empty($_POST['field2'])) {
            echo "<p>سلام " . htmlspecialchars($_POST['field2']) . " - ارسال شده به صورت Multipart</p>";
        }

        // اگر درخواست JSON دریافت شد
        $jsonContent = file_get_contents("php://input");
        $jsonData = json_decode($jsonContent, true);
        if (isset($jsonData['field3']) && !empty($jsonData['field3'])) {
            echo "<p>سلام " . htmlspecialchars($jsonData['field3']) . " - ارسال شده به صورت JSON</p>";
        }
    }
    ?>

    <script>
        // تابع جاوااسکریپت برای ارسال داده به صورت JSON
        function sendJson() {
            const field3Value = document.getElementById("field3").value;

            fetch("", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ field3: field3Value })
            }).then(response => {
                return response.text();
            }).then(data => {
                document.body.innerHTML += data;
            });
        }
    </script>
</body>
</html>

