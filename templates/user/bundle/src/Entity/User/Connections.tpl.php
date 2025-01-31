<?= "<?php\n" ?>

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Idm\Bundle\User\Model\Entity\AbstractConnections;

#[ORM\Entity]
#[ORM\Table(name: 'idm_user_connections')]
#[Gedmo\Loggable(logEntryClass: ConnectionsLog::class)]
class Connections extends AbstractConnections {}
