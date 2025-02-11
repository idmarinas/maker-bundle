<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Doctrine\Persistence\ManagerRegistry;
use Idm\Bundle\User\Model\Repository\AbstractUserRepository;

final class UserRepository extends AbstractUserRepository
{
	public function __construct (ManagerRegistry $registry)
	{
		parent::__construct($registry, <?= $user_entity ?>::class);
	}
}
