#!groovy

@Library('JoSSteJenkinsGlobalLibraries')
import com.stevnsvig.jenkins.release.ReleaseUtil

//TODO: SSH-steps? https://jenkins.io/blog/2019/02/06/ssh-steps-for-jenkins-pipeline/


def hasChanged = false
def buildName = "${env.BRANCH_NAME}-${env.BUILD_NUMBER}"
def frontendBranch = "master"
def npm_config_loglevel = "silent"

node{
    echo "TAG: ${env.TAG_name}"
    
    switch (ReleaseUtil.getBaseName(env.TAG_NAME)) {
        default:
            //get deploy settings for specified tag
            SITE_FQDN = "dummysite"
    }
    currentBuild.displayName = buildName
}

pipeline {
    agent any
    environment {
        SOURCE_DIR="${WORKSPACE}/src"
        BACKUP_FNAME="/tmp/BACKUP-${SITE_NAME}-${(new java.text.SimpleDateFormat('yyyy-MM-dd-HHmm')).format((new Date()))}.tar.gz"
    }
    triggers {
        bitbucketPush()
        pollSCM('') // empty cron expression string
    }
    
    stages {
        stage ('Staging'){
            steps {
                echo "Cleanup build artifacts"
                dir("${WORKSPACE}/build"){
                    deleteDir()
                }
                echo "Prepare for build"
                //re-create folders
                sh "mkdir ${WORKSPACE}/build ${WORKSPACE}/build/api ${WORKSPACE}/build/coverage ${WORKSPACE}/build/logs ${WORKSPACE}/build/pdepend ${WORKSPACE}/build/phpdox"
                echo "Running composer"
                sh "composer install -o -d ${SOURCE_DIR}"
                echo "Fetching Angular Frontend" 
            }
        }
        stage ('Testing'){
            when {
                not { tag  "release-*"}
            }
            parallel {
                stage ("Count LOC"){
                    steps {
                        echo "Running sloc"
                        sh "sloccount --duplicates --wide --details . | grep -v -e 'src/vendor' -e 'src/scripts/bootstrap' > ./build/logs/sloccount.sc  2>/dev/null"
                    }
                }
                stage ("Copy-Paste Detection"){
                    steps{
                        echo "Running copy-paste detection"
                        sh "./src/vendor/bin/phpcpd --fuzzy . --exclude src/vendor --log-pmd ./build/logs/phpcpd.xml || true"
                    }
                }
                stage ("Mess Detection"){
                    steps{
                        echo "Running mess detection on code"
                        //sh "./src/vendor/bin/phpmd src xml phpmd_ruleset.xml --reportfile=\"./build/logs/phpmd_code.xml\" --exclude=\"src/vendor,build\" --ignore-violations-on-exit --suffixes=\"php\""
                        echo "Running mess detection on tests"
                        //sh "./src/vendor/bin/phpmd tests xml phpmd_ruleset.xml --reportfile=\"./build/logs/phpmd_tests.xml\" --ignore-violations-on-exit --suffixes=\"php\""
                    }
                }
                stage ("Testing"){
                    when {
                        buildingTag()
                    }
                    steps{
                        echo "Running PHPUnit w/o code coverage"
                        sh "./src/vendor/bin/phpunit --configuration phpunit-quick.xml" 
                    }
                }
                stage ("Testing & code coverage"){
                    when {
                        not{ buildingTag() }
                    }
                    steps{
                        echo "Running PHPUnit including code coverage"
                        sh "./src/vendor/bin/phpunit --configuration phpunit.xml" 
                    }
                }
            }
        }
        stage ('Documenting') {
            when {
                not { tag  "release-*"}
            }
            steps{
                junit "build/logs/junit.xml"
                sloccountPublish encoding: '', pattern: ''
                // warnings-ng https://github.com/jenkinsci/warnings-ng-plugin/blob/master/doc/Documentation.md
                recordIssues enabledForFailure: true, tool: cpd(pattern: 'build/logs/phpcpd.xml')
                recordIssues enabledForFailure: true, tool: pmdParser(pattern: 'build/logs/phpmd_code.xml')
                recordIssues enabledForFailure: true, tool: pmdParser(pattern: 'build/logs/phpmd_tests.xml')
            }
        }
        stage ('Deploy') {
            when {
                buildingTag()
            }
            environment {
                SSH_TUNNEL_PORT=3309
            }
            parallel {
                stage ("Deploy code") {
                    agent any
                    steps {
                        echo "Deploying via SSH  on ${SSH_SERVER_NAME}:${DEPLOY_DIR}"
                        sh "ssh ${SSH_USERNAME}@${SSH_SERVER_NAME} tar -cvpzf ${BACKUP_FNAME} ${DEPLOY_DIR}/* "
                        sh "ssh ${SSH_USERNAME}@${SSH_SERVER_NAME} rm -R -f ${DEPLOY_DIR}/*"
                        sh "rsync --exclude='logo' -a ${SOURCE_DIR}/ ${SSH_USERNAME}@${SSH_SERVER_NAME}:${DEPLOY_DIR}/"
                    }
                }
            }
        }
    }
    post {
        //https://jenkins.io/doc/pipeline/tour/post/
        changed {
            script {
                hasChanged = true
            }
        }
        success {
            script {
                if(hasChanged){
                    echo '************** First success in a while! '
                }
            }

        }
        failure {
            script {
                if(hasChanged){
                    echo '************** Build broke '
                }
            }
        }
        unstable {
            echo '************** Unstable Build. Check test cases'
        }
        always {
            echo 'Cleaning up workspace'
        }
    }
}  