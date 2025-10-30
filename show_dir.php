<?php
// ملف get_dir.php هيكون داخل نفس المجلد، وظيفته طباعة __DIR__
if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
    echo __DIR__;
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>عرض المسار الحالي (__DIR__)</title>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #212121, #2e7d32);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 400px;
        }

        h1 {
            font-size: 22px;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #66BB6A;
        }

        .output {
            margin-top: 25px;
            background: rgba(255, 255, 255, 0.15);
            padding: 15px;
            border-radius: 10px;
            font-family: monospace;
            color: #E8F5E9;
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>📁 عرض المسار الحالي (__DIR__)</h1>
        <button id="showDirBtn">عرض المسار</button>
        <div id="output" class="output"></div>
    </div>

    <script>
        document.getElementById("showDirBtn").onclick = function() {
            fetch("?ajax=1")
                .then(res => res.text())
                .then(data => {
                    const out = document.getElementById("output");
                    out.style.display = "block";
                    out.innerText = data;
                })
                .catch(() => {
                    alert("حدث خطأ أثناء جلب المسار!");
                });
        };
    </script>
</body>

</html>
