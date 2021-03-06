<?php
namespace Mandae\Order\Console\Command;

use Magento\Sales\Api\OrderRepositoryInterface;
use Mandae\Order\Service\ShipOrderService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
//use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ShipOrderCommand extends Command
{
    protected $service;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ShipOrderService $service
    ) {
        $this->orderRepository = $orderRepository;
        $this->service = $service;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('mandae:ship:order');
        $this->addArgument('order_id', InputArgument::REQUIRED, 'Order ID');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /*if ($orderId = $input->getArgument('order_id'))
            $output->writeln('Provided order id is `' . $orderId . '`');

        $output->writeln('<info>Success Message.</info>');
        $output->writeln('<error>An error encountered.</error>');
        $output->writeln('<comment>Some Comment.</comment>');*/

        $orderId = $input->getArgument('order_id');
        $order = $this->orderRepository->get($orderId);
        $this->service->execute($order);
    }
}