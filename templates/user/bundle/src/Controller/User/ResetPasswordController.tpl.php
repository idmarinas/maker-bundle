<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Idm\Bundle\User\Form\ResetPasswordFormType;
use Idm\Bundle\User\Form\ResetPasswordRequestFormType;
use Idm\Bundle\User\Model\Controller\AbstractResetPasswordController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/reset-password')]
class ResetPasswordController extends AbstractResetPasswordController
{
	protected function getResetPasswordRequestForm (object $data = null, array $options = []): FormInterface
	{
		return $this->createForm(ResetPasswordRequestFormType::class, $data, $options);
	}

	protected function getResetPasswordForm (object $data = null, array $options = []): FormInterface
	{
		return $this->createForm(ResetPasswordFormType::class, $data, $options);
	}
}
