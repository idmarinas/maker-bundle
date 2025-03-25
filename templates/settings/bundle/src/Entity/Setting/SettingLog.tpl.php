<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Loggable\Entity\MappedSuperclass\AbstractLogEntry;
use Gedmo\Loggable\Entity\Repository\LogEntryRepository;

#[ORM\Entity(repositoryClass: LogEntryRepository::class)]
#[ORM\Table(name: 'idm_settings_setting_log', options: ['row_format' => 'DYNAMIC'])]
#[ORM\Index(name: 'idm_settings_setting_log_class_lookup_idx', columns: ['object_class'])]
#[ORM\Index(name: 'idm_settings_setting_log_date_lookup_idx', columns: ['logged_at'])]
#[ORM\Index(name: 'idm_settings_setting_log_user_lookup_idx', columns: ['username'])]
#[ORM\Index(name: 'idm_settings_setting_log_version_lookup_idx', columns: ['object_id', 'object_class', 'version'])]
class SettingLog extends AbstractLogEntry
{
/* All required columns are mapped through inherited superclass */
}
