@extends('layout.main') @section('content')

<!-- Grid -->
<div class="ui grid stackable">
    <div class="seven wide column">
        <div class="ui pointing secondary menu">
            <a class="item active" data-tab="first">搜尋課程</a>
            <a class="item" data-tab="second">已選課程</a>
            <a class="item">
                <% selectPoints %> / 22</a>
        </div>
        <!-- 搜尋課程 -->
        <div class="ui bottom basic tab segment active" data-tab="first">

            <!-- 搜尋列 -->
            <div class="ui fluid icon input">
                <input type="text" ng-model="keywords" placeholder="課程 / 老師" press-Enter="search()">
                <i class="search icon"></i>
            </div>

            <!-- 搜尋結果列 -->
            <div class="lists-max-height">
                <div class="ui card fluid" ng-repeat="item in course">
                    <div class="content">
                        <i class="right floated star icon"></i>
                        <div class="header">
                            <a target="_blank" href="https://coursewiki.clouder.today/courses/<% item.course_id %>">
                                <% item.course_name %> /
                                    <% item.teacher %> /
                                        <% item.com_or_opt %>
                            </a>
                        </div>
                        <div class="description">
                            <p>
                                上課時段：
                                <% item.time_1 | removeDot %>
                                    <% item.time_2 | removeDot %>
                                        <% item.time_3 | removeDot %><br /> 開課系級：
                                            <% item.class %>
                            </p>
                        </div>
                    </div>
                    <div class="extra content">
                        <span class="left floated like">
                            <% item.course_id %>
                        </span>
                        <span class="right floated star">
                            <% item.point %> 學分
                        </span>
                    </div>
                    <div class="ui bottom attached button" ng-click="addCourse(item.course_id , item.course_name, item.teacher, item.time_1, item.time_2, item.time_3, item.com_or_opt, item.point, item.class)">
                        <i class="add icon green"></i>加選
                    </div>
                </div>
            </div>

        </div>

        <!-- 加選課程 -->
        <div class="ui bottom basic tab segment" data-tab="second">

            <!-- 加選結果列 -->
            <div class="lists-max-height">
                <div class="ui card fluid" ng-repeat="item in selectCourse" ng-if="item.id!==undefined">
                    <div class="content">
                        <i class="right floated star icon"></i>
                        <div class="header">
                            <a target="_blank" href="https://coursewiki.clouder.today/courses/<% item.course_id %>">
                                <% item.name %> /
                                    <% item.teacher %> /
                                        <% item.com_or_opt %>
                            </a>
                        </div>
                        <div class="description">
                            <p>
                                上課時段：
                                <% item.time_1 %>
                                    <% item.time_2 %>
                                        <% item.time_3 %><br /> 開課系級：
                                            <% item.class %>
                            </p>
                        </div>
                    </div>
                    <div class="extra content">
                        <span class="left floated like">
                            <% item.id %>
                        </span>
                        <span class="right floated star">
                            <% item.point %> 學分
                        </span>
                    </div>
                    <div class="ui bottom attached button" ng-click="minusCourse(item.id)">
                        <i class="minus icon red"></i>退選
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="nine wide column">

        <div class="ui small basic icon buttons right floated">
            <button class="ui button" id="export"><i class="cloud download icon"></i></button>
            <button class="ui button" ng-click="save_course()"><i class="save icon"></i></button>
        </div>

        <div class="course_scroll">
            <table class="ui unstackable celled inverted table" id="course_exports">
                <thead>
                    <tr class="center aligned">
                        <th></th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                        <th>Sun</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="08:10 ~ 09:00" data-position="top left">1</td>
                        <td class="course_block" data-tooltip="<% course_date[0].teacher %>" data-position="top left">
                            <% course_date[0].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[1].teacher %>" data-position="top left">
                            <% course_date[1].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[2].teacher %>" data-position="top left">
                            <% course_date[2].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[3].teacher %>" data-position="top left">
                            <% course_date[3].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[4].teacher %>" data-position="top left">
                            <% course_date[4].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[5].teacher %>" data-position="top left">
                            <% course_date[5].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[6].teacher %>" data-position="top left">
                            <% course_date[6].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="09:10 ~ 10:00" data-position="top left">2</td>
                        <td class="course_block" data-tooltip="<% course_date[7].teacher %>" data-position="top left">
                            <% course_date[7].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[8].teacher %>" data-position="top left">
                            <% course_date[8].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[9].teacher %>" data-position="top left">
                            <% course_date[9].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[10].teacher %>" data-position="top left">
                            <% course_date[10].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[11].teacher %>" data-position="top left">
                            <% course_date[11].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[12].teacher %>" data-position="top left">
                            <% course_date[12].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[13].teacher %>" data-position="top left">
                            <% course_date[13].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="10:10 ~ 11:00" data-position="top left">3</td>
                        <td class="course_block" data-tooltip="<% course_date[14].teacher %>" data-position="top left">
                            <% course_date[14].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[15].teacher %>" data-position="top left">
                            <% course_date[15].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[16].teacher %>" data-position="top left">
                            <% course_date[16].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[17].teacher %>" data-position="top left">
                            <% course_date[17].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[18].teacher %>" data-position="top left">
                            <% course_date[18].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[19].teacher %>" data-position="top left">
                            <% course_date[19].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[20].teacher %>" data-position="top left">
                            <% course_date[20].id %>
                        </td>

                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="11:10 ~ 12:00" data-position="top left">4</td>
                        <td class="course_block" data-tooltip="<% course_date[21].teacher %>" data-position="top left">
                            <% course_date[21].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[22].teacher %>" data-position="top left">
                            <% course_date[22].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[23].teacher %>" data-position="top left">
                            <% course_date[23].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[24].teacher %>" data-position="top left">
                            <% course_date[24].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[25].teacher %>" data-position="top left">
                            <% course_date[25].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[26].teacher %>" data-position="top left">
                            <% course_date[26].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[27].teacher %>" data-position="top left">
                            <% course_date[27].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="13:10 ~ 14:00" data-position="top left">5</td>
                        <td class="course_block" data-tooltip="<% course_date[28].teacher %>" data-position="top left">
                            <% course_date[28].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[29].teacher %>" data-position="top left">
                            <% course_date[29].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[30].teacher %>" data-position="top left">
                            <% course_date[30].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[31].teacher %>" data-position="top left">
                            <% course_date[31].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[32].teacher %>" data-position="top left">
                            <% course_date[32].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[33].teacher %>" data-position="top left">
                            <% course_date[33].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[34].teacher %>" data-position="top left">
                            <% course_date[34].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="14:10 ~ 15:00" data-position="top left">6</td>
                        <td class="course_block" data-tooltip="<% course_date[35].teacher %>" data-position="top left">
                            <% course_date[35].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[36].teacher %>" data-position="top left">
                            <% course_date[36].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[37].teacher %>" data-position="top left">
                            <% course_date[37].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[38].teacher %>" data-position="top left">
                            <% course_date[38].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[39].teacher %>" data-position="top left">
                            <% course_date[39].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[40].teacher %>" data-position="top left">
                            <% course_date[40].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[41].teacher %>" data-position="top left">
                            <% course_date[41].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="15:10 ~ 16:00" data-position="top left">7</td>
                        <td class="course_block" data-tooltip="<% course_date[42].teacher %>" data-position="top left">
                            <% course_date[42].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[43].teacher %>" data-position="top left">
                            <% course_date[43].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[44].teacher %>" data-position="top left">
                            <% course_date[44].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[45].teacher %>" data-position="top left">
                            <% course_date[45].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[46].teacher %>" data-position="top left">
                            <% course_date[46].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[47].teacher %>" data-position="top left">
                            <% course_date[47].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[48].teacher %>" data-position="top left">
                            <% course_date[48].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="16:10 ~ 17:00" data-position="top left">8</td>
                        <td class="course_block" data-tooltip="<% course_date[49].teacher %>" data-position="top left">
                            <% course_date[49].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[50].teacher %>" data-position="top left">
                            <% course_date[50].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[51].teacher %>" data-position="top left">
                            <% course_date[51].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[52].teacher %>" data-position="top left">
                            <% course_date[52].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[53].teacher %>" data-position="top left">
                            <% course_date[53].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[54].teacher %>" data-position="top left">
                            <% course_date[54].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[55].teacher %>" data-position="top left">
                            <% course_date[55].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="17:05 ~ 17:55" data-position="top left">C</td>
                        <td class="course_block" data-tooltip="<% course_date[56].teacher %>" data-position="top left">
                            <% course_date[56].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[57].teacher %>" data-position="top left">
                            <% course_date[57].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[58].teacher %>" data-position="top left">
                            <% course_date[58].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[59].teacher %>" data-position="top left">
                            <% course_date[59].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[60].teacher %>" data-position="top left">
                            <% course_date[60].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[61].teacher %>" data-position="top left">
                            <% course_date[61].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[62].teacher %>" data-position="top left">
                            <% course_date[62].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="18:00 ~ 18:50" data-position="top left">D</td>
                        <td class="course_block" data-tooltip="<% course_date[63].teacher %>" data-position="top left">
                            <% course_date[63].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[64].teacher %>" data-position="top left">
                            <% course_date[64].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[65].teacher %>" data-position="top left">
                            <% course_date[65].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[66].teacher %>" data-position="top left">
                            <% course_date[66].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[67].teacher %>" data-position="top left">
                            <% course_date[67].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[68].teacher %>" data-position="top left">
                            <% course_date[68].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[69].teacher %>" data-position="top left">
                            <% course_date[69].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="18:55 ~ 19:45" data-position="top left">E</td>
                        <td class="course_block" data-tooltip="<% course_date[70].teacher %>" data-position="top left">
                            <% course_date[70].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[71].teacher %>" data-position="top left">
                            <% course_date[71].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[72].teacher %>" data-position="top left">
                            <% course_date[72].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[73].teacher %>" data-position="top left">
                            <% course_date[73].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[74].teacher %>" data-position="top left">
                            <% course_date[74].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[75].teacher %>" data-position="top left">
                            <% course_date[75].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[76].teacher %>" data-position="top left">
                            <% course_date[76].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="19:50 ~ 20:40" data-position="top left">F</td>
                        <td class="course_block" data-tooltip="<% course_date[77].teacher %>" data-position="top left">
                            <% course_date[77].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[78].teacher %>" data-position="top left">
                            <% course_date[78].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[79].teacher %>" data-position="top left">
                            <% course_date[79].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[80].teacher %>" data-position="top left">
                            <% course_date[80].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[81].teacher %>" data-position="top left">
                            <% course_date[81].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[82].teacher %>" data-position="top left">
                            <% course_date[82].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[83].teacher %>" data-position="top left">
                            <% course_date[83].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="20:45 ~ 21:35" data-position="top left">G</td>
                        <td class="course_block" data-tooltip="<% course_date[84].teacher %>" data-position="top left">
                            <% course_date[84].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[85].teacher %>" data-position="top left">
                            <% course_date[85].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[86].teacher %>" data-position="top left">
                            <% course_date[86].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[87].teacher %>" data-position="top left">
                            <% course_date[87].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[88].teacher %>" data-position="top left">
                            <% course_date[88].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[89].teacher %>" data-position="top left">
                            <% course_date[89].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[90].teacher %>" data-position="top left">
                            <% course_date[90].id %>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
<!-- GridEnd -->

@endsection