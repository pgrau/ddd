<?php

namespace Training\Application\Service\User\Create;

use Assert\Assertion;
use Mockery;
use Training\Infrastructure\Persistence\Doctrine\User\Identity\InMemoryUserRepository;

class CreateANewUserServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Mockery\MockInterface
     */
    private $userRepository;

    protected function setUp()
    {
        $this->userRepository = Mockery::mock('Training\Domain\Model\User\Identity\UserRepository');
    }

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testItShouldReturnAnExceptionWhenUserRepositoryIsNotAvailable()
    {
        $this->expectException('Training\Application\Service\User\Create\CreateANewUserServiceException');

        $this->userRepository->shouldReceive('persist')->once()->andThrow('\Exception');
        $appService = new CreateANewUserService($this->userRepository);
        $appService->execute($this->makeARequest());
    }

    public function testItShouldReturnAnExceptionWhenPasswordAndConfirmPasswordAreDifferents()
    {
        $this->expectException('Training\Application\Service\User\Create\CreateANewUserServiceException');
        $this->userRepository->shouldReceive('persist')->times(0);

        $appService = new CreateANewUserService($this->userRepository);
        $appService->execute($this->makeARequest('Pepe', 'Garcia', 'bcn', 'secreto', 'xecreto'));
    }

    public function testItShouldReturnAValidUserWithUuidWhenAllIsCorrect()
    {
        $userRepository = new InMemoryUserRepository();
        $appService = new CreateANewUserService($userRepository);
        $response = $appService->execute($this->makeARequest());

        $this->assertSame('Juan', $response->user()->name());
        $this->assertNull(Assertion::uuid($response->user()->id()));
    }

    private function makeARequest(
        $name = 'Juan',
        $lastname = 'Iglesias',
        $username = 'jugle',
        $password = 'secreto',
        $confirmPassword = 'secreto'
    ) {
        return new CreateANewUserRequest($name, $lastname, $username, $password, $confirmPassword);
    }
}
