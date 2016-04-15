<?php

namespace Training\Application\Service\User\Create;

use Training\Application\Service\User\Create\CreateUserServiceException;
use Training\Domain\Model\Credentials;
use Training\Domain\Model\FullName;
use Training\Domain\Model\User\Identity\User;
use Training\Domain\Model\User\Identity\UserId;
use Training\Domain\Model\User\Identity\UserRepository;

final class CreateANewUserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateANewUserRequest $request)
    {
        try {
            $anUser = $this->createANewUser($request);
            $anUser->confirmPassword($request->password(), $request->confirmPassword());
            $anUser->encryptPassword($request->password(), User::PASSWORD_ALGORITHM, User::PASSWORD_HASH);

            $this->userRepository->persist($anUser);

            return new CreateANewUserResponse($anUser);

        } catch (\Exception $exception) {
            throw new CreateANewUserServiceException($exception->getMessage());
        }
    }

    /**
     * @param CreateANewUserRequest $request
     * @return User
     */
    private function createANewUser(CreateANewUserRequest $request)
    {
        $fullName = new FullName($request->name(), $request->lastName());
        $credentials = new Credentials($request->username(), $request->password());

        return new User(new UserId(), $fullName, $credentials);
    }
}
