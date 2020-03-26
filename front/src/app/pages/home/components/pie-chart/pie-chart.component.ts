import { Component, Input, AfterViewInit } from '@angular/core';
import Chart from 'node_modules/chart.js';
import { ChartsService } from 'src/app/services/charts.service';

@Component({
  selector: 'app-pie-chart',
  templateUrl: './pie-chart.component.html',
  styleUrls: ['./pie-chart.component.scss']
})
export class PieChartComponent implements AfterViewInit {

  @Input() documents: Document[] = [];
  chart: Chart;
  data;

  constructor(
    private chartsService: ChartsService
  ) { }

  async ngAfterViewInit() {
    this.data = await this.chartsService.getIncomeAndExpensesToPieChart();
    this.createChart();
  }

  private createChart() {
    const ctx = document.getElementById('pie-chart');
    if (this.chart) {
      this.chart.destroy();
    }
    this.chart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: this.data.labels,
        datasets: [
          {
            data: this.data.data,
            backgroundColor: ['rgba(0, 174, 255, 0.8)', 'rgba(255, 46, 23, 0.6)'],
          }
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        legend: {
          position: 'bottom'
        }
      }
    });
  }

}
