<?php
header("Content-Type: text/html; charset=UTF-8");
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Status Checker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 2rem;
        }
        .checker-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .result-area {
            margin-top: 20px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        .api-info {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="checker-container">
            <h3 class="mb-4">Network Status Checker API</h3>
            
            <form method="POST" class="mb-4">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <input type="text" class="form-control" 
                               name="target" placeholder="输入IP地址或域名"
                               pattern="^[a-zA-Z0-9.-]+$" 
                               title="请输入有效的IP地址或域名">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">检测</button>
                    </div>
                </div>
            </form>

            <?php
            if (isset($_POST['target']) && !empty($_POST['target'])) {
                $target = $_POST['target'];

                $command = "ping -c 4 " . $target;
                
                echo '<div class="result-area">';
                echo "<h5>检测结果：</h5>";
                echo "<pre>";
                $output = [];
                exec($command, $output);
                foreach($output as $line) {
                    echo htmlspecialchars($line) . "\n";
                }
                echo "</pre>";
                echo '</div>';
            }
            ?>

            <div class="api-info">
                <h6>API 使用说明：</h6>
                <ul>
                    <li>使用原生Linux命令 ping -c 4 进行检测</li>
                    <li>支持 IPv4 地址和域名检测</li>
                    <li>默认发送4个数据包</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>