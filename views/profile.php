<?php
include_once "controllers/AuthenticationChecker.php";

$pageTitle = "Pofile | VenteVoiture";
$titleOfAddModal = "Ajout d'administrateur";
$titleOfDeleteModal = "Confirmation";
$urlOfDeleteModal = "/supprimer/admin";
$urlOfAddModal = "/ajouter/admin";
?>

<!DOCTYPE html>
<html lang="fr">
    <!-- tête du document -->
    <?php include_once "views/components/head.php"; ?>

    <!-- corps du document-->
    <body class="overflow-hidden font-medium">
        <div class="grid grid-cols-6 gap-2  bg-gray-200">
            <!-- barre latérale gauche -->
            <div class="col-span-1 h-screen bg-blue-400">
                <div class="text-white">
                    <ul>
                        <li class="li-non-active"><a href="/accueil"><i class="bi bi-grid px-4"></i></a><a href="/accueil" class="hidden md:inline">Accueil</a></li>
                        <li class="li-non-active"><a href="/editer/client"><i class="bi bi-pencil-square px-4"></i></a><a href="/editer/client" class="hidden md:inline">Editer</a></li>
                        <li class="li-active"><a href="/profile"><i class="bi bi-person px-4"></i></a><a href="/profile" class="hidden md:inline">Profile</a></li>
                        <li class="li-non-active "><a href="/controllers//Logout.php"><i class="bi bi-box-arrow-right px-4"></i></a><a href="/controllers/Logout.php" class="hidden md:inline">Se déconnecter</a></li>
                    </ul>
                </div>
            </div>

            <!-- contenu principal -->
            <div class="col-span-5 h-screen">
                <!-- contenu en haut -->
                <div class="p-5 bg-blue-500 text-center text-xl text-white rounded-bl">
                    <span>Profile d'administrateur</span>
                </div>

                <!-- contenu en milieu -->
                <div class="text-gray-600 flex items-center flex-col my-3">
                    <!-- partie pour lister admin enregistré -->
                    <div class="flex justify-center flex-col rounded px-4 py-4 bg-white w-1/2">
                        <span class="bg-blue-300 text-white p-2 w-full rounded">Liste d'utilisateur</span>
                        <ul class="admin-list mx-4 my-3 h-fix overflow-y-auto scrollbar-m">
                            <?php
                            foreach ($adminList as $admin) {
                                echo "<li class='flex justify-between px-2 py-1 hover:bg-gray-200 rounded'>{$admin}<a href='test.php' data-username='{$admin}' class='hover:bg-gray-600 hover:text-white rounded-full px-1'><i class='bi bi-trash'></i></a></li>";
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- section bouton d'ajout et d'impression du facture déjà enregistré -->
                    <div class="flex justify-end text-white gap-3 p-4 m-3 rounded bg-white w-1/2">
                        <button class="px-2 py-1 bg-green-500 hover:bg-green-600 rounded" id="a-btn">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- fenêtre modal d'ajout -->
        <?php include_once "views/components/add_admin.php"; ?>

        <!-- fenêtre modal de suppression -->
        <?php include_once "views/components/delete_modal.php"; ?>

        <!-- script pour rendre la page interactive -->
        <script type="text/javascript" src="/views/assets/js/script_profile.js"></script>
    </body>
</html>
