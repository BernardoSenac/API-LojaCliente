<?php
    require_once './models/ClientModel.php';

    class ClientController{
        public function getClients() {
            $clientModel = new ClientModel();

            $clients = $clientModel->getClients();

            return json_encode([
                'error' => null,
                'result' => $clients
            ]);
        }


        public function createClient() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['nome']))
                return $this->error('Você deve informar o nome do cliente!');

            if(empty($data['sobrenome']))
                return $this->error('Você deve informar o sobrenome do cliente!');
            
            if(empty($data['email']))
                return $this->error('Você deve informar o email do cliente!');

            if(empty($data['telefone']))
                return $this->error('Você deve informar o telefone do cliente!');

            if(empty($data['endereco']))
                return $this->error('Você deve informar o endereco do cliente!');

            if(empty($data['cidade']))
                return $this->error('Você deve informar a cidade do cliente!');

            if(empty($data['estado']))
                return $this->error('Você deve informar o estado do cliente!');

            if(empty($data['cep']))
                return $this->error('Você deve informar o CEP do cliente!');

            if ((new ClientModel)->verifyEmail($data['email']))
                return $this->error('Este endereço de e-mail já foi cadastrado anteriormente!');

            if ((new ClientModel)->verifyPhoneNumber($data['telefone']))
                return $this->error('Este número de telefone já foi cadastrado anteriormente!');
            
            $clientModel = new ClientModel();

            $clientData = new ClientModel(
                null,
                $data['nome'], 
                $data['sobrenome'], 
                $data['email'], 
                $data['telefone'], 
                $data['endereco'], 
                $data['cidade'], 
                $data['estado'], 
                $data['cep'],
                (new DateTime('now', new DateTimeZone('America/Sao_Paulo')))->format('Y-m-d H:i:s')
            );

            $client = $clientModel->createClient($clientData);

            return json_encode([
                'error' => null,
                'result' => $client
            ]);
        }

        public function updateClient() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['id']))
                return $this->error('Você deve informar o ID do cliente!');

            if(empty($data['nome']))
                return $this->error('Você deve informar o nome do cliente!');

            if(empty($data['sobrenome']))
                return $this->error('Você deve informar o sobrenome do cliente!');
            
            if(empty($data['email']))
                return $this->error('Você deve informar o email do cliente!');

            if(empty($data['telefone']))
                return $this->error('Você deve informar o telefone do cliente!');

            if(empty($data['endereco']))
                return $this->error('Você deve informar o endereco do cliente!');

            if(empty($data['cidade']))
                return $this->error('Você deve informar a cidade do cliente!');

            if(empty($data['estado']))
                return $this->error('Você deve informar o estado do cliente!');

            if(empty($data['cep']))
                return $this->error('Você deve informar o CEP do cliente!');

            $clientData = new ClientModel(
                $data['id'],
                $data['nome'], 
                $data['sobrenome'], 
                $data['email'], 
                $data['telefone'], 
                $data['endereco'], 
                $data['cidade'], 
                $data['estado'], 
                $data['cep']
            );

            $clientData->updateClient();

            return json_encode([
                'error' => null,
                'result' => $clientData
            ]);
        }

        private function error(string $message) {
            return json_encode([
                'error' => $message,
                'result' => null
            ]);
        }
    }
?>