import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AddDocumentComponent } from './add-document.component';
import { Routes, RouterModule } from '@angular/router';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { ReactiveFormsModule } from '@angular/forms';
import { DragDropDirective } from './directives/drag-drop.directive';
import { DocumentFormComponent } from './components/document-form/document-form.component';
import { SpinnerModule } from 'src/app/shared/spinner/spinner.module';
import { MyPdfViewerModule } from 'src/app/shared/pdf-viewer/my-pdf-viewer.module';

const routes: Routes = [
  {
    path: '',
    component: AddDocumentComponent
  }
];

@NgModule({
  declarations: [
    AddDocumentComponent,
    DragDropDirective,
    DocumentFormComponent,
  ],
  imports: [
    CommonModule,
    MaterialModule,
    SpinnerModule,
    MyPdfViewerModule,
    ReactiveFormsModule,
    RouterModule.forChild(routes)
  ]
})
export class AddDocumentModule { }
