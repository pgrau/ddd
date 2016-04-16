<?php

namespace Training\Application\Service\User\Access;

use Mockery;
use Training\Domain\Model\Credentials;
use Training\Domain\Model\FullName;
use Training\Domain\Model\User\Identity\User;
use Training\Domain\Model\User\Identity\UserId;

class AutheticateUserServiceTest extends \PHPUnit_Framework_TestCase
{
    const USER_NAME    = 'Juan';
    const USER_SURNAME = 'Garcia';
    const USER_NICK    = 'jgarcia';
    const USER_PWD     = 'garcia';

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

    public function testItShouldReturnAnExceptionWhenUsernameNotExists()
    {
        $this->expectException(AuthenticateUserServiceException::class);

        $this->userRepository->shouldReceive('findOneByUsername')->once()->andThrow('\Exception');
        $appService = new AuthenticateUserService($this->userRepository);
        $appService->execute($this->makeARequest());
    }

    public function testItShouldReturnAnExceptionWhenPasswordAndPasswordHashNotAreSame()
    {
        $this->expectException(AuthenticateUserServiceException::class);

        $anUser = $this->makeAnUser('pepe', 'secreto');
        $this->userRepository->shouldReceive('findOneByUsername')->once()->andReturn($anUser);

        $appService = new AuthenticateUserService($this->userRepository);
        $appService->execute($this->makeARequest());
    }


    public function testItShouldReturnAnUserWhenRequestIsOk()
    {
        $anUser = $this->makeAnUser();
        $this->userRepository->shouldReceive('findOneByUsername')->once()->andReturn($anUser);

        $appService = new AuthenticateUserService($this->userRepository);
        $response = $appService->execute($this->makeARequest());

        $this->assertInstanceOf(User::class, $response->user());
    }

    private function makeAnUser($nick = self::USER_NICK, $pwd = self::USER_PWD)
    {
        return new User(
            new UserId(),
            $this->makeAFullName(),
            $this->makeACredentials($nick, $pwd, User::PASSWORD_HASH)
        );
    }

    private function makeARequest($nick = self::USER_NICK, $pwd = self::USER_PWD)
    {
        return new AuthenticateUserRequest($nick, $pwd);
    }

    private function makeAFullName($name = self::USER_NAME, $surname = self::USER_SURNAME)
    {
        return new FullName($name, $surname);
    }

    private function makeACredentials($nick = self::USER_NICK, $pwd = self::USER_PWD, callable $method)
    {
        return new Credentials($nick, $method($pwd, USER::PASSWORD_ALGORITHM));
    }
}
