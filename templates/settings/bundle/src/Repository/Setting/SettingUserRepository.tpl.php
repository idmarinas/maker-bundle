<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Doctrine\Persistence\ManagerRegistry;
use Idm\Bundle\Settings\Model\Repository\AbstractSettingRepository;

class SettingUserRepository extends AbstractSettingRepository
{
	public function __construct (ManagerRegistry $registry)
	{
		parent::__construct($registry, <?= $entity_class ?>::class);
	}
}
