import { DocumentsRepository } from '../repositories/documents.repository.interface';
import { Document } from '../entities/document';

export class GetAllDocumentsAction {

    constructor(
        private documents_repository: DocumentsRepository,
    ) { }

    execute(): Promise<Document[]> {
        return new Promise((resolve, reject) => {
            this.documents_repository.get_all_documents().subscribe(
                (documents: Document[]) => resolve(documents),
                () => reject()
            );
        });
    }

}
