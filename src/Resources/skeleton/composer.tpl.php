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
    "minimum-stability": "dev",
    "prefer-stable": true,
    "require": {
        "php": "^7.4 | ^8.0 | ^8.1",
        "symfony/config": "^4.4 | ^5.4",
        "symfony/dependency-injection": "^4.4 | ^5.4"
    },
    "require-dev": {
        "matthiasnoback/symfony-config-test": "^4.2",
        "matthiasnoback/symfony-dependency-injection-test": "^4.2",
        "nyholm/symfony-bundle-test": "^1.7",
        "phpunit/phpunit": "^9.5",
        "rector/rector": "^0.12.12",
        "symfony/phpunit-bridge": "^5.3",
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
