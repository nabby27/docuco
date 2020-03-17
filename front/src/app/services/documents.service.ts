import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Document } from '../entities/document';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class DocumentsService {

  url = `${environment.baseUrl}/documents`;
  documentFile: File;

  constructor(private http: HttpClient) { }

  getAllDocuments(): Promise<Document[]> {
    return new Promise((resolve, reject) => {
      this.http.get<Document[]>(this.url).pipe(map((response: any) => response.documents))
        .subscribe((documents: Document[]) => resolve(documents));
    })
  }

  getOneDocument(documentId): Promise<Document> {
    return new Promise((resolve, reject) => {
      this.http.get<Document>(`${this.url}/${documentId}`).pipe(map((response: any) => response.document))
        .subscribe((document: Document) => resolve(document));
    })
  }

  saveDocument(document: any): void {
    let data: FormData = new FormData();
    data.append('name', document.name);
    data.append('description', document.description ? document.description : '');
    data.append('type', document.type);
    data.append('date_of_issue', document.date_of_issue.toISOString().split('T')[0]);
    data.append('price', document.price);
    data.append('file', this.documentFile);

    this.http.post(this.url, data).subscribe();
  }

  updateDocument(document: any): void {
    this.http.put<Document>(`${this.url}/${document.id}`, document).subscribe();
  }

  deleteDocument(document: any): Observable<any> {
    return this.http.delete(`${this.url}/${document.id}`);
  }

  getDocumentsToBarChart(): Promise<any> {
    return new Promise((resolve, reject) => {
      this.http.get(`${this.url}/bar-chart`)
        .subscribe((data: any) => resolve(data.data_chart));
    })
  }

  getDocumentsToPieChart(): Promise<any> {
    return new Promise((resolve, reject) => {
      this.http.get(`${this.url}/pie-chart`)
        .subscribe((data: any) => resolve(data.data_chart));
    })
  }

  setDocumentFileToPreview(documentToPreview: File) {
    this.documentFile = documentToPreview;
  }

  getDocumentFileToPreview() {
    return this.documentFile;
  }

  removeDocumentFileToPreview() {
    this.documentFile = null;
  }
}
