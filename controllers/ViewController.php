<?php
include_once "models/DataManipulation.php";
// include_once "models/UserModel.php";
// include_once "models/ClientModel.php";
// include_once "models/CarModel.php";
// include_once "models/PurchaseModel.php";

class ViewController extends DataManipulation
{
    private ?array $data = null;

    public static function redirect($url) {
        header("Location: $url");
    }

    private function login() {
        require_once "views/login.php";
    }

    private function index() {
        $this->data = [];
        parent::getAllData("home", $this->data);
        $clientRegistered = $this->data["client_registered"] ?? 0;
        $purchaseCompleted = $this->data["purchase_completed"] ?? 0;
        $carSold = $this->data["car_sold"] ?? 0;
        $carForSale = $this->data["car_for_sale"] ?? 0;
        $last6MonthsIncome = $this->data["last_6_months_income"] ?? 0;
        require_once "views/home.php";
    }

    private function editClient() {
        $this->data = [];
        $clientData = [];
        parent::getAllData("edit_client", $this->data);
        foreach ($this->data as $item) { array_push($clientData, $item); }
        require_once "views/edit_client.php";
    }

    private function editCar() {
        $this->data = [];
        $carData = [];
        parent::getAllData("edit_car", $this->data);
        foreach ($this->data as $item) { array_push($carData, $item); }
        require_once "views/edit_car.php";
    }

    private function editPurchase() {
        $this->data = [];
        $purchaseData = [];
        parent::getAllData("edit_purchase", $this->data);
        foreach ($this->data as $item) { array_push($purchaseData, $item); }
        require_once "views/edit_purchase.php";
    }

    private function profile() {
        $this->data = [];
        $adminList = [];
        parent::getAllData("profile", $this->data);
        foreach ($this->data as $item) { array_push($adminList, $item); }
        require_once "views/profile.php";
    }

    private function searchedClient($given_data) {
        $this->data = [];
        $clientData = [];
        parent::getSearchedData("edit_client", $given_data, $this->data);
        foreach ($this->data as $item) { array_push($clientData, $item); }
        require_once "views/edit_client.php";
    }

    private function searchedCar($given_data) {
        $this->data = [];
        $carData = [];
        parent::getSearchedData("edit_car", $given_data, $this->data);
        foreach ($this->data as $item) { array_push($carData, $item); }
        require_once "views/edit_car.php";
    }

    private function searchedPurchase($given_data) {
        $this->data = [];
        $purchaseData = [];
        parent::getSearchedData("edit_purchase", $given_data, $this->data);
        foreach ($this->data as $item) { array_push($purchaseData, $item); }
        require_once "views/edit_purchase.php";
    }

    private function notFound() {
        require_once "views/404.php";
    }

    public function renderView($url, $received_data = NULL) {
        switch ($url) {
            case "login":
                $this->login();
                break;
            case "home":
                $this->index();
                break;
            case "edit_client":
                $this->editClient();
                break;
            case "edit_car":
                $this->editCar();
                break;
            case "edit_purchase":
                $this->editPurchase();
                break;
            case "profile":
                $this->profile();
                break;
            case "search_client":
                $this->searchedClient($received_data);
                break;
            case "search_car":
                $this->searchedCar($received_data);
                break;
            case "search_purchase":
                $this->searchedPurchase($received_data);
                break;
            default:
                $this->notFound();
                break;
        }
    }
}
