<?php
include_once __DIR__ . "/dbh.inc.php";

class DataManipulation
{
    // insère nouveau client dans la base de donnée
    public static function setNewClient($data) {
        global $connection;

        $client_data = [
            "client_id" => mysqli_escape_string($connection, $data['client_id']),
            "name" => mysqli_escape_string($connection, $data['name']),
            "contact" => mysqli_escape_string($connection, $data['contact'])
        ];

        $query = "SELECT client_id FROM client ORDER BY client_id DESC LIMIT 1";
        $result = mysqli_query($connection, $query);
        $rows_num = mysqli_num_rows($result);
        
        if ($rows_num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $digit_to_inc = (int)substr($row["client_id"], 3);
                $digit_to_inc += 1;
                $new_client_id = "";

                if ($digit_to_inc > 0 && $digit_to_inc < 10) {
                    $new_client_id = "CLI0$digit_to_inc";
                }
                else {
                    $new_client_id = "CLI$digit_to_inc";
                }

                $query = "INSERT INTO client(client_id, name, contact) VALUES('$new_client_id', '".$client_data['name']."', '".$client_data['contact']."')";
                mysqli_query($connection, $query);
            }
        }
        else {
            $query = "INSERT INTO client(client_id, name, contact) VALUES('CLI01', '".$client_data['name']."', '".$client_data['contact']."')";
            mysqli_query($connection, $query);
        }
    }

    // insère nouvelle voiture dans la base de donnée
    public static function setNewCar($data) {
        global $connection;

        $car_data = [
            "car_id" => mysqli_escape_string($connection, $data['car_id']),
            "designation" => mysqli_escape_string($connection, $data['designation']),
            "price" => mysqli_escape_string($connection, $data['price']),
            "number" => mysqli_escape_string($connection, $data['number'])
        ];

        $query = "SELECT car_id FROM car ORDER BY car_id DESC LIMIT 1";
        $result = mysqli_query($connection, $query);
        $rows_num = mysqli_num_rows($result);
        
        if ($rows_num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $digit_to_inc = (int)substr($row["car_id"], 3);
                $digit_to_inc += 1;
                $new_car_id = "";

                if ($digit_to_inc > 0 && $digit_to_inc < 10) {
                    $new_car_id = "VOI0$digit_to_inc";
                }
                else {
                    $new_car_id = "VOI$digit_to_inc";
                }

                $query = "INSERT INTO car(`car_id`, `designation`, `price`, `number`) VALUES('$new_car_id', '".$car_data['designation']."', ".$car_data['price'].", ".$car_data['number'].")";
                mysqli_query($connection, $query);
            }
        }
        else {
            $query = "INSERT INTO car(car_id, designation, price, number) VALUES('VOI01', '".$car_data['designation']."', ".$car_data['price'].", ".$car_data['number'].")";
            mysqli_query($connection, $query);
        }
    }

    // insère nouveau achat dans la base de donnée
    public static function setNewPurchase($data) {
        global $connection;

        $purchase_data = [
            "purchase_num" => mysqli_escape_string($connection, $data['purchase_num']),
            "client_id" => mysqli_escape_string($connection, $data['client_id']),
            "car_id" => mysqli_escape_string($connection, $data['car_id']),
            "purchase_date" => mysqli_escape_string($connection, $data['purchase_date']),
            "quantity" => mysqli_escape_string($connection, $data['quantity'])
        ];

        $query = "SELECT number FROM car WHERE car_id='".$data['car_id']."'";
        $result = mysqli_query($connection, $query);
        $rows_num = mysqli_num_rows($result);

        if ($rows_num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($data['quantity'] <= $row['number']) {
                    $query = "UPDATE car SET number=number-".$purchase_data['quantity']." WHERE car_id='".$purchase_data['car_id']."'";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        $query = "SELECT purchase_num FROM purchase ORDER BY purchase_num DESC LIMIT 1";
                        $result = mysqli_query($connection, $query);
                        $rows_num = mysqli_num_rows($result);

                        if ($rows_num > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $digit_to_inc = (int)substr($row['purchase_num'], 3);
                                $digit_to_inc += 1;
                                $new_purchase_id = "";

                                if ($digit_to_inc > 0 && $digit_to_inc < 10) {
                                    $new_purchase_id = "ACH0$digit_to_inc";
                                }
                                else {
                                    $new_purchase_id = "ACH$digit_to_inc";
                                }

                                $query = "INSERT INTO purchase(purchase_num, client_id, car_id, purchase_date, quantity) VALUES('".$new_purchase_id."', '".$purchase_data['client_id']."', '".$purchase_data['car_id']."', '".$purchase_data['purchase_date']."', ".$purchase_data['quantity'].")";
                                mysqli_query($connection, $query);
                            }
                        }
                        else {
                            $query = "INSERT INTO purchase(purchase_num, client_id, car_id, purchase_date, quantity) VALUES('ACH01', '".$purchase_data['client_id']."', '".$purchase_data['car_id']."', '".$purchase_data['purchase_date']."', ".$purchase_data['quantity'].")";
                            mysqli_query($connection, $query);
                        }
                    }
                }
            }
        }
    }

    // insère nouveau admin dans la base de donnée
    public static function setNewAdmin($data) {
        global $connection;

        $admin_data = [
            "username" => mysqli_escape_string($connection, $data['username']),
            "password" => hash(hash_algos()[5], mysqli_escape_string($connection, $data['password']))
        ];

        $query = "INSERT INTO administrator(username, password) VALUES('".$admin_data['username']."', '".$admin_data['password']."')";
        mysqli_query($connection, $query);
    }

    // modifie un client dans la base de donnée
    public static function updateClient(&$data) {
        global $connection;

        $client_data = [
            "client_id" => mysqli_escape_string($connection, $data['client_id']),
            "name" => mysqli_escape_string($connection, $data['name']),
            "contact" => mysqli_escape_string($connection, $data['contact'])
        ];

        $query = "UPDATE client SET client_id='".$client_data['client_id']."', name='".$client_data['name']."', contact='".$client_data['contact']."' WHERE client_id='".$client_data['client_id']."'";
        mysqli_query($connection, $query);
    }

    // modifie un client dans la base de donnée
    public static function updateCar($data) {
        global $connection;

        $car_data = [
            "car_id" => mysqli_escape_string($connection, $data['car_id']),
            "designation" => mysqli_escape_string($connection, $data['designation']),
            "price" => mysqli_escape_string($connection, $data['price']),
            "number" => mysqli_escape_string($connection, $data['number'])
        ];

        $query = "UPDATE car SET car_id='".$car_data['car_id']."', designation='".$car_data['designation']."', price=".$car_data['price'].", number=".$car_data['number']." WHERE car_id='".$car_data['car_id']."'";
        mysqli_query($connection, $query);
    }

    // modifie achat dans la base de donnée
    public static function updatePurchase($data) {
        global $connection;

        $purchase_data = [
            "purchase_num" => mysqli_escape_string($connection, $data['purchase_num']),
            "client_id" => mysqli_escape_string($connection, $data['client_id']),
            "car_id" => mysqli_escape_string($connection, $data['car_id']),
            "purchase_date" => mysqli_escape_string($connection, $data['purchase_date']),
            "quantity" => mysqli_escape_string($connection, $data['quantity'])
        ];

        $query = "UPDATE purchase SET purchase_num='".$purchase_data['purchase_num']."', client_id='".$purchase_data['client_id']."', car_id='".$purchase_data['car_id']."', purchase_date='".$purchase_data['purchase_date']."', quantity=".$purchase_data['quantity']." WHERE purchase_num='".$purchase_data['purchase_num']."'";
        mysqli_query($connection, $query);
    }

    // récupère recette mensuelle
    public static function getMonthlyIncome($given_date, &$data) {
        global $connection;
        
        $query = "SELECT SUM(purchase.quantity * car.price) AS monthly_income FROM purchase, car WHERE purchase.car_id = car.car_id AND MONTH(purchase.purchase_date) = MONTH('$given_date') AND YEAR(purchase.purchase_date) = YEAR('$given_date')";
        $result = mysqli_query($connection, $query);
        $rows_num = mysqli_num_rows($result);

        if ($rows_num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data["monthly_income"] = $row["monthly_income"];
            }
        }
    }

    // récupère toutes données en fonction "section"
    protected function getAllData($section, &$data) {
        global $connection;

        if ($section === "home") {
            // récupère nombre du client
            $query = "SELECT COUNT(client_id) AS client_registered FROM client";
            $result = mysqli_query($connection, $query);
            $rows_num = mysqli_num_rows($result);
            
            if ($rows_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data["client_registered"] = $row["client_registered"];
                }
            }

            // récupère nombre d'achat
            $query = "SELECT COUNT(purchase_num) AS purchase_completed FROM purchase";
            $result = mysqli_query($connection, $query);
            $rows_num = mysqli_num_rows($result);

            if ($rows_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data["purchase_completed"] = $row["purchase_completed"];
                }
            }

            // récupère nombre voiture en vente
            $query = "SELECT SUM(number) AS car_for_sale FROM car";
            $result = mysqli_query($connection, $query);
            $rows_num = mysqli_num_rows($result);

            if ($rows_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data["car_for_sale"] = $row["car_for_sale"];
                }
            }

            // récupère nombre voiture vendu
            $query = "SELECT SUM(quantity) AS car_sold FROM purchase";
            $result = mysqli_query($connection, $query);
            $rows_num = mysqli_num_rows($result);

            if ($rows_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data["car_sold"] = $row["car_sold"];
                }
            }

            // récupère recette de 6 derniers mois
            $query = "SELECT SUM(purchase.quantity * car.price) AS last_6_months_income FROM purchase, car WHERE purchase.car_id = car.car_id AND purchase.purchase_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 MONTH) AND CURDATE()";
            $result = mysqli_query($connection, $query);
            $rows_num = mysqli_num_rows($result);

            if ($rows_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data["last_6_months_income"] = $row["last_6_months_income"];
                }
            }
        }
        else if ($section === "edit_client") {
            // récupère toute la liste du client
            $query = "SELECT * FROM client ORDER BY client_id ASC";
            $result = mysqli_query($connection, $query);
            $rows_num = mysqli_num_rows($result);

            if ($rows_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push( $data, [
                        "idcli" => $row["client_id"],
                        "nom" => $row["name"],
                        "contact" => $row["contact"],
                    ]);
                }
            }
        }
        else if ($section === "edit_car") {
            // récupère toute la liste du voiture
            $query = "SELECT * FROM car";
            $result = mysqli_query($connection, $query);
            $rows_num = mysqli_num_rows($result);

            if ($rows_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push( $data, [
                        "idvoit" => $row["car_id"],
                        "design" => $row["designation"],
                        "prix" => $row["price"],
                        "nombre" => $row["number"],
                    ]);
                }
            }
        }
        else if ($section === "edit_purchase") {
            // récupère toute la liste d'achat
            $query = "SELECT * FROM purchase";
            $result = mysqli_query($connection, $query);
            $rows_num = mysqli_num_rows($result);

            if ($rows_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push( $data, [
                        "numAchat" => $row["purchase_num"],
                        "idcli" => $row["client_id"],
                        "idvoit" => $row["car_id"],
                        "date" => $row["purchase_date"],
                        "qte" => $row["quantity"],
                    ]);
                }
            }
        }
        else if ($section === "profile") {
            // récupère toute la liste d'admin
            $query = "SELECT username FROM administrator";
            $result = mysqli_query($connection, $query);
            $rows_num = mysqli_num_rows($result);

            if ($rows_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($data, $row["username"]);
                }
            }
        }
    }

    // récupère donnée recherché
    protected function getSearchedData($section, $given_data, &$data) {
        global $connection;

        if ($section === "edit_client") {
            // récupère donnée du client
            $query = "SELECT * FROM client WHERE client_id LIKE '$given_data' OR name LIKE '%$given_data%'";
            $result = mysqli_query($connection, $query);
            $rows_num = mysqli_num_rows($result);

            if ($rows_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push( $data, [
                        "idcli" => $row["client_id"],
                        "nom" => $row["name"],
                        "contact" => $row["contact"],
                    ]);
                }
            }
        }
        else if ($section === "edit_car") {
            // récupère donnée du voiture
            $query = "SELECT * FROM car WHERE car_id LIKE '$given_data' OR designation LIKE '%$given_data%'";
            $result = mysqli_query($connection, $query);
            $rows_num = mysqli_num_rows($result);

            if ($rows_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push( $data, [
                        "idvoit" => $row["car_id"],
                        "design" => $row["designation"],
                        "prix" => $row["price"],
                        "nombre" => $row["number"],
                    ]);
                }
            }
        }
        else if ($section === "edit_purchase") {
            // récupère donnée d'achat
            if ($given_data['start_date'] !== "" && $given_data['end_date'] !== "") {
                $query = "SELECT * FROM purchase WHERE purchase_date BETWEEN '".$given_data['start_date']."' AND '".$given_data['end_date']."'";
                $result = mysqli_query($connection, $query);
                $rows_num = mysqli_num_rows($result);

                if ($rows_num > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($data, [
                            "numAchat" => $row["purchase_num"],
                            "idcli" => $row["client_id"],
                            "idvoit" => $row["car_id"],
                            "date" => $row["purchase_date"],
                            "qte" => $row["quantity"],
                        ]);
                    }
                }
            }
            else {
                $query = "SELECT * FROM purchase WHERE purchase_num LIKE '".$given_data['search_value']."' OR client_id LIKE '".$given_data['search_value']."'";
                $result = mysqli_query($connection, $query);
                $rows_num = mysqli_num_rows($result);

                if ($rows_num > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($data, [
                            "numAchat" => $row["purchase_num"],
                            "idcli" => $row["client_id"],
                            "idvoit" => $row["car_id"],
                            "date" => $row["purchase_date"],
                            "qte" => $row["quantity"],
                        ]);
                    }
                }
            }
        }
    }

    // récupère des données nécessaire à l'impression de facture du client
    public static function getDataToProduceBills($given_data, &$received_data) {
        global $connection;
        $received_data['client-info'] = [];
        $received_data['purchase-info'] = [];
        $received_data['total-purchase'] = 0;

        foreach ($given_data as $num) {
            $query = "SELECT CURDATE() as billing_date, client.name, client.contact FROM client JOIN purchase ON client.client_id=purchase.client_id WHERE purchase.purchase_num='$num'";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $received_data['client-info'] = [
                    'billing-date' => $row['billing_date'],
                    'name' => $row['name'],
                    'contact' => $row['contact']
                ];
            }

            $query = "SELECT car.designation, purchase.quantity, car.price, (purchase.quantity * car.price) as total FROM purchase JOIN car ON purchase.car_id=car.car_id WHERE purchase.purchase_num='$num'";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($received_data['purchase-info'], [
                    'designation' => $row['designation'],
                    'quantity' => $row['quantity'],
                    'price' => $row['price'],
                    'total' => $row['total']
                ]);
            }

            $query = "SELECT SUM(purchase.quantity * car.price) as total FROM purchase JOIN car ON purchase.car_id=car.car_id WHERE purchase.purchase_num='$num'";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $received_data['total-purchase'] += $row['total'];
            }
        }
    }

    // vérifie le login d'admin
    public static function checkAuth(&$isValid, $data) {
        global $connection;

        $query = "SELECT * FROM administrator WHERE username='".$data['username']."' AND password='".$data['password']."'";
        $result = mysqli_query($connection, $query);
        $rows_num = mysqli_num_rows($result);

        if ($rows_num > 0) {
            $isValid = true;
        } else {
            $isValid = false;
        }
    }

    // supprime client en fonction id entré
    public static function deleteClient($id) {
        global $connection;

        $client_id = mysqli_escape_string($connection, $id);

        $query = "DELETE FROM client WHERE client_id = '$client_id'";
        mysqli_query($connection, $query);
    }

    // supprime client en fonction id entré
    public static function deleteCar($id) {
        global $connection;

        $car_id = mysqli_escape_string($connection, $id);

        $query = "DELETE FROM car WHERE car_id = '$car_id'";
        mysqli_query($connection, $query);
    }

    // supprime achat en fonction id entré
    public static function deletePurchase($id) {
        global $connection;

        $purchase_id = mysqli_escape_string($connection, $id);

        $query = "DELETE FROM purchase WHERE purchase_num = '$purchase_id'";
        mysqli_query($connection, $query);
    }

    // supprime admin en fonction id entré
    public static function deleteAdmin($id) {
        global $connection;

        $admin_id = mysqli_escape_string($connection, $id);

        $query = "SELECT username FROM administrator";
        $result = mysqli_query($connection, $query);
        $rows_num = mysqli_num_rows($result);

        if (!($rows_num < 2)) {
            $query = "DELETE FROM administrator WHERE username='$admin_id'";
            mysqli_query($connection, $query);
        }
    }
}
