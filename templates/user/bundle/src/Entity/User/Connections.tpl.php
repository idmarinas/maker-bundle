<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Idm\Bundle\User\Model\Entity\AbstractConnections;

#[ORM\Entity]
#[ORM\Table(name: 'idm_user_connections')]
#[Gedmo\Loggable(logEntryClass: <?= $log_entry_class ?>::class)]
class Connections extends AbstractConnections {}
