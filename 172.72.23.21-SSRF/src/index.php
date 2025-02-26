<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>SSRF综合靶场 - Hello-CTF</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --background-color: #ffffff;
            --text-color: #2c3e50;
            --code-background: #f4f4f4;}

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;font-family: 'Arial', 'Microsoft YaHei', sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .challenge-title {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 2rem;
        }

        .challenge-description {
            background-color: var(--code-background);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-top: 1rem;
        }

        .challenge-input {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid var(--secondary-color);
            border-radius: 4px;}

        .submit-btn {
            display: block;
            width: 100%;
            padding: 0.8rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: var(--secondary-color);
        }

        .source-code {
            background-color: var(--code-background);
            border-radius: 8px;
            padding: 1rem;
            font-family: 'Consolas', monospace;
            font-size: 0.9rem;
            overflow-x: auto;
            margin-top: 1rem;
        }

        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .footer {
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
            border-top: 1px solid var(--secondary-color);
            color: var(--text-color);
            font-size: 0.9rem;
        }
        
        .footer a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="challenge-title">SSRF-Labs 综合靶场 | Hello-CTF系列靶场</h1>
        <div class="challenge-description">
            <h2>入口点</h2>
            <p>综合靶机一共有 9 个靶机（含本机），尝试找个突破口吧w</p>
            <button onclick="toggleTips()" class="submit-btn" style="margin-top: 10px;">显示/隐藏靶场拓扑</button>
            <div id="tips" style="display: none; margin-top: 10px;">
                <strong>靶场拓扑:</strong><br>
                172.72.23.22-CodeExec<br>
                172.72.23.23-SQLI<br>
                172.72.23.24-CommandExec<br>
                172.72.23.25-XXE<br>
                172.72.23.26-Tomcat<br>
                172.72.23.27-Redisunauth<br>
                172.72.23.28-Redisauth<br>
                172.72.23.29-MySQL
            </div>
            <script>
                function toggleTips() {
                    var tips = document.getElementById("tips");
                    tips.style.display = tips.style.display === "none" ? "block" : "none";
                }
            </script>
            <br>
            <p>.tip:使用file协议查看当前主机的hosts文件获取更多信息</p>
        </div>

        <form id="ssrfForm">
            <input type="url" id="urlInput" class="challenge-input"placeholder="输入要请求的 URL（例如：http://example.com）" 
                   required>
            <button type="submit" class="submit-btn">发送请求</button>
        </form>

        <div id="result" class="challenge-description" style="display:none;">
            <h3>请求结果</h3>
            <pre id="resultContent"></pre>
        </div>

        <div class="source-code">
            <h3>后端源代码</h3>
            <code>
            <?php
                highlight_file('ssrf.php');
            ?>
            </code>
        </div>
    </div>

    <script>
        document.getElementById('ssrfForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const url = document.getElementById('urlInput').value;
            fetch('ssrf.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `url=${encodeURIComponent(url)}`
            })
            .then(response => response.text())
            .then(data => {
                const resultDiv = document.getElementById('result');
                const resultContent = document.getElementById('resultContent');
                resultContent.textContent = data;
                resultDiv.style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
<footer class="footer">
        <p>© 2025 <a href="https://hello-ctf.com" target="_blank">Hello-CTF</a>. All rights reserved.</p>
    </footer>
</body>
</html>