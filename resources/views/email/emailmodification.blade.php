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
        <h1>⚽️ Championnat</h1>
        <p>MODIFICATION</p>
    </div>
    <div class="body">
        <p>Vous venez de mettre les informations de "{{ $test->nom }}" a jours</p>
    </div>
</body>
</html>
