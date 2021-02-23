<?php
namespace Console\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Doctrine\DBAL\DriverManager;

class consultantAdd extends Command
{

    protected function configure()
    {
        $this->setName('add-consultants')
            ->setDescription('Add New Consultants!')
            ->setHelp('list-consultants <name> <title> <availability>.')
            
            ->addArgument('info', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'Consultant Name.');
            
            
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	
    	$this->add($input->getArgument('info'));
		$output->writeln('executed!');
    }
    
    
    protected function add($info){
    
        $connParams = array(
          'dbname' => 'appointment',
          'user' => 'root',
          'password' => '',
          'host' => 'localhost',
          'driver' => 'pdo_mysql',
        );
        $conn = DriverManager::getConnection($connParams);

        $queryBuilder = $conn->createQueryBuilder();
	
		//$conn->beginTransaction(); 		

		$name =$info[0];
		$title=$info[1];
		$avail=$info[2];
		
	     $queryBuilder ->insert('consultants')
           ->setValue('name', '"'.$name.'"')
           ->setValue('ttitle', '"'.$title.'"')
           ->setValue('availability', '"'.$avail.'"');

        
    	$stmt = $conn->query( $queryBuilder) ;  

		//echo $queryBuilder;
    	//return Command::SUCCESS;
    	
     }
    
}




