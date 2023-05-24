<?php
include_once "controllers/AuthenticationCheckerForLogin.php";

$pageTitle = "Se connecter | VenteVoiture";
?>

<!DOCTYPE html>
<html lang="fr">
    <!-- tête du document -->
    <?php include_once "views/components/head.php"; ?>

    <!-- corps du document -->
    <body class="overflow-hidden font-medium">
        <div class="w-full h-screen flex justify-center items-center bg-gray-200">

            <!-- formulaire du login -->
            <form class="bg-white shadow px-24 py-10 text-gray-600 rounded" action="/connexion" method="POST">
                <div class="my-5"><img src="views/assets/img/blue-logo.png" alt="Logo VenteVoiture"></div>
                <div class="" id="error-login"></div>

                <!-- section nom d'utilisateur -->
                <div class="flex flex-col">
                    <label for="username" class="">Nom d'utilisateur</label>
                    <input class="rounded border focus:border-blue-400 focus:bg-white bg-gray-200 hover:bg-white hover:border-gray-300 focus:outline-none pl-1 py-1" type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <!-- section mot de passe -->
                <div class="flex flex-col mt-3 mb-8">
                    <label for="password" class="">Mot de passe</label>
                    <div class="border bg-gray-200 w-full rounded" id="group-input-icon">
                        <input class="focus:bg-white focus:outline-none pl-1 py-1 rounded bg-gray-200" type="password" name="password" id="password" autocomplete="off" required>
                        <button type="button" class="focus:outline-none px-2 slashed-eye" id="icon-btn"><i class="bi bi-eye-slash-fill text-lg"></i></button>
                    </div>
                </div>

                <!-- section bouton submit -->
                <div class="flex justify-center text-white">
                    <button class="rounded border-none focus:outline-none bg-blue-600 hover:bg-blue-500 p-2" type="submit" id="submit-btn">Se connecter</button>
                </div>
            </form>
        </div>

        <!-- script pour dynamiser la page -->
        <script type="text/javascript" src="views/assets/js/script_login.js"></script>
    </body>
</html>
