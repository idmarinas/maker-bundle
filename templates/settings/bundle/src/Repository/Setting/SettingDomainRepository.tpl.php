<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Doctrine\Persistence\ManagerRegistry;
use Idm\Bundle\Settings\Model\Repository\AbstractSettingDomainRepository;

class SettingDomainRepository extends AbstractSettingDomainRepository
{
	public function __construct (ManagerRegistry $registry)
	{
		parent::__construct($registry, <?= $entity_class ?>::class);
	}
}
