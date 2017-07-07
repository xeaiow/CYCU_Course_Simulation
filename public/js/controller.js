var app = angular.module('myApp', []);
app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
app.controller('ListController', function($scope, $http) {

    // 搜尋課程
    $scope.course = [];
    $scope.profile = [{
        "name": "吳冠興",
        "department": "資訊管理學系",
        "level": "四年級",
        "class": "乙班"
    }];
    $scope.search = function() {
        $http({
                url: 'find.php',
                method: "POST",
                data: $.param({ "keywords": $scope.keywords }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
            })
            .success(function(data, status, headers, config) {

                $scope.course = data;
            })
            .error(function(data, status, headers, config) {

            });
    }

    // 把課程上課時間的 . 去除
    $scope.pushCourseTimes = function(input) {

        if (!input || !input.length) { return; }

        return (input == undefined ? undefined : input.slice(0, -1));
    }


    // 選擇課程    
    $scope.selectCourse = []; // 選擇的課程
    $scope.selectCoursePhase = []; // 選擇的課程的絕對位置


    $scope.addCourse = function(id, name, teacher, time_1, time_2, time_3, com_or_opt) {

        $scope.tempSelectCourse = []; // 暫存的所有選課 (未處理)
        $scope.keepGoing = true;

        // 判斷是否加選重複課程        
        angular.forEach($scope.selectCourse, function(val, key) {

            if (val.name == name) {

                swal({
                    title: "錯誤",
                    text: "重複加選啦！",
                    type: "error",
                    confirmButtonText: "知道了"
                });
                $scope.keepGoing = false;
            }
        });


        // 計算此課程有多少個上課時段
        if (time_1 != undefined) {

            for (var i = 0; i < time_1.slice(2, -1).length; i++) {

                $scope.tempSelectCourse.push(((7 * time_1.slice(2, -1).slice(i, i + 1).replace(/C/, 9).replace(/D/, 10).replace(/E/, 11).replace(/F/, 12).replace(/G/, 13)) - (7 - time_1.slice(0, 1))) - 1);
            }

            if (time_2 != undefined) {

                for (var i = 0; i < time_2.slice(2, -1).length; i++) {

                    $scope.tempSelectCourse.push(((7 * time_2.slice(2, -1).slice(i, i + 1).replace(/C/, 9).replace(/D/, 10).replace(/E/, 11).replace(/F/, 12).replace(/G/, 13)) - (7 - time_2.slice(0, 1))) - 1);
                }

                if (time_3 != undefined) {

                    for (var i = 0; i < time_3.slice(2, -1).length; i++) {

                        $scope.tempSelectCourse.push(((7 * time_3.slice(2, -1).slice(i, i + 1).replace(/C/, 9).replace(/D/, 10).replace(/E/, 11).replace(/F/, 12).replace(/G/, 13)) - (7 - time_3.slice(0, 1))) - 1);
                    }
                }
            }

        } else {

            swal({
                title: "錯誤",
                text: "暑修加選功能未開放！",
                type: "error",
                confirmButtonText: "知道了"
            });
            $scope.keepGoing = false;
        }
        // console.log("此次選擇的課程" + $scope.tempSelectCourse);


        for (var i = 0; i < $scope.tempSelectCourse.length; i++) {

            if ($scope.selectCoursePhase.indexOf($scope.tempSelectCourse[i]) !== -1) {

                swal({
                    title: "錯誤",
                    text: "衝堂啦！",
                    type: "error",
                    confirmButtonText: "知道了"
                });
                $scope.keepGoing = false;

            }
        }


        if ($scope.keepGoing) {

            angular.forEach($scope.tempSelectCourse, function(val, key) {

                $scope.selectCoursePhase.push(val);
            });

            $scope.pushCourseToList($scope.tempSelectCourse, name, teacher);

            // 將選擇的課程所有文字資料存到 selectCourse 陣列
            $scope.selectCourse.push({
                'id': id,
                'name': name,
                "teacher": teacher,
                'time_1': $scope.pushCourseTimes(time_1),
                'time_2': $scope.pushCourseTimes(time_2),
                'time_3': $scope.pushCourseTimes(time_3),
                "com_or_opt": com_or_opt
            });
        }
        // console.log("已選課程" + $scope.selectCoursePhase);
    }


    // 將結果顯示在課表上
    $scope.pushCourseToList = function(id, name, teacher) {

        for (var i = 0; i < id.length; i++) {

            $scope.course_date[id[i]].id = name;
            $scope.course_date[id[i]].teacher = teacher;
        }
    }


    // 對應表
    $scope.course_date = [];

    for (var i = 0; i < 90; i++) {

        $scope.course_date.push({
            "id": "",
            "time": "",
            "teacher": "快選好選滿"
        });
    }

    var provider = new firebase.auth.FacebookAuthProvider();
    provider.setCustomParameters({
        'display': 'page'
    });

    $scope.loadProfile = function() {

        firebase.auth().getRedirectResult().then(function(result) {
            console.log(result);
            // The signed-in user info.
            var user = result.user;
        }).catch(function(error) {
            console.log(54);
            // Handle Errors here.
            var errorCode = error.code;
            var errorMessage = error.message;
            // The email of the user's account used.
            var email = error.email;
            // The firebase.auth.AuthCredential type that was used.
            var credential = error.credential;
            // ...
        });
    }


    $scope.login = function() {


        // provider.addScope('user_birthday');
        // provider.addScope('email');
        firebase.auth().signInWithRedirect(provider).then(function(result) {
            console.log(result);
            // This gives you a Facebook Access Token. You can use it to access the Facebook API.
            var token = result.credential.accessToken;

            // The signed-in user info.
            var user = result.user;
            console.log(user);
            // ...
        }).catch(function(error) {
            console.log(error);
            // Handle Errors here.
            var errorCode = error.code;
            var errorMessage = error.message;
            // The email of the user's account used.
            var email = error.email;
            // The firebase.auth.AuthCredential type that was used.
            var credential = error.credential;
            // ...
        });
    }


}).filter('removeDot', function() {
    return function(input) {

        if (!input || !input.length) { return; }

        return input.slice(0, -1);
    }
}).directive('pressEnter', function() {
    return function(scope, element, attrs) {
        element.bind("keydown keypress", function(event) {
            if (event.which === 13) {
                scope.$apply(function() {
                    scope.$eval(attrs.pressEnter);
                });

                event.preventDefault();
            }
        });
    };
});