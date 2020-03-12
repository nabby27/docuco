import { DocumentsRepository } from '../repositories/documents.repository.interface';
import { Document } from '../entities/document';

export class GetAllDocumentsAction {

  constructor(
    private documentsRepository: DocumentsRepository,
  ) { }

  execute(): Promise<Document[]> {
    return new Promise((resolve, reject) => {
      this.documentsRepository.getAllDocuments().subscribe(
        (documents: Document[]) => resolve(documents),
        () => reject()
      );
    });
  }

}
