<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Idm\Bundle\Common\Model\Controller\Admin\AbstractContactCrudController;

class ContactCrudController extends AbstractContactCrudController
{
	public static function getEntityFqcn (): string
	{
		return <?= $entity_class ?>::class;
	}
}
