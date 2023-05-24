<?php
class PurchaseModel
{
    private array $data;

    public function __construct($purchase_num, $client_id, $car_id, $purchase_date, $quantity) {
        $this->data = [
            "numAchat" => $purchase_num,
            "idcli" => $client_id,
            "idvoit" => $car_id,
            "date" => $purchase_date,
            "qte" => $quantity
        ];
    }

    public function setPurchaseNum($purchase_num) {
        $this->data["numAchat"] = $purchase_num;
    }

    public function setClientId($client_id) {
        $this->data["idcli"] = $client_id;
    }

    public function setCarId($car_id) {
        $this->data["idvoit"] = $car_id;
    }

    public function setPurchaseDate($purchase_date) {
        $this->data["date"] = $purchase_date;
    }

    public function setQuantity($quantity) {
        $this->data["qte"] = $quantity;
    }

    public function getPurchaseNum() {
        return $this->data["numAchat"];
    }

    public function getClientId() {
        return $this->data["idcli"];
    }

    public function getCarId() {
        return $this->data["idvoit"];
    }

    public function getPurchaseDate() {
        return $this->data["date"];
    }

    public function getQuantity() {
        return $this->data["qte"];
    }
}
