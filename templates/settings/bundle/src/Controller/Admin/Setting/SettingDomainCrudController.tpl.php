<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Idm\Bundle\Settings\Model\Controller\Admin\AbstractSettingDomainCrudController;

final class SettingDomainCrudController extends AbstractSettingDomainCrudController
{
	public static function getEntityFqcn (): string
	{
		return <?= $class_entity; ?>::class;
	}
}
