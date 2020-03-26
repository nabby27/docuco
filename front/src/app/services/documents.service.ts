import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Document } from '../entities/document';
import { Observable } from 'rxjs';
import * as moment from 'moment';

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
    data.append('date_of_issue', moment(document.date_of_issue).format("YYYY-MM-DD"));
    data.append('price', document.price);
    data.append('file', this.documentFile);

    this.http.post(this.url, data).subscribe();
  }

  updateDocument(document: any): Promise<void> {
    document.date_of_issue = moment(document.date_of_issue).format("YYYY-MM-DD");
    return new Promise((resolve, reject) => {
      this.http.put<Document>(`${this.url}/${document.id}`, document)
        .subscribe(() => resolve());
    })
  }

  deleteDocument(document: any): Observable<any> {
    return this.http.delete(`${this.url}/${document.id}`);
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
