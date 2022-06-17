<?php
namespace Database\Models;

use Config\LoggerConfig\LogHandler;
use Database\DatabaseConnection;

//Model class for interacting with database
//corresponding to staff_members
class StaffModel 
{

    //preventing mannual creation of instance
    private function __construct()
    {}

    //inserting a new staff member
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
                $stmt = $conn->prepare("insert into staff_members(salary,is_admin,person_id) values(:salary,:role,:person_id);");
                $stmt->bindParam(":salary", $data["salary"]);
                $stmt->bindParam(":role", $data["is_admin"]);
                $stmt->bindParam(":person_id", $id);
                if($stmt->execute()){
                    $result = $conn->commit();
                    return $result;
                }
                throw new \PDOException("Operation Failed");
            }
            return $result;
        } catch (\PDOException $ex) {
            if(!$conn){
                $conn->rollBack();
            }
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        } finally {

            unset($stmt);
        }
    }

    //retrieving whole staff rows
     static function all()
    {
        try {
            $conn = DatabaseConnection::getInstance();
            return $conn->query("select * from person p inner join staff_members s on p.id = s.person_id;")->fetchAll();
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];

        }
    }

    //finding a particular row in staff table
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
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }

    //deleting a particular row from staff table
     static function delete(int $id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("DELETE FROM staff_members WHERE id = :id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        } catch (\PDOException$ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];

        } finally {
            unset($stmt);
        }
    }

    
    //getting person id 
    static function getPersonId(int $id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * FROM staff_members WHERE id = :id");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                if($result["person_id"]){
                    return $result["person_id"];
                }
                throw new \PDOException("No data available");
            }
        } catch (\PDOException $ex) {
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }


    //finding particular staff member using its email
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
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
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

                //logging
                LogHandler::infoLog("Login",$person["name"]." is logged in");


                return true;
            }
            return ["error"=>"Wrong Password"];
        } else {
            
            return ["error"=>"Email Address is not registered"];
        }
    }


    // counting all staff members
     static function count(){
        try{
            $result =DatabaseConnection::getInstance()
            ->query("select count(*) as staff_member_count from staff_members;")->fetch();
            return $result["staff_member_count"]; 
        }catch(\PDOException $ex){
            LogHandler::warningLog(__METHOD__, ["error" => $ex->getMessage(), "code" => $ex->getCode()]);
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }


   

}
