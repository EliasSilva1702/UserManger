<?php
class User
{
    private $id;
    private $name;
    private $email;
    private $phone_number;
    private $lastname;
    private $position;
    private $region;
    private $f_num;
    private $department;
    private $address;

    private $can_add_products = false;
    private $can_modify_products = false;
    private $can_delete_products = false;
    private $can_add_categories = false;
    private $can_modify_categories = false;
    private $can_delete_categories = false;

    private $permissions = [
        'can_add_products' => false,
        'can_modify_products' => false,
        'can_delete_products' => false,
        'can_add_categories' => false,
        'can_modify_categories' => false,
        'can_delete_categories' => false,
        'can_add_users' => false,
        'can_modify_users' => false,
        'can_delete_users' => false,
        'can_see_orders' => false
    ];
    public function UserExist($f_num, $pass)
    {
        include('connection.php');

        $res = $conn->query("SELECT * from users where f_num='$f_num' and password = '$pass'");

        if ($res->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function SetUser($f_num)
    {
        include('connection.php');

        $res = $conn->query("SELECT * from users where f_num='$f_num'");

        foreach ($res as $currentUser) {
            $this->id = $currentUser['id'];
            $this->name = $currentUser['name'];
            $this->email = $currentUser['email'];
            $this->lastname = $currentUser['lastname'];
            $this->position = $currentUser['position'];
            $this->region = $currentUser['region'];
            $this->f_num = $currentUser['f_num'];
            $this->department = $currentUser['department'];
            $this->address = $currentUser['address'];
            $this->phone_number = $currentUser['phone_number'];
            $admins = $conn->query("SELECT * from users_admins where id_user='" . $currentUser['id'] . "'");

            if ($admins->num_rows > 0) {

                foreach ($admins as $key => $currentAdmin) {
                    // carga los permisos que tiene el usuario
                    $this->permissions["can_add_products"] = ($currentAdmin["can_add_products"] == "Y") ? true : false;
                    $this->permissions["can_modify_products"] = ($currentAdmin["can_modify_products"] == "Y") ? true : false;
                    $this->permissions["can_delete_products"] = ($currentAdmin["can_delete_products"] == "Y") ? true : false;
                    $this->permissions["can_add_categories"] = ($currentAdmin["can_add_categories"] == "Y") ? true : false;
                    $this->permissions["can_modify_categories"] = ($currentAdmin["can_modify_categories"] == "Y") ? true : false;
                    $this->permissions["can_delete_categories"] = ($currentAdmin["can_delete_categories"] == "Y") ? true : false;
                    $this->permissions["can_see_orders"] = ($currentAdmin["can_see_orders"] == "Y") ? true : false;
                    $this->permissions["can_add_users"] = ($currentAdmin["can_add_users"] == "Y") ? true : false;
                    $this->permissions["can_modify_users"] = ($currentAdmin["can_modify_users"] == "Y") ? true : false;
                    $this->permissions["can_delete_users"] = ($currentAdmin["can_delete_users"] == "Y") ? true : false;
                }
            }
        }

    }
    public function GetPermission($index)
    {
        return $this->permissions[$index];
    }

    public function GetName()
    {
        return $this->name;
    }

    public function GetPhoneNumber()
    {
        return $this->phone_number;
    }

    public function GetPosition()
    {
        return $this->position;
    }
    public function GetDepartment()
    {
        return $this->department;
    }
    public function GetAddress()
    {
        return $this->address;
    }

    public function GetLastName()
    {
        return $this->lastname;
    }

    public function GetEmail()
    {
        return $this->email;
    }
    public function GetId()
    {
        return $this->id;
    }
    public function GetRegion()
    {
        return $this->region;
    }
    public function GetF_num()
    {
        return $this->f_num;
    }
}