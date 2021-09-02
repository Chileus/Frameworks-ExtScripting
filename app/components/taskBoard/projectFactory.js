module.exports = function ($http, $q) {
  // factory dat ervoor zorgt dat ik data kan verplaatsen tussen controllers
  // Het is een zooitje op het moment word nog opgelost later

  var task = this;
  task.taskList = {};

  task.setTask = function(name,id,boardId){
    var defer = $q.defer();

    $http({
      method: "post",
      url: "app/components/assignMember.php",
      data: {
          name: name,
          id: id,
          board: boardId,
      },
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
    .success(function (data) {
      task.taskList = data;
      console.log(data);
      defer.resolve(data);
    })
    .error(function(error,status){
      defer.reject(error);

    })
    return defer.promise;
  }
  return task;
  // vervang alle taken met nieuwe gegevens. ZOals bijvoorbeeld die je net geassignd hebt
}
