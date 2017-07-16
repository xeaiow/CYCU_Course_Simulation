var app = angular.module('myApp', []);
app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

app.config(function($sceDelegateProvider) {
    $sceDelegateProvider.resourceUrlWhitelist([
        // Allow same origin resource loads.
        'self',
        // Allow loading from our assets domain.
        'https://itouch.cycu.edu.tw/myfile/student/json/pf_historyOfClass.jsp'
    ]);
});

app.controller('ListController', function($scope, $http) {

    // 搜尋課程
    $scope.course = [];
    $scope.loging = false;
    $scope.fbProfile = [];
    $scope.baseUrl = "//localhost/simulation/public/";
    $scope.search = function() {

        $http({
                url: $scope.baseUrl + 'search_course/' + $scope.keywords,
                method: "GET",
                // data: $.param({ "keywords": $scope.keywords }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
            })
            .success(function(data, status, headers, config) {

                $scope.course = data;
                console.log(data);
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
    $scope.loadAddedCourse = []; // 從資料庫載入已加選課程資訊
    $scope.history_course = []; // 曾修過的課程
    $scope.selectPoints = 0; // 目前學分數

    $scope.tt = function() {
        console.log($scope.selectPoints);
    }


    $scope.addCourse = function(id, name, teacher, time_1, time_2, time_3, com_or_opt, point, course_class) {

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


        // 判斷是否超過一學期可修習學分數
        if ($scope.selectPoints + parseInt(point) > 22) {

            swal({
                title: "錯誤",
                text: "學分超過上限！",
                type: "error",
                confirmButtonText: "知道了"
            });
            $scope.keepGoing = false;
        }


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

            // console.log($scope.selectCoursePhase);

            $scope.pushCourseToList($scope.tempSelectCourse, name, teacher);

            // 將選擇的課程所有文字資料存到 selectCourse 陣列
            $scope.selectCourse.push({
                'id': id,
                'name': name,
                "teacher": teacher,
                "class": course_class,
                'time_1': $scope.pushCourseTimes(time_1),
                'time_2': $scope.pushCourseTimes(time_2),
                'time_3': $scope.pushCourseTimes(time_3),
                "com_or_opt": com_or_opt,
                "point": point,
                "phase": $scope.tempSelectCourse,
            });

            $scope.selectPoints += parseFloat(point);

            // 存入 mondodb
            $http({
                    url: $scope.baseUrl + 'course/save',
                    method: "POST",
                    data: $.param({

                        "id": id,
                        "name": name,
                        "teacher": teacher,
                        "class": course_class,
                        "time_1": $scope.pushCourseTimes(time_1),
                        "time_2": $scope.pushCourseTimes(time_2),
                        "time_3": $scope.pushCourseTimes(time_3),
                        "point": point,
                        "com_or_opt": com_or_opt,
                        "phase": $scope.tempSelectCourse
                    }),
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
                    },
                })
                .success(function(data, status, headers, config) {

                    console.log(data);
                    toastr["success"](" ", "加選成功")


                })
                .error(function(data, status, headers, config) {
                    console.log('failed');
                });
        }
        // console.log("已選課程" + $scope.selectCoursePhase);
    }


    // 從資料庫載入已加選課程
    $scope.loadAddedCourse = function() {

        $http({
                url: $scope.baseUrl + 'added_course',
                method: "GET",
            })
            .success(function(data, status, headers, config) {
                console.log(data.add_course);
                angular.forEach(data.add_course, function(val, key) {

                    $scope.selectCourse.push({
                        'id': val.id,
                        'name': val.name,
                        "teacher": val.teacher,
                        "class": val.class,
                        'time_1': val.time_1,
                        'time_2': val.time_2,
                        'time_3': val.time_3,
                        "com_or_opt": val.com_or_opt,
                        "point": val.point,
                        "phase": val.phase
                    });

                    $scope.pushCourseToList(val.phase, val.name, val.teacher);
                    $scope.selectPoints += parseInt(val.point); // 取得該課程學分數

                    // 把加選過的課程時間加到 selectCoursePhase 陣列   
                    angular.forEach(val.phase, function(val, key) {

                        $scope.selectCoursePhase.push(parseInt(val));
                    });

                });
                console.log($scope.selectCoursePhase);


                console.log(data);

            })
            .error(function(data, status, headers, config) {
                console.log('failed');
            });
    }


    // 將結果顯示在課表上
    $scope.pushCourseToList = function(id, name, teacher) {

        for (var i = 0; i < id.length; i++) {

            $scope.course_date[parseInt(id[i])].id = name;
            $scope.course_date[parseInt(id[i])].teacher = teacher;
        }
    }


    // 匯入課程    
    $scope.import = function() {

        // 判斷是否為 json 格式
        function isJSON(str) {

            if (typeof str == 'string') {

                try {

                    JSON.parse(str);

                    // 儲存到 mongodb
                    $http({
                            url: $scope.baseUrl + 'import_course',
                            method: "POST",
                            data: $.param({

                                "history_course": JSON.parse($scope.history_course),
                            }),
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
                            },
                        })
                        .success(function(data, status, headers, config) {
                            toastr["success"](" ", "匯入成功")
                            setTimeout(function() { window.location.href = $scope.baseUrl; }, 1000);

                        })
                        .error(function(data, status, headers, config) {
                            console.log('failed');
                        });

                    return true;

                } catch (e) {

                    toastr["error"](" ", "請完整將上方代碼複製到下方！")
                    return false;
                }
            }
            toastr["error"](" ", "請完整將上方代碼複製到下方！")
        }

        isJSON($scope.history_course);
    }


    // 退選
    $scope.minusCourse = function(id) {


        $http({
                url: $scope.baseUrl + 'minus_course/' + id,
                method: "GET",
            })
            .success(function(data, status, headers, config) {

                $scope.pushCourseToList(data, undefined, undefined);
                angular.forEach($scope.selectCourse, function(val, key) {

                    // 從 selectCourse 陣列尋找退選編號            
                    if (val.id == id) {

                        // 刪除該陣列值
                        $scope.selectCourse.splice($scope.selectCourse.indexOf(val), 1);
                        $scope.selectPoints -= parseInt(val.point); // 將退選課程占用之學分數去除
                    }
                });

                // 刪除課程所占用的格子                
                angular.forEach(data, function(val, key) {

                    $scope.selectCoursePhase.splice($scope.selectCoursePhase.indexOf(parseInt(val)), 1);
                });
                toastr["success"](" ", "退選成功")

            })
            .error(function(data, status, headers, config) {
                console.log('failed');
            });
    }



    // 對應表
    $scope.course_date = [];

    for (var i = 0; i < 90; i++) {

        $scope.course_date.push({
            "id": "",
            "time": "",
            "teacher": "選好選滿"
        });
    }


    // 快速登入
    $scope.loadProfile = function() {

        var provider = new firebase.auth.FacebookAuthProvider();
        provider.setCustomParameters({
            'display': 'page'
        });

        firebase.auth().signInWithPopup(provider).then(function(result) {

            $scope.fbProfile.fb_id = result.additionalUserInfo.profile.id;
            $scope.fbProfile.birthday = result.additionalUserInfo.profile.birthday;
            $scope.fbProfile.name = result.additionalUserInfo.profile.name;
            $scope.fbProfile.gender = result.additionalUserInfo.profile.gender;
            $scope.fbProfile.photo = result.user.photoURL;

            $http({
                    url: $scope.baseUrl + 'profile/save',
                    method: "POST",
                    data: $.param({
                        "fb_id": $scope.fbProfile.fb_id,
                        "birthday": $scope.fbProfile.birthday,
                        "name": $scope.fbProfile.name,
                        "gender": $scope.fbProfile.gender,
                        "photo": $scope.fbProfile.photo,
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                })
                .success(function(data, status, headers, config) {

                    window.location.href = $scope.baseUrl + '';
                })
                .error(function(data, status, headers, config) {

                    console.log('login failed');
                });

        }).catch(function(error) {

        });
    }


    $scope.logout = function() {

        window.location.href = $scope.baseUrl + 'logout';
    }

    // toastr dialog setting    
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "0",
        "hideDuration": "300",
        "timeOut": "1000",
        "extendedTimeOut": "0",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
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