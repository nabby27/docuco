import { Component, OnInit } from '@angular/core';
import { DocumentsRepositoryAPI } from 'src/infraestructure/repositories/documents.repository.api';
import { Document } from 'src/domain/documents/entities/document';
import { GetAllDocumentsAction } from 'src/domain/documents/actions/GetAllDocuments.action';

@Component({
    selector: 'app-home',
    templateUrl: './home.component.html',
    styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

    documents: Document[] = []

    constructor(
        private documents_repository_api: DocumentsRepositoryAPI
    ) { }

    async ngOnInit() {
        const get_all_documents_action = new GetAllDocumentsAction(this.documents_repository_api);
        this.documents = await get_all_documents_action.execute();

        debugger
    }

}
