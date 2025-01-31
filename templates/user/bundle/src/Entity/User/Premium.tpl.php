<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Idm\Bundle\User\Model\Entity\AbstractPremium;

#[ORM\Entity]
#[ORM\Table(name: 'idm_user_premium')]
#[Gedmo\Loggable(logEntryClass: PremiumLog::class)]
class Premium extends AbstractPremium {}
