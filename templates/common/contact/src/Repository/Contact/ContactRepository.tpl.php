<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Doctrine\Persistence\ManagerRegistry;
use Idm\Bundle\Common\Model\Repository\AbstractContactRepository;

class ContactRepository extends AbstractContactRepository
{

	public function __construct (ManagerRegistry $registry)
	{
		parent::__construct($registry, <?= $entity_class ?>::class);
	}
}
