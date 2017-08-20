var app = angular.module('myApp', ['ngMask']);
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


app.filter('landlord_gender', function() {
    return function(val) {
        switch (val) {
            case "1":
                return "男";
                break;
            case "2":
                return "女";
                break;
            default:
                return "請選擇房東性別";
                break;
        }
    };
})
app.filter('house_type', function() {
    return function(val) {
        switch (val) {
            case "1":
                return "套房";
                break;
            case "2":
                return "雅房";
                break;
            case "3":
                return "家庭式";
                break;
            case "4":
                return "酒店式公寓";
                break;
            case "5":
                return "摩天大樓";
                break;
            case "6":
                return "其他";
                break;
            default:
                return "請選擇房型";
                break;
        }
    };
});
app.filter('pictures', function() {
    return function(val) {
        if (val === undefined) {
            return "http://alumni.cycu.edu.tw/alumni/upload/editor/campus%20view/%E4%B8%AD%E5%8E%9F%E6%A0%A1%E6%99%AF-%20979x648.jpg";
        }
        return val;
    };
});


app.filter('checkbox', function() {
    return function(val) {
        if (val != "true") {
            return "✖";
        }
        return "✔";
    };
});

app.filter('postcheckbox', function() {
    return function(val) {
        if (val != true) {
            return "✖";
        }
        return "✔";
    };
});



