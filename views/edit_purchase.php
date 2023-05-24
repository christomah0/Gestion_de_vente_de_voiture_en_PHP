<?php
include_once "controllers/AuthenticationChecker.php";

$pageTitle = "Editer | VenteVoiture";
$titleOfModifyModal = "Modification d'achat";
$titleOfAddModal = "Achat du voiture";
$titleOfDeleteModal = "Confirmation";
$urlOfModifyModal = "/modifier/achat";
$urlOfAddModal = "/ajouter/achat";
$urlOfDeleteModal = "/supprimer/achat";
$urlOfSearch = "/rechercher/achat";
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
                        <li class="li-active"><a href="/editer/client"><i class="bi bi-pencil-square px-4"></i></a><a href="/editer/client" class="hidden md:inline">Editer</a></li>
                        <li class="li-non-active"><a href="/profile"><i class="bi bi-person px-4"></i></a><a href="/profile" class="hidden md:inline">Profile</a></li>
                        <li class="li-non-active "><a href="/controllers//Logout.php"><i class="bi bi-box-arrow-right px-4"></i></a><a href="/controllers/Logout.php" class="hidden md:inline">Se déconnecter</a></li>
                    </ul>
                </div>
            </div>

            <!-- contenu principal -->
            <div class="col-span-5">
                <!-- titre du principal du page -->
                <div class="p-5 bg-blue-500 text-center text-xl text-white mb-2 rounded-bl">
                    <span>Informations détaillées des enregistrements</span>
                </div>

                <!-- section d'option supplémentaires avec zone de recherche -->
                <div class="flex justify-between flex-wrap bg-white p-4 m-3 rounded">
                    <!-- section d'option supplémentaires -->
                    <div class="">
                        <a href="/editer/client" class="bg-white px-4 py-2 border focus:outline-none suppl-non-active rounded" id="client-suppl">Client</a>
                        <a href="/editer/voiture" class="bg-white px-4 py-2 border focus:outline-none suppl-non-active rounded" id="car-suppl">Voiture</a>
                        <a href="/editer/achat" class="bg-white px-4 py-2 border focus:outline-none suppl-active rounded" id="purchase-suppl">Achat</a>
                        <input class="bg-white px-4 py-1 border focus:outline-none suppl-non-active rounded" type="date" id="start-date-suppl">
                        <input class="bg-white px-4 py-1 border focus:outline-none suppl-non-active rounded" type="date" id="end-date-suppl">
                    </div>

                    <!-- section de recherche -->
                    <div class="border bg-gray-200 hover:bg-white text-gray-600 rounded" id="group-input-icon">
                        <!-- formulaire pour envoyer la recherche au server -->
                        <form action=<?php echo $urlOfSearch; ?> method="GET" class="flex justify-between" id="search-form">
                            <input type="date" id="start-date-input" name="start-date-input" hidden readonly>
                            <input type="date" id="end-date-input" name="end-date-input" hidden readonly>
                            <input class="bg-gray-200 hover:bg-white focus:bg-white focus:outline-none pl-1 py-1 rounded" type="text" name="search-input" id="search-input" autocomplete="off" placeholder="Rechercher ici..." required>
                            <div class="">
                                <button type="button" class="focus:outline-none px-2 hidden" id="del-btn"><i class="bi bi-x-lg text-lg"></i></button>
                                <button type="submit" class="focus:outline-none px-2" id="search-btn"><i class="bi bi-search text-lg"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- section pour l'affichage des données dans un tableau -->
                <div class="text-gray-600 h-64 overflow-y-auto m-3 p-4 bg-white scrollbar-m rounded h-fix">
                    <table class="min-w-full">
                        <thead class="sticky top-0 bg-gray-200">
                            <tr>
                                <th class="px-3 py-2 text-left">Numéro d'achat</th>
                                <th class="px-3 py-2 text-left">ID client</th>
                                <th class="px-3 py-2 text-left">ID voiture</th>
                                <th class="px-3 py-2 text-left">Date d'achat</th>
                                <th class="px-3 py-2 text-left">Quantité</th>
                                <th class="px-3 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php
                                for ($i = 0; $i < count($purchaseData); $i++) {
                                    echo "<tr class='hover:bg-gray-100 data-purchase'>";
                                    echo "<td class='px-3 py-1.5'>{$purchaseData[$i]['numAchat']}</td>";
                                    echo "<td class='px-3 py-1.5'>{$purchaseData[$i]['idcli']}</td>";
                                    echo "<td class='px-3 py-1.5'>{$purchaseData[$i]['idvoit']}</td>";
                                    echo "<td class='px-3 py-1.5'>{$purchaseData[$i]['date']}</td>";
                                    echo "<td class='px-3 py-1.5'>{$purchaseData[$i]['qte']}</td>";
                                    echo "<td class='px-3 py-1.5'><a href='#' class='px-1 py-1.5 mod-item mr-2 rounded' mod-purchase-data-id='{$purchaseData[$i]['numAchat']}'><i class='bi bi-pencil'></i></a><a href='#' class='px-1 py-1.5 del-item ml-2 rounded' del-purchase-data-id='{$purchaseData[$i]['numAchat']}'><i class='bi bi-x-lg'></i></a></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- section bouton d'ajout et d'impression du facture déjà enregistré -->
                <div class="flex justify-end text-white gap-3 p-4 m-3 rounded bg-white">
                    <button class="p-2 bg-green-500 hover:bg-green-600 rounded" id="a-btn">Ajouter</button>
                    <button class="p-2 bg-green-500 hover:bg-green-600 rounded" id="generate-btn">Générer du facture</button>
                </div>
            </div>
        </div>

        <!-- fenêtre modal pour la modification du client specifié -->
        <?php include_once "views/components/modify_purchase_modal.php"; ?>

        <!-- fenêtre modal pour l'ajout du client désiré -->
        <?php include_once "views/components/add_purchase_modal.php"; ?>

        <!-- fenêtre modal pour la suppression du client désiré -->
        <?php include_once "views/components/delete_modal.php"; ?>

        <!-- script pour dynamiser la page -->
        <script type="text/javascript" src="/views/assets/js/script_edit_purchase.js"></script>
    </body>
</html>
