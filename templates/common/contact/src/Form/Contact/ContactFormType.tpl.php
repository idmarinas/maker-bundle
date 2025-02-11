<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Idm\Bundle\Common\Model\Form\AbstractContactFormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractContactFormType
{
	public function configureOptions (OptionsResolver $resolver): void
	{
		parent::configureOptions($resolver);

		$resolver->setDefaults([
			'data_class' => <?= $entity_class; ?>::class,
		]);
	}
}
