module.exports = function($http, $q){

  var member = this;
  member.memberList = {};
  member.boardId;


  member.getMembers = function(boardId){
    var defer = $q.defer();
    member.boardId = boardId

    $http.post("app/components/getMembers.php" , boardId)
    .success(function (data) {
      member.memberList = data;
      defer.resolve(data);
    })
    .error(function(error,status){
      defer.reject(error);

    })
    return defer.promise;
  }

  return member;
}
