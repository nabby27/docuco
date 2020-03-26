import { Component, Input, OnChanges, OnInit, Output, EventEmitter } from '@angular/core';
import { MatTableDataSource } from '@angular/material/table';
import { Document } from 'src/app/entities/document';
import { DocumentsService } from 'src/app/services/documents.service';
import { UsersService } from 'src/app/services/users.service';
import { Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { DialogComponent } from 'src/app/shared/dialog/dialog.component';
import { MatDialog, MatDialogRef } from '@angular/material/dialog';

@Component({
  selector: 'app-list-document',
  templateUrl: './list-document.component.html',
  styleUrls: ['./list-document.component.scss']
})
export class ListDocumentComponent implements OnInit, OnChanges {

  @Input() documents: Document[];
  @Output() documentDeleted = new EventEmitter();

  dialogRef: MatDialogRef<DialogComponent>;

  url = `${environment.url}`;
  dataSource: MatTableDataSource<any>;
  displayedColumns: string[] = ['name', 'description', 'date_of_issue', 'price', 'type', 'file'];

  constructor(
    private router: Router,
    private documentsService: DocumentsService,
    private usersService: UsersService,
    private dialog: MatDialog
  ) { }

  ngOnInit() {
    if (this.usersService.hasPermissionToEdit()) {
      this.displayedColumns.unshift('delete', 'edit');
    }
  }

  ngOnChanges() {
    if (this.documents) {
      this.documents.map(document => document.type = document.type === 'INCOME' ? 'Ingreso' : 'Gasto')
      this.dataSource = new MatTableDataSource(this.documents);
    }
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();
  }

  goToUpdate(document: Document) {
    this.router.navigate(['update-document', document.id]);
  }

  removeDocument(document: Document) {
    this.documentsService.deleteDocument(document).subscribe(
      () => this.documentDeleted.emit()
    );
    this.dialogRef.close();
  }

  openDialog(document) {
    this.dialogRef = this.dialog.open(DialogComponent, {
      width: '20vw',
      data: {
        text: `¿Quieres eliminar el documento '${document.name}'?`,
        clickFn: () => this.removeDocument(document)
      }
    });
  }
}
