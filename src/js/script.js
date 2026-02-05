// ================================================================================
// script.js
// 案件用のスクリプトファイル
// ================================================================================

// DOM Read for Vanilla
// --------------------------------------------------------------- //

document.addEventListener("DOMContentLoaded", () => {});

// DOM Read for jQuery
// --------------------------------------------------------------- //
jQuery(function ($) {
  console.log("jqueryを使えるぞい");
  $("body").addClass("success");
});

// ハンバーガーメニュー
jQuery(function ($) {
  $(".toggle_btn").click(function () {
    $(this).toggleClass("active");
    $(".site-navigation").toggleClass("active");
  });
});

//チャート
jQuery(function () {
  // chart01
  //   var canvas1 = document.getElementById("chart01");
  //   if (canvas1) {
  //     new Chart(canvas1.getContext("2d"), {
  //       type: "bar",
  //       data: {
  //         labels: ["Aさん", "Bさん", "Cさん", "Dさん"],
  //         datasets: [
  //           {
  //             label: "得点",
  //             data: [40, 20, 70, 60],
  //             backgroundColor: [
  //               "rgba(255, 99, 132, 0.4)",
  //               "rgba(54, 162, 235, 0.4)",
  //               "rgba(255, 206, 86, 0.4)",
  //               "rgba(75, 192, 192, 0.4)",
  //             ],
  //             borderColor: [
  //               "rgba(255,99,132,1)",
  //               "rgba(54, 162, 235, 1)",
  //               "rgba(255, 206, 86, 1)",
  //               "rgba(75, 192, 192, 1)",
  //             ],
  //             borderWidth: 1,
  //           },
  //         ],
  //       },
  //       options: {
  //         scales: {
  //           yAxes: [
  //             {
  //               ticks: {
  //                 beginAtZero: true,
  //                 max: 100,
  //               },
  //             },
  //           ],
  //         },
  //       },
  //     });
  //   }
  // chart02
  //   var canvas2 = document.getElementById("chart02");
  //   if (canvas2) {
  //     new Chart(canvas2.getContext("2d"), {
  //       type: "bar",
  //       data: {
  //         labels: ["Eさん", "Fさん", "Gさん", "Hさん"],
  //         datasets: [
  //           {
  //             label: "得点",
  //             data: [55, 80, 30, 90],
  //             backgroundColor: "rgba(153, 102, 255, 0.4)",
  //             borderColor: "rgba(153, 102, 255, 1)",
  //             borderWidth: 1,
  //           },
  //         ],
  //       },
  //       options: {
  //         scales: {
  //           yAxes: [
  //             {
  //               ticks: {
  //                 beginAtZero: true,
  //                 max: 100,
  //               },
  //             },
  //           ],
  //         },
  //       },
  //     });
  //   }
});

jQuery(function ($) {
  // chart01
  var canvas1 = document.getElementById("chart01");
  if (canvas1 && typeof chart01Labels !== "undefined") {
    new Chart(canvas1.getContext("2d"), {
      type: "bar",
      data: {
        labels: chart01Labels,
        datasets: [
          {
            label: "2025年",
            data: chart01Data,
            backgroundColor: "#F2FFF2",
            borderColor: "#F2FFF2",
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                max: 500,
              },
            },
          ],
        },
      },
    });
  }

  // chart02
  var canvas2 = document.getElementById("chart02");
  if (canvas2 && typeof chart02Labels !== "undefined") {
    new Chart(canvas2.getContext("2d"), {
      type: "bar",
      data: {
        labels: chart02Labels,
        datasets: [
          {
            label: chart02Label,
            data: chart02Data,
            backgroundColor: "#c4ea8f",
            borderColor: "#c4ea8f",
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                max: 8000,
              },
            },
          ],
        },
      },
    });
  }
});

jQuery(function () {
  //.accordion_oneの中の.accordion_headerがクリックされたら
  jQuery(".archive-list__date").click(function () {
    //クリックされた.accordion_oneの中の.accordion_headerに隣接する.accordion_innerが開いたり閉じたりする。
    jQuery(this).next(".archive-list__items").slideToggle();
    jQuery(this).toggleClass("open");
  });
  jQuery(".wp-block-qa-item__title").click(function () {
    //クリックされた.accordion_oneの中の.accordion_headerに隣接する.accordion_innerが開いたり閉じたりする。
    jQuery(this).next(".wp-block-qa-item__detail").slideToggle();
    jQuery(this).toggleClass("open");
  });
});
