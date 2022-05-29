<?php
    namespace Database\Models;

use Database\DatabaseConnection;

    class SubscriptionPlanModel {
        
        static function all(){
            try{
                $result = DatabaseConnection::getInstance()
                ->query("select * from subscription_plans;")
                ->fetchAll();
                return $result;
            }
            catch(\PDOException $ex){
                return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
            }
        }

        static function Activeall(){
            try{
                $result = DatabaseConnection::getInstance()
                ->query("select * from subscription_plans where isActive = '1';")
                ->fetchAll();
                return $result;
            }
            catch(\PDOException $ex){
                return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
            }
        }

        static function find(int $id){
            $stmt = null;
            try{
                $stmt = DatabaseConnection::getInstance()
                ->prepare("SELECT * FROM subscription_plans where id = :id");
                $stmt->bindParam(":id",$id);
                if($stmt->execute()){
                    $result = $stmt->fetch();
                    if(isset($result["id"])){
                        return $result;
                    }
                    throw new \PDOException("No data found");
                }

            }catch(\PDOException $ex){
                return  ["error"=>$ex->getMessage()];
            }finally{
                unset($stmt);
            }
        }

        static function delete(int $id){
            $stmt = null;
            try{
                $stmt = DatabaseConnection::getInstance()
                ->prepare("DELETE FROM subscription_plans where id = :id");
                $stmt->bindParam(":id",$id);
                return $stmt->execute();
            }catch(\PDOException $ex){
                return  ["error"=>$ex->getMessage()];
            }finally{
                unset($stmt);
            }
        }


        static function insert($data){
            $stmt = null;
            try{
                $stmt=  DatabaseConnection::getInstance()
                ->prepare("insert into subscription_plans (title,description,price,book_issue_limit,issue_days,time_period) values
                 (:title,:desc,:price,:book_issue_limit,:issue_days,:time_period); ");
                $stmt->bindParam(":title",$data['title']);
                $stmt->bindParam(":desc",$data["desc"]);
                $stmt->bindParam(":price",$data["price"]);
                $stmt->bindParam(":book_issue_limit",$data["issue_limit"]);
                $stmt->bindParam(":issue_days",$data["issue_days"]);
                $stmt->bindParam(":time_period",$data["time_period"]);
                return $stmt->execute();
            }
            catch(\PDOException $ex){
                return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
            }finally{
                unset($stmt);
            }

        }


        static function update(int $id,$data){
            $stmt = null;
            try{
                $stmt=  DatabaseConnection::getInstance()
                ->prepare("update subscription_plans set title=:title,isActive=:desc,price=:price,book_issue_limit=:book_issue_limit,issue_days=:issue_days,time_period=:time_period where id =:id;");
                $stmt->bindParam(":title",$data['title']);
                $stmt->bindParam(":desc",$data["isActive"]);
                $stmt->bindParam(":price",$data["price"]);
                $stmt->bindParam(":book_issue_limit",$data["book_issue_limit"]);
                $stmt->bindParam(":issue_days",$data["issue_days"]);
                $stmt->bindParam(":time_period",$data["time_period"]);
                $stmt->bindParam(":id",$id);

                return $stmt->execute();
            }
            catch(\PDOException $ex){
                return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
            }finally{
                unset($stmt);
            }

        }

        static function count(){
            try{
                $result = DatabaseConnection::getInstance()
                ->query("select count(*) as plans_count from subscription_plans;")
                ->fetch();
                return $result["plans_count"];
            }catch(\PDOException $ex){
                return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
            }
        }


        static function getSubscribedPlanInfo(int $id){
            try{
                $result = DatabaseConnection::getInstance()
                ->query("select s.id,sp.issue_days as issue_days,sp.book_issue_limit,sp.time_period,st.purchase_date from subscribers s inner join subscribes_to st on s.id = st.subscriber_id inner join subscription_plans sp on sp.id = st.subscription_plan_id where s.id = $id;")
                ->fetch();
                if(isset($result["issue_days"])){
                    return $result;
                }
                throw new \PDOException("Not Subcribed yet");
            }catch(\PDOException $ex){
                return ["error" => $ex->getMessage(),"code"=>$ex->getCode()];
            }
        }


        
    }