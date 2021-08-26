const url = "http://localhost/crawl_data/api/getInfected.php";

fetch(url)
  .then((res) => {
    return res.json();
  })
  .then((data) => {
    getData(data);
  })
  .catch((error) => {
    return error;
  });

function getData(data) {
  getLastUpdate();
  getInfected(data.api.infected);
  getDataToday(data.api.today);
  getCircleData(data.api.circle);
  getChart(data.api.date, data.api.sevenday, data.api.recovered);
}

function getLastUpdate() {
  const d = new Date();
  document.getElementById("time").innerHTML = d;
}


function getInfected(data) {
  for (let i = 0; i < data.length; i++) {
    document.querySelectorAll(".card-number")[i].innerHTML = data[i];
  }
}

function getDataToday(data) {
  for (let i = 0; i < data.length; i++) {
    document.querySelectorAll(".card-number-today")[i].innerHTML = data[i];
  }
}


// *Chart
function getCircleData(data) {
  var xValues = ["Số ca nhiễm", "Hồi phục", "Đang điều trị", "Tử vong"];
  var yValues = [];
  for (let i = 0; i < data.length; i++) {
    yValues.push(data[i]);
  }
  var barColors = ["#b91d47", "#1e7145", "#2b5797", "rgba(0,0,0,0.8)"];

  new Chart("chart-circle", {
    type: "doughnut",
    data: {
      labels: xValues,
      datasets: [
        {
          backgroundColor: barColors,
          data: yValues,
        },
      ],
    },
    options: {
      title: {
        display: true,
      },
    },
  });
}

function getChart(x, y, z) {
  var xValues = [];
  var yValues = [];
  var zValues = [];

  for (let i = 0; i < x.length; i++) {
    xValues.push(x[i]);
    yValues.push(y[i] * 1000);
    zValues.push(z[i]);
  }
  console.log(xValues);
  console.log(yValues);
  console.log(zValues);

  new Chart("chart-square", {
    type: "line",
    data: {
      labels: xValues,
      datasets: [
        {
          data: yValues,
          borderColor: "red",
          fill: true,
          label: "Số ca nhiễm",
        },
        {
          data: zValues,
          borderColor: "green",
          fill: true,
          label: "Hồi phục",
        },
      ],
    },
    options: {
      legend: {
        display: true,
      },
      scales: {
        yAxes: [
          {
            ticks: {
              // min: 500,
              // max: 200000
            },
          },
        ],
      },
    },
  });
}
