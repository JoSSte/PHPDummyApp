# PHP Dummy App
This is a dummy php application I use to test Jenkins pipelines before letting new ideas loose on my actual projects

### Jenkins pipeline strategy
* `master` & all `feature/*` and `hotfix/*` branches are tested and documented, but not deployed anywhere
* All tags in the format `destination-v0.0` are deployed as long as `destination` is a valid target environment