app.controller('ListController', function($scope, $http) {

    $scope.year_class = []; // 開課系級
    $scope.select_class = ""; // 所選擇的開課系級



    // 載入開課系級
    $scope.loadClass = function() {

        $http({ method: 'GET', url: 'class.json' }).success(function(data, status, headers, config) {

            $scope.year_class = data;
        });
    }


    // 搜尋課程
    $scope.course = [];
    $scope.loging = false;
    $scope.fbProfile = [];
    $scope.baseUrl = "//localhost/simulation/public/";
    $scope.search = function() {

        $http({
                url: $scope.baseUrl + 'search_course',
                method: "POST",
                data: $.param({
                    "keywords": $scope.keywords,
                    "year_class": $scope.select_class
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
            })
            .success(function(data, status, headers, config) {


                if (data.length !== 0) {
                    $scope.course = data;
                } else {
                    swal({
                        title: "糟糕",
                        text: "找不到課程，換個關鍵字看看。",
                        type: "error",
                        confirmButtonText: "知道了"
                    });
                }

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
    $scope.history_course_list = []; // 載入已修習之課程
    $scope.selectPoints = 0; // 目前學分數
    $scope.department_id = ""; // 系所 id
    $scope.department_name = ""; // 系所中文名稱



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
        // if ($scope.selectPoints + parseInt(point) > 22) {

        //     swal({
        //         title: "錯誤",
        //         text: "學分超過上限！",
        //         type: "error",
        //         confirmButtonText: "知道了"
        //     });
        //     $scope.keepGoing = false;
        // }


        // 計算此課程有多少個上課時段
        if (time_1 != "") {

            for (var i = 0; i < time_1.slice(2, -1).length; i++) {

                $scope.tempSelectCourse.push(((7 * time_1.slice(2, -1).slice(i, i + 1).replace(/C/, 10).replace(/D/, 11).replace(/E/, 12).replace(/F/, 13).replace(/G/, 14).replace(8, 9).replace(7, 8).replace(6, 7).replace(5, 6).replace(/B/, 5)) - (7 - time_1.slice(0, 1))) - 1);
            }

            if (time_2 != "") {

                for (var i = 0; i < time_2.slice(2, -1).length; i++) {

                    $scope.tempSelectCourse.push(((7 * time_2.slice(2, -1).slice(i, i + 1).replace(/C/, 10).replace(/D/, 11).replace(/E/, 12).replace(/F/, 13).replace(/G/, 14).replace(8, 9).replace(7, 8).replace(6, 7).replace(5, 6).replace(/B/, 5)) - (7 - time_2.slice(0, 1))) - 1);
                }

                if (time_3 != "") {

                    for (var i = 0; i < time_3.slice(2, -1).length; i++) {

                        $scope.tempSelectCourse.push(((7 * time_3.slice(2, -1).slice(i, i + 1).replace(/C/, 10).replace(/D/, 11).replace(/E/, 12).replace(/F/, 13).replace(/G/, 14).replace(8, 9).replace(7, 8).replace(6, 7).replace(5, 6).replace(/B/, 5)) - (7 - time_3.slice(0, 1))) - 1);
                    }
                }
            }

        } else {

            swal({
                title: "錯誤",
                text: "此課程不開放主動加選！",
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
                "phase": $scope.tempSelectCourse
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
                // console.log($scope.selectCoursePhase);

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
                            setTimeout(function() { window.location.href = $scope.baseUrl + 'my'; }, 1000);

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

    for (var i = 0; i < 97; i++) {

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
            $scope.fbProfile.photo = 'https://graph.facebook.com/' + result.additionalUserInfo.profile.id + '/picture?type=large';
            $scope.fbProfile.email = result.user.providerData[0].email;

            $http({
                    url: $scope.baseUrl + 'profile/save',
                    method: "POST",
                    data: $.param({
                        "fb_id": $scope.fbProfile.fb_id,
                        "birthday": $scope.fbProfile.birthday,
                        "name": $scope.fbProfile.name,
                        "gender": $scope.fbProfile.gender,
                        "photo": $scope.fbProfile.photo,
                        "email": $scope.fbProfile.email
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                })
                .success(function(data, status, headers, config) {


                    window.location.href = $scope.baseUrl + 'start';
                })
                .error(function(data, status, headers, config) {

                    console.log('login failed');
                });

        }).catch(function(error) {

        });
    }

    // 設定系所
    $scope.setDepartment = function() {

        if (!$scope.department_id) {

            toastr["error"](" ", "請選擇您的系所！")
            return false;
        }
        // 取得系所中文名稱
        $http({ method: 'GET', url: $scope.baseUrl + 'department.json' }).success(function(data, status, headers, config) {
            angular.forEach(data, function(val, key) {

                if (val.id == $scope.department_id) {

                    $scope.department_name = val.department;
                }
            });

            // 執行儲存腳色設定
            $http({
                    url: $scope.baseUrl + 'department/save',
                    method: "POST",
                    data: $.param({
                        "department_id": $scope.department_id,
                        "department_name": $scope.department_name
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                })
                .success(function(data, status, headers, config) {

                    if (data == 1) {
                        toastr["success"](" ", "設定完成")
                        setTimeout(function() { window.location.href = $scope.baseUrl + 'my'; }, 1000);
                    }
                })
                .error(function(data, status, headers, config) {

                    console.log('failed');
                });
        });
    }


    $scope.inputiTouchModal = function() {

        // 引導匯入已修習課程 輸入 student ID
        swal.setDefaults({
            input: 'text',
            confirmButtonText: '下一步 &rarr;',
            animation: false,
            progressSteps: ['1', '2'],
            allowOutsideClick: false
        })

        var steps = [{
                title: '匯入課程',
                text: '請輸入學號',
                showCancelButton: true,
                cancelButtonText: '取消'
            },
            '輸入 iTouch 密碼完成匯入！'
        ]

        swal.queue(steps).then(function(result) {

            swal.resetDefaults()
            $scope.login_itouch(result[0], result[1]);

        }, function() {
            window.location.href = $scope.baseUrl + 'my';
            return false;
        })
    }

    //載入已修習之課程
    $scope.loadHistory = function() {

        $http({
                url: $scope.baseUrl + 'history',
                method: "GET",
            })
            .success(function(data, status, headers, config) {

                // 如果有抓到資料就秀出來
                if (data.history_course.length !== 0) {

                    $scope.history_course_list = data.history_course;
                    return false;
                }
                $scope.inputiTouchModal();
            })
            .error(function(data, status, headers, config) {

            });
    }

    // 登出
    $scope.logout = function() {

        window.location.href = $scope.baseUrl + 'logout';
    }


    // 開啟 sidebar
    $scope.openSidebar = function() {

        $('.ui.sidebar').sidebar('toggle');
    }


    // 儲存課程
    $scope.save_course = function() {

        swal({
            title: "儲存課表",
            text: "給課表取個名稱",
            input: "text",
            showCancelButton: true,
            confirmButtonText: '儲存',
            cancelButtonText: '取消',
            showLoaderOnConfirm: true,
            preConfirm: function(inputValue) {
                return new Promise(function(resolve, reject) {

                    if (inputValue === false) {

                        toastr["error"](" ", "已放棄儲存")
                        return false;

                    } else {

                        var timestamp = new Date();
                        var rnd = Math.floor((Math.random() * 10) + timestamp.getDate() + timestamp.getDay() + timestamp.getTime() + timestamp.getSeconds());

                        $http({
                                url: $scope.baseUrl + 'course_available/save',
                                method: "POST",
                                data: $.param({
                                    "added_course": JSON.parse(angular.toJson($scope.selectCourse)),
                                    "title": inputValue,
                                    "rnd_id": rnd
                                }),
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                                },
                            })
                            .success(function(data, status, headers, config) {
                                swal("儲存完成", "儲存的課表可從個人首頁查看", "success");
                            })
                            .error(function(data, status, headers, config) {

                            });
                    }
                })
            },
            allowOutsideClick: false
        });
    }


    // 下載課程
    $scope.course_download = function() {

        var images;
        // Export to image
        html2canvas($("#course_exports"), {
            onrendered: function(canvas) {
                images = canvas.toDataURL("image/png");
                swal({
                    title: "請自行另存圖片！",
                    html: '<img src=' + images + ' class="ui image tiny centered"></img>',
                    confirmButtonText: "存好了"
                });
            },
        });
    }

    $scope.mySaveCourse = []; // 儲存的課表資訊
    $scope.mySaveCoursePoint = []; // 儲存的各課表總學分數

    // 讀取我的課表
    $scope.load_my_course = function() {

        $http({
                url: $scope.baseUrl + 'get_my_course',
                method: "GET",
            })
            .success(function(data, status, headers, config) {

                for (var i = 0; i < data.length; i++) {

                    var totalCourse = 0; // init total points

                    for (var j = 0; j < data[i].course_lists.length; j++) {

                        totalCourse += parseInt(data[i].course_lists[j].point)
                    }

                    // 取得所有課表的 id
                    $scope.mySaveCourse.push({
                        'url': data[i].rnd_id,
                        'title': data[i].title,
                        'point': totalCourse,
                        'course': data[i].course_lists,
                    });
                }


            })
            .error(function(data, status, headers, config) {

            });
    }


    // 連結到課表
    $scope.link_course = function(link) {

        window.open($scope.baseUrl + 'course/' + link, '_blank');
    }

    // 刪除課表
    $scope.remove_course = function(link) {

        $http({
                url: $scope.baseUrl + 'remove_course/' + link,
                method: "GET",
            })
            .success(function(data, status, headers, config) {

                if (data) {

                    swal("成功", "已刪除該課程", "success");

                    // 刪除課表後 UI 顯示部分也要刪除
                    angular.forEach($scope.mySaveCourse, function(val, key) {

                        if (val.url == link) {

                            $scope.mySaveCourse.splice(key, 1);
                        }
                    });
                }
            })
            .error(function(data, status, headers, config) {

            });
    }


    $scope.course_info = []; // 課表中其餘資訊
    // 使用編號讀取課表
    $scope.load_open_course = function(id) {

        $http({
                url: $scope.baseUrl + 'load_open_course/' + id,
                method: "GET",
            })
            .success(function(data, status, headers, config) {

                $scope.course_info = data.course_lists;
                var course = data.course_lists; // 將結果存在 course

                angular.forEach(course, function(val, i) {

                    $scope.pushCourseToList(course[i].phase, course[i].name, course[i].teacher);
                });
            })
            .error(function(data, status, headers, config) {

            });
    }

    // 載入已註冊人數
    $scope.joinedCounts = 0;
    $scope.load_joined = function() {

        $http({
                url: $scope.baseUrl + 'load_joined',
                method: "GET",
            })
            .success(function(data, status, headers, config) {

                $(".joined").animateNumber({ number: data });
            })
            .error(function(data, status, headers, config) {

            });
    }


    $scope.passCourse = []; // 已修習之課程
    // 抓取 itouch 課程資料
    $scope.login_itouch = function(username, password) {

        $http({
                url: $scope.baseUrl + 'load_mymentor',
                method: "POST",
                data: $.param({
                    "userId": username,
                    "password": password
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
            })
            .success(function(data, status, headers, config) {

                // 學號或密碼錯誤就終止程式
                if (data.length == 0) {

                    swal({
                        title: '失敗',
                        text: '學號或密碼錯誤！',
                        type: 'error',
                        confirmButtonText: '知道了',
                        allowOutsideClick: false
                    }).then(
                        function() {
                            $scope.inputiTouchModal();
                        },
                    )

                    return false;
                }

                var result = new Array(); // 回傳結果暫存位置
                var course_type; // 課程類別 ex. 天學、必修、體育

                var isNumOrEng = new RegExp("[A-Za-z0-9]+"); // 是否為英文或數字

                // 處理擷取到的課程課程
                angular.forEach(data, function(val, key) {

                    // 清除空格及 html tag
                    var res = result[key] = val.replace(/\s\s+/g, ' ').replace(/(<([^>]+)>)/ig, "").split(" ");
                    var demand = new Array(); // 需存入的值

                    // 排除重複資料
                    if (res[5] === "") return false;

                    // 本學期修習課程，成績尚未登陸
                    if (res[10] == "" && res[11] == "" && isNumOrEng.test(res[1])) {

                        demand = [4, 5, 6, 9, "成績未出", course_type, 1];

                        $scope.passCourse.push({
                            'year': res[demand[0]],
                            'course_id': res[demand[1]],
                            'course_name': res[demand[2]],
                            'point': res[demand[3]],
                            'score': demand[4],
                            'type': demand[5],
                            'class': demand[6]
                        });

                    } else if (res[10] == "" && res[11] == "") {

                        demand = [4, 5, 6, 9, "成績未出", course_type, 1];

                        $scope.passCourse.push({
                            'year': res[demand[0]],
                            'course_id': res[demand[1]],
                            'course_name': res[demand[2]],
                            'point': res[demand[3]],
                            'score': demand[4],
                            'type': demand[5],
                            'class': demand[6]
                        });

                        course_type == res[1]; // 換課程類別

                    } else if (res[12] == "" && res[13] == "") {

                        if (!isNumOrEng.test(res[1]) && res[1] != "") {

                            course_type = res[1];
                        }

                        demand = [5, 6, res[7] + res[8], 11, "成績未出", course_type, 2];

                        // 本學期修習之課程 (例外)
                        $scope.passCourse.push({
                            'year': res[demand[0]],
                            'course_id': res[demand[1]],
                            'course_name': demand[2],
                            'point': res[demand[3]],
                            'score': demand[4],
                            'type': demand[5],
                            'class': demand[6]
                        });
                        return false;

                    } else if (res[13] == "") {

                        if (!isNumOrEng.test(res[1]) && res[1] != "") {

                            course_type = res[1];
                        }

                        demand = [5, 6, res[7] + res[8], 11, 12, course_type, 2];

                        $scope.passCourse.push({
                            'year': res[demand[0]],
                            'course_id': res[demand[1]],
                            'course_name': demand[2],
                            'point': res[demand[3]],
                            'score': res[demand[4]],
                            'type': demand[5],
                            'class': demand[6]
                        });
                        return false;


                    } else if (res[4] == "" && res[11] == "") {

                        if (!isNumOrEng.test(res[1]) && res[1] != "") {

                            course_type = res[1];
                        }

                        demand = [5, 6, 7, 10, "成績未出", course_type, 1];

                        // 為課程類別之首，但剛好是本學期修習課程 ex. 天類 - 宗教哲學
                        $scope.passCourse.push({
                            'year': res[demand[0]],
                            'course_id': res[demand[1]],
                            'course_name': res[demand[2]],
                            'point': res[demand[3]],
                            'score': demand[4],
                            'type': demand[5],
                            'class': demand[6]
                        });

                    } else if (res[11] == "" || res[12] == "") {

                        if (!isNumOrEng.test(res[1]) && res[1] != "") {

                            course_type = res[1];

                            if (res[12] == "") {

                                demand = [5, 6, 7, 10, 11, course_type, 3];

                                // 抵免或已修習之課程
                                $scope.passCourse.push({
                                    'year': res[demand[0]],
                                    'course_id': res[demand[1]],
                                    'course_name': res[demand[2]],
                                    'point': res[demand[3]],
                                    'score': res[demand[4]],
                                    'type': demand[5],
                                    'class': demand[6]
                                });
                                return false;
                            }
                        }

                        if (res[4] != "") {

                            demand = [4, 5, 6, 9, 10, course_type, 3];

                            // 抵免或已修習之課程
                            $scope.passCourse.push({
                                'year': res[demand[0]],
                                'course_id': res[demand[1]],
                                'course_name': res[demand[2]],
                                'point': res[demand[3]],
                                'score': res[demand[4]],
                                'type': demand[5],
                                'class': demand[6]
                            });
                            return false;
                        }

                        if (res[10] == "") {

                            demand = [4, 5, 6, 9, 10, course_type, 3];

                            $scope.passCourse.push({
                                'year': res[demand[0]],
                                'course_id': res[demand[1]],
                                'course_name': res[demand[2]],
                                'point': res[demand[3]],
                                'score': res[demand[4]],
                                'type': demand[5],
                                'class': demand[6]
                            });
                            return false;
                        }
                    }
                });


                // save pass course
                $http({
                        url: $scope.baseUrl + 'pass/save',
                        method: "POST",
                        data: $.param({
                            "history_course": $scope.passCourse,
                        }),
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },
                    })
                    .success(function(data, status, headers, config) {

                        swal({
                            title: '成功',
                            text: '下載完成，系統將自動計算學分！',
                            type: 'success',
                            allowOutsideClick: false
                        }).then(
                            function() {
                                window.location.href = $scope.baseUrl + 'pass';
                            },
                        )
                    })
                    .error(function(data, status, headers, config) {

                    });
            })
            .error(function(data, status, headers, config) {

            });

        $scope.progress = function() {


        }
    }

    // 發布房屋資訊
    $scope.house_post = function() {

        $http({
                url: $scope.baseUrl + 'house/post',
                method: "POST",
                data: $.param({
                    "title": $scope.title,
                    "marker": $scope.marker,
                    "rent_price": $scope.rent_price,
                    "floor": $scope.floor,
                    "door": $scope.door,
                    "space": $scope.space,
                    "landlord_gender": $scope.landlord_gender,
                    "house_type": $scope.house_type,
                    "safe": $scope.safe,
                    "extra_pay": $scope.extra_pay,
                    "cooking": $scope.cooking,
                    "landlord_score": $scope.landlord_score,
                    "live_score": $scope.live_score,
                    "landlord_comment": $scope.landlord_comment,
                    "live_comment": $scope.live_comment,
                    "pic": images
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
            })
            .success(function(data, status, headers, config) {

                window.location.href = $scope.baseUrl;
            })
            .error(function(data, status, headers, config) {

            });
    }

    $scope.houseInfo = [];
    // 搜尋房屋資訊
    $scope.search_house = function() {

        $http({
                url: $scope.baseUrl + '/house/search',
                method: "POST",
                data: $.param({
                    "keywords": $scope.keywords
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
            })
            .success(function(data, status, headers, config) {

                if (data.length !== 0) {

                    $scope.houseInfo = data;
                    console.log(data);
                }
            })
            .error(function(data, status, headers, config) {

            });
    }


    $scope.houseIndex;
    // 進入房屋資訊頁面
    $scope.view_house = function(index) {

        $scope.houseIndex = index;
    }

    $scope.view_house_mobile = function(id) {
        window.location.href = $scope.baseUrl + 'house/' + id;
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