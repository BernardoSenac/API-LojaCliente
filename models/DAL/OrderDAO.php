<?php
    require_once 'Connection.php';

    class OrderDAO{
        public function getOrders(){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM pedido;";

            $stmt = $connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createOrder(OrderModel $orderData){
            $connection = (new connection)->getConnection();

            $sql = "INSERT INTO pedido
            VALUES(
            null,
            :clientId,
            :orderDate,
            :orderStatus,
            :orderPrice,
            :orderNotes
            );";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':clientId', $orderData->clientId);
            $stmt->bindValue(':orderDate', $orderData->orderDate);
            $stmt->bindValue(':orderStatus', $orderData->orderStatus);
            $stmt->bindValue(':orderPrice', $orderData->orderPrice);
            $stmt->bindValue(':orderNotes', $orderData->orderNotes);
            
            return $stmt->execute();
        }
    }
?>