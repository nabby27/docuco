import { Component, Input } from '@angular/core';
import { Document } from 'src/domain/documents/entities/document';

@Component({
  selector: 'app-list-document',
  templateUrl: './list-document.component.html',
  styleUrls: ['./list-document.component.scss']
})
export class ListDocumentComponent {

  @Input() documents: Document[] = [];
  displayedColumns: string[] = ['id', 'name', 'description'];

  constructor() { }

}
