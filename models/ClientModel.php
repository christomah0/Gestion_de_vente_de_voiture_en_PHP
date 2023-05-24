<?php
class ClientModel
{
    private array $data;

    public function __construct($id, $name, $contact) {
        $this->data = [
            "idcli" => $id,
            "nom" => $name,
            "contact" => $contact
        ];
    }

    public function setIdClient($id) {
        $this->data["idcli"] = $id;
    }

    public function setName($name) {
        $this->data["nom"] = $name;
    }

    public function setContact($contact) {
        $this->data["contact"] = $contact;
    }

    public function getId() {
        return $this->data["idcli"];
    }

    public function getName() {
        return $this->data["nom"];
    }

    public function getContact() {
        return $this->data["contact"];
    }
}
