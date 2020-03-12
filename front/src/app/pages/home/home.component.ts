import { Component, OnInit } from '@angular/core';
import { DocumentsRepositoryAPI } from 'src/infraestructure/repositories/documents.repository.api';
import { Document } from 'src/domain/documents/entities/document';
import { GetAllDocumentsAction } from 'src/domain/documents/actions/getAllDocuments.action';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

  documents: Document[] = [];

  constructor(
    private documentsRepositoryApi: DocumentsRepositoryAPI
  ) { }

  async ngOnInit() {
    const getAllDocumentsAction = new GetAllDocumentsAction(this.documentsRepositoryApi);
    this.documents = await getAllDocumentsAction.execute();
  }

}
