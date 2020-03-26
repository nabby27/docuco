import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { DateAdapter } from '@angular/material/core';
import { DocumentsService } from 'src/app/services/documents.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Document } from 'src/app/entities/document';
import { Router } from '@angular/router';

@Component({
  selector: 'app-document-form',
  templateUrl: './document-form.component.html',
  styleUrls: ['./document-form.component.scss']
})
export class DocumentFormComponent implements OnInit {

  @Input() file: File;
  @Input() document: Document;

  documentForm: FormGroup;

  isSaving: boolean = false;

  constructor(
    private adapter: DateAdapter<any>,
    private fb: FormBuilder,
    private documentsService: DocumentsService,
    private snackBar: MatSnackBar,
    private router: Router
  ) { }

  ngOnInit() {
    this.adapter.setLocale('es');
    this.setFormData();
  }

  setFormData() {
    this.documentForm = this.fb.group({
      id: [{ value: this.document.id, disabled: false }],
      name: [{ value: this.document.name, disabled: false }, [Validators.required]],
      description: [{ value: this.document.description, disabled: false }],
      type: [{ value: this.document.type, disabled: false }, [Validators.required]],
      date_of_issue: [{ value: this.document.date_of_issue, disabled: false }, [Validators.required]],
      price: [{ value: this.document.price, disabled: false }, [Validators.required]],
    });
  }

  async update() {
    await this.documentsService.updateDocument(this.documentForm.value);
    this.showMessage('Documento actualizado');
    this.router.navigate(['/home']);
  }


  private showMessage(message: string) {
    this.snackBar.open(message, null, {
      duration: 5000,
      verticalPosition: 'top'
    });
  }

}
