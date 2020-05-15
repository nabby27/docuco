import { Component, OnInit, HostListener } from '@angular/core';
import Chart from 'chart.js';
import { ChartsService } from 'src/app/services/charts.service';

@Component({
  selector: 'app-pie-chart',
  templateUrl: './pie-chart.component.html',
  styleUrls: ['./pie-chart.component.scss'],
})
export class PieChartComponent implements OnInit {

  chart: Chart;
  dataChart;

  constructor(
    private chartsService: ChartsService
  ) { }


  @HostListener('window:resize', ['$event']) onWindowResize(event) {
    this.onResize(event);
  }

  async ngOnInit() {
    this.dataChart = await this.chartsService.getIncomeAndExpensesToPieChart();
    setTimeout(() => this.createChart());
  }

  onResize(event) {
    this.chart.destroy();
    setTimeout(() => {
      this.createChart();
    });
  }

  private createChart() {
    const ctx = document.getElementById('pie-chart') as HTMLCanvasElement;
    if (this.chart) {
      this.chart.destroy();
    }
    this.chart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: this.dataChart.labels,
        datasets: [
          {
            data: this.dataChart.data,
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
