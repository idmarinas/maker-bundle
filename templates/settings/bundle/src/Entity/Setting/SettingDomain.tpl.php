<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Idm\Bundle\Settings\EntityListener\SettingDomainListener;
use Idm\Bundle\Settings\Model\Entity\AbstractSettingDomain;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/** Domain for settings of Symfony App */
#[ORM\Table(name: 'idm_settings_setting_domain')]
#[ORM\Entity(repositoryClass: <?= $repository_class ?>::class)]
#[UniqueEntity(fields: 'name', message: 'domain.not_unique')]
#[ORM\EntityListeners([SettingDomainListener::class])]
#[Gedmo\Loggable(logEntryClass: <?= $log_entry_class ?>::class)]
class SettingDomain extends AbstractSettingDomain {}
