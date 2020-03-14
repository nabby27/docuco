import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Document } from '../entities/document';

@Injectable({
  providedIn: 'root'
})
export class DocumentsService {

  url = `${environment.baseUrl}/documents`;

  constructor(private http: HttpClient) { }

  getAllDocuments(): Promise<Document[]> {
    return new Promise((resolve, reject) => {
      this.http.get<Document[]>(this.url).pipe(map((response: any) => response.documents))
        .subscribe((documents: Document[]) => resolve(documents));
    })
  }

  getDataChartToIncomeExpenseThisYear(): Promise<any> {
    return new Promise((resolve, reject) => {
      this.http.get<any>(`${this.url}/data-charts/income-expense-this-year`).pipe(map((response: any) => response.data))
        .subscribe((data: any) => resolve(data));
    })
  }

  getDataChartToExpenseByTagsThisYear() {
    return new Promise((resolve, reject) => {
      this.http.get<any>(`${this.url}/data-charts/expense-by-tags-this-year`).pipe(map((response: any) => response.data))
        .subscribe((data: any) => resolve(data));
    })
  }

}
