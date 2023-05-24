<?php
include_once "controllers/AuthenticationChecker.php";

$pageTitle = "Accueil | VenteVoiture";
$incomeOfTheMonth = 0;
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
                        <li class="li-active"><a href="/accueil"><i class="bi bi-grid px-4"></i></a><a href="/accueil" class="hidden md:inline">Accueil</a></li>
                        <li class="li-non-active"><a href="/editer/client"><i class="bi bi-pencil-square px-4"></i></a><a href="/editer/client" class="hidden md:inline">Editer</a></li>
                        <li class="li-non-active"><a href="/profile"><i class="bi bi-person px-4"></i></a><a href="/profile" class="hidden md:inline">Profile</a></li>
                        <li class="li-non-active "><a href="/controllers/Logout.php"><i class="bi bi-box-arrow-right px-4"></i></a><a href="/controllers/Logout.php" class="hidden md:inline">Se déconnecter</a></li>
                    </ul>
                </div>
            </div>

            <!-- contenu principal -->
            <div class="col-span-5 h-screen">
                <!-- contenu haut -->
                <div class="p-5 bg-blue-500 text-center text-xl text-white rounded-bl">
                    <span>Vue d'ensemble</span>
                </div>

                <!-- contenu milieu -->
                <div class="grid grid-cols-2 gap-2 p-8 text-white text-center text-base">
                    <div class="flex flex-col shadow p-4 bg-red-500 rounded">
                        <span>Voiture en vente</span>
                        <i class="bi bi-truck text-3xl"></i>
                        <span><?php echo $carForSale; ?></span>
                    </div>
                    <div class="flex flex-col shadow p-4 bg-green-500 rounded">
                        <span>Client enregistré</span>
                        <i class="bi bi-people text-3xl"></i>
                        <span><?php echo $clientRegistered; ?></span>
                    </div>
                    <div class="flex flex-col shadow p-4 bg-orange-500 rounded">
                        <span>Voiture vendu</span>
                        <i class="bi bi-trophy text-3xl"></i>
                        <span><?php echo $carSold; ?></span>
                    </div>
                    <div class="flex flex-col shadow p-4 bg-blue-900 rounded">
                        <span>Achat effectué</span>
                        <i class="bi bi-credit-card text-3xl"></i>
                        <span><?php echo $purchaseCompleted; ?></span>
                    </div>
                </div>

                <!-- contenu bas -->
                <div class="text-gray-600 flex justify-center">
                    <table class="table-auto bg-white w-1/2 rounded">
                        <thead class="">
                            <tr class="">
                                <th class="px-4 py-2 text-left">Recette</th>
                                <th class="px-4 py-2 text-left">Recette total</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr class="hover:bg-blue-100">
                                <td class="px-4 py-2"><input type="date" id="date-for-income-of-the-month"></td>
                                <td class="px-4 py-2" id="monthly-income"><?php echo $incomeOfTheMonth; ?> Ariary</td>
                            </tr>
                            <tr class="hover:bg-blue-100">
                                <td class="px-4 py-2">6 derniers mois</td>
                                <td class="px-4 py-2"><?php echo $last6MonthsIncome; ?> Ariary</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-center">
                    <button class="focus:outline-none p-2 bg-gray-500 hover:bg-gray-600 text-white rounded my-4" onclick="retrieveIncomeOfTheMonth()">Récuperer</button>
                </div>
            </div>
        </div>

        <!-- script pour dynamiser l'accumulation du recette par mois -->
        <script type="text/javascript">
            async function retrieveIncomeOfTheMonth() {
                const dateInput = document.getElementById("date-for-income-of-the-month");
                const monthlyIncome = document.getElementById("monthly-income");

                if (dateInput.value !== "") {
                    const response = await fetch("/monthlyincome", {
                        method: "POST",
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        body: `date=${encodeURIComponent(dateInput.value)}`
                    })
                    .then(res => res.text())
                    .then(data => {monthlyIncome.innerText = data + " Ariary"})
                    .catch(err => console.log(err));
                }
            }
        </script>
    </body>
</html>
