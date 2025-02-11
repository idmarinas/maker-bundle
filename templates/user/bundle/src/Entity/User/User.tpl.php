<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Idm\Bundle\User\Model\Entity\AbstractUser;
use Idm\Bundle\User\Traits\Entity\UserPremiumTrait;

#[ORM\Entity(repositoryClass: <?= $repository_class ?>::class)]
#[ORM\Table(name: 'idm_user_user')]
#[Gedmo\Loggable(logEntryClass: <?= $log_entry_class ?>::class)]
class User extends AbstractUser
{
	use UserPremiumTrait;

	public function __construct ()
	{
		$this->premium = (new <?= $premium_class ?>())
			->setUser($this)
		;
	}
}
