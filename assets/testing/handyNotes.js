app.controller('ExampleController', ['$scope', function($scope) {
  $scope.list = [];
  $scope.text = 'hello';
  $scope.submit = function() {
    if ($scope.text) {
        $scope.list.push(this.text);
        $scope.text = '';
    }
  };
}]);

app.directive("buttontest", function($compile){
return {
  restrict: "E",
  template: "<button addbuttons>add Tasks</button>",
  link: function(scope, element, attrs){
    var html = `<div>Test02</div>`,
    compiledElement = $compile(html)(scope);

    element.on('click', function(event){
        var pageElement = angular.element(document.getElementById("page"));
        pageElement.empty();
        pageElement.append(compiledElement);

        /*var svg = angular.element('<p> test</p>');
        element.append(svg)*/

    })
  }
}
});

app.controller('sign_up', function ($scope, $http) {
  /*
  * This method will be called on click event of button.
  * Here we will read the email and password value and call our PHP file.
  */
  $scope.check_credentials = function () {

  document.getElementById("message").textContent = "";

  var request = $http({
      method: "post",
      url: window.location.href + "login.php",
      data: {
          email: $scope.email,
          pass: $scope.password
      },
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
  });

  /* Check whether the HTTP Request is successful or not. */
  request.success(function (data) {
      document.getElementById("message").textContent = "You have login successfully with email "+data;
  });
  }
});

app.controller('myCtrl', function($scope) {
    $scope.count = 0;
});


app.directive("svg",function(){
  return{
    link: function(scope,element,attrs){
      var svg = angular.element('<p> test</p>');
      element.append(svg)
    }
  }
})
