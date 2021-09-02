module.exports = function ($scope, $http, $window, $location) {
    // register check
    $scope.check_register = function () {

        $scope.message = "";

        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var error = 0;

        if ($scope.register_email == "" || $scope.register_email == null) {
            error = "Please fill in a email-adress";
        }
        if (!emailReg.test($scope.register_email)) {
            error = "Please fill in a proper email-adress";
        }
        /*---- Email is validated ------ */
        if ($scope.register_password == "" || $scope.register_password == null) {
            error = "Please fill in a Password";
        }
        if($scope.register_password_comfirm == "" || $scope.register_password_comfirm == null){
          error = "Please comfirm your Password";
        }

        if($scope.register_password != $scope.register_password_comfirm){
            error = "Password does not match Password(Comfirm)";
        }

        // Als alles OK is zet het in de database
        if (error == 0) {
            var request = $http({
                method: "post",
                url: "./app/components/register/register.php",
                data: {
                    email: $scope.register_email,
                    pass: $scope.register_password
                },
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            });
            /* Check whether the HTTP Request is Successfull or not. */
            request.success(function (data) {
                //stuur door naar login
                $location.path('/login')
            });
        }
        else {
            $scope.message = "You have Filled Wrong Details! Error: " + error;
        }
    }

};
