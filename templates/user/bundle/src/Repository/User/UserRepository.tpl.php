<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use App\Entity\User\User;
use Doctrine\Persistence\ManagerRegistry;
use Idm\Bundle\User\Model\Repository\AbstractUserRepository;

final class UserRepository extends AbstractUserRepository
{
public function __construct (ManagerRegistry $registry)
{
parent::__construct($registry, User::class);
}
}
