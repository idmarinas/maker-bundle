# Changelog

## 2.1.3 - (2025-03-27)

### Fixed {id="fixed_2.1.3"}

* Fixed, now added `resolve_target_entities` to doctrine.yaml config

## 2.1.2 - (2025-03-26)

### Fixed {id="fixed_2.1.2"}

* _Fixed_ Rename `Log` Entity to `ContactLog` in `SourcesCommonBundle`

## 2.1.1 - (2025-03-26)

### Fixed {id="fixed_2.1.1"}

* _Fixed_ Initialized GenerateClasses in MakerCommonContact and MakerUserBundle

## 2.1.0 - (2025-03-25)

### Added {id="added_2.1.0"}

* _Added_ `make:idm:settings:bundle` command

### Changed {id="changed_2.1.0"}

* _Changed_ `sources.php` to a `Sources[Name]Bundle` to get all classes, With this avoid use `import`.

### Fixed {id="fixed_2.1.0"}

* _Fixed_ possible errors when using the `make:idm:user:bundle` command that some files are not found.

## 2.0.8 - (2025-02-21)

### Changed {id="changed_2.0.8"}

* Changed **Common Contact Templates**
	* Rename file `Log.tpl.php` to `ContactLog.tpl.php` and Entity name too
* Changed **ProfileController.tpl.php Template** deleted `IsGranted`
* Changed **User.tpl.php Template** Added `UniqueEntity` validators and `SoftDeleteable`

### Fixed {id="fixed_2.0.8"}

* Fixed error in **Contact.tpl.php Entity Template**, now include a construct to initialized `createdAt` and `updatedAt`
* Fixed error in **User.tpl.php Entity Template**, now include a construct to initialized `createdAt` and `updatedAt`

## 2.0.7 - (2025-02-20)

### Changed

* Changed **User Templates**
	* Table name for User Log entity
	* Rename file `Log.tpl.php` to `UserLog.tpl.php` and Entity name too

### Fixed {id="fixed_2.0.7"}

* **User Templates**
	* Fixed template `ResetPasswordRequest.tpl.php` make `$user` attribute public
* Fixed `MakerCommonContact.php` now search templates in correct dir

## 2.0.6 - (2025-02-20)

### Fixed {id="fixed_2.0.6"}

* Fixed **User Make Command**
	* Replace `array_merge_recursive` for a custom method `ArrayUtilsTrait::arrayMergeRecursive()`
	* With this, when merging array not convert non array value to array

## 2.0.5 - (2025-02-19)

### Fixed {id="fixed_2.0.5"}

* Fixed **User Make Command**
	* `security.yaml` updated route name for login
	* `MakerUserBundle` add method for update `doctrine.yaml`
	* This avoids the error
	  `The class 'Idm\Bundle\User\Model\Entity\AbstractUser' was not found in the chain configured namespaces App\Entity`

## 2.0.4 - (2025-02-19)

### Fixed {id="fixed_2.0.4"}

* Fixed **User Make Command** now updates the `request_password_repository` and correctly updates the file
  `security.yaml`.

## 2.0.3 - (2025-02-19)

### Fixed {id="fixed_2.0.3"}

* Fixed **Templates** to be compatible with your abstract classes.

## 2.0.2 - (2025-02-19)

### Fixed

* Fixed **Commands** now find templates.

## 2.0.0 - (2025-02-18)

### Release highlights

Added new make commands and removed old command for create a bundle.

### Added

* Added `make:idm:common:contact` command
* Added `make:idm:user:bundle` command

### Breaking changes

* Removed **Command** for create a bundle.
  Use [IDMarinas Template Bundle](https://www.github.com/idmarinas/template-bundle) instead
