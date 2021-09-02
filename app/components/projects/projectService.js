module.exports = function($http, $q) {
  // factory dat ervoor zorgt dat ik data kan verplaatsen tussen controllers
  // Het is een zooitje op het moment word nog opgelost later

  var project = this;
  project.projectList = {};
  project.boardItems = {};
  project.boardId;
  project.boardName;

  project.getBoard = function(projectId,projectName){
    var defer = $q.defer();

    $http.post("app/components/getProjectInfo.php", projectId)
    .success(function (data) {
      project.boardItems = data;
      project.boardId = projectId;
      project.boardName = projectName;
      defer.resolve(data);

    })
    .error(function(error,status){
      defer.reject(error);

    })

    return defer.promise;
    // vervang alle taken met nieuwe gegevens. ZOals bijvoorbeeld die je net geassignd hebt
  }

  project.makeProject = function (projectName){
    var defer = $q.defer();

    $http.post("app/components/postProjects.php", projectName)
    .success(function (data) {
      defer.resolve(data);
      console.log(data)
    })
    .error(function (error, status){
      defer.reject(error);
    })
    return defer.promise;
  }

  project.getProjects = function(){
    var defer = $q.defer();

    $http.get("app/components/getProjects.php")
    .success(function (data) {
      defer.resolve(data)
    })
    .error(function(data){
       defer.reject(data);
     });
     return defer.promise;
  }

  project.removeProject = function(projectId){
    var defer = $q.defer();
    $http.post("app/components/removeProject.php" ,projectId)
    .success(function(data,status){
      project.boardItems = data;
      defer.resolve(data);
    })
    .error(function(data,status){
      defer.reject(data);
    })
    return defer.promise;
  }
  project.leaveProject = function(projectId){
    var defer = $q.defer();
    $http.post("app/components/leaveProject.php", projectId)
    .success(function(data){
      console.log(data)
      project.boardItems = data;
      defer.resolve(data)
    })
    .error(function(data){
      defer.reject(data)
    })
    return defer.promise;
  }
  return project;
}
