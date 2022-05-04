<?php
namespace Database\Models;

use Config\Interfaces\ModelInterface;
use Database\DatabaseConnection;

//Model class for interacting with database
//corresponding to user_table
class UsersModel implements ModelInterface
{

    //preventing mannual creation of instance
    private function __construct()
    {}

    //inserting a new User
    public static function insert($data)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $data['password'] = hash("sha256", $data['password']);
            PersonModel::insert($data);
            $id = PersonModel::LastInsertId();
            $stmt = $conn->prepare("insert into customers(id) values(:id);");
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        } catch (\PDOException$ex) {
            return (["people" . $ex->getMessage()]);
        } finally {
            unset($stmt);
        }
    }

    //retrieving whole user rows
    public static function all()
    {
        try {
            $conn = DatabaseConnection::getInstance();
            return $conn->query("select * from person p inner join customers c where p.id = c.id;")->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException$ex) {
            return $ex->getMessage();
        }
    }

    //finding a particular row in user table
    public static function find($id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from users where user_id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetchObject();
            if ($result == null) {
                return "No data found";
            }

            return $result;
        } catch (\PDOException$ex) {
            return $ex->getMessage();
        } finally {
            unset($stmt);
        }
    }

    //deleting a particular row from users table
    public static function delete($id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("delete from users where user_id = :id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        } catch (\PDOException$ex) {
            return $ex->getMessage();
        } finally {
            unset($stmt);
        }
    }

    //updating user data
    public static function update($id, $data)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("update users set name=:name,email=:email,phone_num=:phoneNum,password=:password,role_id =:roleId where user_id = :id;");
            $stmt->bindParam(":name", $data->name);
            $stmt->bindParam(":email", $data->email);
            $stmt->bindParam(":phoneNum", $data->phoneNum);
            $stmt->bindParam(":password", $data->password);
            $stmt->bindParam(":roleId", $data->roleId);
            $stmt->bindParam(":id", $id);
            $data->password = hash("sha256", $data->password);
            return $stmt->execute();
        } catch (\PDOException$ex) {
            return $ex->getMessage();
        } finally {
            unset($stmt);
        }
    }

    //finding particular user using its email
    public static function findUsingEmail($email)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from person p inner join customers c where p.id = c.id and p.email = :email ");
            $stmt->bindParam(":email", $email);
            $result = $stmt->execute();
            if ($result) {
                return $stmt->fetchObject();
            }
            return null;
        } catch (\PDOException$ex) {
            echo $ex->getMessage();
        } finally {
            unset($stmt);
        }
    }

    //making user login
    public static function login(string $email, string $password)
    {
        $person = self::findUsingEmail($email);
        if (isset($person->email)) {
            if (isset($person->email) && $person->password === hash("sha256", $password)) {
                
                session_start();
                $_SESSION['auth'] = true;
                $_SESSION['auth_user'] = $person;
                session_regenerate_id();
                return true;
            } else {
                echo "wrong password";
                return false;
            }

        } else {
            echo "wrong email";
            return false;
        }
    }

    //logging out user
    public static function logout()
    {
        session_start();
        if (isset($_SESSION['auth'])) {
            unset($_SESSION['auth']);
            unset($_SESSION['auth_user']);
            session_regenerate_id();
            return true;
        }
            return true;

    }

    // for testing purposes
    public static function test()
    {
        echo "it is working fine";
    }
}
