<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
/**
 *
 */
class MakeControllerCommand extends Command
{
    protected $commandName                = 'make:controller';
    protected $commandDescription         = "Make Some Controller";
    protected $commandArgumentName        = "name";
    protected $commandArgumentDescription = "What Your Controller Name?";

    protected function configure()
    {
    	$this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription
            );
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument($this->commandArgumentName);
        $nameFile = $name.'Controller.php';

        $controller_content = "<?php

	class {$name}Controller extends Controller {

        public function index()
        {
            self::view('".strtolower($name)."/index');
        }

        public function error()
        {
            self::view('templates/not_found');
        }
	}
        ";

        $view_content = "<h1>Hello {$name} </h1>";

        $fileSystem = new Filesystem();
        $fileSystem->mkdir('app/views/'. strtolower($name), 0700);
        $controller = fopen('app/controllers/'.$nameFile, 'a');
        $view       = fopen('app/views/'.strtolower($name).'/index.php', 'a');
        fputs($controller, $controller_content);
        fclose($controller);
        fputs($view, $view_content);
        fclose($view);
        $output->writeln('success');
    }
}