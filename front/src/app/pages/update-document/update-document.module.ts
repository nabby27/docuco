import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { UpdateDocumentComponent } from './update-document.component';
import { Routes, RouterModule } from '@angular/router';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { ReactiveFormsModule } from '@angular/forms';
import { PdfViewerComponent } from './components/pdf-viewer/pdf-viewer.component';
import { DocumentFormComponent } from './components/document-form/document-form.component';
import { PdfViewerModule } from 'ng2-pdf-viewer';
import { SpinnerModule } from 'src/app/shared/spinner/spinner.module';

const routes: Routes = [
  {
    path: '',
    component: UpdateDocumentComponent
  }
];

@NgModule({
  declarations: [
    UpdateDocumentComponent,
    DocumentFormComponent,
    PdfViewerComponent
  ],
  imports: [
    CommonModule,
    MaterialModule,
    SpinnerModule,
    PdfViewerModule,
    ReactiveFormsModule,
    RouterModule.forChild(routes)
  ]
})
export class UpdateDocumentModule { }
