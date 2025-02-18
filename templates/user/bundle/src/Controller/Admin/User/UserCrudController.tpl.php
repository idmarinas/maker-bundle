<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Idm\Bundle\User\Model\Controller\Admin\AbstractUserCrudController;
use Idm\Bundle\User\Enums\UserRolesEnum;
use function Symfony\Component\Translation\t;

final class UserCrudController extends AbstractUserCrudController
{
	public static function getEntityFqcn (): string
	{
		return <?= $user_entity ?>::class;
	}
}
