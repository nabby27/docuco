import { Observable } from 'rxjs';
import { Document } from '../entities/document';

export interface DocumentsRepository {

    get_all_documents(): Observable<Document[]>;

}