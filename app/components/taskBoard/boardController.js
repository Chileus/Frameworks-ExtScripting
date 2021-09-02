module.exports = function ($scope, $http, SharedDataService ,memberservice,dragulaService,projectService) {
  //checkt of je projectId veranderd

  //check .boardItemsof er extra members zijn toegevoegd
  $scope.$watch(function(){return projectService.boardId}, function(NewValue, OldValue){
    $scope.boardData = projectService.boardItems;
    $scope.boardName = projectService.boardName;
    $scope.boardId = projectService.boardId;

    memberservice.getMembers($scope.boardId)
    .then(function(data){

      $scope.members = memberservice.memberList;
    },function(error){
      //error
    })

  });


  $scope.isCollapsed2 = true;
  $scope.isCollapsed1 = true;

  $scope.today = function() {
    $scope.dt = new Date();
  };
  $scope.today();

  $scope.open1 = function() {
    $scope.popup1.opened = true;
  };
  $scope.open2 = function() {
    $scope.popup2.opened = true;
  };
  $scope.open3 = function() {
    $scope.popup2.opened = true;
  };

  $scope.popup1 = {
    opened: false
  };

  $scope.popup2 = {
    opened: false
  };
  $scope.popup3 = {
    opened: false
  };

  console.log($scope.popup2.opened);

  $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
  $scope.format = $scope.formats[0];
  // Nodig voor de taken zodat ze niet allemaal tegelijk open gaan.
  $scope.oneAtATime = true;


  $scope.status = {
    isFirstOpen: true,
    isFirstDisabled: false
  };


  // Regsiteerd of er gedragged word naar een andere tabel
  $scope.$on('another-bag.drop', function (e, el, source) {
    // ALs er gespeelt word zorg ervoor dat alles goed staat in de database
   var request = $http({
     method: "post",
     url: "app/components/updateTask.php",
     data: {
         board: el.parent().attr('id'),
         id: el.attr('id'),
     },
     headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
   });
   request.success(function (data) {
   });

  });
  //functie die ervoor zorgt dat je mensen kan assigen aan taken
  $scope.assignMember = function(name,id){

    var request = $http({
      method: "post",
      url: "app/components/assignMember.php",
      data: {
          name: name,
          id: id,
          board: $scope.boardId,

      },
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });
    request.success(function (data) {
      // vervang alle taken met nieuwe gegevens. ZOals bijvoorbeeld die je net geassignd hebt
      $scope.boardData = data;
      console.log(data)
    })
  }
  $scope.finishTask = function(id){
    var request = $http({
      method: "post",
      url: "app/components/deleteTask.php",
      data: {
          id: id,
          board: $scope.boardId,

      },
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });
    request.success(function (data) {
      // vervang alle taken met nieuwe gegevens. ZOals bijvoorbeeld die je net geassignd hebt
      $scope.boardData = data;
      console.log(data)
    })
  }
  // Create task fucntie
  $scope.CreateTask = function(taskName, Description ,state){
    // als iets is ingevuld
    if(taskName){
      console.log(Description)
      //zet het in de database
      var request = $http({
        method: "post",
        url: "app/components/postTask.php",
        data: {
            email: taskName,
            board: $scope.boardId,
            description: Description,
            date: $scope.dt,
            state: state,
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
      request.success(function (data) {
        // haal alle taken opnieuw op en zet ze in de view
        $scope.boardData = data;
      });
    }
  }
}
