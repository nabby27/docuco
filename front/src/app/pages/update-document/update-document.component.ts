import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { DocumentsService } from 'src/app/services/documents.service';
import { RouterService } from 'src/app/services/router.service';
import { Document } from 'src/app/entities/document';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-update-document',
  templateUrl: './update-document.component.html',
  styleUrls: ['./update-document.component.scss']
})
export class UpdateDocumentComponent implements OnInit {

  errorType: boolean = false;
  documentFileForm: FormGroup;
  file: File;
  document: Document;

  constructor(
    private fb: FormBuilder,
    private routerService: RouterService,
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
    this.routerService.goTo('/home');
  }

}
