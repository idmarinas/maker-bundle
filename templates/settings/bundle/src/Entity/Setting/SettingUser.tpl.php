<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Idm\Bundle\Settings\EntityListener\SettingListener;
use Idm\Bundle\Settings\Interfaces\Entity\EntityWithSettingsInterface;
use Idm\Bundle\Settings\Interfaces\Entity\SettingsWithEntityInterface;
use Idm\Bundle\Settings\Interfaces\Entity\UseEncryptCacheInterface;
use Idm\Bundle\Settings\Model\Entity\AbstractSetting;

#[ORM\Table(name: 'idm_settings_setting_user')]
#[ORM\Entity(repositoryClass: <?= $repository_class ?>::class)]
#[ORM\UniqueConstraint(name: 'idm_settings_uniq_idx_setting_user', columns: ['domain_id', 'name', 'entity_id'])]
#[ORM\EntityListeners([SettingListener::class])]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\Loggable(logEntryClass: <?= $log_entry_class ?>::class)]
class SettingUser extends AbstractSetting implements SettingsWithEntityInterface, UseEncryptCacheInterface
{
	public const string ENTITY_NAME = 'user_settings';

	#[ORM\ManyToOne(targetEntity: <?= $user_entity ?>::class, inversedBy: 'settings')]
	protected ?<?= $user_entity ?> $entity = null;

	public function getEntity (): ?<?= $user_entity ?>
	{
		return $this->entity;
	}

	public function setEntity (null|<?= $user_entity ?>|EntityWithSettingsInterface $entity): self
	{
		$this->entity = $entity;

		return $this;
	}
}
