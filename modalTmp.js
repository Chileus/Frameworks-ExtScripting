app.controller('myCtrl', function ($scope, $http) {
  $scope.showModal = false;
  $scope.dataArray = [];

  $scope.toggleModal = function(projectName){
    if($scope.showModal){
      $scope.projectName = projectName;
      $scope.dataArray.push({
            Name: projectName
      });
        var request = $http({
          method: "post",
          url: "postProjects.php",
          data: {
              email: $scope.projectName,
          },
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      });

      /* Check whether the HTTP Request is successful or not. */
      request.success(function (data) {
          console.log(data[0]);

      });
    }
    $scope.showModal = !$scope.showModal;
  };

  $http.get("getProjects.php")
  .success(function (data) {
    for (var i=0;i<data.length;i++){

      $scope.dataArray.push(data[i]);
    }
  })
  .error(function(data){
     console.log($scope.data);
   });

});

app.directive('modal', function () {
  return {
    template: '<div class="modal fade">' +
        '<div class="modal-dialog">' +
          '<div class="modal-content">' +
            '<div class="modal-header">' +
              '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
              '<h4 class="modal-title">{{ title }}</h4>' +
            '</div>' +
            '<div class="modal-body" ng-transclude></div>' +
          '</div>' +
        '</div>' +
      '</div>',
    restrict: 'E',
    transclude: true,
    replace:true,
    scope:true,
    link: function postLink(scope, element, attrs) {
      scope.title = attrs.title;

      scope.$watch(attrs.visible, function(value){
        if(value == true)
          $(element).modal('show');
        else
          $(element).modal('hide');
      });

      $(element).on('shown.bs.modal', function(){
        scope.$apply(function(){
          scope.$parent[attrs.visible] = true;

        });
      });

      $(element).on('hidden.bs.modal', function(){
        scope.$apply(function(){
          scope.$parent[attrs.visible] = false;
        });
      });
    }
  };
});
