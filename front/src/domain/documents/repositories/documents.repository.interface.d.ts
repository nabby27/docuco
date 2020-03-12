import { Observable } from 'rxjs';
import { Document } from '../entities/document';

export interface DocumentsRepository {

  getAllDocuments(): Observable<Document[]>;

}