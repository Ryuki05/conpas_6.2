document.addEventListener("DOMContentLoaded", function () {
    var ctxWeight = document.getElementById('weightChart').getContext('2d');
    var ctxHeight = document.getElementById('heightChart').getContext('2d');
    var ctxMuscleMass = document.getElementById('muscleMassChart').getContext('2d');
    var ctxBMI = document.getElementById('bmiChart').getContext('2d');

    // Weight Chartの初期化
    var weightChart = new Chart(ctxWeight, {
        type: 'line',
        data: {
            labels: days,
            datasets: [{
                label: 'Weight (kg)',
                data: weightData,
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                backgroundColor: 'rgba(255, 99, 132, 1)',
                pointStyle: 'circle',
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            // グラフのオプションを追加する場合はここに追加
        }
    });

    // Height Chartの初期化
    var heightChart = new Chart(ctxHeight, {
        type: 'line',
        data: {
            labels: days,
            datasets: [{
                label: 'Height (cm)',
                data: heightData,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                pointStyle: 'circle',
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            // グラフのオプションを追加する場合はここに追加
        }
    });

    // Muscle Mass Chartの初期化
    var muscleMassChart = new Chart(ctxMuscleMass, {
        type: 'line',
        data: {
            labels: days,
            datasets: [{
                label: 'Muscle Mass (kg)',
                data: muscleMassData,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                pointStyle: 'circle',
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            // グラフのオプションを追加する場合はここに追加
        },
    });

    // BMI Chartの初期化
    var bmiChart = new Chart(ctxBMI, {
        type: 'line',
        data: {
            labels: days,
            datasets: [{
                label: 'BMI',
                data: bmiData,
                borderColor: 'rgba(153, 102, 255, 1)',
                backgroundColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1,
                pointStyle: 'circle',
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            // グラフのオプションを追加する場合はここに追加
        }
    });
});

// document.addEventListener("DOMContentLoaded", function () {
//     var ctxCombined = document.getElementById('combinedChart').getContext('2d');

//     var combinedChart = new Chart(ctxCombined, {
//         type: 'line',
//         data: {
//             labels: days,
//             datasets: [
//                 {
//                     label: 'Weight (kg)',
//                     data: weightData,
//                     borderColor: 'rgba(255, 99, 132, 1)',
//                     backgroundColor: 'rgba(255, 99, 132, 0.5)',
//                     borderWidth: 2,
//                     pointStyle: 'circle',
//                     pointRadius: 5,
//                     pointHoverRadius: 8
//                 },
//                 {
//                     label: 'Height (cm)',
//                     data: heightData,
//                     borderColor: 'rgba(54, 162, 235, 1)',
//                     backgroundColor: 'rgba(54, 162, 235, 0.5)',
//                     borderWidth: 1,
//                     pointStyle: 'circle',
//                     pointRadius: 5,
//                     pointHoverRadius: 8
//                 },
//                 {
//                     label: 'Muscle Mass (kg)',
//                     data: muscleMassData,
//                     borderColor: 'rgba(75, 192, 192, 1)',
//                     backgroundColor: 'rgba(75, 192, 192, 0.5)',
//                     borderWidth: 1,
//                     pointStyle: 'circle',
//                     pointRadius: 5,
//                     pointHoverRadius: 8
//                 },
//                 {
//                     label: 'BMI',
//                     data: bmiData,
//                     borderColor: 'rgba(153, 102, 255, 1)',
//                     backgroundColor: 'rgba(153, 102, 255, 0.5)',
//                     borderWidth: 1,
//                     pointStyle: 'circle',
//                     pointRadius: 5,
//                     pointHoverRadius: 8
//                 }
//             ]
//         },
//         options: {
//             // グラフのオプションを追加する場合はここに追加
//         }
//     });
// });
