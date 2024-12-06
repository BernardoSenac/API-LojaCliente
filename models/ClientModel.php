<?php
    require_once 'DAL/ClientDAO.php';

    class ClientModel{
        public ?int $clientId;
        public ?string $clientName;
        public ?string $clientLastName;
        public ?string $clientEmail;
        public ?int $clientPhoneNumber;
        public ?string $clientAddress;
        public ?string $clientCity;
        public ?string $clientState;
        public ?string $clientCEP;
        public ?string $clientRegistrationDate;


        public function __construct(
            ?int $clientId = null, 
            ?string $clientName = null, 
            ?string $clientLastName = null, 
            ?string $clientEmail = null,
            ?int $clientPhoneNumber = null,
            ?string $clientAddress = null,
            ?string $clientCity = null,
            ?string $clientState = null,
            ?string $clientCEP = null,
            ?string $clientRegistrationDate = null,
        )
        {
            $this->clientId = $clientId;
            $this->clientName = $clientName;
            $this->clientLastName = $clientLastName;
            $this->clientEmail = $clientEmail;
            $this->clientPhoneNumber = $clientPhoneNumber;
            $this->clientAddress = $clientAddress;
            $this->clientCity = $clientCity;
            $this->clientState = $clientState;
            $this->clientCEP = $clientCEP;
            $this->clientRegistrationDate = $clientRegistrationDate;
        }

        public function getClients(){
            $clientDAO = new ClientDAO();

            $clients = $clientDAO->getClients();

            foreach ($clients as $key => $client){
                    $clients[$key] = new ClientModel(
                    $client['id'], 
                    $client['nome'],
                    $client['sobrenome'],
                    $client['email'],
                    $client['telefone'],
                    $client['endereco'],
                    $client['cidade'],
                    $client['estado'],
                    $client['cep'],
                    $client['data_cadastro']
                );
            }

            return $clients;
        }

        public function verifyEmail(string $clientEmail){
            $clientDAO = new ClientDAO();

            return $clientDAO->verifyEmail($clientEmail);
        }

        public function verifyPhoneNumber(int $clientPhoneNumber){
            $clientDAO = new ClientDAO();

            return $clientDAO->verifyPhoneNumber($clientPhoneNumber);
        }

        public function createClient(clientModel $clientData){
            $clientDAO = new ClientDAO();

            return $clientDAO->createClient($clientData);
        }

        public function updateClient(){
            $clientDAO = new ClientDAO();

            return $clientDAO->updateClient($this);
        }
    }
?>