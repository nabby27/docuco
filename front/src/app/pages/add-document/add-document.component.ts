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
    if (this.isFilePDF(file) && this.isLessThan1MB(file)) {
      this.errorType = false;
      this.file = file;
      this.documentsService.setDocumentFileToPreview(this.file);
    } else {
      this.errorType = true;
    }
  }

  private isFilePDF(file: File) {
    return file.type === 'application/pdf';
  }

  private isLessThan1MB(file: File) {
    return (file.size / 1024 / 1024) < 1;
  }

  removeImage() {
    this.file = null;
    this.documentsService.removeDocumentFileToPreview();
  }

}
