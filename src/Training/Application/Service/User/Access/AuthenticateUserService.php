<?php

namespace Training\Application\Service\User\Access;

use Ddd\Domain\DomainEventPublisher;
use Training\Domain\Model\User\Access\UserLogged;
use Training\Domain\Model\User\Identity\User;
use Training\Domain\Model\User\Identity\UserId;
use Training\Domain\Model\User\Identity\UserRepository;

final class AuthenticateUserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function execute(AuthenticateUserRequest $request)
    {
        try {
            /* @var $anUser User */
            $anUser = $this->userRepository->findOneByUsername($request->username());
            $anUser->authenticate($request->password(), User::PASSWORD_VERIFY);

            DomainEventPublisher::instance()->publish(new UserLogged(new UserId($anUser->id())));

            return new AuthenticateUserResponse($anUser);
        } catch (\Exception $exception) {
            throw new AuthenticateUserServiceException($exception->getMessage());
        }
    }
}
