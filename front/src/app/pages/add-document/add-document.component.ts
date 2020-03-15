import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { DocumentsService } from 'src/app/services/documents.service';

@Component({
  selector: 'app-add-document',
  templateUrl: './add-document.component.html',
  styleUrls: ['./add-document.component.scss']
})
export class AddDocumentComponent implements OnInit {

  errorType: boolean = false;
  documentFileForm: FormGroup;
  file: File;

  constructor(
    private fb: FormBuilder,
    private documentsService: DocumentsService
  ) { }

  ngOnInit() {
    this.file = this.documentsService.getDocumentFileToPreview();

    this.documentFileForm = this.fb.group({
      file: [{ value: this.file, disabled: false }, [Validators.required]]
    });
  }

  renderView(file: File): void {
    if (file.type === 'application/pdf') {
      this.errorType = false;
      this.file = file;
      this.documentsService.setDocumentFileToPreview(this.file);
    } else {
      this.errorType = true;
    }
  }

  removeImage() {
    this.file = null;
    this.documentsService.removeDocumentFileToPreview();
  }

}
