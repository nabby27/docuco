import { Component, Input, AfterViewInit } from '@angular/core';
import Chart from 'node_modules/chart.js';

@Component({
  selector: 'app-bar-chart',
  templateUrl: './bar-chart.component.html',
  styleUrls: ['./bar-chart.component.scss']
})
export class BarChartComponent implements AfterViewInit {

  @Input() documents: Document[] = [];
  chart: Chart;

  constructor() { }

  ngAfterViewInit() {
    this.createChart();
  }

  private createChart() {
    const ctx = document.getElementById('bar-chart');
    if (this.chart) {
      this.chart.destroy();
    }
    this.chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
        datasets: [
          {
            label: 'Ingresos',
            backgroundColor: 'rgba(0, 174, 255, 0.8)',
            data: [10, 20, 15, 12, 10, 20, 15, 12, 10, 20, 13, 21]
          },
          {
            label: 'Gastos',
            backgroundColor: 'rgba(255, 46, 23, 0.6)',
            data: [15, 12, 20, 10, 15, 12, 20, 10, 15, 12, 20, 10]
          }
        ]
      },
      options: {
        responsive: false,
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
