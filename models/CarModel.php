<?php
class CarModel
{
    private array $data;

    public function __construct($id, $designation, $price, $number) {
        $this->data = [
            "idvoit" => $id,
            "design" => $designation,
            "prix" => $price,
            "nombre" => $number
        ];
    }

    public function setId($id) {
        $this->data["idvoit"] = $id;
    }

    public function setDesignation($designation) {
        $this->data["design"] = $designation;
    }

    public function setPrice($price) {
        $this->data["prix"] = $price;
    }

    public function setNumber($number) {
        $this->data["nombre"] = $number;
    }

    public function getId() {
        return $this->data["idvoit"];
    }

    public function getDesignation() {
        return $this->data["design"];
    }

    public function getPrice() {
        return $this->data["prix"];
    }

    public function getNumber() {
        return $this->data["nombre"];
    }
}
