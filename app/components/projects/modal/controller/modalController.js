module.exports = function ($scope, $http) {
  $scope.showModal = false;
  $scope.dataArray = [];
  console.log("test");

  $scope.toggleModal = function(projectName){
    if($scope.showModal){
      $scope.projectName = projectName;
      //$scope.dataArray.push({
        //    Name: projectName
      //});
        var request = $http({
          method: "post",
          url: "app/components/projects/postProjects.php",
          data: {
              email: $scope.projectName,
          },
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      });

      /* Check whether the HTTP Request is successful or not. */
      request.success(function (data) {
        $scope.dataArray = [];
        for (var i=0;i<data.length;i++){
          console.log(data);
          $scope.dataArray.push(data[i]);
        }

      });
    }
    $scope.showModal = !$scope.showModal;
  };

  $scope.getBoard= function(projectId){
    console.log(projectId);
  }

  $http.get("app/components/projects/getProjects.php")
  .success(function (data) {
    for (var i=0;i<data.length;i++){

      $scope.dataArray.push(data[i]);
      console.log(data)
    }
  })
  .error(function(data){
     console.log(data);
   });

}
