import { Component, OnInit, HostListener } from '@angular/core';
import Chart from 'chart.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';
import { ChartsService } from 'src/app/services/charts.service';

@Component({
  selector: 'app-generic-chart',
  templateUrl: './generic-chart.component.html',
  styleUrls: ['./generic-chart.component.scss']
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

  @HostListener('window:resize', ['$event']) onWindowResize(event) {
    this.onResize(event);
  }

  async ngOnInit() {
    Chart.plugins.unregister(ChartDataLabels);
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
    const ctx = document.getElementById('generic-chart') as HTMLCanvasElement;
    if (this.chart) {
      this.chart.destroy();
    }
    this.chart = new Chart(ctx, {
      type: this.chartType,
      data: {
        labels: this.dataChart.labels,
        datasets: this.dataChart.datasets
      },
      plugins: [ChartDataLabels],
      options: {
        // onResize(chart: Chart, size: Chart.ChartSize) {
        //   chart.options.legend.display = size.height > 128;
        //   chart.update();
        // },
        legend: {
          display: this.chartDataset === 'income-expenses'
        },
        layout: {
          padding: {
            left: 0,
            right: 0,
            top: this.chartDataset === 'benefit' ? 20 : 0,
            bottom: 0
          }
        },
        responsive: true,
        maintainAspectRatio: true,
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        plugins: {
          datalabels: {
            anchor: 'end',
            align: 'end',
            offset: 3
          }
        }
      }
    });
  }

}
