<?php

namespace Training\Application\User\Access;

use \Mockery as Mockery;

class AuthenticateServiceTest extends \PHPUnit_Framework_TestCase
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

    public function testItShouldReturnAnExceptionWhenUserIsNotFound()
    {
        $this->expectException('\Exception');

        $request = new AuthenticateRequest('robin', 'batman');

        $this->userRepository->shouldReceive('findOneByUsername')->once()->andThrow('\Exception');
        $appService = new AuthenticateService($this->userRepository);
        $appService->execute($request);
    }
}