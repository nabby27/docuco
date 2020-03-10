import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { environment } from '../../environments/environment';
import { Document } from '../../domain/documents/entities/document';
import { DocumentsRepository } from '../../domain/documents/repositories/documents.repository.interface';

@Injectable({
    providedIn: 'root'
})
export class DocumentsRepositoryAPI implements DocumentsRepository {

    url = `${environment.baseUrl}/documents`;

    constructor(
        private http: HttpClient
    ) { }

    get_all_documents(): Observable<Document[]> {
        return this.http.get<Document[]>(this.url)
            .pipe(map((response: any) => response.documents));
    }

}
