/*************************************************************************************/
// -->Template Name: Ideia Admin
// -->Author: Belostemas
// -->Email: belostemas@gmail.com
// -->File: c3_chart_JS
/*************************************************************************************/
$(function() {
    var i = c3.generate({
        bindto: "#tick-fitting",
        size: { height: 400 },
        color: { pattern: ["#2962FF", "#E91E63"] },
        data: {
            x: "x",
            columns: [
                ["x", "2020-01-31", "2020-02-31", "2020-03-31", "2020-04-28"],
                ["days", 150, 400, 100, 30]

            ]
        },
        axis: { x: { type: "timeseries", tick: { fit: !0, format: "%e %b %y" } } },
        grid: { y: { show: !0 } }
    });
});