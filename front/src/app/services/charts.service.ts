import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ChartsService {

  url = `${environment.baseUrl}/charts`;

  constructor(private http: HttpClient) { }

  getIncomeAndExpensesToPieChart(): Promise<any> {
    return new Promise((resolve, reject) => {
      this.http.get(`${this.url}/pie-chart/income-expenses`)
        .subscribe((data: any) => resolve(data.data_chart));
    })
  }

  getIncomeAndExpensesToGenericChart(): Promise<any> {
    return new Promise((resolve, reject) => {
      this.http.get(`${this.url}/generic-chart/income-expenses`)
        .subscribe((data: any) => resolve(data.data_chart));
    })
  }

  getBenefitToGenericChart(): Promise<any> {
    return new Promise((resolve, reject) => {
      this.http.get(`${this.url}/generic-chart/benefit`)
        .subscribe((data: any) => resolve(data.data_chart));
    })
  }

}
