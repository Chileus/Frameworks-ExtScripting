module.exports = function ($scope, $http, SharedDataService,modalService, $uibModal, $log) {
  $scope.showModal = false;
  $scope.dataArray = [];
  $scope.select = true;
  $scope.isCollapsed = true;

  $scope.init = function(){
    $scope.getProjects();
  }

  $scope.getProjects = function(){
    modalService.getProjects()
    .then(function(data){
      $scope.dataArray = data;
    },function(error){
      //error
    })
  }



  // Voor het toggelen van de modal en alles wat daarin gebeurt. Dus het aanmkane van projecten
  $scope.toggleModal = function(projectName){
      if(projectName.length > 5){
        // zet het project in de database
        modalService.makeProject(projectName)
        .then(function(data){
          $scope.dataArray = data;
        },function(error){
          //error
        })
    }
  };
  $scope.items = ['item1', 'item2', 'item3'];

  $scope.animationsEnabled = true;

  $scope.open = function (size) {
    var modalInstance = $uibModal.open({
      animation: $scope.animationsEnabled,
      templateUrl: './app/components/projects/view.html',
      controller: 'ModalInstanceCtrl',
      size: size,
      resolve: {
        items: function () {
          return $scope.items;
        }
      }
    });

    modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());
    });
  };

  $scope.toggleAnimation = function () {
    $scope.animationsEnabled = !$scope.animationsEnabled;
  };
  // Haal alle projecten op

   // Word uitgevoerd als je een project aanklikt
   $scope.getBoard=function(projectId, projectName){
     modalService.getBoard(projectId,projectName)
     .then(function(data){
       $scope.boardInfo = data;
       $scope.select = false;
     },function(error){
       //error
     })
   }

    $scope.removeBoard=function(projectId){
      modalService.removeProject(projectId)
      .then(function(data){
        $scope.dataArray = data;
        $scope.select = true;

      },function(error){
        $scope.dataArray = {};
        $scope.select = true;
      })
    }
    $scope.leaveBoard=function(projectId){
      modalService.leaveProject(projectId)
      .then(function(data){
        $scope.dataArray = data;
        $scope.select = true;
      },function(error){
        $scope.dataArray = {};
        $scope.select = true;
      })
    }
    $scope.init();
}
