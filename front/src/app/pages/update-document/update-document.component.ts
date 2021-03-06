import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { DocumentsService } from 'src/app/services/documents.service';
import { Document } from 'src/app/entities/document';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-update-document',
  templateUrl: './update-document.component.html',
  styleUrls: ['./update-document.component.scss']
})
export class UpdateDocumentComponent implements OnInit {
  
  url = `${environment.url}`;
  errorType: boolean = false;
  documentFileForm: FormGroup;
  file: File;
  document: Document;

  constructor(
    private fb: FormBuilder,
    private router: Router,
    private activatedRoute: ActivatedRoute,
    private documentsService: DocumentsService
  ) { }

  async ngOnInit() {
    const documentId = this.activatedRoute.snapshot.paramMap.get('documentId');
    this.document = await this.documentsService.getOneDocument(documentId);

    this.documentFileForm = this.fb.group({
      file: [{ value: this.file, disabled: false }, [Validators.required]]
    });
  }

  goToHome() {
    this.router.navigate(['/home']);
  }

}
