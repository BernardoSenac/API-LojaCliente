<?php
    require_once 'Connection.php';

    class ClientDAO{
        public function getClients(){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM cliente;";

            $stmt = $connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function verifyEmail(string $clientEmail){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM cliente WHERE email = :clientEmail";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':clientEmail', $clientEmail);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function verifyPhoneNumber(string $clientPhoneNumber){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM cliente WHERE telefone = :clientPhoneNumber";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':clientPhoneNumber', $clientPhoneNumber);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function createclient(clientModel $clientData){
            $connection = (new connection)->getConnection();

            $sql = "INSERT INTO cliente
            VALUES(
            null,
            :clientName,
            :clientLastName, 
            :clientEmail, 
            :clientPhoneNumber, 
            :clientAddress,
            :clientCity,
            :clientState,
            :clientCEP,
            :clientRegistrationDate
            );";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':clientName', $clientData->clientName);
            $stmt->bindValue(':clientLastName', $clientData->clientLastName);
            $stmt->bindValue(':clientEmail', $clientData->clientEmail);
            $stmt->bindValue(':clientPhoneNumber', $clientData->clientPhoneNumber);
            $stmt->bindValue(':clientAddress', $clientData->clientAddress);
            $stmt->bindValue(':clientCity', $clientData->clientCity);
            $stmt->bindValue(':clientState', $clientData->clientState);
            $stmt->bindValue(':clientCEP', $clientData->clientCEP);
            $stmt->bindValue(':clientRegistrationDate', $clientData->clientRegistrationDate);
            
            return $stmt->execute();
        }

        public function updateClient(clientModel $clientData){
            $connection = (new connection)->getConnection();

            $sql = "UPDATE cliente
            SET
            nome = :clientName,
            sobrenome = :clientLastName, 
            email = :clientEmail, 
            telefone = :clientPhoneNumber, 
            endereco = :clientAddress,
            cidade = :clientCity,
            estado = :clientState,
            cep = :clientCEP
            WHERE
            id = :clientId
            ;";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':clientId', $clientData->clientId);
            $stmt->bindValue(':clientName', $clientData->clientName);
            $stmt->bindValue(':clientLastName', $clientData->clientLastName);
            $stmt->bindValue(':clientEmail', $clientData->clientEmail);
            $stmt->bindValue(':clientPhoneNumber', $clientData->clientPhoneNumber);
            $stmt->bindValue(':clientAddress', $clientData->clientAddress);
            $stmt->bindValue(':clientCity', $clientData->clientCity);
            $stmt->bindValue(':clientState', $clientData->clientState);
            $stmt->bindValue(':clientCEP', $clientData->clientCEP);
            
            return $stmt->execute();
        }
    }
?>