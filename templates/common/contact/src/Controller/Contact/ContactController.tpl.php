<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Idm\Bundle\Common\Model\Controller\AbstractContactController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/contact', name: 'contact')]
class ContactController extends AbstractContactController
{
	/**
	 * @inheritDoc
	 */
	protected function getContactForm (): FormInterface
	{
		return $this->createForm(<?= $form_class ?>::class);
	}
}
