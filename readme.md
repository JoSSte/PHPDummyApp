[![Build Angular](https://github.com/JoSSte/PHPDummyApp/actions/workflows/main.yml/badge.svg)](https://github.com/JoSSte/PHPDummyApp/actions/workflows/main.yml)  
![GitHub top language](https://img.shields.io/github/languages/top/JoSSte/PHPDummyApp) 
![GitHub repo file count](https://img.shields.io/github/directory-file-count/JoSSte/PHPDummyApp) 
![GitHub repo size](https://img.shields.io/github/repo-size/JoSSte/PHPDummyApp)   
![GitHub commits since tagged version](https://img.shields.io/github/commits-since/JoSSte/PHPDummyApp/master-v0.5.2) 
![GitHub tag (latest by date)](https://img.shields.io/github/v/tag/JoSSte/PHPDummyApp)

# PHP Dummy App
This is a dummy php application I use to test CI/CD concepts before letting new ideas loose on my actual projects.

## Features
* [PHPunit](https://phpunit.readthedocs.io/en/9.5/writing-tests-for-phpunit.html) test suite published with [junit](https://phpunit.readthedocs.io/en/9.5/configuration.html?highlight=junit#the-junit-element) for results trend
* [PHPUnit](https://phpunit.readthedocs.io/en/9.5/code-coverage-analysis.html) with xdebug code coverge driver and [Clover coverage](https://openclover.org/) xml reports



## The CI/CD workflows

### Jenkins pipeline strategy
* `master` & all `feature/*` and `hotfix/*` branches are tested and documented, but not deployed anywhere
* All tags in the format `destination-v0.0` are deployed as long as `destination` is a valid target environment
* Currently only building on PHP 8.1

### Github Actions
I am experimenting with github actions, where one of the attractive abilities is the ability to test using different versions of PHP seamlessly.  

Currently testing on PHP versions 7.3, 7.4 8.0
