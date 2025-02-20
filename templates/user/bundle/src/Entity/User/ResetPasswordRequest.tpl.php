<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Idm\Bundle\Common\Traits\Entity\UuidTrait;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestInterface;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestTrait;

#[ORM\Entity(repositoryClass: <?= $repository_class ?>::class)]
#[ORM\Table(name: 'idm_user_reset_password_request')]
#[Gedmo\Loggable(logEntryClass: <?= $log_entry_class ?>::class)]
class ResetPasswordRequest implements ResetPasswordRequestInterface
{
	use UuidTrait;
	use ResetPasswordRequestTrait;

	#[ORM\ManyToOne]
	#[ORM\JoinColumn(nullable: false)]
	public ?<?= $user_entity ?> $user;

	public function __construct (
		<?= $user_entity ?>$user,
		DateTimeInterface $expiresAt,
		string            $selector,
		string            $hashedToken
	) {
		$this->user = $user;
		$this->initialize($expiresAt, $selector, $hashedToken);
	}

	public function getUser (): <?= $user_entity ?>
	{
		return $this->user;
	}
}
