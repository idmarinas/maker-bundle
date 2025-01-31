<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use App\Entity\User\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\SearchMode;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Idm\Bundle\User\Enums\UserRolesEnum;
use function Symfony\Component\Translation\t;

final class UserCrudController extends AbstractCrudController
{
public static function getEntityFqcn (): string
{
return User::class;
}

public function configureCrud (Crud $crud): Crud
{
return $crud
->setSearchFields(['email', 'displayName'])
->setSearchMode(SearchMode::ANY_TERMS)
->setEntityLabelInPlural(t('entity.label.user.plural', [], 'IdmUserBundle'))
->setEntityLabelInSingular(t('entity.label.user.singular', [], 'IdmUserBundle'))
;
}

public function configureFilters (Filters $filters): Filters
{
return $filters
->add('email')
->add('displayName')
;
}

public function configureFields (string $pageName): iterable
{
// Tab Info
yield FormField::addTab(t('form.tab.info', [], 'IdmUserBundle'), 'fa fa-info');
yield FormField::addColumn(8);
yield IdField::new('uuid', t('crud.common.uuid', [], 'IdmUserBundle'))->onlyOnDetail();
yield TextField::new('displayName', t('crud.user.display_name', [], 'IdmUserBundle'));
yield EmailField::new('email', t('crud.user.email', [], 'IdmUserBundle'))
->setPermission('ROLE_SUPER_ADMIN') // Only a superuser can change this
;

yield FormField::addColumn(4);
yield BooleanField::new('isDeleted', t('crud.common.is_deleted', [], 'IdmUserBundle'))
->hideOnForm()
->renderAsSwitch(false)
->setVirtual(true)
;
yield DateTimeField::new('deletedAt', t('crud.common.deleted_at', [], 'IdmUserBundle'))
->hideOnIndex()
->setPermission('ROLE_SUPER_ADMIN') // Only a superuser can change this
;

// Tab Roles
yield FormField::addTab(t('form.tab.roles', [], 'IdmUserBundle'), 'fa-regular fa-id-badge')
->setPermission('ROLE_SUPER_ADMIN');
yield ChoiceField::new('roles', t('crud.common.roles', [], 'IdmUserBundle'))
->hideOnIndex()
->setTranslatableChoices(UserRolesEnum::toTranslatableChoices())
->allowMultipleChoices()
;
}
}
