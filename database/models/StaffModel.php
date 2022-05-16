<?php
namespace Database\Models;

use Database\DatabaseConnection;

//Model class for interacting with database
//corresponding to user_table
class StaffModel 
{

    //preventing mannual creation of instance
    private function __construct()
    {}

    //inserting a new User
     static function insert($data)
    {
        $stmt = null;
        $conn = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $data['password'] = hash("sha256", $data['password']);
            $conn->beginTransaction();
            $result = PersonModel::insert($data);

            if(!isset($result["error"])){
                $id = PersonModel::LastInsertId();
                $stmt = $conn->prepare("insert into staff_members(salary,role_id,person_id) values(:salary,:role,:person_id);");
                $stmt->bindParam(":salary", $data["salary"]);
                $stmt->bindParam(":role", $data["role"]);
                $stmt->bindParam(":person_id", $id);
                if($stmt->execute()){
                    $result = $conn->commit();
                    return $result;
                }
                throw new \PDOException("Operation Failed");
            }
            throw new \PDOException($result["error"]);
        } catch (\PDOException $ex) {
            if(!$conn){
                $conn->rollBack();
            }
            return ["error"=>$ex->getMessage()];
        } finally {

            unset($stmt);
        }
    }

    //retrieving whole user rows
     static function all()
    {
        try {
            $conn = DatabaseConnection::getInstance();
            return $conn->query("select * from person p inner join staff_members s on p.id = s.person_id;")->fetchAll();
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage()];
        }
    }

    //finding a particular row in user table
     static function find(int $id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from person p inner join staff_members s on p.id = s.person_id where s.id = :id ;");
            $stmt->bindParam(":id", $id);
            if($stmt->execute()){
                $result = $stmt->fetch();
                if(isset($result["name"])){
                    return $result;
                }
            }
            throw new \PDOException("No data Found");
        } catch (\PDOException$ex) {
            return ["error"=> $ex->getMessage()];
        } finally {
            unset($stmt);
        }
    }

    //deleting a particular row from users table
     static function delete(int $id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("delete from staff_members where id = :id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        } catch (\PDOException$ex) {
            return ["error"=>$ex->getMessage()];
        } finally {
            unset($stmt);
        }
    }

    //updating user data
    //  static function update($id, $data)
    // {
    //     $stmt = null;
    //     try {
    //         $conn = DatabaseConnection::getInstance();
    //         $stmt = $conn->prepare("update users set name=:name,email=:email,phone_num=:phoneNum,password=:password,role_id =:roleId where user_id = :id;");
    //         $stmt->bindParam(":name", $data->name);
    //         $stmt->bindParam(":email", $data->email);
    //         $stmt->bindParam(":phoneNum", $data->phoneNum);
    //         $stmt->bindParam(":password", $data->password);
    //         $stmt->bindParam(":roleId", $data->roleId);
    //         $stmt->bindParam(":id", $id);
    //         $data->password = hash("sha256", $data->password);
    //         return $stmt->execute();
    //     } catch (\PDOException$ex) {
    //         return $ex->getMessage();
    //     } finally {
    //         unset($stmt);
    //     }
    // }

    //finding particular user using its email
     static function findUsingEmail(String $email)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from person p inner join staff_members s on p.id = s.person_id where p.email = :email ");
            $stmt->bindParam(":email", $email);
            if ($stmt->execute()) {
                $result =  $stmt->fetch();
                if(isset($result["id"])){
                    return $result;
                }
                throw new \PDOException("No data found");
            }
        } catch (\PDOException$ex) {
            return ["error"=>$ex->getMessage()];
        } finally {
            unset($stmt);
        }
    }

    //making user login
     static function login(string $email, string $password)
    {
        $person = self::findUsingEmail($email);
        if (isset($person["email"])) {
            if (isset($person["email"]) && $person["password"] === hash("sha256", $password)) {
                session_start();
                $_SESSION['auth'] = true;
                $_SESSION['isStaff'] = true;
                $_SESSION['auth_user'] = $person;
                session_regenerate_id();
                return true;
            }
            return ["error"=>"Wrong Password"];
        } else {
            return ["error"=>"Email Address is not registered"];
        }
    }

    //logging out user
     static function logout()
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
     static function count(){
        try{
            $result =DatabaseConnection::getInstance()
            ->query("select count(*) as staff_member_count from staff_members;")->fetch();
            return $result["staff_member_count"]; 
        }catch(\PDOException $ex){
            return ["error"=>$ex->getMessage()];
        }
    }

}
