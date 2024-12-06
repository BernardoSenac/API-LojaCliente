<?php
    require_once './models/OrderModel.php';

    class OrderController{
        public function getOrders(){
            return json_encode(['Order 1', 'Order 2']);
        }

        public function createOrder() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['cliente_id']))
                return $this->error('Você deve informar o ID do cliente!');

            if(empty($data['status']))
                return $this->error('Você deve informar o ID do status do pedido!');

            if(empty($data['valor_total']))
                return $this->error('Você deve informar o valor total do pedido!');

            if(empty($data['observacoes']))
                return $this->error('Você deve informar as observações do pedido!');
            
            $orderModel = new OrderModel();

            $orderData = new OrderModel(
                null,
                $data['cliente_id'], 
                date('Y-m-d H:i:s'),
                $data['status'],
                $data['valor_total'],
                $data['observacoes']
            );

            $order = $orderModel->createOrder($orderData);

            return json_encode([
                'error' => null,
                'result' => $order
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