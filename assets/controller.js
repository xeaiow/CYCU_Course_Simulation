var app = angular.module('myApp', []);
app.controller('ListController', function($scope, $http) {

    // 搜尋課程
    $scope.course = [];
    $scope.courseTimes = [];
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