import { Component, Input, AfterViewInit } from '@angular/core';
import Chart from 'node_modules/chart.js';

@Component({
  selector: 'app-pie-chart',
  templateUrl: './pie-chart.component.html',
  styleUrls: ['./pie-chart.component.scss']
})
export class PieChartComponent implements AfterViewInit {

  @Input() documents: Document[] = [];
  chart: Chart;

  constructor() { }

  ngAfterViewInit() {
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
        labels: ['Luz', 'Agua', 'Internet'],
        datasets: [
          {
            data: [10, 20, 15],
            backgroundColor: ['rgba(245, 220, 32, 0.8)', 'rgba(8, 99, 209, 0.8)', 'rgba(178, 79, 227, 0.8)'],
          }
        ],
      },
      options: {
        responsive: false,
        maintainAspectRatio: true,
        legend: {
          position: 'right'
        }
      }
    });
  }

}
