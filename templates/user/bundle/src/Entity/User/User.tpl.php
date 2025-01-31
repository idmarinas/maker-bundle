<?= "<?php\n" ?>

namespace App\Entity\User;

use App\Repository\User\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Idm\Bundle\User\Model\Entity\AbstractUser;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'idm_user_user')]
#[Gedmo\Loggable(logEntryClass: Log::class)]
class User extends AbstractUser {}
