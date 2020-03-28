import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { MyPdfViewerComponent } from './my-pdf-viewer.component';
import { PdfViewerModule } from 'ng2-pdf-viewer';



@NgModule({
  declarations: [
    MyPdfViewerComponent
  ],
  imports: [
    CommonModule,
    MaterialModule,
    PdfViewerModule
  ],
  exports: [
    MyPdfViewerComponent
  ]
})
export class MyPdfViewerModule { }
