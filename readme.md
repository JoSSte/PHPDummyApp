<a href="#tada-php-support" title="PHP Versions Supported"><img alt="PHP Versions Supported" src="https://img.shields.io/badge/php-7.4%20to%208.0-777bb3.svg?logo=php&logoColor=white&labelColor=555555"></a>


# PHP Dummy App
This is a dummy php application I use to test CI/CD concepts before letting new ideas loose on my actual projects.

[![Build Angular](https://github.com/JoSSte/PHPDummyApp/actions/workflows/main.yml/badge.svg)](https://github.com/JoSSte/PHPDummyApp/actions/workflows/main.yml)

### Jenkins pipeline strategy
* `master` & all `feature/*` and `hotfix/*` branches are tested and documented, but not deployed anywhere
* All tags in the format `destination-v0.0` are deployed as long as `destination` is a valid target environment

### Github Actions
I am experimenting with github actions, where one of the attractive abilities is the ability to test using different versions of PHP seamlessly.  

Currently testing on PHP versions 7.3, 7.4 8.0
