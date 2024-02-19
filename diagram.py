from diagrams import Cluster, Diagram, Edge
from diagrams.programming.language import PHP
from diagrams.onprem.ci import Jenkins
from diagrams.onprem.vcs import Github
from diagrams.generic.os import Ubuntu
from diagrams.k8s.infra import Node as k8sNode

"""
Reference for diagram: https://diagrams.mingrammer.com/docs/nodes/programming

"""

graph_attr = {
    "splines":"curved",
    "bgcolor": "transparent"
    }

with Diagram("PHPDummyApp setup", show=False, direction="TB"):
    gh = Github(label="Github Repository")
        
        
    with Cluster("CI") as ci:
        jenkins = Jenkins("Jenkins") 
        ghwf = Github("Github Action") 
        
    
    with Cluster("k8s") as k8s:
        k8s = k8sNode(
            label="", fontsize="6", loc="t",
            fixedsize="true", width="0.5", height="0.8", 
            pin="true", pos="0,2")
        phpbuilder = PHP("Build & test")

    with Cluster("github") as ghwf_worker:
        k8s = Ubuntu(
            label="", fontsize="6", loc="t",
            fixedsize="true", width="0.5", height="0.8", 
            pin="true", pos="0,2")
        gh_phpbuilder = PHP("Build")

    gh >> ghwf >> gh_phpbuilder
    gh >> jenkins
    jenkins >> phpbuilder
    

    #JenkinsFrontend << Edge(label="build & test") >> k8sFrontend
    #JenkinsBackend  << Edge(label="build & package Backend")  >> k8sBackend
#
    #JenkinsDeploy << Edge(color="black") >> JenkinsBackend, JenkinsDeploy << Edge(color="black") >> JenkinsFrontend
    #JenkinsDeploy >> Edge(color="red") >> envs
