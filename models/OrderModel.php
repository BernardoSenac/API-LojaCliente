<?php
    require_once 'DAL/OrderDAO.php';

    class OrderModel{
        public ?int $orderId;
        public ?int $clientId;
        public ?string $orderDate;
        public ?string $orderStatus;
        public ?float $orderPrice;
        public ?string $orderNotes;


        public function __construct(
            ?int $orderId = null, 
            ?int $clientId = null, 
            ?string $orderDate = null, 
            ?string $orderStatus = null, 
            ?float $orderPrice = null, 
            ?string $orderNotes = null, 
        )
        {
            $this->orderId = $orderId;
            $this->clientId = $clientId;
            $this->orderDate = $orderDate;
            $this->orderStatus = $orderStatus;
            $this->orderPrice = $orderPrice;
            $this->orderNotes = $orderNotes;
        }

        public function getOrders(){
            $orderDAO = new OrderDAO();

            $orders = $orderDAO->getOrders();

            foreach ($orders as $key => $order){
                    $orders[$key] = new OrderModel(
                    $order['id'], 
                    $order['cliente_id'],
                    $order['data_pedido'],
                    $order['status'],
                    $order['valor_total'],
                    $order['observacoes']
                );
            }

            return $orders;
        }

        public function createOrder(OrderModel $orderData){
            $orderDAO = new OrderDAO();

            return $orderDAO->createOrder($orderData);
        }
    }
?>