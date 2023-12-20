{
    "name": "<?= $composer_name ?>",
    "description": "",
    "version": "1.0.0",
    "type": "symfony-bundle",
    "license": "BSD-3-Clause",
    "keywords": [],
    "authors": [
        {
            "name": "Iván Diaz Marinas (IDMarinas)",
            "email": "35842929+idmarinas@users.noreply.github.com",
            "homepage": "https://github.com/<?= $composer_name ?>",
            "role": "Developer"
        }
    ],
    "support": {
        "issues": "https://github.com/<?= $composer_name ?>/issues"
    },
    "minimum-stability": "stable",
    "prefer-stable": true,
    "require": {
        "php": "^8.0",
        "symfony/config": "^5.4 | ^6.0 | ^7.0",
        "symfony/dependency-injection": "^5.4 | ^6.0 | ^7.0"
    },
    "require-dev": {
        "fakerphp/faker": "^1.23",
        "matthiasnoback/symfony-config-test": "^4.2 | ^5.0",
        "matthiasnoback/symfony-dependency-injection-test": "^4.2 | ^5.0",
        "nyholm/symfony-bundle-test": "^1.7",
        "phpunit/phpunit": "^9.5",
        "rector/rector": "^0.15",
        "symfony/phpunit-bridge": "^6.0",
        "symfony/test-pack": "^1.0"
    },
    "config": {
        "allow-plugins": {
            "composer/package-versions-deprecated": true,
            "symfony/flex": true,
            "symfony/runtime": true
        },
        "optimize-autoloader": true,
        "preferred-install": {
            "*": "dist"
        },
        "sort-packages": true
    },
    "autoload": {
        "psr-4": {
            "<?= $namespace ?>": "src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "<?= $namespace ?>Tests\\": "tests/"
        }
    },
    "funding": [
        {
            "type": "paypal",
            "url": "https://www.paypal.me/idmarinas"
        }
    ],
    "scripts": {
        "test": "phpunit"
    }
}
