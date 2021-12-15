window.addEventListener("load", () => {
  // Set theme
  am4core.useTheme(am4themes_animated);

  // Create chart instance
  const chart = am4core.create("nm-graph-amchart", am4charts.PieChart);

  // Configure chart
  chart.innerRadius = am4core.percent(60);

  // Add data
  chart.data = [
    {
      source: "Direct emissions from our own activites",
      emissions: 2962,
      color: am4core.color("#2DC850"),
    },
    {
      source: "Indirect emissions from energy usage",
      emissions: 18775,
      color: am4core.color("#cccccc"),
    },
    {
      source: "Indirect actions form our value-chain.",
      emissions: 260811,
      color: am4core.color("#000000"),
    },
  ];

  // Add and configure Series
  let pieSeries = chart.series.push(new am4charts.PieSeries());
  pieSeries.dataFields.value = "emissions";
  pieSeries.dataFields.category = "source";
  pieSeries.slices.template.propertyFields.fill = "color";
  pieSeries.slices.template.propertyFields.stroke = "stroke";
  pieSeries.slices.template.tooltipText = "";
  pieSeries.ticks.template.disabled = true;
  pieSeries.labels.template.disabled = true;
  pieSeries.slices.template.hiddenState.properties.shiftRadius = 1;
  pieSeries.slices.template.showOnInit = true;

  pieSeries.slices.template.events.on("over", function (ev) {
    document
      .querySelector(
        '.legend-item[data-item-id="' + ev.target.dataItem.index + '"]'
      )
      .classList.add("active-slice");
  });

  pieSeries.slices.template.events.on("out", function (ev) {
    document
      .querySelector(
        '.legend-item[data-item-id="' + ev.target.dataItem.index + '"]'
      )
      .classList.remove("active-slice");
  });

  chart.events.on("ready", function (event) {
    let dataItemsSum = 0;

    // populate our custom legend when chart renders
    chart.customLegend = document.getElementById("legend");

    pieSeries.dataItems.each(function (row, i) {
      let color = row.dataContext.color;
      let percent = Math.round(row.values.value.percent);
      let value = row.value;
      let category = row.category;
      let legendInnerHtml = "";
      dataItemsSum += value;

      legendInnerHtml += '<li class="legend-item" data-item-id="' + i + '" >';
      legendInnerHtml += '<div class="legend-item-top">';
      legendInnerHtml +=
        '<div class="legend-item-percent item-percent-' +
        i +
        '" style="color:' +
        color +
        '">' +
        percent +
        "%</div>";
      legendInnerHtml +=
        '<div class="legend-item-emission">' + value + " T/CO2</div>";
      legendInnerHtml += "</div>";
      legendInnerHtml += '<div class="legend-item-bottom">';
      legendInnerHtml += '<div class="legend-item-source">';
      legendInnerHtml += "<p>" + category + "</p>";
      legendInnerHtml += "</div>";
      legendInnerHtml += "</div>";
      legendInnerHtml += "</li>";

      legend.innerHTML += legendInnerHtml;
    });

    // Add sum inside chart
    const label = pieSeries.createChild(am4core.Label);

    label.html =
      '<div class="items-sum"><div class="items-sum-top">' +
      dataItemsSum +
      '</div><div class="items-sum-bottom">T/CO2</div></div>';
    label.fontFamily = "Bison, cursive";
    label.horizontalCenter = "middle";
    label.verticalCenter = "middle";
    label.contentAlign = "middle";
    label.fontSize = 48;

    function hoverSlice(item) {
      let slice = pieSeries.slices.getIndex(item);
      slice.isHover = true;
    }

    function blurSlice(item) {
      let slice = pieSeries.slices.getIndex(item);
      slice.isHover = false;
    }

    function toggleSlice(item) {
      let slice = pieSeries.slices.getIndex(item);
      slice.isActive = !slice.isActive;
    }

    let legendItems = document.querySelectorAll(".legend-item");
    legendItems.forEach((legendItem) => {
      legendItem.addEventListener("mouseover", function () {
        hoverSlice(legendItem.dataset.itemId);
      });
      legendItem.addEventListener("mouseleave", function () {
        blurSlice(legendItem.dataset.itemId);
      });
      legendItem.addEventListener("click", function () {
        toggleSlice(legendItem.dataset.itemId);
      });
    });
  });
});
