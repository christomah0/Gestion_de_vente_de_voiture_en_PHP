<?php
class UserModel
{
    private array $data;

    public function __construct($usr, $passwd) {
        $this->data = [
            "username" => $usr,
            "password" => $passwd
        ];
    }

    public function setUsername($usr) {
        $this->data["username"] = $usr;
    }

    public function setPassword($passwd) {
        $this->data["password"] = $passwd;
    }

    public function getUsername() {
        return $this->data["username"];
    }

    public function getPassword() {
        return $this->data["password"];
    }
}
