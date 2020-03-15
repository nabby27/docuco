import { Component, Input, OnInit, OnChanges } from '@angular/core';
import { MatTableDataSource } from '@angular/material/table';
import { Document } from 'src/app/entities/document';

@Component({
  selector: 'app-list-document',
  templateUrl: './list-document.component.html',
  styleUrls: ['./list-document.component.scss']
})
export class ListDocumentComponent implements OnChanges {

  @Input() documents: Document[];
  dataSource: MatTableDataSource<any>;
  displayedColumns: string[] = ['id', 'name', 'description', 'date_of_issue', 'price', 'download'];

  constructor() {
  }

  ngOnChanges() {
    this.dataSource = new MatTableDataSource(this.documents);
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();
  }

}
