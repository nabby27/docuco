import { Component, Input, AfterViewInit } from '@angular/core';
import Chart from 'node_modules/chart.js';
import { ChartsService } from 'src/app/services/charts.service';

@Component({
  selector: 'app-generic-chart',
  templateUrl: './generic-chart.component.html',
  styleUrls: ['./generic-chart.component.scss']
})
export class GenericChartComponent implements AfterViewInit {

  @Input() documents: Document[] = [];
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

  async ngAfterViewInit() {
    this.dataChart = await this.chartsService.getIncomeAndExpensesToGenericChart();
    this.createChart();
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
    const ctx = document.getElementById('bar-chart');
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
        responsive: true,
        maintainAspectRatio: true,
        scales: {
          // legend: this.dataChart?.legend,
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
