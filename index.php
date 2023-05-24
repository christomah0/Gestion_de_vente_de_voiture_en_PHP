<?php
session_start();

include_once __DIR__ . "/core/Router.php";
include_once __DIR__ . "/controllers/ViewController.php";
include_once __DIR__ . "/models/DataManipulation.php";
include_once __DIR__ . "/fpdf185/fpdf.php";

// crée une instance d'objet
$router = new Router();
$controller = new ViewController();

// page login
$router->get("/", function() {
    global $controller;
    $controller->renderView("login");
});

// page accueil
$router->get("/accueil", function() {
    global $controller;
    $controller->renderView("home");
});

// page d'édition client
$router->get("/editer/client", function() {
    global $controller;
    $controller->renderView("edit_client");
});

// page d'édition voiture
$router->get("/editer/voiture", function() {
    global $controller;
    $controller->renderView("edit_car");
});

// page d'édition achat
$router->get("/editer/achat", function() {
    global $controller;
    $controller->renderView("edit_purchase");
});

// page profile
$router->get("/profile", function() {
    global $controller;
    $controller->renderView("profile");
});

// recherche d'un(e) client(e) en fonction de son id ou nom
$router->get("/rechercher/client", function() {
    global $controller;
    $data = [
        "search_value" => $_GET['search']
    ];

    $controller->renderView("search_client", $data['search_value']);
});

// recherche d'une voiture en fonction de son id ou désignation
$router->get("/rechercher/voiture", function() {
    global $controller;
    $data = [
        "search_value" => $_GET['search']
    ];
    
    $controller->renderView("search_car", $data['search_value']);
});

// recherche d'achat déjà effectué en fonction de son id ou id client
$router->get("/rechercher/achat", function() {
    global $controller;
    $data = [
        "start_date" => $_GET['start-date-input'],
        "end_date" => $_GET['end-date-input'],
        "search_value" => $_GET['search-input']
    ];

    $controller->renderView("search_purchase", $data);
});

// vérifie la connexion d'utilisateur s'il existe dans la base de donnée
$router->post("/connexion", function() {
    $isValid = false;

    $data = [
        "username" => $_POST['username'],
        "password" => hash(hash_algos()[5], $_POST['password'])
    ];

    DataManipulation::checkAuth($isValid, $data);

    if ($isValid) {
        $_SESSION['AUTHENTICATION'] = [
            "username" => $data['username'],
            "password" => $data['password']
        ];
        ViewController::redirect("/accueil");
    }
    else {
        ViewController::redirect("/");
    }
});

// récupère la date choisi pour obtenir recette accumulé par mois
$router->post("/monthlyincome", function() {
    $data = null;

    DataManipulation::getMonthlyIncome($_POST["date"], $data);
    echo $data["monthly_income"] ?? 0;
});

// récupère la formulaire d'ajout du client
$router->post("/ajouter/client", function() {
    $data = [
        "client_id" => $_POST["a-client-id"],
        "name" => $_POST["a-client-name"],
        "contact" => $_POST["a-client-contact"],
    ];

    DataManipulation::setNewClient($data);
    ViewController::redirect("/editer/client");
});

// récupère la formulaire d'ajout du voiture
$router->post("/ajouter/voiture", function() {
    $data = [
        "car_id" => $_POST["a-car-id"],
        "designation" => $_POST["a-car-designation"],
        "price" => $_POST["a-car-price"],
        "number" => $_POST["a-car-number"],
    ];

    DataManipulation::setNewCar($data);
    ViewController::redirect("/editer/voiture");
});

// récupère la formulaire d'achat
$router->post("/ajouter/achat", function() {
    $data = [
        "purchase_num" => $_POST["a-purchase-id"],
        "client_id" => $_POST["a-purchase-client-id"],
        "car_id" => $_POST["a-purchase-car-id"],
        "purchase_date" => $_POST["a-purchase-date"],
        "quantity" => $_POST["a-purchase-quantity"],
    ];

    DataManipulation::setNewPurchase($data);
    ViewController::redirect("/editer/achat");
});

// récupère la formulaire d'ajout d'admin
$router->post("/ajouter/admin", function() {
    $data = [
        "username" => $_POST["a-admin-username"],
        "password" => $_POST["a-admin-password"]
    ];

    DataManipulation::setNewAdmin($data);
    ViewController::redirect("/profile");
});

// modifie information client existé
$router->post("/modifier/client", function() {
    $data = [
        "client_id" => $_POST["m-client-id"],
        "name" => $_POST["m-client-name"],
        "contact" => $_POST["m-client-contact"],
    ];

    DataManipulation::updateClient($data);
    ViewController::redirect("/editer/client");
});

// modifie information voiture existé
$router->post("/modifier/voiture", function() {
    $data = [
        "car_id" => $_POST["m-car-id"],
        "designation" => $_POST["m-car-designation"],
        "price" => $_POST["m-car-price"],
        "number" => $_POST["m-car-number"],
    ];

    DataManipulation::updateCar($data);
    ViewController::redirect("/editer/voiture");
});

// supprime un client
$router->post("/supprimer/client", function() {
    $data = $_POST["del-id"];
    
    DataManipulation::deleteClient($data);
    ViewController::redirect("/editer/client");
});

// supprime un voiture
$router->post("/supprimer/voiture", function() {
    $data = $_POST["del-id"];
    
    DataManipulation::deleteCar($data);
    ViewController::redirect("/editer/voiture");
});

// supprime achat
$router->post("/supprimer/achat", function() {
    $data = $_POST['del-id'];

    DataManipulation::deletePurchase($data);
    ViewController::redirect("/editer/achat");
});

// supprime admin
$router->post("/supprimer/admin", function() {
    $data = $_POST['del-id'];

    DataManipulation::deleteAdmin($data);
    ViewController::redirect("/profile");
});

// générer un pdf contenant la facture d'achat du client
$router->POST("/exporter", function() {
    $pdf = new FPDF();
    $data = explode(",", $_POST['data']);
    $obtainedData = [];

    DataManipulation::getDataToProduceBills($data, $obtainedData);

    // Column widths
    $w = array(40, 35, 40, 45);
    $header = array('Désignation', 'Quantité', 'Prix Unitaire', 'Total');

    $pdf->SetFont('Arial','',14);
    $pdf->AddPage();

    // Header
    for($i = 0; $i < count($header); $i++)
        $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
    $pdf->Ln();

    // Data
    foreach($obtainedData['purchase-info'] as $row)
    {
        $pdf->Cell($w[0], 6, $row['designation'], 'LR');
        $pdf->Cell($w[1], 6, $row['quantity'], 'LR');
        $pdf->Cell($w[2], 6, number_format($row['price']), 'LR', 0, 'R');
        $pdf->Cell($w[3], 6, number_format($row['total']), 'LR', 0, 'R');
        $pdf->Ln();
    }

    // Closing line
    $pdf->Cell(array_sum($w),0,'','T');
    $pdf->Output("facture_du_client" . date("Y-m-d") . ".pdf", 'D');

    print_r($obtainedData);
});

// gère la page non trouvé
$router->pageNotFound(function() {
    global $controller;
    $controller->renderView("404");
});

// exécute le mécanisme de vérification
$router->run();
