<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Idm\Bundle\User\Model\Controller\AbstractRegistrationController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route(path: '/registration', name: 'registration_')]
class RegistrationController extends AbstractRegistrationController
{
	protected function getRegistrationForm (?object $data = null, array $options = []): FormInterface
	{
		return $this->createForm(<?= $registration_form ?>::class, $data, $options);
	}
}
