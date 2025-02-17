<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hello-CTF | SSRF Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            color: #333;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .main-container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .custom-input {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 12px;
            transition: all 0.3s ease;
        }
        .custom-input:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
        }
        .custom-btn {
            background: #007bff;
            border: none;
            padding: 10px 30px;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .custom-btn:hover {
            background: #0056b3;
            transform: translateY(-1px);
        }
        .navbar {
            background: #ffffff !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .security-notice {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 1rem;
            margin: 1rem 0;
            font-size: 0.9rem;
            color: #666;
        }
        .output-area {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 1rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<?php
    error_reporting(0);
    function curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
?>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="https://hello-ctf.com">
            <img src="/assets/logo.png" width="30" height="30" class="d-inline-block align-top me-2" alt="Logo">
            Hello-CTF | SSRF Challenge
        </a>
    </div>
</nav>

<div class="container">
    <div class="main-container">
        <h2 class="text-center mb-4">Web URL Scanner</h2>

        <div class="security-notice">
            <h5>安全模拟实验环境 - 本系统仅供学习SSRF原理使用</h5>
        </div><form method="POST" class="mb-4">
            <div class="form-group">
                <input type="text" class="form-control custom-input" 
                       name="url" placeholder="请输入要扫描的URL (例如: http://example.com)"
                       required>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn custom-btn">开始扫描</button>
            </div>
        </form>

        <?php
            $url = $_POST['url'];
            if($url){
                echo '<div class="output-area">';
                echo "<h5>扫描结果:</h5>";
                echo "<pre>";
                echo htmlspecialchars(curl($url));
                echo "</pre>";
                echo '</div>';
            }
        ?>
    </div>
</div>

<footer class="text-center py-3">
    <small class="text-muted">© 2024 Hello-CTF. All rights reserved.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>