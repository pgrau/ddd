<?php

namespace Training\Application\Service\User\Access;

use Training\Application\Service\User\Create\CreateUserServiceException;
use Training\Domain\Model\Credentials;
use Training\Domain\Model\FullName;
use Training\Domain\Model\User\Identity\User;
use Training\Domain\Model\User\Identity\UserId;
use Training\Domain\Model\User\Identity\UserRepository;

final class CreateUserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateUserRequest $request)
    {
        try {
            $fullName = new FullName($request->name(), $request->lastName());
            $credentials = new Credentials($request->username(), $request->password());

            $anUser = new User(new UserId(), $fullName, $credentials);
            $anUser->confirmPassword($request->password(), $request->confirmPassword());
            $anUser->encryptPassword($request->password(), PASSWORD_DEFAULT, 'password_hash');

            $this->userRepository->persist($anUser);

            return new CreateUserResponse($anUser);

        } catch (\Exception $exception) {
            throw new CreateUserServiceException($exception->getMessage());
        }
    }
}