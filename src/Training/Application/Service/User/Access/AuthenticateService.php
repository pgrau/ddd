<?php

namespace Training\Application\Service\User\Access;

use Training\Domain\Model\User\Identity\UserRepository;

final class AuthenticateService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(AuthenticateRequest $request)
    {
        try {
            $anUser = $this->userRepository->findOneByUsername($request->username());
            $anUser->authenticate($request->password(), 'password_verify');

            return new AuthenticateResponse($anUser);

        } catch (\Exception $exception) {
            throw new AuthenticateServiceException($exception->getMessage());
        }
    }
}