<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>
use Idm\Bundle\User\Model\Controller\AbstractLoginController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route(path: '/login', name: 'login_')]
class LoginController extends AbstractLoginController {}
