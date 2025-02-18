<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Idm\Bundle\User\Form\ChangePasswordFormType;
use Idm\Bundle\User\Model\Controller\AbstractProfileController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[AsController]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
#[Route(path: '/profile', name: 'profile_')]
class ProfileController extends AbstractProfileController
{
	protected function getChangePasswordForm (object $data = null, array $options = []): FormInterface
	{
		return $this->createForm(ChangePasswordFormType::class, $data, $options);
	}
}
