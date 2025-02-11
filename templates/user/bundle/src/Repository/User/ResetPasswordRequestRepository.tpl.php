<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Doctrine\Persistence\ManagerRegistry;
use Idm\Bundle\User\Model\Repository\AbstractResetPasswordRequestRepository;

final class ResetPasswordRequestRepository extends AbstractResetPasswordRequestRepository
{
	public function __construct (ManagerRegistry $registry)
	{
		parent::__construct($registry, <?= $entity_class ?>::class);
	}
}
