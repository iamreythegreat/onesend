<?php
namespace Console\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Doctrine\DBAL\DriverManager;

 

class consultantLists extends Command
{


    protected function configure()
    {
        $this->setName('list-consultants')
            ->setDescription('Listing of all Consultants!')
            ->setHelp('list-consultants <fields> separated by comma.')
            ->addArgument('field', InputArgument::IS_ARRAY, 'Pass the field to display.');
            
            
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$output->writeln(sprintf('field!, %s', $input->getArgument('field'))); 
     	$this->lists($input->getArgument('field'));   
    }
    
    
    protected function lists($arg){
    
        $connParams = array(
          'dbname' => 'appointment',
          'user' => 'root',
          'password' => '',
          'host' => 'localhost',
          'driver' => 'pdo_mysql',
        );
        $conn = DriverManager::getConnection($connParams);

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder
               ->select('id', 'name','ttitle','availability')
               ->from('consultants');

        $stmt = $conn->query( $queryBuilder) ;  


        while (($row = $stmt->fetchAssociative()) !== false) {
    
        	   
        	   foreach($arg as $field) echo $row[$field].", ";	   
        	   echo "\n";
        	   
        }
        
 
    }
    
 
    
    
}




