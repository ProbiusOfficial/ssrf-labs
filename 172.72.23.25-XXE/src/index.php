<?php
error_reporting(0);
$USERNAME = 'admin'; 
$PASSWORD = 'admin'; 
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    libxml_disable_entity_loader(false);
    $xmlfile = file_get_contents('php://input');

    try {
        $dom = new DOMDocument();
        $dom->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
        $creds = simplexml_import_dom($dom);

        $username = $creds->username;
        $password = $creds->password;

        if($username == $USERNAME && $password == $PASSWORD){
            $result = sprintf("<result><code>%d</code><msg>%s</msg></result>", 1, $username);
        } else {
            $result = sprintf("<result><code>%d</code><msg>%s</msg></result>", 0, $username);
        }    
    } catch(Exception $e) {
        $result = sprintf("<result><code>%d</code><msg>%s</msg></result>", 3, $e->getMessage());
    }

    header('Content-Type: text/html; charset=utf-8');
    echo $result;
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>XXE漏洞实验环境</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 50px; }
        .login-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 15px;
        }
        .form-group { margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center mb-4">用户登录</h2>
                <div class="form-group">
                    <label for="username">用户名</label>
                    <input type="text" class="form-control" id="username">
                    <small class="form-text text-muted">默认用户名：admin</small>
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" class="form-control" id="password">
                    <small class="form-text text-muted">默认密码：admin</small>
                </div>
                <button type="submit" class="btn btn-primary w-100" onclick="login()">登录</button>
                <div id="result" class="mt-3"></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script type='text/javascript'> 
    function login(){
        var username = $("#username").val();
        var password = $("#password").val();
        if(username == "" || password == ""){
            Swal.fire({
                icon: 'error',
                title: '错误',
                text: '用户名或密码不能为空'
            });
            return;
        }
        
        var data = "<user><username>" + username + "</username><password>" + password + "</password></user>"; 
        $.ajax({
            type: "POST",
            url: window.location.href,
            contentType: "application/xml;charset=utf-8",
            data: data,
            dataType: "xml",
            success: function (result) {
                var code = result.getElementsByTagName("code")[0].childNodes[0].nodeValue;
                var msg = result.getElementsByTagName("msg")[0].childNodes[0].nodeValue;
                if(code == "0"){
                    Swal.fire({
                        icon: 'error',
                        title: '登录失败',
                        text: '用户名或密码错误'
                    });
                }else if(code == "1"){
                    Swal.fire({
                        icon: 'success',
                        title: '登录成功',
                        text: 'XXE！，' + msg
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '系统错误',
                        text: msg
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: '请求错误',
                    text: error
                });
            }
        }); 
    }
    </script>
</body>
</html>