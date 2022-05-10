<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>スイーツシェア</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        
        <style>
            .home_text {
                text-align: center;
                margin: 50px 0px;
                padding: 50px 0px;
                background-color: #b0e0e6;
                text-decoration: underline;
            }
            footer {
                background-color: #17a2b8;
                padding: 8px 16px;
            }
            .register, .login {
                background-color: #f0f8ff;
            }
            .btn_logout {
                color: #fff;
                background-color: #eb6100;
                margin-top: 20px;
            }
            .btn_logout:hover {
                color: #fff;
                background: #f56500;
            }
            .before_signup_img {
                flex-wrap: wrap;
            }
        </style>
    </head>
    
    <body>
        
        {{-- ナビゲーションバー --}}
        @include('commons.navbar')
        
        <div class="container">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')
            
            @yield('content')
        </div>
        
        <footer>
            
        </footer>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>