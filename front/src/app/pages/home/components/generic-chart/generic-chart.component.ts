import { Component, OnInit } from '@angular/core';
import Chart from 'node_modules/chart.js';
import { ChartsService } from 'src/app/services/charts.service';

@Component({
  selector: 'app-generic-chart',
  templateUrl: './generic-chart.component.html',
  styleUrls: ['./generic-chart.component.scss'],
  host: {
    '(window:resize)': 'onResize($event)'
  }
})
export class GenericChartComponent implements OnInit {

  chart: Chart;
  dataChart;
  
  chartType: 'bar'|'line' = 'bar';
  // toChartTypeText = 'cambiar a lineas';
  
  titleChart = 'Ingresos y gastos este año';
  
  chartDataset: 'income-expenses'|'benefit' = 'income-expenses';
  toChartDatasetText = 'ver beneficio';
  

  constructor(
    private chartsService: ChartsService
  ) { }

  async ngOnInit() {
    this.dataChart = await this.chartsService.getIncomeAndExpensesToGenericChart();
    setTimeout(() => this.createChart());
  }

  onResize(event) {
    this.chart.destroy();
    setTimeout(() => {
      this.createChart();
    });
  }

  async changeChartFromDatasetType() {
    if (this.chartDataset === 'income-expenses') {
      this.dataChart = await this.chartsService.getBenefitToGenericChart();
      this.chartDataset = 'benefit';
      this.titleChart = 'Beneficios este año';
      this.toChartDatasetText = 'ver ingresos y gastos';
    } else {
      this.dataChart = await this.chartsService.getIncomeAndExpensesToGenericChart();
      this.chartDataset = 'income-expenses';
      this.titleChart = 'Ingresos y gastos este año';
      this.toChartDatasetText = 'ver beneficio';
    }
    this.chart.destroy();
    this.createChart();
  }

  private createChart() {
    const ctx = document.getElementById('generic-chart');
    if (this.chart) {
      this.chart.destroy();
    }
    this.chart = new Chart(ctx, {
      type: this.chartType,
      data: {
        labels: this.dataChart.labels,
        datasets: this.dataChart.datasets
      },
      options: {
        onResize: function(chart, size) {
          chart.options.legend.display = size.height > 128;
          chart.update();
        },
        legend: {
          display: this.chartDataset === 'income-expenses'
        },
        responsive: true,
        maintainAspectRatio: true,
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  }

}
