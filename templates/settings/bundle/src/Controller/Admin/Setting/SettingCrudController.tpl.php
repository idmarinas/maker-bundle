<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Idm\Bundle\Settings\Model\Controller\Admin\AbstractSettingCrudController;

final class SettingCrudController extends AbstractSettingCrudController
{
	public static function getEntityFqcn (): string
	{
		return <?= $class_entity; ?>::class;
	}
}
