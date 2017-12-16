<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.06.17
 * Time: 21:30
 */

namespace AppBundle\Command;


use AppBundle\Entity\Stock;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CsvImportCommand extends Command
{

    /**
     * @var EntityManagerInterface
     */
    private $em;


    /**
     * CsvImportCommand constructor.
     *
     * @param EntityManagerInterface $em
     *
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function _construct(EntityManagerInterface $em)
    {
        parent::_construct();

        $this->em = $em;
    }


    /**
     * Configure
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName("csv:import")
            ->setDescription("Imports a mock CSV file")
        ;
    }


    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $io->title("Attempting to import the feed...");

        $stock = new Stock();

        $stock
            ->setProductCode("P0000")
            ->setProductName("DVD")
            ->setProductDescription("3 movies in complect")
            ->setStockValue("51")
            ->setCostInGBP("57.3")
            ->setDiscontinued("")
        ;

        $this->em->persist($stock);
        $this->em->flush();

        $io->success("Everything is OK");
    }

}