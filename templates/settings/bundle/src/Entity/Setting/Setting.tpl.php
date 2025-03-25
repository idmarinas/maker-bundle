<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Idm\Bundle\Settings\EntityListener\SettingListener;
use Idm\Bundle\Settings\Model\Entity\AbstractSetting;

#[ORM\Table(name: 'idm_settings_setting')]
#[ORM\UniqueConstraint(name: 'idm_settings_uniq_idx__setting', columns: ['domain_id', 'name'])]
#[ORM\Entity(repositoryClass: <?= $repository_class ?>::class)]
#[ORM\EntityListeners([SettingListener::class])]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\Loggable(logEntryClass: <?= $log_entry_class ?>::class)]
class Setting extends AbstractSetting
{
	public const string ENTITY_NAME = 'setting';
}
