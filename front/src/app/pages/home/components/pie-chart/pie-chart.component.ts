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
        labels: ['Ingresos', 'Gastos'],
        datasets: [
          {
            data: [10, 15],
            backgroundColor: ['rgba(0, 174, 255, 0.8)', 'rgba(255, 46, 23, 0.6)'],
          }
        ],
      },
      options: {
        responsive: false,
        maintainAspectRatio: true,
        legend: {
          position: 'bottom'
        }
      }
    });
  }

}
