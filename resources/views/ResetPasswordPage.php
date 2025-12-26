<?php
if (!isset($_SESSION["alreadyUsedEmail"])) {
    $_SESSION["alreadyUsedEmail"] = false;
}
if (!isset($_SESSION["alreadyUsedUsername"])) {
    $_SESSION["alreadyUsedUsername"] = false;
}
if (!isset($_SESSION["registerNewPasswordError"])) {
    $_SESSION["registerNewPasswordError"] = false;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" href="/DungeonXplorer/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - DungeonXplorer</title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap');
    </style>
</head>
<body class="font-['Roboto'] text-[#E5E5E5] bg-[#1A1A1A] min-h-screen flex flex-col">
    <?php include_once ("Navbar/Navbar.php"); ?>

    <h1 class="font-['Pirata_One'] text-5xl text-center text-[#C4975E] mt-8 mb-6">Inscription</h1>
    <div class="max-w-md mx-auto bg-[#2E2E2E] rounded-lg shadow-2xl p-8 border-2 border-[#C4975E]/30">
        <form action="resetPassword" method="POST" class="max-w-md mx-auto">
            <?php 
                if($_SESSION["registerNewPasswordError"]==true){
                    echo "<label class='block text-[#8B1E1E] text-xl mb-4'>Une erreur est survenue.</label>";
                }
            ?>
            <label class="block text-[#C4975E] text-xl mb-2">Choisissez votre nouveau mot de passe : </label>
            <input id="password_1" name="password_1" type="password" class="w-full bg-[#2E2E2E] border border-[#C4975E] text-[#E5E5E5] rounded p-2 mb-4 focus:outline-none focus:border-[#8B1E1E]" required>
            <label class="block text-[#C4975E] text-xl mb-2">Confirmer le mot de passe : </label>
            <input id="password_2" name="password_2" type="password" class="w-full bg-[#2E2E2E] border border-[#C4975E] text-[#E5E5E5] rounded p-2 mb-4 focus:outline-none focus:border-[#8B1E1E]" required>
            <label id="labelTooLongPassword" class='block text-[#8B1E1E] mb-4'>Mot de passe trop long (255 caractères max.)</label>
            <label id="labelMismatchedPassword" class='block text-[#8B1E1E] mb-4'>Les mots de passe ne correspondent pas.</label>
            <input type="submit" value="Changer de mot de passe" class="w-full bg-gray-500 hover:bg-[#8B1E1E] text-white rounded-md p-2 cursor-pointer font-['Pirata_One'] text-2xl">
        </form>
    </div>
    <script>
        const labelTooLongPassword = document.getElementById('labelTooLongPassword');
        const labelMismatchedPassword = document.getElementById('labelMismatchedPassword');


        const password1Input = document.getElementById('password_1');
        const password2Input = document.getElementById('password_2');
        const newPasswordButton = document.querySelector('input[type="submit"]');

        
        
        labelTooLongPassword.style.display = 'none';
        labelMismatchedPassword.style.display = 'none';

        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function verifyForm() {
            let valid = true;

            if (password1Input.value.length > 255 || password2Input.value.length > 255) {
                labelTooLongPassword.style.display = 'block';
                valid = false;
            } else {
                labelTooLongPassword.style.display = 'none';
            }

            if (password1Input.value !== password2Input.value) {
                labelMismatchedPassword.style.display = 'block';
                valid = false;
            } else {
                labelMismatchedPassword.style.display = 'none';
            }
            if (password1Input.value.length < 1) {
                valid = false;
            }



            newPasswordButton.disabled = !valid;
            if (valid) {
                newPasswordButton.classList.remove('bg-gray-500', 'cursor-not-allowed');
                newPasswordButton.classList.add('bg-[#C4975E]', 'hover:bg-[#8B1E1E]');
            } else {
                newPasswordButton.classList.remove('bg-[#C4975E]', 'hover:bg-[#8B1E1E]');
                newPasswordButton.classList.add('bg-gray-500', 'cursor-not-allowed');
            }
        }

        password1Input.addEventListener('input', verifyForm);
        password2Input.addEventListener('input', verifyForm);

        const genre_group = document.querySelectorAll('input[name="gender"]');

        verifyForm();
    </script>

</body>
</html>