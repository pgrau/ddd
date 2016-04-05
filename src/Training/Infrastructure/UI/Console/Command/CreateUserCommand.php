<?php

namespace Training\Infrastructure\UI\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Training\Application\Service\User\Create\CreateANewUserRequest;

class CreateUserCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('user:create')
            ->setDescription('Create new user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $container = \Training\Infrastructure\Service\Container\getContainer();

        $questionName     = new Question('Please enter your name: ');
        $questionLastName = new Question('Please enter your last name: ');
        $questionNickname = new Question('Please enter your username: ');
        $questionPassword = new Question('Please enter your password: ');
        $questionConfirmPassword = new Question('Please confirm your password: ');

        $request = new CreateANewUserRequest(
            $helper->ask($input, $output, $questionName),
            $helper->ask($input, $output, $questionLastName),
            $helper->ask($input, $output, $questionNickname),
            $helper->ask($input, $output, $questionPassword),
            $helper->ask($input, $output, $questionConfirmPassword)
        );

        try {
            /** @var $appService \Training\Application\Service\User\Access\CreateANewUserService */
            $appService = $container->get('create_new_user_service');
            $response = $appService->execute($request);

            $output->writeln("<info>Hey {$response->user()->name()}, welcome to the app.</info>");
        } catch (\Exception $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");
        }
    }
}
