<?php

namespace Training\Infrastructure\UI\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Training\Application\Service\User\Access\AuthenticateUserRequest;

class AuthenticateUserCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('user:authenticate')
            ->setDescription('Authenticate user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $container = \Training\Infrastructure\Service\Container\getContainer();

        \Ddd\Domain\DomainEventPublisher::instance()->subscribe(
            new \Ddd\Domain\PersistDomainEventSubscriber(
                $container->get('event_store')
            )
        );

        $questionUsername     = new Question('Please enter your username: ');
        $questionPassword = new Question('Please enter your password: ');

        $request = new AuthenticateUserRequest(
            $helper->ask($input, $output, $questionUsername),
            $helper->ask($input, $output, $questionPassword)
        );

        try {
            /** @var $appService \Training\Application\Service\User\Access\AuthenticateUserService */
            $appService = $container->get('authenticate_user_service');
            $response = $appService->execute($request);

            $output->writeln("<info>Hey {$response->user()->name()}, welcome to the app.</info>");
        } catch (\Exception $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");
        }
    }
}
