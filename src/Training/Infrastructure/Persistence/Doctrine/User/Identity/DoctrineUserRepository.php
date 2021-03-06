<?php

namespace Training\Infrastructure\Persistence\Doctrine\User\Identity;

use Doctrine\ORM\EntityRepository;
use Training\Domain\Model\User\Identity\User;
use Training\Domain\Model\User\Identity\UserRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    public function persist(User $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function findOneByUsername($username)
    {
        $anUser = $this->_em->getRepository(User::class)->findOneBy(['username' => $username]);

        if (null === $anUser) {
            throw new DoctrineUserRepositoryException('Not exist an user with username ' . $username);
        }

        return $anUser;
    }
}
