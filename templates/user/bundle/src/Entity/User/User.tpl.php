<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Idm\Bundle\User\Model\Entity\AbstractUser;
use Idm\Bundle\User\Traits\Entity\UserPremiumTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: <?= $repository_class ?>::class)]
#[ORM\Table(name: 'idm_user_user')]
#[Gedmo\SoftDeleteable()]
#[Gedmo\Loggable(logEntryClass: <?= $log_entry_class ?>::class)]
#[UniqueEntity('email', message: 'idm_user_bundle.email.not_unique')]
#[UniqueEntity('username', message: 'idm_user_bundle.username.not_unique')]
class User extends AbstractUser
{
	use UserPremiumTrait;
	use SoftDeleteableEntity;

	public function __construct ()
	{
		$this->createdAt = new DateTime();
		$this->updatedAt = new DateTime();
		$this->premium = (new <?= $premium_class ?>())
			->setUser($this)
		;
	}
}
