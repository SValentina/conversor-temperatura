pipeline {
  agent any  
  
  stages {
    stage('SonarQube Analysis') {
      environment {
        sonarHome = tool 'sonar-scanner'
        JAVA_HOME = tool 'openjdk-11'
      }
      steps {
        withSonarQubeEnv('sonarqube') {
          sh "${sonarHome}/bin/sonar-scanner"
        }
      }
    }

    stage('Quality Gate') {
      steps {
        waitForQualityGate true
        echo '--- QualityGate Passed ---'
      }
    }
  }
}
