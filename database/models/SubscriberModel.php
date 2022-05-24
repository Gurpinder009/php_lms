<?php

namespace Database\Models;

use Database\DatabaseConnection;
use PDOException;

//Model class for interacting with database
//corresponding to Subsscriber
class SubscriberModel
{

    //preventing mannual creation of instance
    private function __construct()
    {}

    //inserting a new Subscriber
    static function insert($data)
    {
        $stmt = null;
        $conn = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $data['password'] = hash("sha256", $data['password']);
            $conn->beginTransaction();
            $result = PersonModel::insert($data);
            if (!isset($result["error"])) {
                $id = PersonModel::LastInsertId();
                $stmt = $conn->prepare("insert into subscribers(id,person_id) values(:id,:person_id);");
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":person_id", $id);
                if ($stmt->execute()) {
                    $result = $conn->commit();
                    return $result;
                }
            }
            return $result;
        } catch (\PDOException $ex) {
            if (!$conn) {
                $conn->rollBack();
            }
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }

    //retrieving whole Subscriber rows
    static function all()
    {
        try {
            $conn = DatabaseConnection::getInstance();
            return $conn->query("select p.*,s.*,sp.title from subscribers s inner join  person p on p.id = s.person_id left join subscribes_to st on s.id = st.subscriber_id left join subscription_plans sp  on sp.id =st.subscriber_id group by s.id ;")->fetchAll();
          

        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
        }
    }


    //finding a particular row in subscriber table
    static function find(int $id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select p.*,s.*,sp.title from subscribers s inner join  person p on p.id = s.person_id left join subscribes_to st on s.id = st.subscriber_id left join subscription_plans sp  on sp.id =st.subscriber_id where id = :id ;");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                if (isset($result["id"])) {
                    return $result;
                }
                throw new \PDOException("No data Found");
            }
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }

    //deleting a particular row from subscriber table
    static function delete(int $id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $conn->beginTransaction();
            $person_id  = self::getPersonId($id);
            if (isset($person["error"])) {
                return $person;
            }
            $stmt = $conn->prepare("DELETE FROM subscribers WHERE id = :id");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $result = PersonModel::delete($person_id);
                if (isset($result["error"])) {
                    throw new \PDOException("Operation failed");
                }
                return $result;
            }
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }

    static function getPersonId(int $id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * FROM subscribers WHERE id = :id");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                if($result["person_id"]){
                    return $result["person_id"];
                }
                throw new \PDOException("No data available");
            }
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }

    //finding particular subscriber using its email
    static function findUsingEmail(String $email)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select * from person p inner join subscribers c on p.id = c.person_id where p.email = :email ");
            $stmt->bindParam(":email", $email);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                if (isset($result["id"])) {
                    return $result;
                }
                throw new \PDOException("No data found");
            }
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }

    //making subscriber login
    static function login(string $email, string $password)
    {
        $person = self::findUsingEmail($email);

        if (isset($person["email"])) {
            if (isset($person["email"]) && $person["password"] === hash("sha256", $password)) {
                session_start();
                $_SESSION['auth'] = true;
                $_SESSION['isStaff'] = false;
                $_SESSION['auth_user'] = $person;
                session_regenerate_id();
                return true;
            } else {
                return ["error" => "Wrong Password"];
            }
        } else {
            return ["error" => "Email Address is not registered"];
        }
    }

    //logging out Subscriber
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

    // for counting subscriber
    static function count()
    {
        try {
            $result = DatabaseConnection::getInstance()
                ->query("select count(*) as subscriber_count from subscribers")->fetch();
            return $result["subscriber_count"];
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
        }
    }

    //counting borrowed_book count
    static function books_borrowed_count($id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select count(*) as count from subscribers s inner join borrow_books bb on s.id = bb.subscriber_id and bb.`return date` is null where s.id = :id ;");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                if (isset($result["count"])) {
                    return $result["count"];
                }
                throw new \PDOException("No data Found");
            }
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }

    //providing subscription to subscribers
    static function subscribe($data)
    {
        $stmt = null;
        try {
            $stmt = DatabaseConnection::getInstance()
                ->prepare("insert into subscribes_to(subscriber_id,subscription_plan_id,purchase_date)
            values (:sub,:plan,:date);");
            $stmt->bindParam(":sub", $data["subscriber_id"]);
            $stmt->bindParam(":plan", $data["subscription_plan_id"]);
            $stmt->bindParam(":date", $data["purchase_date"]);
            $result =$stmt->execute();
            if ($result) {
                return $result;
            }
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }


    //getting subscription plan data 
    static function subscription(int $id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select sp.* from subscribers s left join subscribes_to st on st.subscriber_id = s.id left join subscription_plans sp on sp.id = st.subscription_plan_id where s.id = :id ;");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                if (isset($result)) {
                    return $result;
                }
                throw new \PDOException("No active subscription plan is available");
            }
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }


    //count of subscription plans
    static function subscription_count(int $id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select count(*) as count from subscribers s left join subscribes_to st on st.subscriber_id = s.id left join subscription_plans sp on sp.id = st.subscription_plan_id where s.id = :id ;");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                if (isset($result["count"])) {
                    return $result["count"];
                }
                return 0;
            }
        } catch (\PDOException $ex) {
            return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }



}
