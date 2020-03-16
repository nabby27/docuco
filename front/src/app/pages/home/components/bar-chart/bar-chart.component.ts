import { Component, Input, AfterViewInit } from '@angular/core';
import Chart from 'node_modules/chart.js';
import { DocumentsService } from 'src/app/services/documents.service';

@Component({
  selector: 'app-bar-chart',
  templateUrl: './bar-chart.component.html',
  styleUrls: ['./bar-chart.component.scss']
})
export class BarChartComponent implements AfterViewInit {

  @Input() documents: Document[] = [];
  chart: Chart;
  data;

  constructor(
    private documentsService: DocumentsService
  ) { }

  async ngAfterViewInit() {
    this.data = await this.documentsService.getDocumentsToBarChart();
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
        labels: this.data.labels,
        datasets: [
          {
            label: 'Ingresos',
            backgroundColor: 'rgba(0, 174, 255, 0.8)',
            data: this.data.income
          },
          {
            label: 'Gastos',
            backgroundColor: 'rgba(255, 46, 23, 0.6)',
            data: this.data.expenses
          }
        ]
      },
      options: {
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
