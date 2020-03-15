import { Component, OnInit, Input } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { DateAdapter } from '@angular/material/core';
import { DocumentsService } from 'src/app/services/documents.service';

@Component({
  selector: 'app-document-form',
  templateUrl: './document-form.component.html',
  styleUrls: ['./document-form.component.scss']
})
export class DocumentFormComponent implements OnInit {

  @Input() file: File;

  documentForm: FormGroup;
  name: string;
  description: string;
  date_of_issue: Date;
  price: number;
  type: string;

  isSaving: boolean = false;

  constructor(
    private adapter: DateAdapter<any>,
    private fb: FormBuilder,
    private documentsService: DocumentsService
  ) { }

  ngOnInit() {
    this.adapter.setLocale('es');
    this.setFormData();
  }

  setFormData() {
    this.documentForm = this.fb.group({
      name: [{ value: this.name, disabled: false }, [Validators.required]],
      description: [{ value: this.description, disabled: false }],
      type: [{ value: '', disabled: false }, [Validators.required]],
      date_of_issue: [{ value: this.date_of_issue, disabled: false }, [Validators.required]],
      price: [{ value: this.price, disabled: false }, [Validators.required]],
    });
  }

  save() {
    this.documentsService.saveDocument(this.documentForm.value);
  }

}
