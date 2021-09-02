module.exports = function ($scope, $http, SharedDataService,memberservice,projectService) {

  // Standaard value voor member veld
  $scope.memberName = "Fill in member name"
  // Kijkt wanneer er een verandering is in het variable projectId zo ja voert hij deze code uit de factory SharedDataService
  $scope.$watch(function(){return projectService.boardId}, function(NewValue, OldValue){
    $scope.boardId = projectService.boardId;
    $scope.getMembers();
  });
  $scope.init = function(){

  }

  $scope.getMembers = function(){
    memberservice.getMembers($scope.boardId)
    .then(function(data){
      $scope.members = data;
      console.log(data)
    },function(error){
      //error
    })
  }

  $scope.removeMember = function (memberName){
    var request = $http({
      method: "post",
      url: "app/components/removeMembers.php",
      data: {
          name: memberName,
          board: $scope.boardId,
      },
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });
    request.success(function (data) {
      // omdat er een nieuw gebruiker is haal ik alle data op van members en zet deze in de SharedDataService factory
      //SharedDataService.setMembers(data);
      $scope.members = data;
    });
  }
  // Add member functie
  $scope.addMember = function(memberName){
    var member = false;
    // check of member al in het project zit
    for(var i=0;i<$scope.members.length;i++){
      if($scope.members[i].Username == memberName){
        member = true
      }
    }
    if(!member){
      // Zo niet voeg hem toe aan het project
      var request = $http({
        method: "post",
        url: "app/components/addMembers.php",
        data: {
            name: memberName,
            board: $scope.boardId,
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
      request.success(function (data) {
        // omdat er een nieuw gebruiker is haal ik alle data op van members en zet deze in de SharedDataService factory
        //SharedDataService.setMembers(data);
        $scope.members = data;
      });
    }
  }
  $scope.init();
}
