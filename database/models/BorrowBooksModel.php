<?php

namespace Database\Models;


use Database\DatabaseConnection;


class BorrowBooksModel
{
    private function __construct(){}

    //Getting all borrowed books
    static function all()
    {
        try {
            $result = DatabaseConnection::getInstance()
                ->query("select if( datediff(now(),bb.expected_return_date) > 0,datediff(now(),bb.expected_return_date)*10, 0)  as fine,bb.*, b.title, b.accession_no,p.name from borrow_books bb inner join books b on b.accession_no = bb.book_id inner join subscribers s on s.id = bb.subscriber_id inner join person p on p.id = s.person_id where `return date` is null ;")
                ->fetchAll();
            return $result;
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }


    //returning issued book
    static function return_book(int $id)
    {
        $stmt = null;
        $date = $date = date('Y-m-d');

        try {
            $stmt = DatabaseConnection::getInstance()
                ->prepare("update borrow_books set `return date` = :date where book_id = :id");
            $stmt->bindParam(":date", $date);
            $stmt->bindParam(":id", $id);

            $result = $stmt->execute();
            if ($result) {
                return $result;
            }
            throw  new \PDOException("Operation Failed");
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }


    //issuing a book
    static function issue_book($data)
    {
        $stmt = null;
        $days = SubscriptionPlanModel::getSubscribedPlanInfo($data["subscriber_id"]);
        if(isset($days["error"])){
            echo "<h1>".$days["error"]."</h1>";
            echo "<a href = '/issue_book/create'>Go back</a>";
            die();
        }
        if (!isset($data["issue_date"]) || $data["issue_date"] == "") {
            $data["issue_date"] = date("Y-m-d");
        }
        $expected_date = new \DateTime($data["issue_date"]);
        date_add($expected_date, new \DateInterval("P".$days["issue_days"]."D"));

        try {
            $stmt = DatabaseConnection::getInstance()
                ->prepare("INSERT INTO borrow_books (book_id,subscriber_id,issue_date,expected_return_date) values (:book_id,:subscriber_id,:issue_date,:expected_return_date);");

            $stmt->bindParam(":book_id", $data["access_no"]);
            $stmt->bindParam(":subscriber_id", $data["subscriber_id"]);
            $stmt->bindParam(":issue_date", $data["issue_date"]);
            $stmt->bindValue(":expected_return_date", $expected_date->format("Y-m-d"));
            $result = $stmt->execute();
            if ($result) {
                return $result;
            }
            throw new \PDOException("Operation Failed");
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
            unset($expected_date);

        }
    }

    //deteting issued book 
    static function delete()
    {
        $stmt = null;
        try {
            $stmt = DatabaseConnection::getInstance()
                ->prepare("DELETE FROM borrow_books WHERE id = :id;");
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        }
    }
    //count of issued books of subscriber
    static function count(int $id)
    {
        $stmt = null;
        try {
            $stmt = DatabaseConnection::getInstance()
                ->prepare("select count(*) as count from borrow_books bb inner join subscribers s on s.id = bb.subscriber_id  where bb.`return date` is null and s.id = :id;");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                if (isset($result["count"])) {
                    return $result["count"];
                }
                throw new \PDOException("No data available");
            }
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }

    //count of all issued book
    static function CountAll()
    {
        $stmt = null;
        try {
            return DatabaseConnection::getInstance()
                ->query("select count(*) as count from borrow_books bb inner join subscribers s on s.id = bb.subscriber_id  where bb.`return date` is null;")->fetch()["count"];
            
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];

        } finally {
            unset($stmt);
        }
    }

//finding particular borrowed book
    static function find($id)
    {
        $stmt = null;
        try {
            $stmt = DatabaseConnection::getInstance()
                ->prepare("select if( datediff(now(),bb.expected_return_date) > 0,datediff(now(),bb.expected_return_date)*10, 0)  as fine,bb.*, b.title, b.accession_no,p.name from borrow_books bb inner join books b on b.accession_no = bb.book_id inner join subscribers s on s.id = bb.subscriber_id inner join person p on p.id = s.person_id where `return date` is null and s.id = :id;");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                if (isset($result)) {
                    return $result;
                }
                throw new \PDOException("No data available");
            }
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];

        } finally {
            unset($stmt);
        }
    }

    //Calculating fine
    static function calculate_fine(int $id)
    {
        $subscribers  = self::find($id);
        if(isset($subscribers["error"])){
            return $subscribers["err0r"];
        }
        $fine = 0;
        foreach ($subscribers as $subscriber) {
            $expected_date = new \DateTime($subscriber["expected_return_date"]);
            $today = new \DateTime(date("Y-m-d"));
            if ($expected_date < $today) {
                $fine += $expected_date->diff($today)->days * 10;
            }
        }
        return $fine;
    }

    //calculating total fine
    static function calculate_total_fine()
    {
        $subscribers  = self::all();
        if(isset($subscribers["error"])){
            return $subscribers;
        }

        $fine = 0;
        foreach ($subscribers as $subscriber) {
            $expected_date = new \DateTime($subscriber["expected_return_date"]);
            $today = new \DateTime(date("Y-m-d"));
            if ($expected_date < $today) {
                $fine += $expected_date->diff($today)->days * 10;
            }
        }
        return $fine;
    }

    //checking where the book is issued to someone or not
    static function isBorrowed(int $id)
    {
        $stmt = null;
        try {
            $conn = DatabaseConnection::getInstance();
            $stmt = $conn->prepare("select count(id) as count from borrow_books where book_id = :id and `return date` is null;");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                if (isset($result["count"]) && $result["count"] > 0) {
                    return true;
                }
                return false;
            }
        } catch (\PDOException $ex) {
            return ["error"=>$ex->getMessage(),"code"=>$ex->getCode()];
        } finally {
            unset($stmt);
        }
    }
}
