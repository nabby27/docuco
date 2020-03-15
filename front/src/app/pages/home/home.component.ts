import { Component, OnInit } from '@angular/core';
import { DocumentsService } from 'src/app/services/documents.service';
import { Document } from 'src/app/entities/document';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

  documents: Document[];

  constructor(
    private documentsService: DocumentsService
  ) { }

  async ngOnInit() {
    this.documents = await this.documentsService.getAllDocuments();
  }

}
