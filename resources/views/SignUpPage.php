<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h1>SignUp</h1>
    <form action="/signup" method="POST">
        <label>Username : </label><input id="username" name="username" type="text">
        <label>Email address : </label><input id="email" name="email" type="text">
        <label>Password : </label><input id="password_1" name="password_1" type="password">
        <label>Confirm Password : </label><input id="password_2" name="password_2" type="password">
        
        <input type="submit" value="Send">
    </form>
</body>
</html>