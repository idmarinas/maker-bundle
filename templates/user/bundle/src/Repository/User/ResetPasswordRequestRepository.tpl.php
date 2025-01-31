<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use App\Entity\User\ResetPasswordRequest;
use Doctrine\Persistence\ManagerRegistry;
use Idm\Bundle\User\Model\Repository\AbstractResetPasswordRequestRepository;

final class ResetPasswordRequestRepository extends AbstractResetPasswordRequestRepository
{
public function __construct (ManagerRegistry $registry)
{
parent::__construct($registry, ResetPasswordRequest::class);
}
}
