<!DOCTYPE html>
<html>
<head>
<style>
body {
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.header {
    text-align: center;
    padding: 20px 0;
}

.header h1 {
    color: #333;
    margin: 0;
}

.header p {
    color: #777;
    margin: 0;
}

.body {
    padding: 20px 0;
}

.body p {
    color: #333;
    line-height: 1.5;
}

.footer {
    text-align: center;
    padding: 20px 0;
}

.footer p {
    color: #777;
    margin: 0;
}
</style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>mon match</h1>
        <p>Envoi de mail</p>
    </div>
    <div class="body">
        <p>Cher(e) , {{ $test->nom }}</p>
        <p>- update: </p>
    </div>
</body>
</html>
