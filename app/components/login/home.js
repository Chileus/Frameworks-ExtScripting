module.exports = function ($scope, $http, $window, $location) {
    // check of alles klopt
    $scope.check_credentials = function () {
        $scope.message = "";
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var error = 0;
        if ($scope.email == "" || $scope.email == null) {
            error = 1;
        }
        if (!emailReg.test($scope.email)) {
            error = 2;
        }
        /*---- Email is validated ------ */
        if ($scope.password == "" || $scope.password == null) {
            error = 3;
        }
        // klopt alles log dan logje in
        if (error == 0) {
            var request = $http({
                method: "post",
                url: "./app/components/login/login.php",
                data: {
                    email: $scope.email,
                    pass: $scope.password
                },
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            });
            /* Check whether the HTTP Request is Successfull or not. */
            request.success(function (data) {
                if(data){
                  console.log(data)
                  $scope.message = "From PHP file : "+data;
                  $location.path('/')
                }else{
                  $scope.message = "You have Filled Wrong Details! ";
                }

            });
        }
        else {
            $scope.message = "You have Filled Wrong Details! Error: " + error;
        }
    }

};
