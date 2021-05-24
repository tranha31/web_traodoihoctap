<!DOCTYPE html>
<head>
    <title>Sahre</title>
    <meta charset="UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "index.css">

    <style>
        .btn-group {
            display: flex;
            padding: 10px;
            margin: auto;

        }

        .btn-group a{
            margin: 20px;
            padding: 20px;
            background-color: #00AA45;
            color: white;
            cursor: pointer;
            width: 100%;
            border: none;
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            font-size: 3vw;
            text-decoration: none;
        }

        .btn-group button:not(:last-child) {
            border-right: none;
        }

        h1{
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            padding: 20px;
            font-size: 3vw;
        }

        
    </style>

</head>
<body>
    <h1>Share with:</h1>
    <div class="btn-group">
        <a href="https://facebook.com">Facebook</a>
        <a>Telegram</a>
        <a>Zalo</a>
    </div>
</body>
