<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use App\Repository\User\ResetPasswordRequestRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Idm\Bundle\Common\Traits\Entity\UuidTrait;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestInterface;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestTrait;

#[ORM\Table(name: 'idm_user_reset_password_request')]
#[ORM\Entity(repositoryClass: ResetPasswordRequestRepository::class)]
#[Gedmo\Loggable(logEntryClass: ResetPasswordRequestLog::class)]
class ResetPasswordRequest implements ResetPasswordRequestInterface
{
use UuidTrait;
use ResetPasswordRequestTrait;

#[ORM\ManyToOne]
#[ORM\JoinColumn(nullable: false)]
private ?User $user;

public function __construct (
User              $user,
DateTimeInterface $expiresAt,
string            $selector,
string            $hashedToken
) {
$this->user = $user;
$this->initialize($expiresAt, $selector, $hashedToken);
}

public function getUser (): User
{
return $this->user;
}
}
