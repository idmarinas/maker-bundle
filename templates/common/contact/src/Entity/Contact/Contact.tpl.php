<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Idm\Bundle\Common\Model\Entity\AbstractContact;

#[ORM\Table(name: 'idm_common_contact')]
#[ORM\Entity(repositoryClass: <?= $repository_class ?>::class)]
#[Gedmo\Loggable(logEntryClass: <?= $log_entry_class ?>::class)]
class Contact extends AbstractContact {}
