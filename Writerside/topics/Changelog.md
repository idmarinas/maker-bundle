# Changelog

## 2.0.4 - (2025-02-19)

### Fixed {id="fixed_2.0.4"}

* Fixed **User Make Command** now updates the `request_password_repository` and correctly updates the file
  `security.yaml`.

## 2.0.3 - (2025-02-19)

### Fixed {id="fixed_2.0.3"}

* Fixed **Templates** to be compatible with your abstract classes.

## 2.0.2 - (2025-02-19)

### Fixed {id="fixed_2.0.2"}

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
